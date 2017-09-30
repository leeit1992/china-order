<div id="avt-userT-handle-revenueExpen">
    <header class="page-header">
            <div class="container-fluid">
                <h2 class="no-margin-bottom">Tài Chính</h2>
            </div>
    </header>
    <section class="tables">
        <div class="container-fluid">
            <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header d-flex align-items-center">
                                <h3 class="h4">Lọc tìm kiếm</h3>
                            </div>
                            <div class="card-body">
                                <form class="form-inline" id="avt-userT-revenueExpen-form" method="POST">
                                    <div class="row">
                                        <div class="form-group">
                                            <input type="text" placeholder="Đơn hàng" class="mx-sm-3 form-control" name="avt_userT_revenueExpen_code">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" placeholder="Ngày tháng" class="mx-sm-3 form-control" name="avt_userT_revenueExpen_date">
                                        </div>
                                    </div> 
                                    <div class="row" style="margin-top: 5px;padding-left: 5px;">
                                        <div class="form-group">
                                            <input type="submit" value="Lọc tìm kiếm" class="mx-sm-3 btn btn-primary">
                                        </div>
                                    </div>        
                                </form>
                            </div>
                            
                        </div>
                    </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header d-flex align-items-center">
                            <h3 class="h4">Danh sách chi tiêu</h3>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Đơn Hàng</th>
                                        <th>Thanh toán</th>
                                        <th>Còn Nợ</th>
                                        <th>Ngày</th>
                                    </tr>
                                </thead>
                                <tbody class="avt-userT-revenueExpen-not-js">
                                    <?php $i = 1;  foreach ($listData as $value) : ?>
                                    <tr>
                                        <th scope="row"><?php echo $i++ ?></th>
                                        <td><?php
                                            $infoOrder = $mdOrder->getBy('id', $value['order_id']);
                                        if (isset($infoOrder[0]['order_code'])) {
                                            ?>
                                            <a href="<?php echo url('/user-tool/detail-order/' . $infoOrder[0]['id']) ?>"><?php echo $infoOrder[0]['order_code'] ?></a>
                                            <?php
                                        }
                                        ?></td>
                                        <td><?php echo $apiHandlePrice->formatPrice($value['payment'], 'vnđ') ?></td>
                                        <td><?php echo $apiHandlePrice->formatPrice($value['rest_payment'], 'vnđ') ?></td>
                                        <td><?php echo $value['date'] ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tbody class="avt-userT-revenueExpen-js">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php 
registerScrips( array(
    'userT-page-revenueExpen' => assets('frontend/user-tool/js/userTool-page-revenueExpen.min.js'),
) );
