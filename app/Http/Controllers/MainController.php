<?php
namespace App\Http\Controllers;

use Atl\Routing\Controller as baseController;
use Atl\Validation\Validation;
use Atl\Foundation\Request;
use Atl\Pagination\Pagination;
use App\Model\NoticeModel;
use App\Model\PageModel;

class MainController extends baseController{

	public function __construct(){
		parent::__construct();
	}

	public function index( $page = null ){
		
		// Session
		// Session()->set('name','Test Session');
		// echo Session()->get('name');

		// Session flash
		// var_dump(Session()->getFlashBag()->set('name', 'Test'));
		// var_dump(Session()->getFlashBag()->has('name'));
		// var_dump(Session()->getFlashBag()->get('name'));

        //Get Start query
        //echo $pagination->getStartResult( $page );

		// Load layout.
		$mdPage = new PageModel;
		$listMenu = $mdPage->getMenuList();
		$output = View('layout/header', 
				array(
					'apiSlug' => $this,
					'listMenu' => $listMenu,
					'pageCurrent' => 0,
				)
			);
		$listFeatured = $mdPage->getFeaturesList();
		$output .= View('index', array(
					'listFeatured' => $listFeatured,
				));
		$output .= View('layout/footer');
		
		return $output; $this->redirectToRoute();
	}

	public function singlePage( $id = null )
	{
		$mdPage = new PageModel;
		$listMenu = $mdPage->getMenuList();
		$output = View('layout/header', 
				array( 
					'listMenu' => $listMenu,
					'apiSlug' => $this,
					'pageCurrent' => $id,
				)
			);
		$infoPage = $mdPage->getPageBy( 'id', $id );
		$output .= View('single-page.tpl', 
					array( 
					'infoPage' => $infoPage[0]
				)
			);
		$output .= View('layout/footer');
	}

	/**
	 * Check method get from http request
	 * @return void
	 */
	public function checkRouteGet( $id ){
		echo '<h1>Is numner ' . $id . '</h1>';
	}

	/**
	 * Check method post from http request
	 * @return void
	 */
	public function checkRoutePost(){
		$validator = new Validation;
		$validator->add(array('text:text' => 'required | minlength(10)'));
		
		if ($validator->validate($_POST)) {
			var_dump($_POST);
		} else{
			var_dump($validator->getMessages());
		}
	}
	/**
	 * Handle status notice
	 * 
	 * @param  Request $request POST | GET
	 * @return 
	 */
	public function handleNoticeStatus( Request $request ) {
		$mdNotice = new NoticeModel;
		$message = [];
		$notice = $mdNotice->getBy( 'id' , $request->get('id') );
		if ( $notice[0]['notice_status'] == 1 ) {
			$mdNotice->save( 
				[
					'notice_status' => 2,
				],
				$request->get('id')
			);
			$message['status'] = true;
		}else{
			$message['status'] = false;
		}
		echo json_encode($message);
	}

	public function slug($str, $is_url = false, $lower = true) {
        $str = strip_tags(trim($str));
        $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
        $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
        $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
        $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
        $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
        $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
        $str = preg_replace("/(Đ)/", 'D', $str);

        $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/i", 'a', $str);
        $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/i", 'e', $str);
        $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/i", 'i', $str);
        $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/i", 'o', $str);
        $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/i", 'u', $str);
        $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/i", 'y', $str);
        $str = preg_replace("/(đ)/i", 'd', $str);
        $str = preg_replace(array('#(amp;|quot;|;|-)#i', '#[^\w]+#i', '#[\s]+#iU'), '-', $str);
        $str = trim($str, '- ');
        $str = $lower ? strtolower($str) : $str;
        return $str;
    }

}