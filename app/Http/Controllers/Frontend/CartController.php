<?php
namespace app\Http\Controllers\Frontend;

use Atl\Foundation\Request;
use App\Http\Components\ApiHandlePrice;
use App\Http\Components\Frontend\Controller as baseController;
use App\Model\OrderModel;
use App\Model\OrderItemModel;
use App\Model\NoticeModel;
use App\Model\UserModel;

class CartController extends baseController
{
    public function __construct()
    {
        parent::__construct();
        $this->userAccess();

        $this->mdOrder = new OrderModel();
        $this->mdOrderItem = new OrderItemModel();
        $this->mdNotice = new NoticeModel();
        $this->mdUser = new UserModel();
        // var_dump(Session()->get('avt_cart'));
        // Session()->set('avt_cart', []);
    }

    public function addToCart2(Request $request)
    {
        $cart = Session()->get('avt_cart');

        if (!$cart) {
            $cart = [];
        }
        $keyId = isset($_POST['shop_id']) ? $this->slug($_POST['shop_id']) : $_POST['item_id'];

        $_POST['id'] = uniqid();
        $_POST['title_origin'] = strip_tags($_POST['title_origin']);
        $_POST['title_translated'] = strip_tags($_POST['title_translated']);
        
        $cart[$keyId][] = $_POST;

        Session()->set('avt_cart', $cart);
        ?>
        <div id="box_overlay" style="background: none repeat scroll 0 0 #000000;height: 1000px;left: 0;opacity: 0.5;position: fixed;top: 0;width: 100%; z-index: 2147483646;"></div>
        <div id="box-confirm-order" style="position:fixed; top:150px; left: 400px;z-index:2147483647;width:400px; border:1px solid #47b200; background:#fff; padding:15px;-moz-border-radius:3px; -webkit-border-radius:3px; border-radius:3px;">
            <a style="float:right; width:15px; height: 15px; border:1px solid #DDD; margin-right:2px;background:url('<?php echo assets('frontend/user-tool/img/icon.png') ?>') no-repeat 3px -34px transparent;" id="box-nh-box-close" href="javascript:void(0);" onclick="document.getElementById('box-confirm-order').parentNode.removeChild(document.getElementById('box-confirm-order'));var boxOverlay = document.getElementById('box_overlay');if(boxOverlay != null) {boxOverlay.parentNode.removeChild(boxOverlay);}" data-spm-anchor-id="a220o.1000855.0.0"></a>
            <div style="background:url('<?php echo assets('frontend/user-tool/img/icon-success.png') ?>') no-repeat 0 0; padding-left:45px;">
                <h4 style="margin:0 0 10px 0;text-transform:uppercase; color:#47b200">Bạn đã cho sản phẩm vào giỏ hàng thành công</h4>
                <div>SL: <?php echo $_POST['quantity'] ?>&nbsp&nbsp&nbsp&nbsp&nbsp Giá SP:
                    <?php echo $_POST['price_origin'] ?> NDT 
                    <a href="https://localhost:3000/project8/user-tool/cart" style="color:#007cbc; text-decoration:none; float:right" target="_blank">Xem giỏ hàng &raquo;</a>
                </div>
            </div>
        </div>
        <?php
    }

    public function addToCartHttp(Request $request)
    {
        $cart = Session()->get('avt_cart');

        if (!$cart) {
            $cart = [];
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'http://ddecode.com/hexdecoder/');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, 'text1='.$_POST['seller_name']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);
        curl_close($ch);
        preg_match_all('/<textarea cols=90 rows=10 name=text1>(.*)<\/textarea>/i', $server_output, $matches);

        $_POST['seller_name'] = isset($matches[1][0]) ?  html_entity_decode($matches[1][0]) : $_POST['seller_name'];

        $keyId = isset($_POST['seller_id']) ? $this->slug($_POST['seller_id']) : $_POST['item_id'];

        $_POST['id'] = uniqid();
        $_POST['seller_name'] = strip_tags($_POST['seller_name']);

        $cart[$keyId][] = $_POST;

        Session()->set('avt_cart', $cart);

