<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Components\Controller as baseController;

class MainController extends baseController{

	public function __construct(){
		parent::__construct();
		$this->userAccess();
	}

	public function main(){

		$this->loadTemplate('main.tpl',[], ['path' => 'frontend/userTool/']);
	}


}