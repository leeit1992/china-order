<?php
namespace App\Http\Controllers\Backend;

use Atl\Foundation\Request;
use App\Http\Components\Backend\Controller as baseController;
use Atl\Validation\Validation;
use App\Model\UserModel;

class UserController extends baseController
{

    public function __construct()
    {
        parent::__construct();

        // Model data system.
        $this->mdUser = new UserModel;
    }

    public function login()
    {

        if (true === Session()->has('avt_admin_user_id')) {
            redirect(url('/admcp'));
            return true;
        }

        View(
            'backend/user/login.tpl',
            [
                'noticeLogin' => Session()->getFlashBag()->get('loginError')
            ]
        );
    }

    public function validateLogin(Request $request)
    {
        $validator = new Validation;
        $validator->add(
            [
                'avt_email:Account'   => 'email | required | minlength(6)',
                'avt_password:Password' => 'required | minlength(4)',
            ]
        );

        $error = [];

        if ($validator->validate($_POST)) {
            $user = new UserModel();

            $checkUser = $user->checkLoginAdmin($request->get('avt_email'), md5($request->get('avt_password')));
            
            if (!empty($checkUser)) {
                Session()->set('avt_admin_user_id', $checkUser[0]['id']);
                Session()->set('avt_admin_user_name', $checkUser[0]['user_name']);
                Session()->set('avt_admin_user_email', $checkUser[0]['user_email']);
                Session()->set('avt_admin_user_meta', $user->getAllMetaData($checkUser[0]['id']));

                redirect(url('/admcp'));
            } else {
                $error[] = 'error';
            }
        } else {
            $error[] = 'error';
        }

        if (!empty($error)) {
            Session()->getFlashBag()->set('loginError', 'Account or Password not match !');
            redirect(url('/admcp/login'));
        }
    }

    public function logout()
    {
        Session()->remove('avt_admin_user_id');
        Session()->remove('avt_admin_user_name');
        Session()->remove('avt_admin_user_email');
        redirect(url('/admcp/login'));
    }

    public function userManage()
    {

        $this->loadTemplate('user/userManage.tpl', [
            
        ], ['path' => 'backend/']);
    }

    public function changePassword()
    {
        $this->userAccess();
        $this->loadTemplate('user/userChangePassword.tpl', [
            'noticeSuccess' => Session()->getFlashBag()->get('noticeSuccess'),
            'noticeError' => Session()->getFlashBag()->get('noticeError')
        ], ['path' => 'backend/']);
    }

    public function handleChangePass(Request $request)
    {
        $validator = new Validation;
        $validator->add(
            [
                'avt_pass_old:Password Old'   => 'required | minlength(4)',
                'avt_pass:Password'   => 'required | minlength(4)',
                'avt_pass_confirm:Confirm password' => 'required | minlength(4) | match(item=avt_pass)',
            ]
        );

        $message = [];

        if ($validator->validate($_POST)) {
            $user = new UserModel();

            $checkUser = $user->checkPassword($request->get('avt_id'), md5($request->get('avt_pass_old')));
            
            if (!empty($checkUser)) {
                $user->save( 
                    [
                        'user_password' => md5( $request->get('avt_pass') ),
                    ],
                    $request->get('avt_id')
                );
                Session()->getFlashBag()->set('noticeSuccess', 'Change password succes !');
                redirect(url('/admcp/change-pass'));
            } else {
                $message[] = 'Password old not match !';
            }
        } else {
            foreach ($validator->getAllErrors() as $value) {
                $message[] = $value;
            }
        }
        if (!empty($message)) {
            Session()->getFlashBag()->set('noticeError', $message);
            redirect(url('/admcp/change-pass'));
        }
    }
}
