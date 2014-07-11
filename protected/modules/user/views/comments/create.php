<div class="list_breadcrumbs wrap">
    <?php $this->widget('zii.widgets.CBreadcrumbs', array(
        'homeLink'=>'首页',
        'links'=>array(
            '发表评论',
        ),
    )); ?><!-- breadcrumbs -->
</div>
<div class="list_wrap wrap clear">
    <div class="list_lft">
        <div class="list_lft_panel allcomments_good_panel">
            <h2>商品信息</h2>
            <div class="allcomments_good">
                <div class="allcomments_good_pic">
                    <a href=""><img src="<?php echo $good['goodImageUrl'].'/'.$good['good_thumb'];?>" alt=""></a>
                </div>
                <p class='allcomments_good_name'><?php echo $good['good_name']; ?></p>
                <p class="allcomments_good_price">折扣价:<b>￥<?php echo $good['shop_price'];?></b></p>
                <div class="allcomments_good_btn"><a href="<?php echo Yii::app()->createUrl('goods/view',array('id'=>$good['good_id']));?>" class='product_buy' target="_blank"></a></div>
            </div>
        </div>
    </div>
    <div class="list_rgt">
        <div class="comments_form_wrap">
        <?php $this->renderPartial('_form',array('model'=>$model,'good'=>$good));?>
        </div>
    </div>
</div>