<div class="payment_choice">
    <p class="pay_item">
        <?php echo CHtml::radioButton('payment_check',false,array('uncheckValue'=>null,'class'=>'ebank_check'));?>
        <label>在线支付<b></b></label>
    </p>
    <div class="payment_list" style="display:none;">
        <ul>
            <?php foreach($ebankPayments as $ebankPayment){?>
            <li class='ebank_option'>
                <img title='<?php echo $ebankPayment->pay_name;?>' src="<?php echo Yii::app()->request->baseUrl;?>/images/payment/<?php echo $ebankPayment->mark;?>.gif" alt="">
                <?php echo CHtml::hiddenField('payment_id',$ebankPayment->id,array('class'=>'payment_id'));?>
            </li>
            <?php }?>
        </ul>
    </div>
    <?php foreach($normalPayments as $normalPayment){?>
    <p class="pay_item">
        <?php echo CHtml::radioButton('payment_check',false,array('uncheckValue'=>null,'class'=>'payment_check'));?>
        <label>
            <?php echo $normalPayment->pay_name;?><b></b>
        </label>
        <?php echo CHtml::hiddenField('payment_id',$normalPayment->id,array('class'=>'payment_id'));?>
    </p>
    <?php }?>
</div>
<?php Yii::app()->clientScript->registerScript('payment_checkout',"
    $('.ebank_check').click(function(){
        $('.payment_list').show();
    });
    $('.payment_check').click(function(){
        var payId=$(this).next().find('input').val(),payText=$(this).siblings('label').text();
        $('.payment_list').hide();
        $('#payment_selected').val(payId);
        $('#payment_result').html(payText);
        checkShipFee({payId:payId});
    });
    $('.ebank_option').click(function(){
        var payName=$(this).find('img').attr('src'),payId=$(this).find('input').val();
        $(this).addClass('curr').siblings().removeClass('curr');
        $('#payment_result').html('在线支付<div><img src=\"'+payName+'\" /></div>');
        $('#payment_selected').val(payId);
        checkShipFee({payId:payId});
    });
",CClientScript::POS_END);?>