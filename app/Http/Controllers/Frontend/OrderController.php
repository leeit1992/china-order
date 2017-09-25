<?php
namespace App\Http\Controllers\Frontend;

use Atl\Foundation\Request;
use App\Http\Components\ApiHandlePrice;
use App\Http\Components\Frontend\Controller as baseController;

use App\Model\OrderModel;
use App\Model\OrderItemModel;


class OrderController extends baseController{

	public function __construct(){
		parent::__construct();
		$this->userAccess();

		$this->mdOrder = new OrderModel;
		$this->mdOrderItem = new OrderItemModel;
	}

	public function orderSuccess(){
		$this->loadTemplate('order/order-notice.tpl',[], ['path' => 'frontend/userTool/']);
	}

	public function orderManage(){

		$listOrder = $this->mdOrder->getAll();

		$notPayment = $this->mdOrder->getBy('order_status', 1);
		$payWaitBuy = $this->mdOrder->getBy('order_status', 2);
		$delivery = $this->mdOrder->getBy('order_delivery_status', 2);
		$hasBuy = $this->mdOrder->getBy('order_buy_status', 2);
		$outStock = $this->mdOrder->getBy('order_buy_status', 3);

		$this->loadTemplate('order/order-manage.tpl',[
			'listOrder' => $listOrder,
			'notPayment' => $notPayment,
			'payWaitBuy' => $payWaitBuy,
			'delivery'   => $delivery,
			'hasBuy'     => $hasBuy,
			'outStock'     => $outStock,

			'apiHandlePrice' => ApiHandlePrice::getInstance()
		], ['path' => 'frontend/userTool/']);
	}

}