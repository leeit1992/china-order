<?php
namespace App\Http\Controllers\Backend;

use Atl\Foundation\Request;
use App\Http\Components\ApiHandlePrice;
use App\Http\Components\Backend\Controller as baseController;

use App\Model\OrderModel;
use App\Model\OrderItemModel;

class OrderController extends baseController
{

    public function __construct()
    {
        parent::__construct();
        $this->userAccess();

        $this->mdOrder = new OrderModel;
        $this->mdOrderItem = new OrderItemModel;
    }

    public function orderSuccess()
    {
        $this->loadTemplate('order/order-notice.tpl', [], ['path' => 'frontend/userTool/']);
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
        ], ['path' => 'backend/']);
    }

    public function orderDetail($id)
    {
        $listItem = $this->mdOrderItem->getBy('order_id', $id);
        $orderInfo = $this->mdOrder->getBy('id', $id);

        $this->loadTemplate('order/detail-order.tpl', [
            'orderInfo' => $orderInfo,
            'listItem' => $listItem,
            'apiHandlePrice' => ApiHandlePrice::getInstance()
        ], ['path' => 'backend/']);
    }

    public function updateOrder(Request $request)
    {

        foreach ($request->get('avt_order_item') as $keyId => $value) {
            $this->mdOrderItem->save([
                'order_item_real_purchase' => $value['purchase_number']
            ], $keyId);
        }

        $listItem = $this->mdOrderItem->getBy('order_id', $request->get('avt_oder_id'));

        $orderRealPurchase = 0;
        foreach ($listItem as $value) {
            $orderRealPurchase += $value['order_item_real_purchase'];
        }

        $argsSave = [
            'order_real_purchase' => $orderRealPurchase
        ];

        if (1 == $request->get('avt_has_pay')) {
            $argsSave['order_status'] = 2;
        }

        if (1 == $request->get('avt_has_purchase')) {
            $argsSave['order_buy_status'] = 2;
        }

        if (1 == $request->get('avt_has_delivery')) {
            $argsSave['order_delivery_status'] = 2;
        }

        if (1 == $request->get('avt_has_end')) {
            $argsSave['order_buy_status'] = 3;
        }

        $this->mdOrder->save($argsSave, $request->get('avt_oder_id'));

        redirect(url('/admcp/detail-order/' . $request->get('avt_oder_id')));
    }

    /**
     * Handle filter Order
     * 
     * @param  Request $request POST | GET
     * @return json
     */
    public function ajaxOrderManage(Request $request)
    {
        $output = '';
        if( !empty( $request->get('formData') ) ) {
            parse_str($request->get('formData'), $formData);
            ob_start();
            $output .= View(
                'backend/order/order-manageJs.tpl',
                [
                    'orders'  => $this->mdOrder->searchByAdmcp( $formData ),
                    'apiHandlePrice' => ApiHandlePrice::getInstance()
                ]
            );
            $output .= ob_get_clean();
        }
        echo json_encode( 
            [
                'output' => $output
            ]
        );
    }
}
