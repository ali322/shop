<div class="order_view_wrap wrap">
    <div class="order_state">
        <b>订单编号:<i><?php echo $model->order_sn; ?></i></b><b>订单状态:<i class='state_1'>等待发货中</i></b>
    </div>
    <div class="order_process">
        <div class="node ready_node">
            <span>
                <p>提交订单</p>
                <p class='ready_time'>2012-07-31 12:00:00</p>
            </span>
        </div>
        <div class="line ready_line"></div>
        <div class="node ready_node">
            <span>
                <p>商品出库</p>
                <p class='ready_time'>2012-07-31 12:00:00</p>
            </span>
        </div>
        <div class="line ready_line"></div>
        <div class="node ready_node">
            <span>
                <p>等待收货</p>
                <p class='ready_time'>2012-07-31 12:00:00</p>
            </span>
        </div>
        <div class="line"></div>
        <div class="node">
            <span>
                <p>完成</p>
                <p class='ready_time'>2012-07-31 12:00:00</p>
            </span>
        </div>
    </div>
<div class="order_view_box">
    <h2>订单信息</h2>
    <div class='order_view_consignee order_view_item'>
        <h3>收货信息</h3>
            <span class="consignee_show">
                <?php echo $model->delivery->consignee;?>,&nbsp;
                <?php echo $model->delivery->formatedProvince;?>,&nbsp;
                <?php echo $model->delivery->formatedCity;?>,&nbsp;
                <?php echo $model->delivery->formatedZone;?>,&nbsp;
                <?php echo $model->delivery->address;?>,&nbsp;
                <?php echo $model->delivery->zipcode;?>,&nbsp;
                <?php echo $model->delivery->phone;?>,&nbsp;
                <?php echo $model->delivery->ext;?>,
            </span>
    </div>
    <div class='order_view_shipment order_view_item'>
            <h3>送货方式</h3>
            <span class="ship_show"><?php echo $model->shippment->ship_name;?></span>
    </div>
    <div class='order_view_payment order_view_item'>
            <h3>支付方式</h3>
            <span class="payment_show"><?php echo $model->payment->pay_name;?></span>
    </div>
     <div class='order_view_goods order_view_item'>
            <h3>购物清单:</h3>
            <?php $this->widget('widget.order.OrderGoods',array('goodInfo'=>CJSON::decode($model->good_info)));?>
     </div>
     <div class="order_view_sum">
            <p class='good_amount'>商品金额总计:￥<?php echo $model->good_amount;?></p>
            <p class='ship_fee'>运费:￥<?php echo $model->ship_fee;?></p>
            <p class='bonus_fee'>优惠金额:￥<?php echo $model->bonus_fee;?></p>
            <p class='order_amount'>订单总金额:<b>￥<?php echo $model->order_amount;?></b></p>
     </div>
</div>
</div>