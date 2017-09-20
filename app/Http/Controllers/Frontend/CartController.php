<?php
namespace App\Http\Controllers\Frontend;
use Atl\Foundation\Request;
use App\Http\Components\ApiHandlePrice;

use App\Http\Components\Controller as baseController;

class CartController extends baseController{

	public function addToCartHttp(Request $request){

		$cart = Session()->get('avt_cart');

		if( !$cart ) {
			$cart = [];
		}

		$ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,"http://ddecode.com/hexdecoder/");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,"text1=" . $_POST['seller_name']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec ($ch);
        curl_close ($ch);
        preg_match_all('/<textarea cols=90 rows=10 name=text1>(.*)<\/textarea>/i', $server_output, $matches);

        $_POST['seller_name'] = isset( $matches[1][0] ) ?  html_entity_decode($matches[1][0]) : $_POST['seller_name'];

        $keyId = isset( $_POST['seller_id'] ) ? $this->slug($_POST['seller_id']) : $_POST['item_id'];
       
        $_POST['id'] = uniqid();

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

	public function cartManage(){
		$this->loadTemplate('cart/listItem.tpl',[
			'listCart' => Session()->get('avt_cart'),
			'apiHandlePrice' => ApiHandlePrice::getInstance(),
		], ['path' => 'frontend/userTool/']);
	}

	public function updateCart(Request $request){
		$listCarts = Session()->get('avt_cart');

		$priceItem = 0;

		foreach ($listCarts as $keyList => $carts) {
			foreach ($carts as $keyCart => $cart) {
				if( $cart['id'] == $request->get('id') ) {
					$listCarts[$keyList][$keyCart]['quantity'] = $request->get('quantity');
					$priceItem = $request->get('quantity') * $cart['item_price'];
				}
			}
		}
		Session()->set('avt_cart', $listCarts);

		$totalPrice = 0;
        $countItem = 0;
		
		foreach ($listCarts as $keyList => $carts) {
			foreach ($carts as $keyCart => $cart) {
				$totalPrice += $cart['item_price'] * $cart['quantity'];
       		 	$countItem +=  $cart['quantity'];
			}
		}

		echo json_encode([
			'price_item' => ApiHandlePrice::getInstance()->formatPrice( $priceItem ),
			'total_item' => $countItem,
			'total_price' => ApiHandlePrice::getInstance()->formatPrice( $totalPrice ),
			'total_price_vnd' => ApiHandlePrice::getInstance()->formatPrice( $totalPrice * 3540)
		]);
	}


}