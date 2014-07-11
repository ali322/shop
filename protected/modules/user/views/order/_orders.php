<div class="orders_wrap">
    <div class="orders_query">
        <div class="orders_select">
            <select name="" id="">
                <option value="">近一个月</option>
                <option value="">近一个星期</option>
            </select>
        </div>
        <div class="orders_query_form">
            <form action="">
            <input type="text" class='text'/>
            <button type='submit' class='orders_query_submit'>查询</button>
            </form>
        </div>
    </div>
    <table cellpadding="0" cellspacing="0">
        <thead>
        <tr>
            <th width='12%'>订单编号</th>
            <th width='28%'>订单商品</th>
            <th width='10%'>订单金额</th>
            <th width='12%'>支付方式</th>
            <th width='12%'>下单时间</th>
            <th width='12%'>订单状态</th>
            <th width='14%'>操作</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($orders as $order){ ?>
        <tr>
            <td><?php echo $order->order_sn; ?></td>
            <td class='order_img_list'>
                <div class="img_list">
                    <?php foreach(CJSON::decode($order->good_info) as $good){ ?>
                    <a href="<?php echo Yii::app()->createUrl('goods/view',array('id'=>$good['good_id']));?>" target="_blank"><img src="<?php echo $good['goodImageUrl'].'/'.$good['good_thumb'];?>" alt="" title='<?php echo $good['good_name']; ?>'></a>
                    <?php } ?>
                </div>
            </td>
            <td>￥<?php echo $order->order_amount; ?></td>
            <td><?php echo $order->payment->pay_name; ?></td>
            <td><?php echo date('Y年m月d日 H:i:s',$order->add_time); ?></td>
            <td><?php echo $order->formattedOrderStatus.'/'.$order->formattedPayStatus; ?></td>
            <td class='order_btn'><a href="<?php echo Yii::app()->createUrl('user/order/view',array('id'=>$order->id));?>">查看</a></td>
        </tr>
        <?php }?>
        </tbody>
    </table>
    <div class="orders_pager list_goods_pager">
        <div class="pager">
        <?php $this->widget('CLinkPager',array(
                'pages'=>$pager,
                'header'=>'&nbsp',
                'cssFile'=>false
        ))?>
        </div>
    </div>
</div>