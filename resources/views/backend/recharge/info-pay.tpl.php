<section class="projects" style="padding-bottom: 20px;">
    <div class="container-fluid">
        <!-- Project-->
        <div class="card">
            <div class="card-header d-flex align-items-center">
                <h3 class="h4">Danh sách thông tin tài khoản thanh toán.</h3>
            </div>
            <div class="card-body">
                <div class="row bg-white">
                    <div class="right-col col-lg-12">
                        <?php 
                            if( !empty( $noticeAddBank ) ) {
                                if( $noticeAddBank['type'] ) {
                                    $classNoptice = 'alert-success';
                                }else{
                                    $classNoptice = 'alert-danger';
                                }
                                ?>
                                <div class="alert <?php echo $classNoptice ?>" role="alert">
                                    <?php
                                        echo $noticeAddBank['notice'];
                                    ?>
                                </div>
                                <?php   
                            }
                        ?>
                        <form action="<?php echo url('/admcp/add-pay-validate') ?>" method="POST">
                            <div class="form-group">
                                <label class="form-control-label">Tên ngân hàng</label>
                                <input type="text" name="avt_bank_name" class="form-control">
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">Tên Chủ khoản</label>
                                <input type="text" name="avt_bank_user_name" class="form-control">
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">Số tài khoản</label>
                                <input type="text" name="avt_bank_number" class="form-control">
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">Địa chỉ / Chi nhánh</label>
                                <input type="text" name="avt_bank_address" class="form-control">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary"> Thêm </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</section>
<section class="tables" style="padding-top: 0;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <h3 class="h4">Danh sách thông tin tài khoản thanh toán.</h3>
                    </div>
                    <div class="card-body">
                        <table class="table avt-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Ngân hàng</th>
                                    <th>Tên chủ khoản</th>
                                    <th>Số tài khoản</th>
                                    <th>Địa chỉ / Chi nhánh</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; foreach ($listBank as $value): ?>
                                <tr>
                                    <td><?php echo $i++ ?></td>
                                    <td><?php echo $value['bank_name'] ?></td>
                                    <td><?php echo $value['bank_user_name'] ?></td>
                                    <td><?php echo $value['bank_number'] ?></td>
                                    <td><?php echo $value['bank_address'] ?></td>
                                    <td>
                                        <a href="#"> <i class="fa fa-times"></i> </a> | 
                                        <a href="#"> <i class="fa fa-gear"></i> </a>
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