        ?>
        <div id="box_overlay" style="background: none repeat scroll 0 0 #000000;height: 1000px;left: 0;opacity: 0.5;position: fixed;top: 0;width: 100%; z-index: 2147483646;"></div>
        <div id="box-confirm-order" style="position:fixed; top:150px; left: 400px;z-index:2147483647;width:400px; border:1px solid #47b200; background:#fff; padding:15px;-moz-border-radius:3px; -webkit-border-radius:3px; border-radius:3px;">
            <a style="float:right; width:15px; height: 15px; border:1px solid #DDD; margin-right:2px;background:url('<?php echo assets('frontend/user-tool/img/icon.png') ?>') no-repeat 3px -34px transparent;" id="box-nh-box-close" href="javascript:void(0);" onclick="document.getElementById('box-confirm-order').parentNode.removeChild(document.getElementById('box-confirm-order'));var boxOverlay = document.getElementById('box_overlay');if(boxOverlay != null) {boxOverlay.parentNode.removeChild(boxOverlay);}" data-spm-anchor-id="a220o.1000855.0.0"></a>
            <div style="background:url('<?php echo assets('frontend/user-tool/img/icon-success.png') ?>') no-repeat 0 0; padding-left:45px;">
                <h4 style="margin:0 0 10px 0;text-transform:uppercase; color:#47b200">Bạn đã cho sản phẩm vào giỏ hàng thành công</h4>
                <div>SL: <?php echo $_POST['quantity'] ?>&nbsp&nbsp&nbsp&nbsp&nbsp Giá SP:
                    <?php echo $_POST['item_price'] ?> NDT 
                    <a href="https://localhost:3000/project8/user-tool/cart" style="color:#007cbc; text-decoration:none; float:right" target="_blank">Xem giỏ hàng &raquo;</a>
                </div>
            </div>
        </div>
        <?php
    }

    public function cartManage()
    {
        $listCart = Session()->get('avt_cart');
        if (empty($listCart)) {
            $listCart = [];
        }
        $this->loadTemplate('cart/listItem.tpl', [
            'listCart' => $listCart,
            'apiHandlePrice' => ApiHandlePrice::getInstance(),
        ], ['path' => 'frontend/userTool/']);
    }

    public function updateCart(Request $request)
    {
        $listCarts = Session()->get('avt_cart');

        $priceItem = 0;

        foreach ($listCarts as $keyList => $carts) {
            foreach ($carts as $keyCart => $cart) {
                if ($cart['id'] == $request->get('id')) {
                    $listCarts[$keyList][$keyCart]['quantity'] = $request->get('quantity');
                    $priceItem = $request->get('quantity') * $cart['price_origin'];
                }
            }
        }
        Session()->set('avt_cart', $listCarts);

        $totalPrice = 0;
        $countItem = 0;

        foreach ($listCarts as $keyList => $carts) {
            foreach ($carts as $keyCart => $cart) {
                $totalPrice += $cart['price_origin'] * $cart['quantity'];
                $countItem +=  $cart['quantity'];
            }
        }

        echo json_encode([
            'price_item' => ApiHandlePrice::getInstance()->formatPrice($priceItem),
            'total_item' => $countItem,
            'total_price' => ApiHandlePrice::getInstance()->formatPrice($totalPrice),
            'total_price_vnd' => ApiHandlePrice::getInstance()->formatPrice($totalPrice * 3540),
            'total_price_no_icon' => $totalPrice,
            'total_price_vn_no_icon' => $totalPrice * 3540,
        ]);
    }

    public function addToOrder(Request $request)
    {
        $listCart = Session()->get('avt_cart');
        
        if (!empty($listCart)) {
            $lastId = $this->mdOrder->save([
                'order_code' => $request->get('avt_order_code'),
                'order_date' => date('Y-m-d H:s:j'),
                'order_quantity' => $request->get('avt_quanlity'),
                'order_total_price_cn' => $request->get('avt_total_price_cn'),
                'order_total_price_vn' => $request->get('avt_total_price_vn'),
                'order_real_purchase' => 0,
                'order_buy_status' => 1,
                'order_status' => 1,
                'order_delivery_status' => 1,
                'user_id' => Session()->get('avt_user_id'),
            ]);

            foreach ($listCart as $key => $carts) {
                foreach ($carts as $value) {
                    $this->mdOrderItem->save([
                        'order_item_content' => json_encode($value),
                        'order_item_quantity' => $value['quantity'],
                        'order_item_seller' => $this->getSaleName( $value['wangwang'] ),
                        'order_item_real_purchase' => 0,
                        'order_item_status' => 1,
                        'order_id' => $lastId,
                        'order_item_seller_id' => $key
                    ]);
                }
            }
            $listAdmin = $this->mdUser->getUserBy( 'user_role', 1 );
            if (!empty($listAdmin)) {
                foreach ($listAdmin as $item) {
                    $this->mdNotice->save([
                        'notice_title'       => 'Đơn đặt hàng mới '. $request->get('avt_order_code'),
                        'notice_description' => '',
                        'notice_sender'      => Session()->get('avt_user_id'),
                        'notice_receiver'    => $item['id'],
                        'notice_status'      => 1,
                        'notice_link'        => '/admcp/detail-order/'. $lastId,
                        'notice_type'        => 'new_order',
                        'notice_date'        => date('Y-m-d H:s:j')
                    ]);
                }
            }
        }
   
        redirect(url('/user-tool/order-success/'. $lastId));
        // Session()->set('avt_cart', []);
    }

    public function getSaleName( $name ){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'http://ddecode.com/hexdecoder/');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, 'text1='.$name);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);
        curl_close($ch);
        preg_match_all('/<textarea cols=90 rows=10 name=text1>(.*)<\/textarea>/i', $server_output, $matches);

        return isset($matches[1][0]) ?  html_entity_decode($matches[1][0]) : $name;
    }

    public function deleteCart( $id ){
        $listCart = Session()->get( 'avt_cart' );
        foreach ( $listCart as $k => $items ) {
            foreach ( $items as $key => $value ) {
                if ( $value['id'] === $id ) {
                    unset( $listCart[$k][$key] );
                }
            }
        }
        Session()->set('avt_cart', $listCart);
        redirect( url( '/user-tool/cart') );
    }

    public function deleteCarts( $id ){
        $listCart = Session()->get( 'avt_cart' );
        foreach ( $listCart as $key => $items ) {
            if ( $key === $id ) {
                unset( $listCart[$key] );
            }
        }
        Session()->set('avt_cart', $listCart);
        redirect( url( '/user-tool/cart') );
    }
}
