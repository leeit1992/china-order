<div id="avt-admcp-handle-page">
    <header class="page-header">
        <div class="container-fluid">
            <h2 class="no-margin-bottom">Bài viết</h2>
        </div>
    </header>

    <section class="forms">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header d-flex align-items-center">
                            <h3 class="h4"><?php echo $actionName; ?>bài viết</h3>
                        </div>
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
                        <div class="card-body">
                            <form action="<?php echo url('/admcp/validate-page') ?>" method="POST">
                                <?php if ( $infoPage ): ?>
                                    <input type="hidden" name="avt_page_id" value="<?php echo $infoPage['id'] ?>">
                                <?php endif ?>
                                
                                <div class="form-group row">
                                    <label class="col-sm-3 form-control-label">Tiêu đề (*)</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="avt_page_title" value="<?php echo isset($infoPage['page_title']) ? $infoPage['page_title'] : ''; ?>">
                                    </div>
                                </div>
                                <div class="line"></div>

                                <div class="form-group row">
                                    <label class="col-sm-3 form-control-label">Mô tả (*)</label>
                                    <div class="col-sm-9">
                                        <textarea  name="avt_page_description" cols="90" rows="5"><?php echo isset($infoPage['page_description']) ? $infoPage['page_description'] : ''; ?></textarea>
                                    </div>
                                </div>
                                <div class="line"></div>

                                <div class="form-group row">
                                    <label class="col-sm-3 form-control-label">Nội dung (*)</label>
                                    <div class="col-sm-9">
                                        <textarea  name="avt_page_content" cols="90" rows="5"><?php echo isset($infoPage['page_content']) ? $infoPage['page_content'] : ''; ?></textarea>
                                    </div>
                                </div>
                                <div class="line"></div>
                                <div class="form-group row">
                                    <label class="col-sm-3 form-control-label">Tùy chọn</label>
                                    <div class="col-sm-9">
                                        <div class="i-checks">
                                            <input type="checkbox" value="1" class="checkbox-template avt-check-menu" name="avt_page_menu" <?php if (isset($infoPage['page_menu'])) {
                                                echo ($infoPage['page_menu'] == 1) ? 'checked' : '';
                                            } ?>><label>Menu</label>
                                        </div>
                                        <div class="i-checks">
                                            <input type="checkbox" value="1" class="checkbox-template avt-check-icon" name="avt_page_featured" <?php if (isset($infoPage['page_featured'])) {
                                                echo ($infoPage['page_featured'] == 1) ? 'checked' : '';
                                            } ?>>
                                            <label>Nổi bật</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="line"></div>
                                <?php 
                                $condition = 'style="display:none"';
                                if (isset($infoPage['page_menu'])): 
                                    if ($infoPage['page_menu'] == 1): 
                                        $condition = '';
                                    endif;
                                endif; ?>
                                <div class="avt-menu-js" <?php echo $condition; ?>>
                                    <div class="form-group row">
                                        <label class="col-sm-3 form-control-label">Thứ tự</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="avt_page_order" value="<?php echo isset($infoPage['page_order']) ? $infoPage['page_order'] : ''; ?>">
                                        </div>
                                    </div>
                                    <div class="line"></div>
                                </div>
                                <?php 
                                $conditionMenu = 'style="display:none"';
                                if (isset($infoPage['page_featured'])): 
                                    if ($infoPage['page_featured'] == 1): 
                                        $conditionMenu = '';
                                    endif;
                                endif; ?>
                                <div class="avt-icon-js" <?php echo $conditionMenu; ?>>
                                    <div class="form-group row">
                                        <label class="col-sm-3 form-control-label">Link icon</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="avt_page_icon" value="<?php echo isset($infoPage['page_icon']) ? $infoPage['page_icon'] : ''; ?>">
                                        </div>
                                    </div>
                                    <div class="line"></div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-4 offset-sm-3">
                                        <button type="submit" class="btn btn-primary">Lưu</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php 
registerScrips( array(
    'admcp-page-page' => assets('frontend/user-tool/js/admcp-page-page.min.js'),
) );