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
			            <h3 class="h4">Danh Sách Nạp Tiền</h3>
			        </div>
			        <div class="card-body">
			        	<p class="text-right" style="padding-right: 90px;">
                                TỔNG SỐ TIỀN ĐÃ NẠP: &nbsp;<strong class="text-danger" style="font-size: 20px"><?php echo $apiHandlePrice->formatPrice($total_price, 'vnđ') ?></strong>
                            </p>
			            <table class="table">
			                <thead>
			                    <tr>
			                        <th>#</th>
			                        <th>Họ và tên</th>
			                        <th>Số tiền</th>
			                        <th>Thời gian</th>
			                        <th>Ghi chú</th>
			                        <th>Trạng thái</th>
			                    </tr>
			                </thead>
			                <tbody>
			                	<?php $i = 1; foreach ($listRecharge as $value): ?>
			                    <tr>
			                        <th scope="row"><?php echo $i++ ?></th>
			                        <td><?php echo $value['name'] ?></td>
			                        <td><?php echo $apiHandlePrice->formatPrice( $value['price'], 'vnđ' ) ?></td>
			                        <td><?php echo $value['date'] ?></td>
			                        <td><?php echo $value['note'] ?></td>
			                        <td>
			                        	<?php
			                        		if( 1 == $value['status'] ) {
			                        			echo '<span style="color:red;">Đợi duyệt</span>';
			                        		}

			                        		if( 2 == $value['status'] ) {
			                        			echo '<span style="color:green;">Đã duyệt</span>';
			                        		}
			                        	?>
			                        	
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
</section>