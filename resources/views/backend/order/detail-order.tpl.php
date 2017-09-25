<?php
    $orderCode = $orderInfo[0]['order_code'];
?>
<div id="page-user-tool-cart">
    <!-- Page Header-->
    <header class="page-header">
        <div class="container-fluid">
            <h2>Đơn Hàng</h2>
             <strong>MÃ</strong> : <?php echo $orderCode  ?> (<?php echo date('d-m-Y') ?>)
        </div>
    </header>
    <section class="projects">
        <div class="container-fluid">
            <!-- Project-->
            <div class="project">
                <form action="<?php echo url('/admcp/update-order') ?>" method="POST">
                <div class="avt-group-item bg-white has-shadow">
                    <!-- <div class="avt-row-sale">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="checkbox" value="" class="checkbox-template avt-checkbox-primary-js">
                               <label> Người bán: <?php //echo $carts[0]['seller_name']; ?> </label>
                            </div>
                        </div>
                    </div> -->
                    <?php
                        $totalPrice = 0;
                        $countItem = 0;
                        $hasPurchase = 0;

                    foreach ($listItem as $value) :
                        $dataItem = json_decode($value['order_item_content'], true);

                        $colorSize = [];
                        if (isset($value['color_size'])) {
                            $colorSize = explode(';', $value['color_size']);

                            foreach ($colorSize as $keyS => $valueS) {
                                if (empty($valueS)) {
                                    unset($colorSize[$keyS]);
                                }
                            }
                        }

                        $totalPrice += $dataItem['item_price'] * $dataItem['quantity'];
                        $countItem += $dataItem['quantity'];
                        $hasPurchase += $value['order_item_real_purchase'];
                    ?>
                    <div class="row" id="item-<?php echo $dataItem['id'] ?>">
                    <div class="left-col col-lg-4 d-flex align-items-center justify-content-between">
                    <div class="project-title d-flex align-items-center" style="overflow:hidden;">
        
                        <div class="image has-shadow">
                            <img src="<?php echo $dataItem['item_image'] ?>" class="img-fluid">
                        </div>
                        <div class="text">
                            <small>
                                <a href="<?php echo $dataItem['item_link'] ?>">
                                    <?php echo substr($dataItem['item_link'], 0, 50); ?>
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
                            <p><?php echo $apiHandlePrice->formatPrice($dataItem['item_price']) ?></p>
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
                        <div class="quantum">
                            <input type="text" class="quantity-input" style="width: 50px;" name="avt_order_item[<?php echo $value['id'] ?>][purchase_number]" value="<?php echo $value['order_item_real_purchase'] ?>">
                            <input type="hidden" name="avt_order_item[<?php echo $value['id'] ?>][item_id]" value="<?php echo $value['id'] ?>">
                        </div>     
                    </div>
                    </div>
     
                    <div class="right-col col-lg-2 d-flex align-items-center">
                    <div class="form-group">
                        <label class="form-control-label">Tổng </label>
                        <p id="price-item-<?php echo $value['id'] ?>"><?php echo $apiHandlePrice->formatPrice($dataItem['item_price'] * $dataItem['quantity']) ?></p>
                    </div>
                    </div>
                    <br>
                    <div class="right-col col-lg-12 align-items-center" style="margin-top: 10px;">
                    <div class="form-group">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Ghi Chú" value="<?php echo $dataItem['comment'] ?>">
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-primary">Ghi Chú</button>
                            </span>
                        </div>
                    </div>
                    </div>
                    </div>
                    <?php                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         endforeach; ?>
                </div>
              
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
                                    </td>
                                </tr>
                                <tr>
                                    <td>Tổng tiền hoá đơn</td>
                                    <td>
                                        <span id="total-price">
                                        <?php echo $apiHandlePrice->formatPrice($totalPrice) ?>
                                        </span>
                                        <input type="hidden" name="avt_total_price_cn" value="<?php echo $totalPrice ?>">
                                        <hr> = 
                                        <span id="total-price-vnd">
                                            <?php echo $apiHandlePrice->formatPrice($cartTotalPriceVN, 'vnđ')  ?>
                                        </span>
                                        <input type="hidden" name="avt_total_price_vn" value="<?php echo $cartTotalPriceVN ?>">
                                        <?php if (1 == $orderInfo[0]['order_status']) :  ?>
                                        <hr>
                                        <span style="color: #ff9800;"> 
                                            <i class="fa fa-exclamation-triangle"></i> Đơn hàng chưa được thanh toán.
                                        </span>
                                        <?php endif; ?>
                                    </td> 
                                </tr>
    
                                <tr>
                                    <td>
                                    </td>
                                    <td>
                                        <div class="col-sm-9">
                                            <div class="i-checks">
                                                <input id="avt_status_1" <?php echo checked($orderInfo[0]['order_status'], 2); ?> name="avt_has_pay" value="1" type="checkbox" class="checkbox-template">
                                                <label for="avt_status_1">Đã thanh toán chờ mua</label>
                                            </div>
                                            <div class="i-checks">
                                                <input id="avt_status_2" <?php echo checked($orderInfo[0]['order_buy_status'], 2); ?> name="avt_has_purchase" value="1" type="checkbox" class="checkbox-template">
                                                <label for="avt_status_2">Đã mua hàng</label>
                                            </div>

                                            <div class="i-checks">
                                                <input id="avt_status_3" <?php echo checked($orderInfo[0]['order_delivery_status'], 2); ?> name="avt_has_delivery" value="1" type="checkbox" class="checkbox-template">
                                                <label for="avt_status_3">Đã giao hàng</label>
                                            </div>

                                            <div class="i-checks">
                                                <input id="avt_status_4" <?php echo checked($orderInfo[0]['order_buy_status'], 3); ?> name="avt_has_end" value="1" type="checkbox" class="checkbox-template">
                                                <label for="avt_status_4">Hết hàng</label>
                                            </div>
                                           
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="hidden" name="avt_oder_id" value="<?php echo $orderInfo[0]['id'] ?>">
                                        <button type="submit" class="btn btn-primary">
                                            Update thông tin
                                        </button>
                                    </td>
                                    <td>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </section>
</div>

<?php
registerScrips(array(
    'page-user-tool-cart' => assets('frontend/user-tool/js/userTool-page-cart-debug.js'),
    'cart' => assets('frontend/user-tool/js/cart.js'),
));
?>