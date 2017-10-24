<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>VẬN CHUYỂN HÀNG 24H</title>
    <!-- Google font -->
    <link rel='stylesheet' type='text/css' href='http://fonts.googleapis.com/css?family=Arvo:400,400italic%7CMontserrat:400,700' />
    <!-- CSS STYLE -->
    <link rel="stylesheet" type="text/css" href="<?php echo assets('/frontend/site/css/bootstrap.css') ?>" media="screen" />
    <link rel="stylesheet" type="text/css" href="<?php echo assets('/frontend/site/css/style.css') ?>" media="screen" />
    <link rel="stylesheet" type="text/css" href="<?php echo assets('/frontend/site/css/icomoon.css') ?>" media="screen" />
    <link rel="stylesheet" type="text/css" href="<?php echo assets('/frontend/site/css/font-awesome.min.css') ?>" media="screen" />
    <link rel="stylesheet" type="text/css" href="<?php echo assets('/frontend/site/css/owl.carousel.css') ?>" media="screen" />
    <link rel="stylesheet" type="text/css" href="<?php echo assets('/frontend/site/css/animate.css') ?>" media="screen" />
    <link rel="stylesheet" type="text/css" href="<?php echo assets('/frontend/site/css/magnific-popup.css') ?>" media="screen" />
    <!-- COLOR OPTION STYLE -->
    <link rel="stylesheet" href="<?php echo assets('/frontend/site/css/color/color-1.css') ?>" id="color-style">
    <link rel="stylesheet" href="<?php echo assets('/frontend/site/css/style-custom.css') ?>" id="color-style">
    <!-- IE9-10 fix -->
    <!--[if IE 9]><link rel="stylesheet" type="text/css" href="css/ie9-10.css" media="screen" /><!--[endif]-->
    <!--[if !IE]><!--><script>if(/*@cc_on!@*/false){document.documentElement.className+=' ie10';}</script><!--<![endif]-->
    <!--[if lt IE 9]> <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script> <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script> <![endif]-->
    <title>W&amp;M</title>
</head>
<body onload="hide_preloader();" class="home">

<style type="text/css">
    .extentsion {
        border: 1px solid #d7d7d7;
        border-radius: 5px;
        background-color: #e5e5e5;
        margin: 0 15px;
        padding: 8px 5px;
        padding-bottom: 4px;
        margin-top: -10px;
        width: 250px;
        position: fixed;
        bottom: 0;
        right: 0;
        z-index: 9;
    }
    .extentsion a {
        text-decoration: none;
        color: #757575;
    }
    .extentsion div {
        display: inline-block;
    }
    .ext-icon {
        padding: 0px 15px 0 10px;
        border-right: 2px solid #d7d7d7;
    }
    .ext-text {
        padding: 0px 10px 0 15px;
    }
    .extentsion h5 {
        margin: 0;
        margin-bottom: 5px;
        font-size: 13px;
        font-weight: bold;
    }
    .extentsion h6 {
        margin: 0;
        font-size: 13px;
    }
</style>
<div class="extentsion">
    <a href="https://chrome.google.com/webstore/detail/c%C3%B4ng-c%E1%BB%A5-%C4%91%E1%BA%B7t-h%C3%A0ng-vanchuye/jjoegifoajbfjnjjcbphcghlmgfgcehb" target="_blank">
        <div class="ext-icon">
            <img src="http://vanchuyenchina.com/wp-content/themes/accelerate/anh/extension.png" alt="" class="img-responsive">
        </div>
        <div class="text-center ext-text">
            <h5 class="text-uppercase text-black">Công cụ đặt hàng</h5>
            <h6>Trên trình duyệt Chrome</h6>
        </div>
    </a>
</div>
<!-- Page wrap -->
<div id="page-wrap">


    <!-- Preloader -->

    <div id="preloader">

        <div class="inner">

            <img src="images/logo.png" alt="">

        </div>

    </div>

    <!-- End / Preloader -->
     <!-- Navigation -->

    <nav id="navigation" class="nav-ver1">

        <div class="container">
            <div class="row">

                <div class="logo"><a href="<?php echo url(''); ?>"><img src="<?php echo assets('/frontend/site/') ?>images/logo.png" alt=""></a></div>

                <div class="menu-mobile"><p>Menu</p></div>

                <ul class="menu">

                    <li class="<?php echo (0 == $pageCurrent ) ? 'current-page-item' : '' ?>">
                        <a href="<?php echo url('/'); ?>">Trang Chủ</a>
                    </li>
                    <?php foreach ($listMenu as $key => $value): ?>
                        <li class="<?php echo ($value['id'] == $pageCurrent ) ? 'current-page-item' : '' ?>">
                            <a href="<?php echo url('/page/' . $apiSlug->slug($value['page_title']) . '/' .$value['id'] ) ?>">
                                <?php echo $value['page_title']; ?>
                                
                            </a>
                        </li>
                    <?php endforeach ?>
                    <li>
                        <a href="#">Tài Khoản</a>
                        <ul class="submenu">
                            <li><a href="<?php echo url('/user-tool') ?>">Đăng Nhập</a></li>
                            <li><a href="<?php echo url('/user-tool/register') ?>">Đăng Ký</a></li>

                        </ul>
                    </li>
                    
                </ul>

            </div>
        </div>

    </nav>

    <!-- End / Navigation -->
