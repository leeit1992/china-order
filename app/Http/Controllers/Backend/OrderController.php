<?php
namespace App\Http\Controllers\Backend;

use Atl\Foundation\Request;
use App\Http\Components\ApiHandlePrice;
use App\Http\Components\Backend\Controller as baseController;
use App\Model\OrderModel;
use App\Model\OrderItemModel;
use App\Model\BillofladingModel;
use App\Model\OptionModel;
use App\Model\NoticeModel;

class OrderController extends baseController
{

    public function __construct()
    {
        parent::__construct();
        $this->userAccess();

        $this->mdOrder = new OrderModel;
        $this->mdOrderItem = new OrderItemModel;
        $this->mdBillofladingModel = new BillofladingModel;
        $this->mdOption = new OptionModel;
        $this->mdNotice = new NoticeModel;
    }

    public function orderSuccess()
    {
        $this->loadTemplate('order/order-notice.tpl', [], ['path' => 'frontend/userTool/']);
    }

    public function orderManage( Request $request )
    {
        $listOrder = $this->mdOrder->getAll();
        $notPayment = $this->mdOrder->getBy('order_status', 1);
        $payWaitBuy = $this->mdOrder->getBy('order_status', 2);
        $delivery = $this->mdOrder->getBy('order_delivery_status', 2);
        $hasBuy = $this->mdOrder->getBy('order_buy_status', 2);
        $restPercent = $this->mdOrder->getByRestPercent();
        $outStock = $this->mdOrder->getBy('order_buy_status', 3);

        if (!empty($request->get('status'))) {
            $listOrder = [];
            if ($request->get('status') == 1) {
                $listOrder = $notPayment;
            } elseif ($request->get('status') == 2) {
                $listOrder = $payWaitBuy;
            }
        }

        if (!empty($request->get('statusBuy'))) {
            $listOrder = [];
            if ($request->get('statusBuy') == 2) {
                $listOrder = $hasBuy;
            } elseif ($request->get('statusBuy') == 3) {
                $listOrder = $outStock;
            }
        }

        if (!empty($request->get('statusRest'))) {
            $listOrder = [];
            if ($request->get('statusRest') == 1) {
                $listOrder = $restPercent;
            }
        }

        if (!empty($request->get('statusDelivery'))) {
            $listOrder = [];
            if ($request->get('statusDelivery') == 2) {
                $listOrder = $delivery;
            }
        }

        $this->loadTemplate('order/order-manage.tpl', [
            'listOrder' => $listOrder,
            'notPayment' => $notPayment,
            'payWaitBuy' => $payWaitBuy,
            'delivery'   => $delivery,
            'hasBuy'     => $hasBuy,
            'restPercent' => $restPercent,
            'outStock'     => $outStock,
            'apiHandlePrice' => ApiHandlePrice::getInstance()
        ], ['path' => 'backend/']);
    }

    public function orderDetail($id)
    {
        // setting status seen notice
        $condiNotice =  [ 'notice_link' => '/admcp/detail-order/'. $id,
                          'notice_receiver' => Session()->get('avt_admin_user_id')
                        ];
        $notice = $this->mdNotice->getByArray( $condiNotice );
        if (!empty($notice)) {
            $this->mdNotice->save( [ 'notice_status' => 2 ], $notice[0]['id'] );
        }

        $listItem = $this->mdOrderItem->getBy('order_id', $id);
        $orderInfo = $this->mdOrder->getBy('id', $id);
        $priceByWeight = $this->mdOption->getOption('priceByWeight');

        $dir = FOLDER_UPLOAD . '/chat-data/chat-order-' . $id. '.txt';
        $mesData = [];
        if( file_exists( $dir ) ) {
            $mesData = json_decode(file_get_contents($dir), true);
        }

        $this->loadTemplate('order/detail-order.tpl', [
            'mdBillofladingModel' => $this->mdBillofladingModel,
            'orderInfo' => $orderInfo,
            'priceByWeight' => json_decode($priceByWeight),
            'currentcyRate' => $this->currentcyRate,
            'listItem' => $listItem,
            'apiHandlePrice' => ApiHandlePrice::getInstance(),
            'updateOrderNotice' => Session()->getFlashBag()->get('updateOrder'),
            'getHandle' => isset( $_GET['handle'] ) ? $_GET['handle'] : '',
            'mesData' => $mesData,
            'dataUser' => [
                'userID' => Session()->get('avt_admin_user_id'),
                'userName' => Session()->get('avt_admin_user_name'),
            ]
        ], ['path' => 'backend/']);
    }

