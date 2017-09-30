<?php $i = 1;  foreach ($revenueExpenes as $value) : ?>
    <tr>
        <th scope="row"><?php echo $i++ ?></th>
        <td><?php
            $infoOrder = $mdOrder->getBy('id', $value['order_id']);
        if (isset($infoOrder[0]['order_code'])) {
            ?>
            <a href="<?php echo url('/user-tool/detail-order/' . $infoOrder[0]['id']) ?>"><?php echo $infoOrder[0]['order_code'] ?></a>
            <?php
        }
        ?></td>
        <td><?php echo $apiHandlePrice->formatPrice($value['payment'], 'vnđ') ?></td>
        <td><?php echo $apiHandlePrice->formatPrice($value['rest_payment'], 'vnđ') ?></td>
        <td><?php echo $value['date'] ?></td>
    </tr>
<?php endforeach; ?>
