<div class="checkout_wrap wrap">
    <div class="buy_steps">
        <ul>
            <li class='step step_1'><span>1.</span>查看购物车<b></b></li>
            <li class='step step_2 step_on'><span>2.</span>确认订单信息<b></b></li>
            <li class='step step_3'><span>3.</span>提交支付<b></b></li>
        </ul>
    </div>
    <div class="receive_box checkout_box">
        <h2>收货信息<span style="display:none;"><a href="javascript:void(0)">[修改]</a></span></h2>
        <!--确认后的收货信息开始-->
        <div class="checkout_result" id='delivery_result' style='display:none'></div>
        <!--确认后的收货信息结束-->
        <div class="receive_list_wrap">
        <!--隐藏的地址列表项模板开始-->
        <p class="receive_list" id='receive_list_template' style='display:none;'>
            <?php echo CHtml::radioButton('receive_check',true,array('uncheckValue'=>null));?>
            <label>
            <span class='receive_text' id='receive_text_'></span>
            </label>
            <span class="receive_list_btn"><a href="<?php echo Yii::app()->createUrl('user/delivery/update');?>" target='_blank'>修改</a></span>
        </p>
        <!--隐藏的地址列表项模板结束-->
        <div class="receive_loop">
        <?php if($userDeliverys){?>
        <?php foreach($userDeliverys as $userDelivery){?>
        <p class="receive_list">
            <?php echo CHtml::radioButton('receive_check',false,array('uncheckValue'=>null));?>
        <label>
            <span class='receive_text' id='receive_text_<?php echo $userDelivery->id;?>'>
                <?php echo $userDelivery->consignee;?>,&nbsp;
                <?php echo $userDelivery->formatedProvince;?>,&nbsp;
                <?php echo $userDelivery->formatedCity;?>,&nbsp;
                <?php echo $userDelivery->formatedZone;?>,&nbsp;
                <?php echo $userDelivery->address;?>,&nbsp;
                <?php echo $userDelivery->zipcode;?>,&nbsp;
                <?php echo $userDelivery->phone;?>,&nbsp;
                <?php echo $userDelivery->ext;?>,
            </span>
            <?php echo CHtml::hiddenField('delivery_id',$userDelivery->id,array('class'=>'delivery_id'));?>
        </label>
        <span class="receive_list_btn"><a href="<?php echo Yii::app()->createUrl('user/delivery/update',array('id'=>$userDelivery->id));?>" target='_blank'>修改</a></span>
        </p>
        <?php }}else{?>
        <p class="receive_list">快添加收货地址吧</p>
        <?php }?>
        </div>
        <p class='receive_btn'>
            <a class='add_receive add_receive_btn' href="javascript:void(0)">想要添加新地址?</a>
            <a class='cancel_receive add_receive_btn' style='display:none' href="javascript:void(0)">不想填写了</a>
        </p>
        <!--新收货地址表单-->
        <div class="delivery_form consignee_form address_form user_box" style='display:none;'>
            <?php $this->renderPartial('_delivery',array('model'=>new UserDelivery()));?>
        </div>
        <div class="delivery_confirm_btn checkout_btn_row">
            <?php echo CHtml::button('确认收货信息',array('class'=>'delivery_confirm checkout_btn','id'=>'consignee_confirm'));?>
        </div>
        </div>
    </div>

    <div class="shippment_box checkout_box">
        <h2>配送方式<span style="display:none;"><a href="javascript:void(0)">[修改]</a></span></h2>
        <!--确认后的配送方式开始-->
        <div class="checkout_result" id='shippment_result' style='display:none'></div>
        <!--确认后的配送方式结束-->
        <div class="shippment_list_wrap">
        <?php foreach($shippments as $shippment){?>
        <p class="shippment_list">
            <?php echo CHtml::radioButton('shippment_check',false,array('uncheckValue'=>null,'class'=>'shippment_check'));?>
            <label id='shippment_text_<?php echo $shippment->id;?>'>
                <?php echo $shippment->ship_name;?>
                <span class='shippment_fee_text'>运费<b>¥<?php echo $shippment->ship_fee;?></b></span>
            </label>
            <?php echo CHtml::hiddenField('shippment_id',$shippment->id,array('class'=>'shippment_id'));?>
        </p>
        <?php }?>
        <div class="shippment_confirm_btn checkout_btn_row">
            <?php echo CHtml::submitButton('确认配送信息',array('class'=>'shippment_confirm checkout_btn','id'=>'shippment_confirm'));?>
        </div>
        </div>
    </div>

    <div class="payment_box checkout_box">
        <h2>支付方式<span style="display:none;"><a href="javascript:void(0)">[修改]</a></span></h2>
        <!--确认后的支付方式开始-->
        <div class="checkout_result" id='payment_result' style='display:none'></div>
        <!--确认后的支付方式结束-->
        <div class="payment_list_wrap">
        <?php $this->widget('widget.order.PaymentList');?>
        <div class="payment_confirm_btn checkout_btn_row">
            <?php echo CHtml::submitButton('确认支付信息',array('class'=>'payment_confirm checkout_btn','id'=>'payment_confirm'));?>
        </div>
        </div>
    </div>

    <div class="order_goods_box checkout_box">
        <h2>商品清单</h2>
        <?php $this->widget('widget.order.OrderGoods',array('goodInfo'=>$carts));?>
        <div class="bill_box">
            <p class="order_goods_sum">
                <span class="sum_expression">商品金额:<b id='cart_sum'>¥<?php echo $cartAmount['cartPrice'];?></b>(已优惠&nbsp;<b id='forable_sum'>¥<?php echo $cartAmount['favorablePrice'];?></b>)&nbsp;&nbsp;+&nbsp;&nbsp;运费:<b id='shipfee_sum'>¥0</b>-&nbsp;&nbsp;抵用券立减:<b id='bonus_sum'>¥0</b>-&nbsp;&nbsp;账户余额支付:<b id='accountPay_sum'>¥0</b></span>
                <span class="sum_result">您需支付:<b>¥<?php echo $cartAmount['cartPrice'];?></b></span>
            </p>
            <dl class='bonus'>
                <dt>使用抵用券</dt>
                <dd><input type="text"  class='checkout_text'/><button type='button' class='check_bonus'>使用</button></dd>
                <dd><span class='bonus_error'></span></dd>
            </dl>
            <dl class='account_pay'>
                <dt>使用账户余额支付<b>(您当前有<strong>10</strong>元可用余额)</b></dt>
                <dd><input type="text"  class='checkout_text'/><button type='button' class='check_account_pay'>支付</button></dd>
                <dd><span class="account_pay_error"></span></dd>
            </dl>
        </div>
    </div>
    <div class="checkout_error" style='display:none;'></div>
    <div class="submit_box">
        <?php echo CHtml::beginForm(Yii::app()->createUrl('order/pay'),'post',array('id'=>'checkout_form'));?>
        <button type='button' class='checkout_btn checkout_submit'>提交订单</button>
        <?php echo CHtml::hiddenField('Order[delivery_selected]','',array('id'=>'delivery_selected'));?>
        <?php echo CHtml::hiddenField('Order[shippment_selected]','',array('id'=>'shippment_selected'));?>
        <?php echo CHtml::hiddenField('Order[payment_selected]','',array('id'=>'payment_selected'));?>
        <?php echo CHtml::hiddenField('Order[good_info]',CJSON::encode($carts));?>
        <?php echo CHtml::hiddenField('Order[cartAmount]',CJSON::encode($cartAmount));?>
        <?php echo CHtml::hiddenField('Order[shipfee]',0);?>
        <?php echo CHtml::hiddenField('Order[shipfeeBonus]',0);?>
        <?php echo CHtml::hiddenField('Order[bonus]',0);?>
        <?php echo CHtml::hiddenField('Order[accountPay]',0);?>
        <?php echo CHtml::hiddenField('Order[order_amount]',$cartAmount['cartPrice']);?>
        <?php echo CHtml::endForm();?>
    </div>
