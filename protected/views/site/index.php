<div class='wrap first_panel'>
    <div class="slider_wrap">
        <?php $this->widget('widget.siteIndex.SliderAd'); ?>
    </div>
    <div class="f_p_rgt">
        <!--公告开始-->
        <?php $this->widget('widget.siteIndex.Announcement'); ?>
        <!--公告结束-->
        <div class="f_p_ad"><a href=""><img src="<?php echo Yii::app()->request->baseUrl;?>/images/ad/f_p_ad.jpg" alt=""></a></div>
    </div>
</div>
<div class="wrap second_panel">
    <div class="promote_goods_list s_p_lft">
        <?php $this->widget('widget.siteIndex.PromotionPanel'); ?>
    </div>
    <div class="s_p_rgt">
        <!--团购开始-->
        <?php $this->widget('widget.public.TuanWidget'); ?>
        <!--团购结束-->
    </div>
</div>
<div class="third_panel wrap">
    <?php $this->widget('widget.siteIndex.RecommendPanel'); ?>
</div>
<div class="four_panel wrap">
    <?php $this->widget('widget.siteIndex.FloorPanel'); ?>
</div>