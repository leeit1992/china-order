<header class="page-header">
    <div class="container-fluid">
        <h2 class="no-margin-bottom">Thành viên</h2>
    </div>
</header>
<section class="forms">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <h3 class="h4">Cập nhật thông tin</h3>
                    </div>
                    <div class="card-body">
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
                        <form action="<?php echo url('/admcp/edit-user-validate') ?>" method="POST">
                            <input type="hidden" name="avt_user_id" value="<?php echo $infoUser['id'] ?>">
                            <div class="form-group row">
                                <label class="col-sm-2 form-control-label">Tên thành viên</label>
                                <div class="col-sm-9">
                                    <input type="text" name="avt_user_display_name" class="form-control" value="<?php echo $infoUser['user_display_name'] ?>">
                                </div>
                            </div>
                            <div class="line"></div>
                            <div class="form-group row">
                                <label class="col-sm-2 form-control-label">Số tiền</label>
                                <div class="col-sm-9">
                                    <input type="text" name="avt_user_money" class="form-control avt-price" value="<?php echo $infoUser['user_money'] ?>">
                                </div>
                            </div>
                            <div class="line"></div>

                            <div class="form-group row">
                                <label class="col-sm-2 form-control-label">Thành viên</label>
                                <div class="col-sm-9">
                                    <div class="i-checks">
                                        <input type="radio" name="avt_user_level" class="radio-template" value="normal" checked>
                                        <label>Thường</label>&nbsp;&nbsp;&nbsp;
                                        <input type="radio" name="avt_user_level" class="radio-template" value="vip" <?php echo ( $metaData['user_level'] == 'vip') ? 'checked' : '' ?>>
                                        <label>VIP</label>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="line"></div>

                            <div class="form-group row">
                                <label class="col-sm-2 form-control-label">Quyền lợi</label>
                                <div class="col-sm-9">
                                    <div class="i-checks">
                                        <input type="checkbox" value="yes" class="checkbox-template" name="avt_user_debt" <?php echo ( $metaData['user_debt'] == 'yes') ? 'checked' : '' ?>>
                                        <label>Được phép nợ</label>
                                    </div>
                                </div>
                            </div>
                            <div class="line"></div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary"> Lưu thay đổi </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>