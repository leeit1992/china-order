<header class="page-header">
	<div class="container-fluid">
	  	<h2 class="no-margin-bottom">Vận Chuyển</h2>
	</div>
</header>

<section class="forms">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
			    <div class="card">
			        <div class="card-header d-flex align-items-center">
			            <h3 class="h4">Danh Sách Vận Chuyển</h3>
			        </div>
			        <div class="card-body">
			            <table class="table">
			                <thead>
			                    <tr>
			                        <th>#</th>
			                        <th>Order</th>
			                        <th>Ngày Hàng Về</th>
			                        <th>Mã Vận Đơn</th>
			                        <th>Cân Nặng</th>
			                        <th>Tên Shop</th>
			                        <th>Thành Tiền</th>
			                        <th>Trạng Thái</th>
			                    </tr>
			                </thead>
			                <tbody>
			                	<?php 
			                		$i =1; foreach ($listData as $key => $value): 
			                		$infoOrder = $mdOrder->getBy('id', $value['order_id']);
			                	?>
			                		<?php if( !empty( $value['day_in_stock'] ) && !empty( $value['code'] ) ): ?>
			                		<tr>
			                			<td><?php echo $i++; ?></td>
			                			<td>
			                				<a href="<?php echo url('/user-tool/detail-order/' . $value['order_id']) ?>">
			                					<?php echo $infoOrder[0]['order_code'] ?>
			                				</a>
			                			</td>
			                			<td><?php echo $value['day_in_stock'] ?></td>
			                			<td><a href="http://www.baidu.com/s?ie=utf-8&f=8&rsv_bp=1&tn=baidu&wd=449928239221kuaidi&rsv_enter=1&rsv_n=2&rsv_sug3=7&rsv_sug4=483&rsv_sug2=0&inputT=4460"><?php echo $value['code'] ?></a></td>
			                			<td><?php echo $value['weight'] ?> Kg</td>
			                			<td><?php echo $value['shop_name'] ?></td>
			                			<td><?php echo $apiHandlePrice->formatPrice( $value['price'], 'vnđ' ) ?></td>
			                			<td>
			                				<?php
			                				if( 1 == $value['status'] ) {
			                					echo '<span style="color:red;">Chưa thanh toán</span>';
			                				}else{
			                					echo '<span style="color:blue;">Đã thanh toán</span>';
			                				}
			                				?>
			                			</td>
			                		</tr>
			                		<?php endif; ?>
			                	<?php endforeach ?>
			                </tbody>
			            </table>
			        </div>
			    </div>
			</div>
		</div>
	</div>
</section>