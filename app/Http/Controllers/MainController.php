<?php
namespace App\Http\Controllers;

use Atl\Routing\Controller as baseController;
use Atl\Validation\Validation;
use Atl\Foundation\Request;
use Atl\Pagination\Pagination;
use App\Model\NoticeModel;

class MainController extends baseController{

	public function index( $page = null ){
		
		// Session
		// Session()->set('name','Test Session');
		// echo Session()->get('name');

		// Session flash
		// var_dump(Session()->getFlashBag()->set('name', 'Test'));
		// var_dump(Session()->getFlashBag()->has('name'));
		// var_dump(Session()->getFlashBag()->get('name'));

        $ofset                = 10;
        $config['pageStart']  = $page;
        $config['ofset']      = $ofset;
        $config['totalRow']  = 50;
        $config['baseUrl']   = url('/page/');

        $pagination          = new Pagination($config);

        //Get Start query
        //echo $pagination->getStartResult( $page );

		// Load layout.
		$output = View('layout/header');
		$output .= View('atlFramework', array( 'link' => $pagination->link( $config ) ));
		$output .= View('layout/footer');
		
		return $output; $this->redirectToRoute();
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

}