</div>
<?php Yii::app()->clientScript->registerScript('order_checkout',"
    $('.receive_list').mouseover(function(){
        $(this).addClass('receive_list_on').siblings().removeClass('receive_list_on');
    });
    $('.receive_box h2 span a').click(function(){
        $(this).parent().hide();
        $('.receive_list_wrap').slideDown(600);
        $('.cancel_receive').hide().prev().show();
        $('.delivery_form').hide().find('input').removeAttr('checked').removeAttr('selected').val('');
        $('#delivery_result').hide();
    });
    $('.receive_list input').click(function(){
        $('.consignee_form').hide();
        $('.cancel_receive').hide().prev().show();
        $('#delivery_selected').val($(this).next().find('input').val());
    });
    $('.add_receive').click(function(){
        $('.receive_list').removeClass('receive_list_on').find('input').attr('checked',false);
        $('#delivery_selected').val('');
        $(this).hide().next().slideDown(600);
        $('.delivery_form').show();
    });
    $('.cancel_receive').click(function(){
         $(this).hide().prev().show();
        $('.delivery_form').slideUp(600);
    });
    $('.delivery_confirm').click(function(){
        if($('#delivery_selected').val()==''){
            var newItem,newItemContent,editHref,textId;
            if($('.delivery_form').find('form').serialize() == ''){
                alert('请至少选择一个收货地址');
            }else{
                $.ajax({
                    type:'POST',
                    url:'".Yii::app()->createUrl('user/delivery/create')."',
                    data:$('.delivery_form').find('form').serialize(),
                    dataType:'json',
                    success:function(data){
                            if(data.status == 1){
                            newItem=$('#receive_list_template').clone(true);
                            newItemContent= data.consignee+',&nbsp;'+
                                            data.province_id+',&nbsp;'+
                                            data.city_id+',&nbsp;'+
                                            data.zone_id+',&nbsp;'+
                                            data.address+',&nbsp;'+
                                            data.zipcode+',&nbsp;'+
                                            data.phone+',&nbsp;'+
                                            data.ext+',&nbsp;';
                            newItem.find('.receive_text').html(newItemContent);
                            textId=newItem.find('.receive_text').attr('id');
                            newItem.find('.receive_text').attr('id',textId+data.id);
                            editHref=newItem.find('.receive_list_btn a').attr('href');
                            newItem.find('.receive_list_btn a').attr('href',editHref+'?id='+data.id);
                            newItem.find('input').attr('checked','checked');
                            newItem.show().appendTo('.receive_loop');
                            $('.receive_list_wrap').hide();
                            $('#delivery_selected').val(data.id);
                            var resultId=$('#delivery_selected').val();
                            $('#delivery_result').slideDown(600).html($('#receive_text_'+resultId).html());
                            $('.receive_box h2 span').show();
                        }else{
                            var errors=data.error;
                            for(var i in errors){
                                $('#UserDelivery_'+i).next().html('<div class=\"errorMessage\">'+errors[i]+'</div>')
                            }
                        }
                    }
                });
            }
        }else{
             var resultId=$('#delivery_selected').val();
             $('#delivery_result').slideDown(600).html($('#receive_text_'+resultId).html());
             $('.receive_list_wrap').hide();
             $('.receive_box h2 span').show();
        }
    });
    $('.shippment_check').click(function(){
        $('#shippment_selected').val($(this).siblings('input').val());
        $('#shipfee_sum').text($(this).next().find('.shippment_fee_text b').text());
        $('#Order_shipfee').val($(this).next().find('.shippment_fee_text b').text().substring(1));
        checkSum();
    });
    $('.shippment_confirm').click(function(){
        var shippmentId=$('#shippment_selected').val();
        $('#shippment_result').slideDown(600).html($('#shippment_text_'+shippmentId).html());
        $('.shippment_list_wrap').hide();
        $('.shippment_box h2 span').show();
    });
    $('.shippment_box h2 span a').click(function(){
        $(this).parent().hide();
        $('.shippment_list_wrap').slideDown(600);
        $('#shippment_result').hide();
    });
    $('.payment_confirm').click(function(){
        var paymentId=$('#payment_selected').val();
        $('#payment_result').slideDown(600);
        $('.payment_list_wrap').hide();
        $('.payment_box h2 span').show();
    });
    $('.payment_box h2 span a').click(function(){
        $(this).parent().hide();
        $('.payment_list_wrap').slideDown(600);
        $('#payment_result').hide();
    });

    $('.checkout_submit').click(function(e){
        e.preventDefault();
        var checkoutError='';
        if($('#delivery_selected').val() == ''){
            checkoutError+='<span>收货地址不能为空!</span>';
        }
        if($('#shippment_selected').val() == ''){
            checkoutError+='<span>配送方式不能为空!</span>';
        }
        if($('#payment_selected').val() == ''){
            checkoutError+='<span>支付方式不能为空!</span>';
        }
        if(checkoutError != ''){
            $('.checkout_error').show().html(checkoutError);
        }else{
            $('#checkout_form').trigger('submit');
        }
    });
    var checkSum=function(){
        var sumResult=Number($('#cart_sum').text().substring(1));
        sumResult-=Number($('#favorable_sum').text().substring(1));
        sumResult+=Number($('#shipfee_sum').text().substring(1));
        sumResult-=Number($('#bonus_sum').text().substring(1));
        sumResult-=Number($('#accountPay_sum').text().substring(1));
        sumResult=sumResult.toFixed(2);
        $('.sum_result b').text('¥'+String(sumResult));
        $('#order_amount').val(sumResult);
    };
    var checkShipFee=function(postVars){
        if($('#shippment_selected').val()==''){
            return false;
        }
        if(postVars){
            var newShipfee,oldShipfee=$('#Order_shipfee').val();
            $.extend(postVars,{shipfee:oldShipfee});
            $.post('".Yii::app()->createUrl('order/checkShipfee')."',postVars,function(data){
                if(data.status == 1){
                   newShipFee=oldShipfee-data.ship_fee_bonus;
                   $('#shipfee_sum').text('¥'+newShipFee.toFixed(2)).after('<i>(已优惠<b>¥'+data.ship_fee_bonus.toFixed(2)+'</b>)</i>');
                   $('#Order_shipfeeBonus').val(data.ship_fee_bonus);
                }else{
                   $('#shipfee_sum').text('¥'+oldShipfee).next('i').empty().remove();
                   $('#Order_shipfeeBonus').val(0);
                }
            },'json');
        }else{
            return false;
        }
    };
    $('.check_bonus').click(function(){
        var bonus=$(this).prev().val();
        if(bonus == ''){
            return false;
        }else{
            $.post('".Yii::app()->createUrl('order/checkBonus')."',{bonus:bonus},function(data){
                if(data.status == 1){
                    $('#bonus_sum').text('¥'+data.bonus);
                    $('#Order_bonus').val(data.bonus);
                    checkSum();
                }else{
                    $('.bonus_error').text(data.error);
                }
            },'json');
        }
    });
    $('.check_account_pay').click(function(){
        var accountPay=$(this).prev().val();
        if(accountPay == ''){
            return false;
        }else{
            $.post('".Yii::app()->createUrl('order/checkAccountPay')."',{accountPay:accountPay},function(data){
                if(data.status == 1){
                    $('#accountPay_sum').text('¥'+data.accountPay);
                    $('#Order_accountPay').val(data.accountPay);
                    checkSum();
                }else{
                    $('.account_pay_error').text(data.error);
                }
            },'json');
        }
    });
",CClientScript::POS_END);?>