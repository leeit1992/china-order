<?php
namespace App\Http\Controllers\Backend;

use Atl\Foundation\Request;
use App\Http\Components\Backend\Controller as baseController;
use Atl\Validation\Validation;
use App\Model\PageModel;
use App\Model\NoticeModel;

class PagesController extends baseController
{
    public function __construct()
    {
        parent::__construct();
        $this->userAccess();

        // Model data system.
        $this->mdPage = new PageModel;
        $this->mdNotice = new NoticeModel;
    }

    public function pageManage()
    {
        $listPage = $this->mdPage->getPageList();
        $this->loadTemplate('page/pageManage.tpl', [
            'listPage' => $listPage,
            'noticeSuccess' => Session()->getFlashBag()->get('noticeSuccess')
        ], ['path' => 'backend/']);
    }

    public function menuManage()
    {
        $listMenu = $this->mdPage->getMenuList();
        $this->loadTemplate('page/menuManage.tpl', [
            'listMenu' => $listMenu,
            'noticeSuccess' => Session()->getFlashBag()->get('noticeSuccess')
        ], ['path' => 'backend/']);
    }

    public function handlePage( $id = null )
    {   
        $infoPage   = [];
        if ( $id ) {
            $infoPage = $this->mdPage->getPageBy( 'id', $id );
        }
        $this->loadTemplate('page/pageAdd.tpl', [
            'infoPage' => !empty( $infoPage[0] ) ? $infoPage[0] : [],
            'actionName' => ( $id ) ? 'Sửa ' : 'Tạo mới ',
            'noticeSuccess' => Session()->getFlashBag()->get('noticeSuccess'),
            'noticeError' => Session()->getFlashBag()->get('noticeError')
        ], ['path' => 'backend/']);
    }

    public function validatePage( Request $request )
    {
        $validator = new Validation;
        $validator->add (
            [
                'avt_page_title:Tiêu đề' => 'required',
                'avt_page_description:Mô tả' => 'required',
                'avt_page_content:Nội dung' => 'required',
            ]
        );
        $message = [];
        if ( $validator->validate( $_POST ) ) {
            $pageID = $this->mdPage->save( 
                [
                    'page_title' => $request->get('avt_page_title'),
                    'page_description' => $request->get('avt_page_description'),
                    'page_content' => $request->get('avt_page_content'),
                    'page_menu' => !empty($request->get('avt_page_menu')) ? $request->get('avt_page_menu') : 'no',
                    'page_featured' => !empty($request->get('avt_page_featured')) ? $request->get('avt_page_featured') : 0,
                    'page_order' => !empty($request->get('avt_page_order')) ? $request->get('avt_page_order') : '',
                    'page_icon' => !empty($request->get('avt_page_icon')) ? $request->get('avt_page_icon') : '',
                    'page_date' => date('Y-m-d H:s:j')
                ],
                $request->get('avt_page_id')
            );
            $nameAction = isset( $formData['atl_user_id'] ) ? 'Sửa ' : 'Tạo mới ';
            Session()->getFlashBag()->set( 'noticeSuccess', $nameAction.' bài viết thành công!' );
            redirect( url( '/admcp/page-edit/'. $pageID ) );
        } else {
            foreach ( $validator->getAllErrors() as $value ) {
                $message[] = $value;
            }
        }
        if ( !empty( $message ) ) {
            Session()->getFlashBag()->set( 'noticeError', $message );
            if ($request->get('avt_page_id')) {
                redirect( url( '/admcp/page-edit/'. $request->get('avt_page_id') ) );
            } else {
                redirect( url( '/admcp/page-add') );
            }
        }
    }

    public function deletePage( $id ){
        // Remove page
        $this->mdPage->delete( $id );

        Session()->getFlashBag()->set( 'noticeSuccess', 'Delete user succes !' );
        redirect( url('/admcp/page-manage') );
    }
}
