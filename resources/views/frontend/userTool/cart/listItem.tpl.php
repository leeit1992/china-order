<?php
    $orderCode = Session()->get('avt_user_name') .'-HN-'. date('d-m-Y');
?>
<div id="page-user-tool-cart">
    <!-- Page Header-->
    <header class="page-header">
        <div class="container-fluid">
            <h2>Giỏ Hàng</h2>
             <strong>MÃ</strong> : <?php echo $orderCode  ?> (<?php echo date('d-m-Y') ?>)

        </div>
    </header>
    <section class="projects">
        <div class="container-fluid">
            <!-- Project-->
            <div class="project">
                <?php
                    $totalPrice = 0;
                    $countItem = 0;
                foreach ($listCart as $key => $carts) :
                ?>
                <div class="avt-group-item bg-white has-shadow">
                <div class="avt-row-sale">
                <div class="form-group">
                    <div class="input-group">
                        <?php /*
                        <input type="checkbox" value="<?php echo $key ?>" class="checkbox-template avt-checkbox-primary-js">
                        */ ?>
                        <a href="<?php echo url('/user-tool/delete-carts/'.$key) ?>" title="Delete All"><i class="fa fa-trash"></i></a>&nbsp;&nbsp;
                        <?php foreach ($carts as $value) {
                            $seller = $value['wangwang'];
                        } ?>
                        <label> Người bán: <?php echo $seller; ?> </label>
                    </div>
                </div>
                </div>
                <?php
                foreach ($carts as $value) :
                    $colorSize = [];
                    if (isset($value['property'])) {
                        $colorSize = explode(';', $value['property']);

                        foreach ($colorSize as $keyS => $valueS) {
                            if (empty($valueS)) {
                                unset($colorSize[$keyS]);
                            }
                        }
                    }
                    
                    $totalPrice += $value['price_origin'] * $value['quantity'];
                    $countItem += $value['quantity'];
                    ?>
                    <div class="row" id="item-<?php echo $value['id'] ?>">
                        <div class="left-col col-lg-6 d-flex align-items-center justify-content-between">
                            <div class="project-title d-flex align-items-center">
                            <?php /*
                            <div style="width: 20px;">
                                <input type="checkbox" value="<?php echo $value['item_id'] ?>" class="checkbox-template avt-checkbox-child-js">
                            </div> 
                            */ ?>
                            <div style="width: 30px;">
                                <a href="<?php echo url('/user-tool/delete-cart/'. $value['id']) ?>" title="Delete" class="avt-delete-item" data-id="<?php echo $value['id'] ?>"><i class="fa fa-times"></i></a>
                            </div>
                            <div class="image has-shadow">
                                <img src="<?php echo urldecode($value['image_origin']) ?>" class="img-fluid">
                            </div>
                            <div class="text">
                                <small>
                                    <a href="<?php echo $value['link_origin'] ?>">
                                        <?php echo substr($value['link_origin'], 0, 50); ?>
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
                            <p><?php echo $apiHandlePrice->formatPrice($value['price_origin']) ?></p>
                            </div>
                        </div>
                        <div class="right-col col-lg-2 d-flex align-items-center">
                            <div class="quantum">
                            <a href="javascript:;" class="discount" cart-id="<?php echo $value['id'] ?>">-</a>
                            <input type="text" value="<?php echo $value['quantity'] ?>" id="quantity-<?php echo $value['id'] ?>" class="quantity-input">
                            <a href="javascript:;" class="increment" cart-id="<?php echo $value['id'] ?>">+</a>
                            </div>
                        </div>
                        <div class="right-col col-lg-2 d-flex align-items-center">
                            <div class="form-group">
                            <label class="form-control-label">Tổng </label>
                            <p id="price-item-<?php echo $value['id'] ?>"><?php echo $apiHandlePrice->formatPrice($value['price_origin'] * $value['quantity']) ?></p>
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
                <?php endforeach; ?>
               
                <?php if (!empty($listCart)) : ?>
                <div class="row bg-gray has-shadow">
                    <div class="right-col col-lg-6"></div>
                    <div class="right-col col-lg-6">
                        <?php
                        $cartTotalPriceVN = $totalPrice * 3540;
                        ?>
                        <form action="<?php echo url('/user-tool/add-order') ?>" method="POSt">
                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <td>Tổng sản phẩm</td>
                                    <td id="total-item">
                                        <?php echo $countItem ?>
                                        <input type="hidden" name="avt_quanlity" value="<?php echo $countItem ?>">
                                        <input type="hidden" name="avt_order_code" value="<?php echo $orderCode ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Tổng Tiền</td>
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
                                    </td> 
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>
                                        <button type="submit" class="btn btn-primary">
                                        Xạc nhận đơn hàng 
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        </form>
                    </div>
                </div>
                <?php endif; ?>

                <?php if (empty($listCart)) : ?>
                <section class="projects no-padding-top">
                    <div class="container-fluid">
                        <div class="row bg-white has-shadow">
                            <div class="left-col col-lg-1 d-flex align-items-center justify-content-between">
                                <div class="icon bg-green" style="padding: 20px;">
                                    <i class="fa fa-exclamation-triangle" aria-hidden="true" style="font-size: 25px;"></i>
                                </div>
                            </div>
                            <div class="left-col col-lg-10  align-items-center" style="padding-top: 25px;">
                                <h3>GIỎ HÀNG RỖNG</h3>
                                <p>Chưa có sản phẩm nào trong giỏ hàng.</p>
                                
                            </div>
                        </div>
                    </div>
                </section>
                <?php endif; ?>
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