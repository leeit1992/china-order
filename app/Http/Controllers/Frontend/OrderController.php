<?php
namespace App\Http\Controllers\Frontend;

use Atl\Foundation\Request;
use App\Http\Components\ApiHandlePrice;
use App\Http\Components\Frontend\Controller as baseController;
use App\Model\OrderModel;
use App\Model\OrderItemModel;
use App\Model\UserModel;
use App\Model\ExpenditureModel;
use App\Model\BillofladingModel;
use App\Model\NoticeModel;

class OrderController extends baseController
{

    public function __construct()
    {
        parent::__construct();
        $this->userAccess();

        $this->mdOrder = new OrderModel;
        $this->mdOrderItem = new OrderItemModel;
        $this->mdUser = new UserModel;
        $this->mdExpenditure = new ExpenditureModel;
        $this->mdBillofladingModel = new BillofladingModel;
        $this->mdNotice = new NoticeModel;
    }

    public function orderSuccess($id = null)
    {
        $this->loadTemplate('order/order-notice.tpl', [
            'id' => $id
        ], ['path' => 'frontend/userTool/']);
    }

    public function orderManage( Request $request )
    {
        $listOrder = $this->mdOrder->getBy('user_id',Session()->get('avt_user_id') );
        $notPayment = $this->mdOrder->getBy('order_status', 1);
        $payWaitBuy = $this->mdOrder->getBy('order_status', 2);
        $delivery = $this->mdOrder->getBy('order_delivery_status', 2);
        $hasBuy = $this->mdOrder->getBy('order_buy_status', 2);
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
            'outStock'     => $outStock,
            'apiHandlePrice' => ApiHandlePrice::getInstance()
        ], ['path' => 'frontend/userTool/']);
    }

    public function orderDetail($id)
    {
        $listItem = $this->mdOrderItem->getBy('order_id', $id);
        $orderInfo = $this->mdOrder->getBy('id', $id);

        $dir = FOLDER_UPLOAD . '/chat-data/chat-order-' . $id. '.txt';
        $mesData = [];
        if( file_exists( $dir ) ) {
            $mesData = json_decode(file_get_contents($dir), true);
        }

        $this->loadTemplate('order/detail-order.tpl', [
            'mdBillofladingModel' => $this->mdBillofladingModel,
            'orderInfo' => $orderInfo,
            'listItem' => $listItem,
            'apiHandlePrice' => ApiHandlePrice::getInstance(),
            'updateOrderNotice' => Session()->getFlashBag()->get('updateOrder'),
            'getHandle' => isset( $_GET['handle'] ) ? $_GET['handle'] : '',
            'mesData' => $mesData,
            'currentcyRate' => $this->currentcyRate,
            'dataUser' => [
                'userID' => Session()->get('avt_user_id'),
                'userName' => Session()->get('avt_user_name'),
            ]
        ], ['path' => 'frontend/userTool/']);
    }

    public function updateOrder(Request $request)
    {
        $infoUser = $this->mdUser->getUserBy('id', Session()->get('avt_user_id'));
        $infoOrder = $this->mdOrder->getBy('id', $request->get('avt_oder_id'));
        //pr($infoOrder[0]);die;

        switch ($request->get('avt_pay_type')) {
            case 'pay_emaining_amount':
                $dataInfoPay = json_decode($infoOrder[0]['order_info_pay'], true);
                if ($infoUser[0]['user_money'] > $dataInfoPay['rest_pay']) {
                    $argsSave = [
                        'order_info_pay' => json_encode([
                            'rest_percent' => 0,
                            'has_pay' => $dataInfoPay['has_pay'] +  $dataInfoPay['rest_pay'],
                            'rest_pay' => 0
                        ]),
                        'order_status' => 2,
                        
                    ];
                    $this->mdOrder->save($argsSave, $request->get('avt_oder_id'));

                    $this->mdUser->save([
                        'user_money' => $infoUser[0]['user_money'] - $dataInfoPay['rest_pay']
                    ], Session()->get('avt_user_id'));

                     Session()->getFlashBag()->set('updateOrder', ['type' => true, 'notice' => 'Tất toán đơn hàng thành công.']);
                } else {
                    Session()->getFlashBag()->set('updateOrder', ['type' => false, 'notice' => 'Tiền trong tải khoản của bạn không đủ. vui lòng nạp thêm tiền vào tài khoản.']);
                }
                break;
            case 'arises_price':
                if ($infoUser[0]['user_money'] > $infoOrder[0]['order_arises_price']) {
                    $argsSave = [
                        'order_status' => 2,
                        'order_arises_price' => 0,
                    ];
                    $this->mdOrder->save($argsSave, $request->get('avt_oder_id'));

                    $this->mdUser->save([
                        'user_money' => $infoUser[0]['user_money'] - $infoOrder[0]['order_arises_price']
                    ], Session()->get('avt_user_id'));

                    $listAdmin = $this->mdUser->getUserBy( 'user_role', 1 );
                    if (!empty($listAdmin)) {
                        foreach ($listAdmin as $item) {
                            $this->mdNotice->save([
                                'notice_title'       => 'Đã thanh toán phí phát sinh '. $infoOrder[0]["order_code"],
                                'notice_description' => '',
                                'notice_sender'      => Session()->get('avt_user_id'),
                                'notice_receiver'    => $item['id'],
                                'notice_status'      => 1,
                                'notice_link'        => '/admcp/detail-order/'. $request->get('avt_oder_id'),
                                'notice_type'        => 'arises_price_done',
                                'notice_date'        => date('Y-m-d H:s:j')
                            ]);
                        }
                    }

                    Session()->getFlashBag()->set('updateOrder', ['type' => true, 'notice' => 'Thanh toán chi phí phát sinh thành công.']);
                } else {
                    Session()->getFlashBag()->set('updateOrder', ['type' => false, 'notice' => 'Tiền trong tải khoản của bạn không đủ. vui lòng nạp thêm tiền vào tài khoản.']);
                }
                break;

            default:
                $priceCount = $request->get('avt_pay_type') / 100 * $infoOrder[0]['order_total_price_vn'];

                if ($infoUser[0]['user_money'] > $priceCount) {
                    $argsSave = [
                    'order_info_pay' => json_encode([
                    'rest_percent' => 100 - $request->get('avt_pay_type'),
                    'has_pay' => $priceCount,
                    'rest_pay' => $infoOrder[0]['order_total_price_vn'] - $priceCount
                    ]),
                    'order_status' => 2,
                        
                    ];
                    $this->mdOrder->save($argsSave, $request->get('avt_oder_id'));

                    $this->mdExpenditure->save([
                    'order_id' => $request->get('avt_oder_id'),
                    'payment' => $priceCount,
                    'payment_type' => $request->get('avt_pay_type'),
                    'rest_payment' => $infoOrder[0]['order_total_price_vn'] - $priceCount,
                    'date' => date('Y-m-d H:s:j'),
                    'desc' => 'Thanh toán cho đơn hàng ' . $infoOrder[0]['order_code'],
                    'user_id' => Session()->get('avt_user_id'),
                    ]);

                    $this->mdUser->save([
                    'user_money' => $infoUser[0]['user_money'] - $priceCount
                    ], Session()->get('avt_user_id'));

                    Session()->getFlashBag()->set('updateOrder', ['type' => true, 'notice' => 'Thanh toán '.$request->get('avt_pay_type').'% số tiền của đơn hàng thành công.']);
                } else {
                    Session()->getFlashBag()->set('updateOrder', ['type' => false, 'notice' => 'Tiền trong tải khoản của bạn không đủ. vui lòng nạp thêm tiền vào tài khoản.']);
                }

                break;
        }
        
        redirect(url('/user-tool/detail-order/' . $request->get('avt_oder_id')));
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
                'frontend/userTool/order/order-manageJs.tpl',
                [
                    'orders'  => $this->mdOrder->searchByUserT( $formData ),
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
