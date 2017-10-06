<?php

namespace app\Http\Controllers\Frontend;

use Atl\Foundation\Request;
use App\Http\Components\ApiHandlePrice;
use App\Http\Components\Frontend\Controller as baseController;
use App\Model\BillofladingModel;
use App\Model\OrderModel;

class TransportController extends baseController
{
    public function __construct()
    {
        parent::__construct();
        $this->userAccess();
        $this->mdBillofladingModel = new BillofladingModel;
        $this->mdOrder = new OrderModel;

    }

    public function manageList()
    {
        $listData = $this->mdBillofladingModel->getAll();
        $this->loadTemplate('transport/manage.tpl', [
            'listData' => $listData,
            'apiHandlePrice' => ApiHandlePrice::getInstance(),
            'mdOrder' => $this->mdOrder
        ], ['path' => 'frontend/userTool/']);
    }

   
}
