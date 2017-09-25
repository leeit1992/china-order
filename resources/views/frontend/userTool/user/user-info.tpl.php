<section class="forms">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <h3 class="h4">#BCDAD</h3>
                    </div>
                    <div class="card-body">
                        <form class="form-horizontal" method="POST" action="https://localhost:3000/project8/admcp/recharge-validate">
                            <div class="project">
                                <div class="row bg-white has-shadow">
                                    <div class="right-col col-lg-12">
                                        <table class="table table-striped">
                                            <tbody>
                                                <tr>
                                                    <td>Tài khoản</td>
                                                    <td>
                                                        <?php echo $userInfo[0]['user_email'] ?> 
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Họ và tên</td>
                                                    <td><?php echo $userInfo[0]['user_name'] ?> </td>
                                                </tr>
                                                <tr>
                                                    <td>Ngày Tạo</td>
                                                    <td><?php echo $userInfo[0]['user_registered'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Số tiền</td>
                                                    <td><?php echo $apiHandlePrice->formatPrice($userInfo[0]['user_money'], 'vnđ') ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-4">
                                    <input type="hidden" name="avt_recharge_id" value="4">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>