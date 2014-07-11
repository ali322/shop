<div class="product_spec_wrap">
<?php if($goodSpecs){foreach($goodSpecs as $specName=>$specValues){?>
<dl class='product_spec'>
    <dt alt='<?php echo $specName;?>'><?php echo substr($specName,strpos($specName,'_')+1);?>:</dt>
    <dd>
        <ul>
            <?php foreach($specValues as $specValue){?>
            <li class='<?php if($specValue==$defaultProduct['spec_values'][$specName])echo 'selected';?>'><span><?php echo $specValue;?></span><b></b></li>
            <?php }?>
        </ul>
    </dd>
</dl>
<?php }}?>
</div>
<dl class='product_store'>
    <dt>我要买:</dt>
    <dd>
        <?php $this->widget('widget.goodsView.GoodCounter');?>
    </dd>
    <dd class='product_store_number'>(库存<b><?php echo $defaultProduct['good_number'];?></b><?php echo $good->unit;?>)</dd>
</dl>
<?php if($defaultProduct['spec_values']){ ?>
<dl class="product_chosen">
    <dt>您选择了</dt>
    <dd><span><?php  echo implode('，',$defaultProduct['spec_values']);?></span></dd>
</dl>
<?php } ?>
<div class="product_btn">
    <!--提交表单开始-->
    <?php echo CHtml::beginForm($this->createUrl('cart/add'),'POST',array('id'=>'cart_form','name'=>'cart_form'));?>
    <?php echo CHtml::hiddenField('cart[good_id]',$good->good_id);?>
    <?php echo CHtml::hiddenField('cart[good_thumb]',$good->goodDetail->good_img);?>
    <?php echo CHtml::hiddenField('cart[goodImageUrl]',$good->goodDetail->getImageUrl());?>
    <?php echo CHtml::hiddenField('cart[good_name]',$good->good_name);?>
    <?php echo CHtml::hiddenField('cart[shop_price]',$defaultProduct['shop_price'],array('id'=>'shop_price'));?>
    <?php echo CHtml::hiddenField('cart[good_specs]',$defaultProduct['spec_values']?implode('，',$defaultProduct['spec_values']):'',array('id'=>'good_specs'));?>
    <?php echo CHtml::hiddenField('cart[buy_number]',1,array('id'=>'buy_number'));?>
    <?php echo CHtml::submitButton('',array('class'=>'product_buy hideFocus'));?>
    <?php echo CHtml::endForm();?>
    <!--提交表单结束-->
    <a href="<?php echo Yii::app()->createUrl('user/collect/create',array('id'=>$good->good_id));?>" class='product_collect hideFocus' target='_blank'>加收藏</a>
</div>
<?php Yii::app()->clientScript->registerScript('good_products',"
    $('.product_spec li').live('click',function(){
        $(this).addClass('selected').siblings().removeClass('selected');
        var specs=new Array(),selectedSpec=null;
        $('.product_spec').each(function(){
            specs.push($(this).find('li.selected span').text());
        });
        specs=specs.join(',');
        selectedSpec=$(this).parents('.product_spec').find('dt').attr('alt');
        $.post('".Yii::app()->createUrl('goods/view',$this->actionParams)."',{specs:specs,selectedSpec:selectedSpec},function(data){
            $('.product_info').html(data);
            $('.product_shop_price strong').text($('#shop_price').val());
        },'html');
    });
",CClientScript::POS_END);?>