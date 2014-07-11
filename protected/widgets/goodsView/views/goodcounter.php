<div class="cart_counter">
    <span class='cart_number_reduce'></span>
    <span class='cart_number_plus'></span>
    <?php echo CHtml::textField('cart_number',1);?>
</div>
<?php Yii::app()->clientScript->registerScript('good_counter',"
    $('.cart_number_reduce').live('click',function(){
        var num=$(this).siblings('#cart_number').val();
        num=Number(num);
        if(num<=1){
            return false;
        }else{
            num-=1;
            $(this).siblings('#cart_number').val(num.toString());
            $('#buy_number').val(num.toString());
        }
    });
    $('.cart_number_plus').live('click',function(){
        var num=$(this).siblings('#cart_number').val();
        num=Number(num);
        num+=1;
        $(this).siblings('#cart_number').val(num.toString());
        $('#buy_number').val(num.toString());
    });
",CClientScript::POS_END);?>