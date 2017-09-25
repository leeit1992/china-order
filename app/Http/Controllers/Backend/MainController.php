<?php
namespace App\Http\Controllers\Backend;

use App\Http\Components\Backend\Controller as baseController;

class MainController extends baseController{

	public function __construct(){
		parent::__construct();
		$this->userAccess();
	}

	public function main(){
		$this->loadTemplate('main.tpl',[], ['path' => 'backend/']);

	}


}