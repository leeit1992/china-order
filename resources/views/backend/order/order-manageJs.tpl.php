<?php $i = 1; foreach ($orders as $value) : ?>
    <tr>
        <th scope="row"><?php echo $i++ ?></th>
        <td><?php echo $value['order_date'] ?></td>
        <td><a href="<?php echo url('/admcp/detail-order/' . $value['id']) ?>"><?php echo $value['order_code'] ?></a></td>
        <td><?php echo $value['order_quantity'] ?></td>
        <td><?php echo $apiHandlePrice->formatPrice($value['order_total_price_vn'], 'vnđ') ?></td>

        <td>
            <?php if (2 == $value['order_status']) { ?>
            Đã mua <?php echo $value['order_real_purchase'] ?>/<?php echo $value['order_quantity'];
            $countPer = $value['order_real_purchase'] / $value['order_quantity'] * 100;

            ?> 
            <div class="progress">
                <div role="progressbar" style="width: <?php echo $countPer ?>%; height: 4px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-violet"></div>
            </div>
            <?php } else {
                echo '<span style="color:red;">Chưa thanh toán</span>';
        } ?>
        </td>

        <td>
            <a href="#"> <i class="fa fa-times"></i> </a>
        </td>
    </tr>
<?php endforeach; ?>
