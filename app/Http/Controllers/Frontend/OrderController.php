<?php
namespace App\Http\Controllers\Frontend;

use Atl\Foundation\Request;
use App\Http\Components\ApiHandlePrice;
use App\Http\Components\Frontend\Controller as baseController;

use App\Model\OrderModel;
use App\Model\OrderItemModel;
use App\Model\UserModel;

class OrderController extends baseController
{

    public function __construct()
    {
        parent::__construct();
        $this->userAccess();

        $this->mdOrder = new OrderModel;
        $this->mdOrderItem = new OrderItemModel;
        $this->mdUser = new UserModel;
    }

    public function orderSuccess($id = null)
    {
        $this->loadTemplate('order/order-notice.tpl', [
            'id' => $id
        ], ['path' => 'frontend/userTool/']);
    }

    public function orderManage()
    {

        $listOrder = $this->mdOrder->getAll();

        $notPayment = $this->mdOrder->getBy('order_status', 1);
        $payWaitBuy = $this->mdOrder->getBy('order_status', 2);
        $delivery = $this->mdOrder->getBy('order_delivery_status', 2);
        $hasBuy = $this->mdOrder->getBy('order_buy_status', 2);
        $outStock = $this->mdOrder->getBy('order_buy_status', 3);

        $this->loadTemplate('order/order-manage.tpl', [
            'listOrder' => $listOrder,
            'notPayment' => $notPayment,
            'payWaitBuy' => $payWaitBuy,
            'delivery'   => $delivery,
            'hasBuy'     => $hasBuy,
            'outStock'     => $outStock,
            'apiHandlePrice' => ApiHandlePrice::getInstance()
        ], ['path' => 'frontend/userTool/']);
    }

    public function orderDetail($id)
    {
        $listItem = $this->mdOrderItem->getBy('order_id', $id);
        $orderInfo = $this->mdOrder->getBy('id', $id);

        $this->loadTemplate('order/detail-order.tpl', [
            'orderInfo' => $orderInfo,
            'listItem' => $listItem,
            'apiHandlePrice' => ApiHandlePrice::getInstance(),
            'updateOrderNotice' => Session()->getFlashBag()->get('updateOrder'),
        ], ['path' => 'frontend/userTool/']);
    }

    public function updateOrder(Request $request)
    {
        $infoUser = $this->mdUser->getUserBy('id', Session()->get('avt_user_id'));
        $infoOrder = $this->mdOrder->getBy('id', $request->get('avt_oder_id'));

        $priceCount = $request->get('avt_pay_type') / 100 * $infoOrder[0]['order_total_price_vn'];

        if ($infoUser[0]['user_money'] > $priceCount) {
            $argsSave = [
                'order_info_pay' => json_decode([
                    'rest_percent' => 100 - $request->get('avt_pay_type'),
                    'has_pay' => $priceCount,
                    'rest_pay' => $infoOrder[0]['order_total_price_vn'] - $priceCount
                ]),
                'order_status' => 2,
                
            ];
            $this->mdOrder->save($argsSave, $request->get('avt_oder_id'));
        } else {
            Session()->getFlashBag()->set('updateOrder', ['type' => false, 'notice' => 'Tiền trong tải khoản của bạn không đủ. vui lòng nạp thêm tiền vào tài khoản.']);
        }

        redirect(url('/user-tool/detail-order/' . $request->get('avt_oder_id')));
    }
}
