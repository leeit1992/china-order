<header class="page-header">
	<div class="container-fluid">
	  	<h2 class="no-margin-bottom">Tài chính</h2>
	</div>
</header>

<section class="forms">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
			    <div class="card">
			        <div class="card-header d-flex align-items-center">
			            <h3 class="h4">NẠP TIỀN VÀO TÀI KHOẢN</h3>
			        </div>
			        <div class="card-body">
			        	<?php
                        if (!empty($noticeRecharge)) {
                            if ($noticeRecharge['type']) {
                                $classNoptice = 'alert-success';
                            } else {
                                $classNoptice = 'alert-danger';
                            }
                            ?>
                            <div class="alert <?php echo $classNoptice ?>" role="alert">
                            <?php
                                echo $noticeRecharge['notice'];
                            ?> 
                            </div>
                            <?php
                        }
                        ?>
                        <form class="form-horizontal" method="POST" action="<?php echo url('/user-tool/recharge-validate') ?>">
                            <div class="form-group row">
                                <label class="col-sm-3 form-control-label">Ngày nạp (*)</label>
                                <div class="col-sm-9">
                                    <input type="text" name="avt_recharge_date" class="form-control op-datepicker">
                                </div>
                            </div>
                            <div class="line"></div>

                            <div class="form-group row">
                                <label class="col-sm-3 form-control-label">Họ và tên (*)</label>
                                <div class="col-sm-9">
                                    <input type="text" name="avt_recharge_name" class="form-control">
                                </div>
                            </div>
                            <div class="line"></div>

                            <div class="form-group row">
                                <label class="col-sm-3 form-control-label">Số tiền nạp (*)</label>
                                <div class="col-sm-9">
                                    <input type="text" name="avt_recharge_price" class="form-control avt-price">
                                </div>
                            </div>
                            <div class="line"></div>

                            <div class="form-group row">
                                <label class="col-sm-3 form-control-label">Hình thức nạp</label>
                                <div class="col-sm-9 select">
                                    <select name="avt_recharge_type" class="form-control">
                                        <option value="ck">Chuyển khoản</option>
                                        <option value="tm">Tiền mặt</option>
                                    </select>
                                </div>
                            </div>
                            <div class="line"></div>

                            <div class="form-group row">
                                <label class="col-sm-3 form-control-label">Ngân hàng (Nếu là hình thức chuyển khoản)</label>
                                <div class="col-sm-9 select">
                                    <select name="avt_recharge_bank" class="form-control">
                                        <?php foreach ($mkBank->getAll() as $key => $value) : ?>
                                        <option value="<?php echo $value['id'] ?>"><?php echo $value['bank_name'] . ' ( '.$value['bank_user_name'].' - '.$value['bank_number'].' - '.$value['bank_address'].' )'; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="line"></div>

                            <div class="form-group row">
                                <label class="col-sm-3 form-control-label">Ghi chú</label>
                                <div class="col-sm-9">
                                    <textarea name="avt_recharge_note" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="line"></div>

                            <div class="form-group row">
                                <div class="col-sm-4 offset-sm-3">
                                    <button type="submit" class="btn btn-primary">Nạp Tiền</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>