<?php
    $orderCode = $orderInfo[0]['order_code'];

    $newListByIdSale = [];
    foreach ($listItem as $value) {
        $newListByIdSale[$value['order_item_seller_id']][] = $value;
    }

?>
<style type="text/css">
    .atl-input-group-btn{
        width: 90px;
    }

    .atl-input-group-btn button{
        font-size: 12px;
        padding: 0;
    }
    .atl-order-fix-input{
        font-size: 13px;
    }
    .avt-tab-detail-order{
        border-bottom: 1px solid #ccc;
        height: 36px;
    }
</style>
<div id="page-user-tool-cart">
    <!-- Page Header-->
    <header class="page-header">
        <div class="container-fluid">
            <h2>Đơn Hàng</h2>
             <strong>MÃ</strong> : <?php echo $orderCode  ?> (<?php echo date('d-m-Y') ?>)
        </div>
    </header>
    <section>
        <div class="container-fluid">
            <ul class="tabs avt-tab-detail-order">
                <li><a href="<?php echo url('/user-tool/detail-order/' . $orderInfo[0]['id']) ?>" class="<?php echo ( '' == $getHandle ) ? 'active' : '' ?>">Tất Cả</a></li>
                <li><a href="<?php echo url('/user-tool/detail-order/' . $orderInfo[0]['id'] . '?handle=filter_purchase' ) ?>" class="<?php echo ( 'filter_purchase' == $getHandle ) ? 'active' : '' ?>">Đã Mua</a></li>
            </ul>
        </div>
        
    </section>
    <div class="projects">
        <div class="container-fluid">
            <!-- Project-->
            <div class="project">
                <form action="<?php echo url('/user-tool/update-order') ?>" method="POST">
                <?php
                    if (!empty($updateOrderNotice)) {
                        if ($updateOrderNotice['type'

                    ]) {
                            $classNoptice = 'alert-success';
                        } else {
                            $classNoptice = 'alert-danger';
                        }
                        ?>
                        <div class="alert <?php echo $classNoptice ?>" role="alert">
                        <?php
                            echo $updateOrderNotice['notice'];
                        ?>
                        </div>
                        <?php
                    }
                ?>
                <?php 
                    $totalPrice = 0;
                    $countItem = 0;
                    $hasPurchase = 0;
                    $totalPriceTrans = 0;
                    $totalWeight = 0;
                    $totalPriceShip = 0;
                    foreach ($newListByIdSale as $_listItem): 
                ?>
                <div class="avt-group-item bg-white has-shadow" <?php echo ( 'filter_purchase' == $getHandle ) ? 'style="display:none;"' : '' ?>    >
                                         
                    <div class="avt-row-sale">
                        <div class="form-group">
                            <div class="input-group">
                               <label> Người bán: <?php echo $_listItem[0]['order_item_seller']; ?> </label>
                            </div>
                        </div>
                    </div>
                    <?php
                        
                    foreach ($_listItem as $value) :
                        $dataItem = json_decode($value['order_item_content'], true);

                        $colorSize = [];
                        if (isset($value['property'])) {
                            $colorSize = explode(';', $value['property']);

                            foreach ($colorSize as $keyS => $valueS) {
                                if (empty($valueS)) {
                                    unset($colorSize[$keyS]);
                                }
                            }
                        }

                        $totalPrice += $dataItem['price_origin'] * $dataItem['quantity'];
                        $countItem += $dataItem['quantity'];
                        $hasPurchase += $value['order_item_real_purchase'];
                    ?>
                    <div class="row" id="item-<?php echo $dataItem['id'] ?>">
                    <div class="left-col col-lg-4 d-flex align-items-center justify-content-between">
                    <div class="project-title d-flex align-items-center" style="overflow:hidden;">
        
                        <div class="image has-shadow">
                            <img src="<?php echo urldecode($dataItem['image_origin']) ?>" class="img-fluid">
                        </div>
                        <div class="text">
                            <small>
                                <a href="<?php echo $dataItem['link_origin'] ?>">
                                    <?php echo substr($dataItem['link_origin'], 0, 50); ?>
                                </a>
                            </small>
                            <br>
                            <small><?php echo implode(', ', $colorSize) ?></small>
                        </div>
                    </div>
                    </div>
                    <div class="right-col col-lg-2 d-flex align-items-center">
                        <div class="form-group">
                            <label class="form-control-label">Giá </label>
                            <p><?php echo $apiHandlePrice->formatPrice($dataItem['price_origin']) ?></p>
                        </div>
                    </div>
                    <div class="right-col col-lg-2 d-flex align-items-center">
                        <div class="form-group">
                            <label class="form-control-label">Số lượng </label>
                            <p><?php echo $dataItem['quantity'] ?></p>
                        </div>
                    </div>

                    <div class="right-col col-lg-2 d-flex align-items-center">
                    <div class="form-group">
                        <label class="form-control-label">Đã Mua</label>
                        <p><?php echo $value['order_item_real_purchase'] ?></p>   
                    </div>
                    </div>
     
                    <div class="right-col col-lg-2 d-flex align-items-center">
                    <div class="form-group">
                        <label class="form-control-label">Tổng </label>
                        <p id="price-item-<?php echo $value['id'] ?>"><?php echo $apiHandlePrice->formatPrice($dataItem['price_origin'] * $dataItem['quantity']) ?></p>
                    </div>
                    </div>
                    <br>
                    <div class="right-col col-lg-12 align-items-center" style="margin-top: 10px;">
                    <div class="form-group">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Ghi Chú" value="<?php echo isset( $value['comment'] ) ? $value['comment'] : '' ?>">
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-primary">Ghi Chú</button>
                            </span>
                        </div>
                    </div>
                    </div>
                    </div>
                    <?php endforeach; ?>
                </div>

                <div class="bg-white has-shadow" style="display: <?php echo ('' == $getHandle) ? 'none' : 'block'; ?>">
                    <?php
                        $newListPurchase = [];
                        foreach ($_listItem as $key => $value)
                        {
                            if($value['order_item_quantity'] == $value['order_item_real_purchase'])
                            {
                                $newListPurchase[] = $value;
                            }
                            
                        }
                    ?>
                    <?php

                        foreach ($newListPurchase as $value) :
                            $dataItem = json_decode($value['order_item_content'], true);

                            $colorSize = [];
                            if (isset($value['property'])) {
                                $colorSize = explode(';', $value['property']);

                                foreach ($colorSize as $keyS => $valueS) {
                                    if (empty($valueS)) {
                                        unset($colorSize[$keyS]);
                                    }
                                }
                            }
                
                            $infoBill = $mdBillofladingModel->getBy('general_id', $value['id']);
                            $totalPriceTrans += isset( $infoBill[0]['price'] ) ? $infoBill[0]['price'] : 0;
                            $totalWeight += isset( $infoBill[0]['weight'] ) ? $infoBill[0]['weight'] : 0;
                            $totalPriceShip += isset( $infoBill[0]['price_ship'] ) ? $infoBill[0]['price_ship'] : 0;
                        ?>
                        <div class="row" id="item-<?php echo $dataItem['id'] ?>">
                            <div class="left-col col-lg-4 d-flex align-items-center justify-content-between">
                            <div class="project-title d-flex align-items-center" style="overflow:hidden;">
                
                                <div class="image has-shadow">
                                    <img src="<?php echo urldecode($dataItem['image_origin']) ?>" class="img-fluid">
                                </div>
                                <div class="text">
                                    <small>
                                        <a href="<?php echo $dataItem['link_origin'] ?>">
                                            <?php echo substr($dataItem['link_origin'], 0, 50); ?>
                                        </a>
                                    </small>
                                    <br>
                                    <small><?php echo implode(', ', $colorSize) ?></small>
                                </div>
                            </div>
                            </div>
                            <div class="right-col col-lg-2 d-flex align-items-center">
                                <div class="form-group">
                                    <label class="form-control-label">Giá </label>
                                    <p><?php echo $apiHandlePrice->formatPrice($dataItem['price_origin']) ?></p>
                                </div>
                            </div>
                            <div class="right-col col-lg-2 d-flex align-items-center">
                                <div class="form-group">
                                    <label class="form-control-label">Số lượng </label>
                                    <p><?php echo $dataItem['quantity'] ?></p>
                                </div>
                            </div>

                            <div class="right-col col-lg-2 d-flex align-items-center">
                                <div class="form-group">
                                    <label class="form-control-label">Đã Mua</label>
                                    <p><?php echo $value['order_item_real_purchase'] ?></p>
                                </div>
                            </div>
             
                            <div class="right-col col-lg-2 d-flex align-items-center">
                            <div class="form-group">
                                <label class="form-control-label">Tổng </label>
                                <p id="price-item-<?php echo $value['id'] ?>"><?php echo $apiHandlePrice->formatPrice($dataItem['price_origin'] * $dataItem['quantity']) ?></p>
                            </div>
                            </div>
                            <br>
                            <div class="right-col col-lg-12 align-items-center" style="margin-top: 10px;">
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Ghi Chú" value="<?php echo isset( $value['comment'] ) ? $value['comment'] : '' ?>">
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-primary">Ghi Chú</button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                 
                        <div class="row">
                            <div class="right-col col-lg-3 align-items-center" style="margin-top: 10px;">
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="text" class="form-control atl-order-fix-input" readonly="" placeholder="Ngày Hàng Về" value="<?php echo isset( $infoBill[0]['day_in_stock'] ) ? $infoBill[0]['day_in_stock'] : '' ?>">
                                        <span class="input-group-btn atl-input-group-btn">
                                            <button type="button" class="btn btn-primary">Ngày Hàng Về</button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="right-col col-lg-3 align-items-center" style="margin-top: 10px;">
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="text" class="form-control atl-order-fix-input" readonly="" placeholder="Cân Nặng" value="<?php echo isset( $infoBill[0]['weight'] ) ? $infoBill[0]['weight'] : '' ?>">
                                        <span class="input-group-btn atl-input-group-btn">
                                            <button type="button" class="btn btn-primary">KG</button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="right-col col-lg-3 align-items-center" style="margin-top: 10px;">
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="text" class="form-control atl-order-fix-input avt-price" readonly="" placeholder="Thành Tiền" value="<?php echo isset( $infoBill[0]['price'] ) ? $apiHandlePrice->formatPrice($infoBill[0]['price'], '') : '' ?>">
                                        <span class="input-group-btn atl-input-group-btn">
                                            <button type="button" class="btn btn-primary">VNĐ</button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="right-col col-lg-3 align-items-center" style="margin-top: 10px;">
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="text" class="form-control atl-order-fix-input" readonly="" placeholder="Mã vận đơn" value="<?php echo isset( $infoBill[0]['code'] ) ? $infoBill[0]['code'] : '' ?>">
                                        <span class="input-group-btn atl-input-group-btn">
                                            <button type="button" class="btn btn-primary">Mã vận đơn</button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="right-col col-lg-3 align-items-center" style="margin-top: 10px;">
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="text" class="form-control atl-order-fix-input avt-price" readonly="" placeholder="Mã vận đơn" value="<?php echo isset( $infoBill[0]['price_ship'] ) ? $apiHandlePrice->formatPrice($infoBill[0]['price_ship'], '') : '' ?>">
                                        <span class="input-group-btn atl-input-group-btn">
                                            <button type="button" class="btn btn-primary">Phí ship nội địa</button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>            
                </div>
                
                <?php endforeach; ?>
                <div class="row bg-gray has-shadow">
                    <div class="right-col col-lg-12">
                        <?php
                        $cartTotalPriceVN = $totalPrice * 3540;
                        ?>
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>Tổng sản phẩm</td>
                                    <td id="total-item">
                                        <?php echo $countItem ?> Sản phẩm
                                        <hr>
                                        <b>Đã mua</b> : <?php echo $hasPurchase ?>
                                        <hr>
                                        <b>Còn lại</b> : <?php echo $countItem - $hasPurchase ?>
                                        <hr>
                                        <b>Tổng số cân nặng</b> : <?php echo $totalWeight ?> kg
                                    </td>
                                </tr>
                                <tr>
                                    <td>Tổng tiền hoá đơn</td>
                                    <td>
                                        <span id="total-price">
                                        <input type="hidden" name="avt_total_price_cn" value="<?php echo $totalPrice ?>">
                                        <input type="hidden" name="avt_total_price_vn" value="<?php echo $cartTotalPriceVN ?>">
                                        Tiền đơn hàng: <?php echo $apiHandlePrice->formatPrice($totalPrice) ?> = <?php echo $apiHandlePrice->formatPrice($cartTotalPriceVN, 'vnđ')  ?>
                                        </span>
                                        <hr>
                                        <span id="total-price-trans">
                                        Tiền vận chuyển : 
                                        <?php if ($totalWeight > 0): ?>
                                            <?php echo $apiHandlePrice->formatPrice($totalPriceTrans, 'vnđ') ?> /  <?php echo $totalWeight ?> kg
                                        <?php else: ?>
                                            <?php echo $apiHandlePrice->formatPrice($totalPriceTrans, 'vnđ') ?>
                                        <?php endif ?>
                                        </span>
                                        <hr>
                                        <span id="total-price-trans">
                                        Phí ship nội địa: <?php echo $apiHandlePrice->formatPrice($totalPriceShip) ?> = <?php echo $apiHandlePrice->formatPrice($totalPriceShip * $currentcyRate, 'vnđ') ?>
                                        </span>
                                                       
                                        <hr> = 
                                        <span id="total-price-vnd">
                                            <?php echo $apiHandlePrice->formatPrice($cartTotalPriceVN + $totalPriceTrans + $totalPriceShip, 'vnđ')  ?>
                                        </span>
                                        <?php if (1 == $orderInfo[0]['order_status']) :  ?>
                                        <hr>
                                        <span style="color: #ff9800;"> 
                                            <i class="fa fa-exclamation-triangle"></i> Đơn hàng chưa được thanh toán.
                                        </span>
                                        <?php endif; ?>
                                    </td> 
                                </tr>
                                <input type="hidden" name="avt_oder_id" value="<?php echo $orderInfo[0]['id'] ?>">
                                <?php if ($orderInfo[0]['order_status'] == 3): ?>
                                    <tr>
                                        <td>
                                        </td>
                                        <td>
                                            <span class="text-danger"><i class="fa fa-exclamation-triangle"></i> Đơn hàng cần thanh toán phí phát sinh</span>
                                            <input type="hidden" name="avt_pay_type" value="arises_price"><hr>
                                            <p class="text-danger">Phí phát sinh: <?php echo $apiHandlePrice->formatPrice( $orderInfo[0]['order_arises_price'], 'vnđ' ) ?></p><hr>
                                            <button type="submit" class="btn btn-primary">Thanh toán tiền phát sinh</button>
                                        </td>
                                    <?php else: ?>
                                        <tr>
                                            <td>
                                            </td>
                                            <td>
                                                <?php if (empty($orderInfo[0]['order_info_pay'])) : ?>
                                                <div class="col-sm-9">
                                                    <div class="i-checks">
                                                        <input id="avt_status_1" name="avt_pay_type" value="100" checked="checked" type="radio" class="checkbox-template">
                                                        <label for="avt_status_1">Thanh toán toàn bộ đơn hàng.</label>
                                                    </div>
                                                    <div class="i-checks">
                                                        <input id="avt_status_2" name="avt_pay_type" value="80" type="radio" class="checkbox-template">
                                                        <label for="avt_status_2">Thanh toán 80% đơn hàng.</label>
                                                    </div>
                                                </div>
                                                <?php endif; ?>
                                                <hr>
                                                <?php
                                                if (!empty($orderInfo[0]['order_info_pay'])) :
                                                    $dataInfoPay = json_decode($orderInfo[0]['order_info_pay'], true);
                                                ?>
                                                <b>Đã thanh toán </b> : <?php echo 100 - $dataInfoPay['rest_percent'] ?> % = <?php echo $apiHandlePrice->formatPrice($dataInfoPay['has_pay'], 'vnđ') ?>
                                                <hr>
                                                <b>Số còn lại </b> :  <?php echo $dataInfoPay['rest_percent'] ?> % = <?php echo $apiHandlePrice->formatPrice($dataInfoPay['rest_pay'], 'vnđ') ?>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td>
                                                   <?php
                                                    if (empty($orderInfo[0]['order_info_pay'])) {
                                                        echo '<button type="submit" class="btn btn-primary">Thanh toán tiền </button>';
                                                    }

                                                    if (!empty($orderInfo[0]['order_info_pay'])) {
                                                        if (0 != $dataInfoPay['rest_pay']) {

                                                            echo '<input type="hidden" name="avt_pay_type" value="pay_emaining_amount">';
                                                            echo '<button type="submit" value="pay_emaining_amount" class="btn btn-primary">Tất toán </button>';
                                                        } else {
                                                            echo '<span style="color: #4CAF50; font-size: 20px;"> 
                                                                            <i class="fa fa-exclamation-triangle"></i> Đơn hàng đã tất toán.
                                                                        </span>';
                                                        }
                                                    }
                                                ?>
                                            </td>
                                            <td>
                                            </td>
                                        </tr>
                                    <?php endif ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
View('layout/form-chat.tpl', [ 'orderID' =>  $orderInfo[0]['id'], 'mesData' => $mesData, 'dataUser' => $dataUser]);

registerScrips(array(
    'page-user-tool-cart' => assets('frontend/user-tool/js/userTool-page-cart-debug.js'),
    'cart' => assets('frontend/user-tool/js/cart.js'),
    'page-chat' => assets('frontend/user-tool/js/page-chat-debug.js'),
));
?>