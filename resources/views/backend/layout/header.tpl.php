<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>VẬN CHUYỂN HÀNG 24H</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="robots" content="all,follow">

        <!-- Google fonts - Roboto -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,700">
        <link rel="shortcut icon" href="img/favicon.ico">
        <!-- Font Awesome CDN-->
        <!-- you can replace it by local Font Awesome-->
        <script src="<?php echo assets('frontend/user-tool/js/fontawesome.js') ?>"></script>

        <?php  
            enqueueStyle(
                array(
                        'bootstrap'  => assets('frontend/user-tool/css/bootstrap.min.css'),
                        'default'  => assets('frontend/user-tool/css/style.default.css'),
                        'main'  => assets('frontend/user-tool/css/custom.css'),
                        'icons'  => assets('frontend/user-tool/css/icons.css'),
                        'user-custom'  => assets('frontend/user-tool/css/user-custom.css'),
                    )
            );
        ?>

        <script type="text/javascript">
            window.AVTDATA = {
                adminUrl: "<?php echo url('/admcp'); ?>",
                SITE_URI: "<?php echo url('/'); ?>",
            }
        </script>
        <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
    </head>
<body>

