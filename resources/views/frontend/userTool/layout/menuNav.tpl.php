<div class="page home-page">
    <!-- Main Navbar-->
    <header class="header">
        <nav class="navbar">
            <!-- Search Box-->
            <div class="search-box">
                <button class="dismiss"><i class="icon-close"></i></button>
                <form id="searchForm" action="#" role="search">
                    <input type="search" placeholder="What are you looking for..." class="form-control">
                </form>
            </div>
            <div class="container-fluid">
                <div class="navbar-holder d-flex align-items-center justify-content-between">
                    <!-- Navbar Header-->
                    <div class="navbar-header">
                        <!-- Navbar Brand -->
                        <a href="index.html" class="navbar-brand">
                            <div class="brand-text brand-big hidden-lg-down">VẬN CHUYỂN HÀNG 24H</div>
                            <div class="brand-text brand-small"><strong>BD</strong></div>
                        </a>
                        <!-- Toggle Button--><a id="toggle-btn" href="#" class="menu-btn active"><span></span><span></span><span></span></a>
                    </div>
                    <!-- Navbar Menu -->
                    <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
                        <!-- Search-->
                        <li class="nav-item d-flex align-items-center">
                            <a id="search" href="#">
                                <i class="icon-search"></i>
                            </a>
                        </li>
                        <!-- Notifications-->
                        <!-- Messages                        -->
                        <li class="nav-item dropdown">
                            <ul aria-labelledby="notifications" class="dropdown-menu">
                                <?php 
                                $countItem = 0;
                                foreach ($cartInfo as $carts) :
                                    foreach ($carts as $value): 
                                    $colorSize = explode(';', $value['property']);

                                    foreach ($colorSize as $keyS => $valueS) {
                                        if (empty($valueS)) {
                                            unset($colorSize[$keyS]);
                                        }
                                    }
                                    $countItem +=  $value['quantity']
                                ?>
                                <li>
                                    <a rel="nofollow" href="#" class="dropdown-item d-flex">
                                        <div class="msg-profile">
                                            <img src="<?php echo urldecode($value['image_origin']) ?>" class="img-fluid rounded-circle">
                                        </div>
                                        <div class="msg-body">
                                            <h3 class="h5"><?php echo isset($value['type']) ? ucfirst($value['type']) : '' ?></h3>
                                            <span>Quantity: <?php echo isset($value['quantity']) ? ucfirst($value['quantity']) : '' ?></span>
                                        </div>
                                    </a>
                                </li>
                                <?php endforeach; ?>
                                <?php endforeach; ?>
                                <li>
                                    <a rel="nofollow" href="<?php echo url('/user-tool/cart') ?>" class="dropdown-item all-notifications text-center"> 
                                        <strong>Read all cart</strong>
                                    </a>
                                </li>
                            </ul>
                            <a id="messages" rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link">
                                <i class="fa fa-cart-arrow-down" aria-hidden="true"></i>
                                <span class="badge bg-orange">
                                    <?php echo $countItem ?>
                                </span>
                            </a>
                        </li>

                        <!-- Messages                        -->
                        <li class="nav-item dropdown"> <a id="messages" rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link"><i class="fa fa-envelope-o"></i><span class="badge bg-orange"><?php echo ($totalNotice > 0) ? $totalNotice : '' ?></span></a>
                            <?php if ($totalNotice > 0): ?>
                                <ul aria-labelledby="notifications" class="dropdown-menu">
                                    <?php foreach ($listNotice as $item): ?>
                                        <li><a rel="nofollow"  href="#" data-link="<?php echo url($item['notice_link']); ?>" class="dropdown-item d-flex avt-notice-status" data-id="<?php echo $item['id']; ?>" >
                                                <div class="msg-body">
                                                    <h3 class="h5">
                                                        <?php $user = $mdUser->getUserBy( 'id', $item['notice_sender']);
                                                            echo $user[0]['user_display_name']
                                                        ?>
                                                    </h3><span>
                                                        <?php echo $item['notice_title']; ?>
                                                    </span>
                                                </div>
                                        </a></li>
                                    <?php endforeach ?>

                                    <li><a rel="nofollow" href="<?php echo url('/user-tool/order-manage') ?>" class="dropdown-item all-notifications text-center"> <strong>Read all messages</strong></a></li>
                                </ul>
                            <?php endif ?>
                        </li>
                        <!-- Logout    -->
                        <li class="nav-item"><a href="<?php echo url('/user-tool/logout') ?>" class="nav-link logout">Logout<i class="fa fa-sign-out"></i></a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <div class="page-content d-flex align-items-stretch">
        <!-- Side Navbar -->
        <nav class="side-navbar">
            <div class="sidebar-header d-flex align-items-center">
                <div class="avatar"><img src="<?php echo assets('frontend/user-tool/img/user.png') ?>" alt="<?php echo Session()->get('avt_user_name') ?>" class="img-fluid rounded-circle"></div>
                <div class="title">
                    <h1 class="h4"><?php echo Session()->get('avt_user_name') ?></h1>
                    <p>Member VIP</p>
                </div>
            </div>
            <!-- Sidebar Navidation Menus-->
            <span class="heading">
            <span class="rate">Tỷ giá: <strong>1 tệ</strong> = <strong>3.540 vnđ</strong></span>
            </span>
            <!-- Sidebar Navidation Menus--><span class="heading">Chức năng </span>
            <?php echo $menuAdmin->menuNav(); ?>
        </nav>
        <div class="content-inner">