<header class="page-header">
    <div class="container-fluid">
        <h2 class="no-margin-bottom">Thành viên</h2>
    </div>
</header>
<section class="tables">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <h3 class="h4">Danh sách thành viên</h3>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Họ Tên</th>
                                    <th>Email</th>
                                    <th>Ngày Tạo</th>
                                    <th>Trạng Thái</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                            	<?php $i = 1;
                                foreach ($listUser as $key => $value) :
                                    if (1 != $value['user_role']) :
                                ?>
                                <tr>
                                    <th scope="row"><?php echo $i++ ?></th>
                                    <td><?php echo $value['user_name'] ?></td>
                                    <td><?php echo $value['user_email'] ?></td>
                                    <td><?php echo $value['user_registered'] ?></td>
                                    <td>
                                        <?php
                                        if (2 == $value['user_status']) {
                                            echo '<span style="color:red;">Đợi duyệt</span>';
                                        }

                                        if (1 == $value['user_status']) {
                                            echo '<span style="color:green;">Đã duyệt</span>';
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <a href="#"> <i class="fa fa-times"></i> </a>
                                    </td>
                                </tr>
                                <?php                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         endif;
                                endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>