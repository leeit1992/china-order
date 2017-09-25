<!-- Page Header-->
<header class="page-header">
    <div class="container-fluid">
        <h2 class="no-margin-bottom">Thông báo</h2>
    </div>
</header>
<br>
<section class="projects no-padding-top">
    <div class="container-fluid">
        <div class="row bg-white has-shadow">
            <div class="left-col col-lg-1 d-flex align-items-center justify-content-between">
                <div class="icon bg-green" style="padding: 20px;">
                    <i class="fa fa-check" aria-hidden="true" style="font-size: 25px;"></i>
                </div>
            </div>
            <div class="left-col col-lg-10  align-items-center" style="padding-top: 25px;">
                <h3>TẠO ĐƠN HÀNG THÀNH CÔNG!</h3>
                <p>Bạn đã kết đơn hàng thành công. Vui lòng đặt cọc 80% số tiền đơn hàng bằng cách vào các tác vụ sau:</p>
                <hr>
                <div style="padding-bottom: 10px;">
                    <a target="_blank" href="<?php echo url('/user-tool/recharge') ?>" class="btn btn-primary">Nạp tiền</a>
                    <a target="_blank" href="<?php echo url('/user-tool/detail-order/' . $id) ?>" class="btn btn-primary">Xem đơn vừa tạo</a>
                    <a target="_blank" href="<?php echo url('/user-tool/order-manage/') ?>" class="btn btn-primary">Quản lý đơn hàng</a>
                    <a target="_blank" href="<?php echo url('/user-tool/detail-order/' . $id) ?>" class="btn btn-primary">Quản lý tài chính</a>
                </div>
            </div>
        </div>
    </div>
</section>