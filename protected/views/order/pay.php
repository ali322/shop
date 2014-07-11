<div class="pay_wrap wrap">
    <div class="buy_steps">
        <ul>
            <li class='step step_1'><span>1.</span>查看购物车<b></b></li>
            <li class='step step_2'><span>2.</span>确认订单信息<b></b></li>
            <li class='step step_3 step_on'><span>3.</span>提交支付<b></b></li>
        </ul>
    </div>
    <h3>您的订单已生成，请尽快支付订单！</h3>
    <p class="pay_prompt"><b>为了保证及时处理您的订单，请于下单24小时内付款，若逾期未付款订单将被取消，需重新下单。</b></p>
    <div class="pay_info_table cart_table">
    <table border="0" cellpadding="0" cellspacing="0">
        <thead>
        <tr>
            <th>订单号</th>
            <th>订单金额</th>
            <th>支付方式</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td><?php echo $order['order_sn'];?></td>
            <td><b class='pay_money'><?php echo $order['order_amount'];?></b>元</td>
            <td><div class='pay_type'><img src="<?php echo Yii::app()->request->baseUrl;?>/images/payment/cmb.gif" alt=""></div></td>
        </tr>
        </tbody>
    </table>
    </div>
    <div class="submit_box">
        <a class='pay_redirect' href='<?php echo $order['url'];?>'>提交支付</a>
    </div>
</div>