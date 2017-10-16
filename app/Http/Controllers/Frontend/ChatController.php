<?php
namespace app\Http\Controllers\Frontend;

use Atl\Foundation\Request;
use App\Http\Components\Frontend\Controller as baseController;


class ChatController extends baseController{

	public function __construct()
    {
        parent::__construct();
        $this->userAccess();

    }

    public function addChat(Request $request){

    }

}