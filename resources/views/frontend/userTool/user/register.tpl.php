    <?php View('frontend/userTool/layout/header.tpl') ?> 
    <div class="page login-page">
        <div class="container d-flex align-items-center">
            <div class="form-holder has-shadow">
                <div class="row">
                    <!-- Logo & Information Panel-->
                    <div class="col-lg-6">
                        <div class="info d-flex align-items-center">
                            <div class="content">
                                <div class="logo">
                                    <h1>VẬN CHUYỂN HÀNG 24H</h1>
                                </div>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                            </div>
                        </div>
                    </div>
                    <!-- Form Panel    -->
                    <div class="col-lg-6 bg-white">
                        <div class="form d-flex align-items-center">
                            <div class="content">
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
                                <form id="register-form" action="<?php echo url('/user-tool/validateUser') ?>" method="POST">
                                    <div class="form-group">
                                        <input id="register-username" type="text" name="avt_user_name" required class="input-material">
                                        <label for="register-username" class="label-material">Tài khoản</label>
                                    </div>
                                    <div class="form-group">
                                        <input id="register-email" type="email" name="avt_user_email" required class="input-material">
                                        <label for="register-email" class="label-material">Email</label>
                                    </div>
                                    <div class="form-group">
                                        <input id="register-passowrd" type="password" name="avt_user_pass" required class="input-material">
                                        <label for="register-passowrd" class="label-material">Mật khẩu </label>
                                    </div>
                                    <div class="form-group">
                                        <input id="register-passowrd" type="password" name="avt_user_password" required class="input-material">
                                        <label for="register-passowrd" class="label-material">Nhập lại mật khẩu </label>
                                    </div>
                                    <div class="form-group terms-conditions">
                                        <input id="license" type="checkbox" class="checkbox-template" name="avt_user_rules">
                                        <label for="license">Đồng ý với các điều khoản.</label>
                                    </div>
                                    <input id="register" type="submit" value="Register" class="btn btn-primary">
                                </form><small>Quay về </small><a href="<?php echo url('/user-tool/login') ?>" class="signup">Đăng nhập</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyrights text-center">
            <p>VẬN CHUYỂN HÀNG 24H</p>
            <!-- Please do not remove the backlink to us unless you support further theme's development at https://bootstrapious.com/donate. It is part of the license conditions. Thank you for understanding :)-->
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
</body>

</html>