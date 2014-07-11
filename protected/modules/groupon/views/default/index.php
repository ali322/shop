<div class="list_breadcrumbs wrap">
    <?php $this->widget('zii.widgets.CBreadcrumbs', array(
        'homeLink'=>'首页',
        'links'=>array(
            '团购',
            '今日团购',
        ),
    )); ?><!-- breadcrumbs -->
</div>
<div class="tuan_category_nav wrap">
    <ul class='clear'>
        <li><a href="">全部<em>(29)</em></a></li>
        <li class='curr'><a href="">今日上线<em>(3)</em></a></li>
        <li><a href="">食品饮料<em>(10)</em></a></li>
        <li><a href="">家电数码<em>(8)</em></a></li>
        <li><a href="">生活服务<em>(8)</em></a></li>
    </ul>
</div>
<div class="tuan_list_wrap wrap">
    <dl class="clear">
        <?php for($i=0;$i<8;$i++){?>
        <dd>
            <div class="tuan_title"><a href="">【望京】欢乐唱歌，无限畅快！仅39元，原价207元『同乐迪KTV』三小时欢唱套餐！周一至周五11:00-18:00中、小包1张起唱，大包2张起唱；周日至周四黄金档18:00-24:00中、小包2张起唱，大包4张起唱！每间包房赠爆米花1份！8月1日起用！</a></div>
            <div class="tuan_pic"><a href=""><img src="<?php echo Yii::app()->request->baseUrl;?>/images/temp/tuan_thumb.jpg" alt=""></a></div>
            <div class="tuan_text clear"><span class="tuan_price">原价:<b>207元</b></span><span class="tuan_number"><b>591</b>人已购买</span></div>
            <div class="tuan_buy"><span>169</span><span class='tuan_btn'><a href=""></a></span></div>
        </dd>
        <?php }?>
    </dl>
</div>