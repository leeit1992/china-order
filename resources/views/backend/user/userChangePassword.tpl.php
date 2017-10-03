<header class="page-header">
	<div class="container-fluid">
	  	<h2 class="no-margin-bottom">Tài Khoản</h2>
	</div>
</header>

<section class="forms">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
			    <div class="card">
			        <div class="card-header d-flex align-items-center">
			            <h3 class="h4">Đổi Mật Khẩu </h3>
			        </div>
			        <?php 
                        if( !empty( $noticeSuccess ) ) {
                            ?>
                            <div class="alert alert-success" role="alert">
                                <?php
                                    echo $noticeSuccess[0];
                                ?>
                            </div>
                            <?php   
                        }
                        if( !empty( $noticeError ) ) {
                            ?>
                            <div class="alert alert-danger" role="alert">
                                <?php
                                    echo $noticeError[0];
                                ?>
                            </div>
                            <?php   
                        }
                    ?>
			        <div class="card-body">
			            <form action="<?php echo url('/admcp/handleChangePass') ?>" method="POST">
			            	<input type="hidden" name="avt_id" value="<?php  echo Session()->get('avt_admin_user_id');  ?>">
			                <div class="form-group row">
			                    <label class="col-sm-3 form-control-label">Mật khẩu cũ (*)</label>
			                    <div class="col-sm-9">
			                        <input type="password" class="form-control" name="avt_pass_old">
			                    </div>
			                </div>
			                <div class="line"></div>

			                <div class="form-group row">
			                    <label class="col-sm-3 form-control-label">Mật khẩu mới (*)</label>
			                    <div class="col-sm-9">
			                        <input type="password" class="form-control" name="avt_pass">
			                    </div>
			                </div>
			                <div class="line"></div>

			                <div class="form-group row">
			                    <label class="col-sm-3 form-control-label">Nhập lại mật khẩu mới (*)</label>
			                    <div class="col-sm-9">
			                        <input type="password" class="form-control" name="avt_pass_confirm">
			                    </div>
			                </div>
			                <div class="line"></div>

			                <div class="form-group row">
			                    <div class="col-sm-4 offset-sm-3">
			                        <button type="submit" class="btn btn-primary">Lưu</button>
			                    </div>
			                </div>
			            </form>
			        </div>
			    </div>
			</div>
		</div>
	</div>
</section>