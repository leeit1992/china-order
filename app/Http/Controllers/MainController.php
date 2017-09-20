<?php
namespace App\Http\Controllers;

use Atl\Routing\Controller as baseController;
use Atl\Validation\Validation;
use Atl\Pagination\Pagination;


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

}