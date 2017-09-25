<?php
namespace App\Http\Controllers\Backend;

use Atl\Foundation\Request;
use App\Http\Components\Backend\Controller as baseController;
use Atl\Validation\Validation;
use App\Model\UserModel;

class UsersController extends baseController
{

    public function __construct()
    {
        parent::__construct();
        $this->userAccess();

        // Model data system.
        $this->mdUser = new UserModel;
    }

    public function userManage()
    {

        $this->loadTemplate('user/userManage.tpl', [
            'listUser' => $this->mdUser->getUserList()
        ], ['path' => 'backend/']);
    }
}
