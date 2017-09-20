<div id="page-user-tool-cart">
    <!-- Page Header-->
    <header class="page-header">
        <div class="container-fluid">
            <h2>Giỏ Hàng</h2>
             <strong>MÃ</strong> : TAU-1Cuong59HN-<?php echo date('d-m-Y') ?> (<?php echo date('d-m-Y') ?>)
        </div>
    </header>
    <section class="projects">
        <div class="container-fluid">
            <!-- Project-->
            <div class="project">
                <?php 
                    $totalPrice = 0;
                    $countItem = 0;
                    foreach ($listCart as $key => $carts): 
                ?>
                <div class="avt-group-item bg-white has-shadow">
                    <div class="avt-row-sale">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="checkbox" value="<?php echo $key ?>" class="checkbox-template avt-checkbox-primary-js">
                               <label> Người bán: <?php echo $carts[0]['seller_name']; ?> </label>
                            </div>
                        </div>
                    </div>
                    <?php 
                        foreach ($carts as $value): 
                        $colorSize = explode(';',$value['color_size']);

                        foreach ($colorSize as $keyS => $valueS) {
                            if( empty( $valueS ) ) {
                                unset($colorSize[$keyS]);
                            }
                        }

                        $totalPrice += $value['item_price'] * $value['quantity'];
                        $countItem += $value['quantity'];
                    ?>
                    <div class="row" id="item-<?php echo $value['id'] ?>">
                        <div class="left-col col-lg-6 d-flex align-items-center justify-content-between">
                            <div class="project-title d-flex align-items-center">
                                <div style="width: 20px;">
                                    <input type="checkbox" value="<?php echo $value['item_id'] ?>" class="checkbox-template avt-checkbox-child-js">
                                </div>
                                <div class="image has-shadow">
                                    <img src="<?php echo $value['item_image'] ?>" class="img-fluid">
                                </div>
                                <div class="text">
                                    <small>
                                        <a href="<?php echo $value['item_link'] ?>">
                                            <?php echo substr($value['item_link'], 0, 50); ?>
                                        </a>
                                    </small>
                                    <br>
                                    <small><?php echo implode(', ',$colorSize) ?></small>
                                </div>
                            </div>
                        </div>
                        <div class="right-col col-lg-2 d-flex align-items-center">
                            <div class="form-group">
                                <label class="form-control-label">Giá </label>
                                <p><?php echo $apiHandlePrice->formatPrice( $value['item_price'] ) ?></p>
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
                                <p id="price-item-<?php echo $value['id'] ?>"><?php echo $apiHandlePrice->formatPrice( $value['item_price'] * $value['quantity'] ) ?></p>
                            </div>
                        </div>
                        <br>
                        <div class="right-col col-lg-12 align-items-center" style="margin-top: 10px;">
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Ghi Chú" value="<?php echo $value['comment'] ?>">
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
                <div class="row bg-gray has-shadow">
                    <div class="right-col col-lg-6"></div>
                    <div class="right-col col-lg-6">
                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <td>Tổng sản phẩm</td>
                                    <td id="total-item"><?php echo $countItem ?></td>
                                </tr>
                                <tr>
                                    <td>Tổng Tiền</td>
                                    <td>
                                        <span id="total-price"><?php echo $apiHandlePrice->formatPrice( $totalPrice ) ?></span>
                                        <hr> = 
                                        <span id="total-price-vnd"><?php echo $apiHandlePrice->formatPrice( $totalPrice * 3540, 'vnđ' )  ?></span>
                                    </td> 
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>
                                        <button type="button" data-toggle="modal" data-target="#myModal" class="btn btn-primary">Xạc nhận đơn hàng </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php 
registerScrips( array(
    'page-user-tool-cart' => assets('frontend/user-tool/js/userTool-page-cart-debug.js'),
    'cart' => assets('frontend/user-tool/js/cart.js'),
) );
?>