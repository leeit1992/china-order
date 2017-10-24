
    <!-- About -->

    <section id="about">

        <div class="container">

            <header class="header-section-dark">
                <h2>Vận Chuyển Hàng 24h</h2>
                <p>Nhanh - Uy Tín - Chất Lượng - An Toàn - Hiệu Quả</p>
            </header>

            <div class="image-head-about"><img src="new_banner1.png" alt=""></div>

            <div class="row feature-list style-1 text-center">
                
                <?php foreach ($listFeatured as $key => $value): ?>
                    <article class="col-md-4 col-sm-6 wow fadeInRight" data-wow-delay=".4s">
                        <a href="#"><span class="fa fa-<?php echo $value['page_icon']; ?>"></span></a>
                        <h3><?php echo $value['page_title']; ?></h3>
                        <p><?php echo $value['page_description']; ?></p>
                    </article>
                <?php endforeach ?>
            </div>
        </div>

    </section>

    <!-- End / About -->

     <!-- Services -->

    <section id="services" class="ver3">

        <div class="container">

            <header class="header-section-dark">
                <h2>QUY TRÌNH MUA HÀNG</h2>
                <p>We provide best digital solutions for your project</p>
            </header>
            <div class="transport-processes part-homepage">
            	<ul>
	                <li>
	                    <div class="icon"><i class="fa fa-download" aria-hidden="true"></i></div>
	                    <div class="title">
	                        <a href="#">
	                            Cài đặt công cụ
	                        </a>
	                    </div>
	                </li>
	                <li>
	                    <div class="icon"><i class="fa fa-search" aria-hidden="true"></i></div>
	                    <div class="title">Tìm kiếm sản phẩm</div>
	                </li>
	                <li>
	                    <div class="icon"><i class="fa fa-shopping-cart" aria-hidden="true"></i></div>
	                    <div class="title">
	                        <a href="#">
	                            Tạo đơn hàng
	                        </a>
	                    </div>
	                </li>
	                <li>
	                    <div class="icon"><i class="fa fa-money" aria-hidden="true"></i></div>
	                    <div class="title">Thanh toán tiền hàng</div>
	                </li>
	                <li>
	                    <div class="icon"><i class="fa fa-truck" aria-hidden="true"></i></div>
	                    <div class="title">Vận chuyển</div>
	                </li>
	                <li>
	                    <div class="icon"><i class="fa fa-gift" aria-hidden="true"></i></div>
	                    <div class="title">Nhận hàng</div>
	                </li>
	            </ul>
            </div>
            
        </div>

    </section>

    <!-- End / Services -->

    <!-- Client -->

    <section id="client">
        <div class="container">
            <div class="row">
                <a class="wow lightSpeedIn" data-wow-delay=".4s" href="https://taobao.com" target="_blank"><img src="<?php echo assets('/frontend/site/images/') ?>taobao.png" alt=""/></a>
                <a class="wow lightSpeedIn" data-wow-delay=".6s" href="https://www.tmall.com" target="_blank"><img src="<?php echo assets('/frontend/site/images/') ?>tmall.png" alt=""/></a>
                <a class="wow lightSpeedIn" data-wow-delay=".8s" href="https://www.1688.com" target="_blank"><img src="<?php echo assets('/frontend/site/images/') ?>1688.png" alt=""/></a>
                <a class="wow lightSpeedIn" data-wow-delay="1.2s" href="https://www.alibaba.com" target="_blank"><img src="<?php echo assets('/frontend/site/images/') ?>logo_Alibaba.png" alt=""/></a>
                <a class="wow lightSpeedIn" data-wow-delay=".6s" href="https://www.tmall.com" target="_blank"><img src="<?php echo assets('/frontend/site/images/') ?>tmall.png" alt=""/></a>
            </div>
        </div>

    </section>

    <!-- Start project -->

    <section id="start-project" class="start-project">

        <div class="container">

            <header class="header-section-dark">
                <h2>Liên Hệ</h2>
                <p>Don't hesitate to get in touch with us, we would love to discuss on your project</p>
            </header>

            <div class="row">

                <div class="contact-form wow fadeInUp" data-wow-delay=".4s">

                    <form id="contact-form" class="clearfix" action="processForm.php" method="post">
                        <div class="col-md-6">
                            <input type="text" name="name" onfocus="if(this.value == 'Full Name') { this.value = ''; }" onblur="if(this.value == '') { this.value = 'Full Name'; }" value="Full Name"/>
                        </div>

                        <div class="col-md-6">
                            <input type="text" name="email" onfocus="if(this.value == 'Email') { this.value = ''; }" onblur="if(this.value == '') { this.value = 'Email'; }" value="Email"/>
                        </div>

                        <div class="col-md-6">
                            <input type="text" name="phone" onfocus="if(this.value == 'Phone') { this.value = ''; }" onblur="if(this.value == '') { this.value = 'Phone'; }" value="Phone"/>
                        </div>

                        <div class="col-md-6">
                            <input type="text" name="website" onfocus="if(this.value == 'Website') { this.value = ''; }" onblur="if(this.value == '') { this.value = 'Website'; }" value="Website"/>
                        </div>

                        <div class="clearfix"></div>

                        <div class="col-sm-12">
                            <textarea name="message" class="textarea-form" onfocus="if(this.value == 'Message or project description') { this.value = ''; }" onblur="if(this.value == '') { this.value = 'Message or project description'; }">Message or project description</textarea>
                        </div>

                        <div class="clearfix"></div>
                        <div id="contact-content"></div>
                        <button type="submit"><span class="icofont moon-paper-plane"></span><i id="submit-contact">Gửi</i></button>

                    </form>

                </div>

            </div>
        </div>

    </section>
    <!-- End / Start project -->

    