    public function updateOrder(Request $request)
    {
        $totalShipPriceNew = 0;
        $totalShipPrice = 0;
        $listBill = $this->mdBillofladingModel->getBy('order_id', $request->get('avt_oder_id'));
        foreach ($listBill as $value) {
            $totalShipPrice += $value['price_ship'];
        }
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

        if( $request->get('avt_bill') ) {
            foreach ($request->get('avt_bill') as $key => $value) {

                $checkBillItem = $this->mdBillofladingModel->getBy('general_id', $value['check_order_item_id']);

                if ( $value['price-status'] == 1 ) {
                    $price_status = 1;
                    $weight = $value['weight'];
                } elseif ( $value['price-status'] == 2 ) {
                    $price_status = 2;
                    $weight = '';
                }

                $this->mdBillofladingModel->save(
                    [
                        'day_in_stock' => $value['date'],
                        'code' => $value['code'],
                        'order_id' => $value['order_id'],
                        'shop_name' => $value['shop_name'],
                        'order_item_id' => json_encode($value['order_item_id']),
                        'weight' => $weight,
                        'price_status' => $price_status,
                        'price' => $this->convertPriceToInt($value['price']),
                        'price_ship' => $this->convertPriceToInt($value['price_ship']),
                        'general_id' => implode('-',$value['order_item_id']),
                    ],
                    isset( $checkBillItem[0]['id'] ) ? $checkBillItem[0]['id'] : null
                );
                $totalShipPriceNew += $this->convertPriceToInt($value['price_ship']);
            }
        }

        $infoOrder = $this->mdOrder->getBy( 'id', $request->get('avt_oder_id') );
        if ( $totalShipPriceNew > $totalShipPrice && $infoOrder[0]["order_status"] == 2) {
            $this->mdOrder->save([
                'order_status' => 3,
                'order_arises_price'=> $totalShipPriceNew - $totalShipPrice,
                ],
                $request->get('avt_oder_id'));
            $this->mdNotice->save([
                'notice_title'       => 'Thanh toán phí phát sinh '. $infoOrder[0]["order_code"],
                'notice_description' => '',
                'notice_sender'      => Session()->get('avt_admin_user_id'),
                'notice_receiver'    => $infoOrder[0]['user_id'],
                'notice_status'      => 1,
                'notice_link'        => '/user-tool/detail-order/'. $request->get('avt_oder_id'),
                'notice_type'        => 'arises_price',
                'notice_date'        => date('Y-m-d H:s:j')
            ]);
        }

        Session()->getFlashBag()->set('updateOrder', ['type' => true, 'notice' => 'Update thông tin thành công.']);

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

    public function priceByWeight(Request $request){
        $currentPrice = $this->mdOption->getOption('priceByWeight');
        if( $request->get('del') ) {
            $dataWP = json_decode($currentPrice, true);
           foreach ($dataWP as $key => $value) {
               if( $request->get('del') == $value ) {
                    unset($dataWP[$key]);
               }
           }

           $this->mdOption->setOption('priceByWeight', $dataWP);

           redirect(url('/admcp/price-by-weight'));
        }
   
        $this->loadTemplate('order/price-by-weight.tpl', [
            'apiHandlePrice' => ApiHandlePrice::getInstance(),
            'currentPrice' => json_decode($currentPrice),
            'apiHandlePrice' => ApiHandlePrice::getInstance(),
            'updatePriceKg' => Session()->getFlashBag()->get('updatePriceKg'),
        ], ['path' => 'backend/']);
    }

    public function validateAddPriceWeight(Request $request)
    {   

        if( !empty( $request->get('avt_price') ) ) {
            $currentPrice = $this->mdOption->getOption('priceByWeight');

            $addData = [];

            if( empty( $currentPrice ) ) {
                $addData[] = $this->convertPriceToInt($request->get('avt_price'));
            }else{
                $currentPrice = json_decode($currentPrice);
                $currentPrice[] = $this->convertPriceToInt($request->get('avt_price'));
                $addData = $currentPrice;
            }
            
            $this->mdOption->setOption('priceByWeight', $addData);

            Session()->getFlashBag()->set('updatePriceKg', ['type' => true, 'notice' => 'Update thông tin thành công.']);
            redirect(url('/admcp/price-by-weight'));
        }  
    }
}
