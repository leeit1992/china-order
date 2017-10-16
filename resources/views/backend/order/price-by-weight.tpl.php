<header class="page-header">
	<div class="container-fluid">
	  	<h2 class="no-margin-bottom">Quản lý giá tiền / KG</h2>
	</div>
</header>

<section class="forms">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
			    <div class="card">
			        <div class="card-header d-flex align-items-center">
			            <h3 class="h4">Thêm đơn vị tính</h3>
			        </div>
			         <?php
	                    if (!empty($updatePriceKg)) {
	                        if ($updatePriceKg['type'

	                    ]) {
	                            $classNoptice = 'alert-success';
	                        } else {
	                            $classNoptice = 'alert-danger';
	                        }
	                        ?>
	                        <div class="alert <?php echo $classNoptice ?>" role="alert">
	                        <?php
	                            echo $updatePriceKg['notice'];
	                        ?>
	                        </div>
	                        <?php
	                    }
	                ?>
			        <div class="card-body">
			            <form action="<?php echo url('/admcp/validate-price-by-weight') ?>" method="POST">
			                <div class="form-group row">
			                    <label class="col-sm-3 form-control-label">Số tiền / 1KG</label>
			                    <div class="col-sm-9">
			                        <input type="text" class="form-control avt-price" name="avt_price">
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
			<div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <h3 class="h4">Danh sách giá / 1kg.</h3>
                    </div>
                    <div class="card-body">
                        <table class="table avt-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Giá / 1KG</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                            	<?php $i=1; foreach ($currentPrice as $value) : ?>
                                <tr>
                                    <td><?php echo $i++; ?></td>
                                    <td><?php echo $apiHandlePrice->formatPrice( $value, 'vnđ' ) ?></td>
                                    <td>
                                        <a href="<?php echo url('/admcp/price-by-weight?del='.$value) ?>"> <i class="fa fa-times"></i> </a>
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