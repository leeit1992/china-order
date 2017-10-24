<header class="page-header">
    <div class="container-fluid">
        <h2 class="no-margin-bottom">Thông báo</h2>
    </div>
</header>
<section class="tables">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <h3 class="h4">Danh sách thông báo</h3>
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
                        ?>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nội dung</th>
                                    <th>Loại thông báo</th>
                                    <th>Thời gian</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                            	<?php $i = 1;
                                foreach ($listNotice as $key => $value) :
                                ?>
                                    <tr>
                                        <th scope="row"><?php echo $i++ ?></th>
                                        <td><?php echo $value['notice_title'] ?></td>
                                        <td>
                                            <?php
                                            if ('arises_price' == $value['notice_type']) {
                                                echo 'Thanh toán phát sinh';
                                            }
                                            ?>
                                        </td>
                                        <td><?php echo $value['notice_date'] ?></td>
                                        <td>
                                            <a href="<?php echo url('/user-tool/notice-delete/' . $value['id']) ?>" title="Delete"><i class="fa fa-times"></i></a>
                                        </td>
                                    </tr>
                                <?php
                                endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>