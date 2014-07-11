<p class='product_shop_price'><label>折扣价:</label><i>&yen;</i><strong class='shop_price'><?php echo $price;?></strong></p>
<?php echo CHtml::hiddenField('favorablePrice',$favorablePrice);?>
<?php if($promotionVisible){ ?>
<p class='product_limit'>
    <label>促销信息:</label>
    <span class="product_promotion">剩余<?php echo $limitInfo;?></span>
</p>
<?php } ?>