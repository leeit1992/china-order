<?php
namespace App\Http\Controllers\Backend;

use Atl\Foundation\Request;
use App\Http\Components\Backend\Controller as baseController;
use Atl\Validation\Validation;
use App\Model\UserModel;
use App\Http\Components\ApiHandlePrice;
use App\Model\NoticeModel;

class UsersController extends baseController
{
    public function __construct()
    {
        parent::__construct();
        $this->userAccess();

        // Model data system.
        $this->mdUser = new UserModel;
        $this->mdNotice = new NoticeModel;
        $this->helperPrice = ApiHandlePrice::getInstance();
    }

    public function userManage()
    {
        $this->loadTemplate('user/userManage.tpl', [
            'listUser' => $this->mdUser->getUserList(),
            'noticeSuccess' => Session()->getFlashBag()->get('noticeSuccess')
        ], ['path' => 'backend/']);
    }

    public function userEdit($id)
    {
        $infoUser = $this->mdUser->getUserBy( 'id', $id );
        $metaData = $this->mdUser->getAllMetaData( $id );
        //print_r($metaData);die;
        $this->loadTemplate('user/userEdit.tpl', [
            'infoUser' => $infoUser[0],
            'metaData' => $metaData,
            'apiHandlePrice' => $this->helperPrice,
            'noticeSuccess' => Session()->getFlashBag()->get('noticeSuccess'),
            'noticeError' => Session()->getFlashBag()->get('noticeError')
        ], ['path' => 'backend/']);
    }

    public function editUserValidate( Request $request )
    {
        $validator = new Validation;
        $validator->add (
            [
                'avt_user_display_name:User name' => 'required',
                'avt_user_money:Number nmney' => 'required'
            ]
        );
        $message = [];
        if ( $validator->validate( $_POST ) ) {
            $this->mdUser->save( 
                [
                    'user_display_name' => $request->get('avt_user_display_name'),
                    'user_money'        => $this->helperPrice->convertPriceToInt( $request->get('avt_user_money') )
                ],
                $request->get('avt_user_id')
            );
            /**
             * Add meta data for user.
             */
            $userMeta = [
                'user_level' => $request->get('avt_user_level'),
                'user_debt'  => !empty($request->get('avt_user_debt')) ? $request->get('avt_user_debt') : 'no'
            ];
            // Loop add add | update meta data.
            foreach ($userMeta as $mtaKey => $metaValue) {
                $this->mdUser->setMetaData( $request->get('avt_user_id'), $mtaKey, $metaValue );
            }

            Session()->getFlashBag()->set( 'noticeSuccess', 'Change info user succes !' );
            redirect( url( '/admcp/user-edit/'. $request->get('avt_user_id') ) );
        } else {
            foreach ( $validator->getAllErrors() as $value ) {
                $message[] = $value;
            }
        }
        if ( !empty( $message ) ) {
            Session()->getFlashBag()->set( 'noticeError', $message );
            redirect( url( '/admcp/user-edit/'. $request->get('avt_user_id') ) );
        }
    }

    public function deleteUser( $id ){
        // Remove user
        $this->mdUser->delete( $id );
        // Remove metadata
        $this->mdUser->deleteMetaData( $id );
        Session()->getFlashBag()->set( 'noticeSuccess', 'Delete user succes !' );
        redirect( url('/admcp/user-manage') );
    }

    public function noticeManage()
    {
        $this->loadTemplate('user/noticeManage.tpl', [
            'listNotice' => $this->mdNotice->getBy( 'notice_receiver', Session()->get('avt_admin_user_id')),
            'noticeSuccess' => Session()->getFlashBag()->get('noticeSuccess')
        ], ['path' => 'backend/']);
    }

    public function deleteNotice( $id ){
        // Remove user
        $this->mdNotice->delete( $id );

        Session()->getFlashBag()->set( 'noticeSuccess', 'Delete notice succes !' );
        redirect( url('/admcp/notice-manage') );
    }
}
