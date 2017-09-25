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
                <div class="avatar"><img src="<?php echo assets('frontend/user-tool/img/user.png') ?>" alt="<?php echo Session()->get('avt_admin_user_name') ?>" class="img-fluid rounded-circle"></div>
                <div class="title">
                    <h1 class="h4"><?php echo Session()->get('avt_admin_user_name') ?></h1>
                </div>
            </div>
            <span class="heading">Chức năng </span>
            <?php echo $menuAdmin->menuNav(); ?>
        </nav>
        <div class="content-inner">