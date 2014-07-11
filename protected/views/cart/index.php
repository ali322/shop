<div class="wrap cart_wrap">
    <div class="buy_steps">
        <ul>
            <li class='step step_1 step_on'><span>1.</span>查看购物车<b></b></li>
            <li class='step step_2'><span>2.</span>确认订单信息<b></b></li>
            <li class='step step_3'><span>3.</span>提交支付<b></b></li>
        </ul>
    </div>
    <div class="cart_table">
        <?php if($cartsAmount['carts']){ ?>
        <table border="0" cellpadding="0" cellspacing="0">
            <thead>
            <tr>
                <th width='30'></th>
                <th width='580'>商品名称</th>
                <th width='120'>单价</th>
                <th width='100'>数量</th>
                <th width='100'>优惠</th>
                <th width='150'>小计</th>
                <th width='100'>操作</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($cartsAmount['carts'] as $cartId=>$cart){ ?>
            <tr>
                <td>
                    <?php echo CHtml::checkBox('cart_check',false,array('class'=>'cart_check'));?>
                </td>
                <td class='cart_good_info'>
                    <span class='cart_good_thumb'><a href=""><img src="<?php echo $cart['goodImageUrl'].'/'.$cart['good_thumb'];?>" alt=""></a></span>
                    <span class='cart_good_name'>
                        <p><a href=""><?php echo $cart['good_name'];?></a></p>
                        <p>
                            <?php foreach($cart['good_specs'] as $v){?>
                            <small><?php echo $v;?></small>
                            <?php }?>
                        </p>
                    </span>
                </td>
                <td class='cart_good_price'>¥<?php echo $cart['shop_price'];?></td>
                <td>
                    <div class="cart_counter">
                        <span class='cart_number_reduce'></span>
                        <span class='cart_number_plus'></span>
                        <?php echo CHtml::textField('cart_number',$cart['buy_number']);?>
                        <?php echo CHtml::hiddenField('cart_id',$cartId);?>
                        <?php echo CHtml::hiddenField('good_id',$cart['good_id']);?>
                        <?php echo CHtml::hiddenField('shop_price',$cart['shop_price']);?>
                    </div>
                </td>
                <td class='cart_good_price'>-</td>
                <td class='cart_good_price cart_price_sum'>¥<?php echo $cart['good_amount'];?></td>
                <td class='cart_action'>
                    <span><a href="<?php echo Yii::app()->createUrl('cart/delete',array('cartId'=>$cartId));?>">删除</a></span>
                    <span><a href="">加入收藏</a></span>
                </td>
            </tr>
            <?php } ?>
            </tbody>
        </table>
        <!--购物车提交表单开始-->
        <?php echo CHtml::beginForm($this->createUrl('order/checkout'),'POST',array('id'=>'checkout_form','name'=>'checkout_form'));?>
        <!--购物车提交表单结束-->
        <p class="cart_total">
            <span>金额总计:<strong id='good_amount'>¥<?php echo $cartsAmount['sumPrice'];?></strong></span>
            <?php echo CHtml::hiddenField('cartSum[sumPrice]',$cartsAmount['sumPrice']);?>
            <span id='favorable_total'>优惠金额:<strong>¥<?php echo $cartsAmount['favorablePrice'];?></strong></span>
            <?php echo CHtml::hiddenField('cartSum[favorablePrice]',$cartsAmount['favorablePrice']);?>
        </p>
        <div class="cart_btn">
            <div class="cart_choice">
                <input type="checkbox" id='check_all_goods' class='cart_check'/>
                <?php echo CHtml::hiddenField('selectedCarts','');?>
                <label for="check_all_goods">
                    <a href="javascript:void(0)">全选</a>
                    <a href="javascript:void(0)" id='deleteAll'>清空购物车</a>
                    <a href="javascript:void(0)" id='deleteBatch'>批量删除</a>
                </label>
            </div>
            <div class="cart_btns">
                <strong id='cart_amount'>商品总金额:<b>¥<?php echo $cartsAmount['cartPrice'];?></b></strong>
                <?php echo CHtml::hiddenField('cartSum[cartPrice]',$cartsAmount['cartPrice']);?>
                <a class='shopping'>继续购物</a>
                <button type='button' class='checkout' id='checkout'>确认结算</button>
            </div>
        </div>
        <?php echo CHtml::endForm();?>
        <?php }else{ ?>
            <div class="empty_cart">
                <div class="empty_cart_text">
                    <h3>您的购物车还是空的</h3>
                    <span>您还没有添加任何商品。马上去 [ <a href="<?php echo $this->createUrl('site/index'); ?>">挑选商品</a> ]，或者去 [ <a href="<?php echo $this->createUrl('user/collect');?>">我的收藏夹</a> ]看看。你可能还未登录，可能导致购物车的商品没有显示。马上去 [ <a
                            href="<?php echo $this->createUrl('user/login');?>">登录</a> ]</span>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
<?php $this->widget('widget.cartIndex.MinLogin',array('trigger'=>'checkout'));?>
<?php Yii::app()->clientScript->registerScript('cart_index',"
    var getCartGoods=function(){
        var cartGoods={};
        $('.cart_counter').each(function(i){
            var cartNum=$(this).find('#cart_number').val(),shopPrice=$(this).find('#shop_price').val(),sumPrice,cartId=$(this).find('#cart_id').val();
            cartGoods[cartId]={
            good_id:$(this).find('#good_id').val(),
            cart_number:cartNum,
            shop_price:shopPrice
            };
            sumPrice=cartNum*shopPrice;
            $(this).parent().siblings('.cart_price_sum').html('¥'+sumPrice.toFixed(2));
        });
        $.post('".Yii::app()->createUrl('cart/index')."',{cartGoods:cartGoods},function(data){
            $('#favorable_total strong').html('¥'+data.favorablePrice);
            $('#good_amount').html('¥'+data.sumPrice);
            $('#cart_amount b').html('¥'+data.cartPrice);
            $('#good_info').text(data.carts);
        },'json');
    }
    $('.cart_number_reduce').click(function(){
        var num=$(this).siblings('#cart_number').val();
        num=Number(num);
        if(num<=1){
            return false;
        }else{
            num-=1;
            $(this).siblings('#cart_number').val(num.toString());
            getCartGoods();
        }
    });
    $('.cart_number_plus').click(function(){
        var num=$(this).siblings('#cart_number').val();
        num=Number(num);
        num+=1;
        $(this).siblings('#cart_number').val(num.toString());
        getCartGoods();
    });
    $('#check_all_goods').click(function(){
        if($(this).is(':checked')){
            $('.cart_check').attr('checked','checked');
        }else{
            $('.cart_check').removeAttr('checked');
        }
    });
    $('.cart_check').click(function(){
        var selectedCarts=new Array();
        $('.cart_table tbody tr').each(function(i){
            if($(this).find('.cart_check').is(':checked')){
                selectedCarts.push($(this).find('#cart_id').val());
            }
        });
        $('#selectedCarts').val(selectedCarts.join(','));
    });
    $('#deleteAll').click(function(){
        var selectedCarts=new Array();
        $('.cart_table tbody tr').each(function(i){
            selectedCarts.push($(this).find('#cart_id').val());
        });
       if(selectedCarts.length>0){
           selectedCarts=selectedCarts.join(',');
           window.location.href='".Yii::app()->createUrl('cart/delete')."/cartId/'+selectedCarts;
       }else{
            return false;
       }
    });
    $('#deleteBatch').click(function(){
        var selectedCarts=new Array();
        $('.cart_table tbody tr').each(function(i){
            if($(this).find('.cart_check').is(':checked')){
                selectedCarts.push($(this).find('#cart_id').val());
            }
        });
       if(selectedCarts.length>0){
           selectedCarts=selectedCarts.join(',');
           window.location.href='".Yii::app()->createUrl('cart/delete')."/cartId/'+selectedCarts;
       }else{
            return false;
       }
    });
",CClientScript::POS_END);?>