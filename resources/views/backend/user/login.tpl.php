    <?php View('frontend/userTool/layout/header.tpl') ?> 
    <style type="text/css">
        .login-page .form-holder .form form{
            max-width: 100%;
        }
    </style>
    <div class="page login-page">
        <div class="container d-flex align-items-center">
            <div class="form-holder">
                <div class="row">
                    <!-- Logo & Information Panel-->
                    <div class="col-lg-3">
                    </div>
                    <!-- Form Panel    -->
                    <div class="col-lg-6 bg-white">

                        <div class="form d-flex align-items-center">
                            <div class="content">
                                <?php 
                                    if( !empty( $noticeLogin ) ) {
                                        ?>
                                        <div class="alert alert-danger" role="alert">
                                            <?php
                                                echo $noticeLogin[0];
                                            ?>
                                        </div>
                                        <?php   
                                    }
                                ?>
                                <form action="<?php echo url('/admcp/validateLogin') ?>" method="POST">
                                    <div class="form-group">
                                        <input type="email" name="avt_email" required="" class="input-material">
                                        <label class="label-material">Tài khoản</label>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="avt_password" required="" class="input-material">
                                        <label class="label-material">Mật khẩu</label>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Login</button>
                                    <!-- This should be submit button but I replaced it with <a> for demo purposes-->
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                    </div>
                </div>
            </div>
        </div>
        <div class="copyrights text-center">
            <p>VẬN CHUYỂN HÀNG 24H</p>
        </div>
        <?php  
        enqueueScripts(
            array(
                    'jquery'            => assets('js/jquery.min.js'),
                    'tether'            => assets('frontend/user-tool/js/tether.min.js'),
                    'bootstrap'         => assets('frontend/user-tool/js/bootstrap.min.js'),
                    'jquery.cookie'     => assets('frontend/user-tool/js/jquery.cookie.js'),
                    'jquery.validate'   => assets('frontend/user-tool/js/jquery.validate.min.js'),

                    'jqfrontuery'       => assets('frontend/user-tool/js/front.js')
                )
        );
        ?>
    </div>
</html>