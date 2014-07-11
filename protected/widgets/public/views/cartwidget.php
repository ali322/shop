<div class="mini_cart">
    <span class='cart_info'>购物车:<strong><?php echo count($cartsAmount['carts']); ?></strong>件</span>
    <div class="cart_items clear">
        <?php if($cartsAmount['carts']){ ?>
        <ul>
            <?php foreach($cartsAmount['carts'] as $cartId=>$cart){ ?>
            <li>
                <span class="cart_item cart_good_img"><a href=""><img src="<?php echo $cart['goodImageUrl'].'/'.$cart['good_thumb'];?>" alt=""></a></span>
                <span class="cart_item mini_cart_good_name"><a href=""><?php echo $cart['good_name'];?></a></span>
                <span class="cart_item cart_num"><strong><b>¥<?php echo $cart['shop_price'];?></b>x<b><?php echo $cart['buy_number'];?></b></strong><a href="<?php echo Yii::app()->createUrl('cart/delete',array('cartId'=>$cartId));?>">删除</a></span>
            </li>
            <?php } ?>
            <li class='cart_sum'>
                共<strong><?php echo count($cartsAmount['carts']); ?></strong>件商品 金额总计(预估):<strong><?php echo $cartsAmount['cartPrice'];?></strong>元
            </li>
        </ul>
        <?php }else{ ?>
        <div class="empty_cart empty_cart_mini">
            <div class="empty_cart_text">
                <h3>您的购物车还是空的</h3>
                    <span>您还没有添加任何商品。马上去 [ <a href="<?php echo Yii::app()->createUrl('site/index'); ?>">挑选商品</a> ]，或者去 [ <a href="<?php echo Yii::app()->createUrl('user/collect');?>">我的收藏夹</a> ]看看。你可能还未登录，可能导致购物车的商品没有显示。马上去 [ <a
                            href="<?php echo Yii::app()->createUrl('user/login');?>">登录</a> ]</span>
            </div>
        </div>
        <?php } ?>
    </div>
</div>
<div class='check_cart'><a href='<?php echo Yii::app()->createUrl('cart/index'); ?>' target='_blank'>去结算</a></div>
<?php Yii::app()->clientScript->registerScript('cart_bar',"
            $('.mini_cart').mouseenter(function(){
                $(this).find('.cart_items').show();
            }).mouseleave(function(){
                $(this).find('.cart_items').hide();
            });
        ",CClientScript::POS_END);?>