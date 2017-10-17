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
                        <ul class="tabs">
                            <li><a href="<?php echo url('/admcp/recharge-manage') ?>" class="active">Tất cả<sup>(<?php echo count($listRecharge) ?>)</sup></a></li>
                            <li><a href="<?php echo url('/admcp/recharge-manage?status=2') ?>" class="">Đã duyệt<sup>(<?php echo count($listRechargeOke) ?>)</sup></a></li>
                            <li><a href="<?php echo url('/admcp/recharge-manage?status=1') ?>" class="">Đợi duyệt<sup>(<?php echo count($listRechargeNotOke) ?>)</sup></a></li>
                        </ul>
                        <div class="orderslist-ct">
                            <table class="table">
				                <thead>
				                    <tr>
				                        <th>#</th>
				                        <th>Mã</th>
				                        <th>Họ và tên</th>
				                        <th>Số tiền</th>
				                        <th>Thời gian</th>
				                        <th>Ghi chú</th>
				                        <th>Trạng thái</th>
				                        <th>#</th>
				                    </tr>
				                </thead>
				                <tbody>
				                	<?php $i = 1; foreach ($listRecharge as $value): ?>
				                    <tr>
				                        <th scope="row"><?php echo $i++ ?></th>
				                        <th>
				                        	<a href="<?php echo url('/admcp/recharge/' . $value['id']) ?>">#<?php echo uniqid(); ?></a>
				                        </th>
				                        <td><a href="<?php echo url('/admcp/recharge/' . $value['id']) ?>"><?php echo $value['name'] ?></a></td>
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
				                        <td>
                                        <a href="<?php echo url('/admcp/remove-recharge/'.$value['id']) ?>"> <i class="fa fa-times"></i> </a>
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