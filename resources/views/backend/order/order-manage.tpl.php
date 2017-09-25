<header class="page-header">
    <div class="container-fluid">
        <h2 class="no-margin-bottom">Đơn Hàng</h2>
    </div>
</header>
<section class="tables">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <h3 class="h4">Lọc tìm kiếm</h3>
                    </div>
                    <div class="card-body">
                        <form class="form-inline">
                            <div class="row">
                                <div class="form-group">
                                    <input type="text" placeholder="Ngày tháng" class="mx-sm-3 form-control">
                                </div>
                                <div class="form-group">
                                    <input type="text" placeholder="Mã đơn hàng" class="mx-sm-3 form-control">
                                </div>
                                <div class="form-group">
                                    <input type="text" placeholder="Mã vận đơn" class="mx-sm-3 form-control">
                                </div>

                                <div class="form-group">
                                    <input type="text" placeholder="Tên chủ shop" class="mx-sm-3 form-control">
                                </div>
                                
                            </div> 
                            <div class="row" style="margin-top: 10px;">
                                <div class="form-group">
                                    <input type="submit" value="Lọc tìm kiếm" class="mx-sm-3 btn btn-primary">
                                </div>
                            </div>        
                        </form>
                    </div>
                    
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card">
          
                    <div class="card-header d-flex align-items-center">
                        <h3 class="h4">Tất Cả</h3>
                    </div>
                    <div class="card-body">
                        <ul class="tabs">
                            <li><a href="<?php echo url('/admcp/order-manage') ?>" class="active">Tất cả<sup>(<?php echo count($listOrder) ?>)</sup></a></li>
                            <li><a href="<?php echo url('/admcp/order-manage?status=1') ?>">chưa thanh toán<sup>(<?php echo count($notPayment) ?>)</sup></a></li>
                            <li><a href="<?php echo url('/admcp/order-manage?status=2') ?>">Đã thanh toán chờ mua<sup>(<?php echo count($payWaitBuy) ?>)</sup></a></li>
                            <li><a href="<?php echo url('/admcp/order-manage?statusBuy=2') ?>">Đã mua<sup>(<?php echo count($hasBuy) ?>)</sup></a></li>
                            <li><a href="<?php echo url('/admcp/order-manage?statusDelivery=2') ?>">Đã giao hàng<sup>(<?php echo count($delivery) ?>)</sup></a></li>
                            <li><a href="<?php echo url('/admcp/order-manage?statusBuy=3') ?>">Hết hàng<sup>(<?php echo count($outStock) ?>)</sup></a></li>
                        </ul>
                        <div class="orderslist-ct">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Ngày tạo</th>
                                        <th>Mã đơn hàng</th>
                                        <th>Số lượng</th>
                                        <th>Mã vận đơn</th>
                                        <th>Tổng tiền</th>
                                        <th>Trạng thái</th>
                                        <th>#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; foreach ($listOrder as $value) : ?>
                                    <tr>
                                        <th scope="row"><?php echo $i++ ?></th>
                                        <td><?php echo $value['order_date'] ?></td>
                                        <td><a href="<?php echo url('/admcp/detail-order/' . $value['id']) ?>"><?php echo $value['order_code'] ?></a></td>
                                        <td><?php echo $value['order_quantity'] ?></td>
                                        <td>--</td>
                                        <td><?php echo $apiHandlePrice->formatPrice($value['order_total_price_vn'], 'vnđ') ?></td>

                                        <td>
                                            <?php if (2 == $value['order_status']) { ?>
                                            Đã mua <?php echo $value['order_real_purchase'] ?>/<?php echo $value['order_quantity'];
                                            $countPer = $value['order_real_purchase'] / $value['order_quantity'] * 100;

                                            ?> 
                                            <div class="progress">
                                                <div role="progressbar" style="width: <?php echo $countPer ?>%; height: 4px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-violet"></div>
                                            </div>
                                            <?php } else {
                                                echo '<span style="color:red;">Chưa thanh toán</span>';
} ?>
                                        </td>

                                        <td>
                                            <a href="#"> <i class="fa fa-times"></i> </a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>