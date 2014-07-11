<div class="order_wrap profile_info collect_wrap">
    <h2>您最近的订单</h2>
    <table border='0' cellpadding="0" cellspacing="0" class='order_table'>
        <thead>
        <tr>
            <th>订单号</th>
            <th>订单金额</th>
            <th>下单时间</th>
            <th>支付方式</th>
            <th>订单状态</th>
            <th>支付状态</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($orders as $order){ ?>
        <tr>
            <td><?php echo $order->order_sn; ?></td>
            <td>￥<?php echo $order->order_amount; ?></td>
            <td><?php echo date('Y年m月d日 H:i:s',$order->add_time); ?></td>
            <td><?php echo $order->payment->pay_name; ?></td>
            <td><?php echo $order->formattedOrderStatus; ?></td>
            <td><?php echo $order->formattedPayStatus; ?></td>
            <td><a href="<?php echo Yii::app()->createUrl('user/order/view',array('id'=>$order->id));?>">查看</a></td>
        </tr>
        <?php } ?>
        </tbody>
    </table>
</div>