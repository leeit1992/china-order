<div id="avt-admcp-handle-page">
    <header class="page-header">
        <div class="container-fluid">
            <h2 class="no-margin-bottom">Danh sách bài viết</h2>
        </div>
    </header>
    <section class="tables">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header d-flex align-items-center">
                            <h3 class="h4">Tất Cả</h3>
                        </div>
                        <div class="card-body">
                            <div class="orderslist-ct">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Ngày tạo</th>
                                            <th>Tiêu đề</th>
                                            <th>Thứ tự</th>
                                            <th>#</th>
                                        </tr>
                                    </thead>
                                    <tbody class="avt-admcp-orders-not-js">
                                        <?php $i = 1;
                                foreach ($listMenu as $key => $value) : ?>
                                    <tr>
                                        <th scope="row"><?php echo $i++ ?></th>
                                        <td><?php echo $value['page_date'] ?></td>
                                        <td><?php echo $value['page_title'] ?></td>
                                        <td><?php echo $value['page_order'] ?></td>
                                        <td>
                                            <a href="<?php echo url('/admcp/page-edit/' . $value['id']) ?>" title="Edit"><i class="fa fa-edit"></i></a>&nbsp;
                                            <a href="<?php echo url('/admcp/page-delete/' . $value['id']) ?>" title="Delete"><i class="fa fa-times"></i></a>
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
        </div>
    </section>
</div>