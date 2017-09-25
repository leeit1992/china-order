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
			            <h3 class="h4">#<?php echo $infoData[0]['code'] ?></h3>
			        </div>
			        <div class="card-body">
			        	<?php 
                            if( !empty( $noticeRecharge ) ) {
                            	if( $noticeRecharge['type'] ) {
                            		$classNoptice = 'alert-success';
                            	}else{
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
                        <?php if( 2 == $infoData[0]['status'] ) : ?>
                        <div class="alert alert-success" role="alert">
                            Khoản tiền đã được duyệt
                        </div>
                    	<?php endif; ?>
			            <form class="form-horizontal" method="POST" action="<?php echo url('/admcp/recharge-validate') ?>">
			                <div class="project">
							    <div class="row bg-white has-shadow">
							        <div class="right-col col-lg-12">
							            <table class="table table-striped">
							                <tbody>
							                	<tr>
							                        <td>Tài khoản</td>
							                        <td>
							                        <?php 
							                        $accountRecharge = $mdUser->getUserBy('id', $infoData[0]['user_id']);
							                        echo $accountRecharge[0]['user_name'] 
							                        ?>
							                        </td>
							                    </tr>
							                    <tr>
							                        <td>Họ và tên</td>
							                        <td><?php echo $infoData[0]['name'] ?></td>
							                    </tr>
							                    <tr>
							                        <td>Ngày nạp</td>
							                        <td><?php echo $infoData[0]['date'] ?> </td>
							                    </tr>
							                    <tr>
							                        <td>Hình thức</td>
							                        <td><?php echo $infoData[0]['type'] ?> </td>
							                    </tr>
							                    <tr>
							                        <td>Ngân hàng</td>
							                        <td>
							                        <?php 
							                        $bankInfo = $mkBank->getBy('id', $infoData[0]['bank_id']);
							                        echo $bankInfo[0]['bank_name'] . ' ( '.$bankInfo[0]['bank_user_name'].' - '.$bankInfo[0]['bank_number'].' - '.$bankInfo[0]['bank_address'].' )';
							                        ?>
							                        </td>
							                    </tr>
							                    <tr>
							                        <td>Số tiền</td>
							                        <td><?php echo $apiHandlePrice->formatPrice( $infoData[0]['price'], 'vnđ' ) ?> </td>
							                    </tr>
							                    <tr>
							                        <td>Ghi chú</td>
							                        <td><?php echo $infoData[0]['note'] ?> </td>
							                    </tr>
							                </tbody>
							            </table>
							        </div>
							    </div>
							</div>
			                <div class="form-group row">
			                    <div class="col-sm-4">
			                    	<input type="hidden" name="avt_recharge_id" value="<?php echo $rechargeId ?>">
			                    	<?php if( 1 == $infoData[0]['status'] ) : ?>
			                        <button type="submit" class="btn btn-primary">Duyệt</button>
			                    	<?php endif; ?>
			                    </div>
			                </div>
			            </form>
			        </div>
			    </div>
			</div>
		</div>
	</div>
</section>