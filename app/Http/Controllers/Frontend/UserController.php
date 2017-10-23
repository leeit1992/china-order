<?php
namespace App\Http\Controllers\Frontend;

use Atl\Foundation\Request;
use App\Http\Components\Frontend\Controller as baseController;
use Atl\Validation\Validation;
use App\Model\UserModel;
use App\Http\Components\ApiHandlePrice;
use App\Model\NoticeModel;

class UserController extends baseController
{

    public function __construct()
    {
        parent::__construct();

        // Model data system.
        $this->mdUser = new UserModel;
        $this->mdNotice = new NoticeModel;
    }

    public function login()
    {

        if (true === Session()->has('avt_user_id')) {
            redirect(url('/user-tool'));
            return true;
        }

        View(
            'frontend/userTool/user/login.tpl',
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

            $checkUser = $user->checkLogin($request->get('avt_email'), md5($request->get('avt_password')));
            
            if (!empty($checkUser)) {
                Session()->set('avt_user_id', $checkUser[0]['id']);
                Session()->set('avt_user_name', $checkUser[0]['user_name']);
                Session()->set('avt_user_email', $checkUser[0]['user_email']);
                Session()->set('avt_user_meta', $user->getAllMetaData($checkUser[0]['id']));

                redirect(url('/user-tool'));
            } else {
                $error[] = 'error';
            }
        } else {
            $error[] = 'error';
        }

        if (!empty($error)) {
            Session()->getFlashBag()->set('loginError', 'Account or Password not match !');
            redirect(url('/user-tool/login'));
        }
    }

    public function logout()
    {
        Session()->remove('avt_user_id');
        Session()->remove('avt_user_name');
        Session()->remove('avt_user_email');

        redirect(url('/user-tool/login'));
    }

    public function register()
    {
        View('frontend/userTool/user/register.tpl', [
            'noticeSuccess' => Session()->getFlashBag()->get('noticeSuccess'),
            'noticeError' => Session()->getFlashBag()->get('noticeError')
        ]);
    }

    /**
     * Handle validate form user.
     * 
     * @param  Request $request Request POST | GET method
     * @return void.
     */
    public function validateUser( Request $request )
    {
        $validator = new Validation;
        $validator->add (
            [
                'avt_user_password:Confirm password' => 'required | minlength(4) | match(item=avt_user_pass)'
            ]
        );
        $message = [];
        if ( $validator->validate( $_POST ) ) {
            if ($request->get( 'avt_user_rules' ) == 'on') {
                $emailExists = $this->mdUser->getUserBy( 'user_email', $request->get( 'avt_user_email' ) );
                if ( empty( $emailExists ) ) {
                    $this->mdUser->save( 
                        [
                            'user_name'         => $request->get('avt_user_name'),
                            'user_password'     => $this->isValidMd5( $request->get('avt_user_pass') ) ? $request->get('avt_user_pass') : md5( $request->get('avt_user_pass') ),
                            'user_email'        => $request->get('avt_user_email'),
                            'user_registered'   => date("Y-m-d H:i:s"),
                            'user_status'       => 1,
                            'user_display_name' => $request->get('avt_user_name'),
                            'user_role'         => 2,
                            'user_money'        => 0
                        ]
                    );
                    /**
                     * Add meta data for user.
                     */
                    $userMeta = [
                        'user_level' => 'normal',
                        'user_debt'  => 'no'
                    ];
                    // Loop add add | update meta data.
                    foreach ($userMeta as $mtaKey => $metaValue) {
                        $this->mdUser->setMetaData( $request->get('avt_user_id'), $mtaKey, $metaValue );
                    }

                    Session()->getFlashBag()->set( 'noticeSuccess', 'Register account succes !' );
                    redirect( url( '/user-tool/register' ) );
                } else {
                    $message[] = 'This account already exists!';
                }
            } else {
                $message[] = 'Please choose accept content rules!';
            }
        } else {
            foreach ( $validator->getAllErrors() as $value ) {
                $message[] = $value;
            }
        }
        if ( !empty( $message ) ) {
            Session()->getFlashBag()->set( 'noticeError', $message );
            redirect( url( '/user-tool/register' ) );
        }
    }

    public function userUpdateProfile()
    {
        $this->userAccess();
        $this->loadTemplate('user/user-update.tpl', [
            'noticeSuccess' => Session()->getFlashBag()->get('noticeSuccess'),
            'noticeError' => Session()->getFlashBag()->get('noticeError')
        ], ['path' => 'frontend/userTool/']);
    }

    public function userInfo()
    {
        $this->userAccess();
        $this->loadTemplate('user/user-info.tpl', [
            'userInfo' => $this->mdUser->getUserBy('id', Session()->get('avt_user_id')),
            'apiHandlePrice' => ApiHandlePrice::getInstance()
        ], ['path' => 'frontend/userTool/']);
    }

    public function changePass(Request $request)
    {
        $validator = new Validation;
        $validator->add(
            [
                'avt_pass_old:Password Old'   => 'required | minlength(4)',
                'avt_pass:Password'   => 'required | minlength(4)',
                'avt_pass_confirm:Confirm password' => 'required | minlength(4) | match(item=avt_pass)',
            ]
        );

        $error = [];

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
                redirect(url('/user-tool/user-update-profile'));
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
            redirect(url('/user-tool/user-update-profile'));
        }
    }

    public function noticeManage()
    {
        $this->loadTemplate('user/noticeManage.tpl', [
            'listNotice' => $this->mdNotice->getBy( 'notice_receiver', Session()->get('avt_user_id')),
            'noticeSuccess' => Session()->getFlashBag()->get('noticeSuccess')
        ], ['path' => 'frontend/userTool/']);
    }

    public function deleteNotice( $id ){
        // Remove user
        $this->mdNotice->delete( $id );

        Session()->getFlashBag()->set( 'noticeSuccess', 'Delete notice succes !' );
        redirect( url('/user-tool/notice-manage') );
    }
}
