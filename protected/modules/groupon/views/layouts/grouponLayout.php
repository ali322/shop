<?php $this->beginContent('//layouts/basicLayout'); ?>
<?php $this->widget('widget.public.ShortCut');?>
<div class="wrap clearfix header">
    <div class='logo_wrap'>
        <a href="<?php echo Yii::app()->request->baseUrl;?>"><img src="<?php echo Yii::app()->request->baseUrl;?>/images/ad/logo.jpg" alt="" /></a>
    </div>
    <div class='search_box'>
        <div class="search_box_header"></div>
        <div class="search_form">
            <input type="text" class='search_text' value='请输入' />
            <input type="button" class='search_button' value='搜索' />
        </div>
        <div class="search_box_footer"></div>
    </div>
    <div class='header_ad'></div>
</div>
<div class="nav_panel">
    <div class="nav_panel_wrap wrap">
        <div class='category_bar'>
            <?php $this->widget('widget.public.CategoryNav',array('collapse'=>$this->collapseCategoryNav)); ?>
        </div>
        <div class='nav_bar'>
            <ul>
                <li><a href="<?php echo Yii::app()->createUrl('site/index'); ?>">首页</a></li>
                <li><a href="<?php echo Yii::app()->createUrl('groupon'); ?>">商品团购</a></li>
                <li><a href="<?php echo Yii::app()->createUrl('groupon/default/page/view/help'); ?>">团购指南</a></li>
            </ul>
        </div>
    </div>
</div>
<?php echo $content; ?>
<div class="last_panel wrap">
    <?php $this->renderPartial('//site/_footerGuild');?>
    <?php $this->widget('widget.public.FooterLink');?>
</div>
<div class="footer_copyrights wrap">
    湖南友谊阿波罗电子商务分公司 版权所有&nbsp;&nbsp;Copyright (c) 1998 - 2012 9448.net All Rights Reserved&nbsp;&nbsp;增值电信业务经营许可证：湘B-2-4-20060060 ICP备案号：湘ICP备05020822号
</div>
<?php $this->renderPartial('//site/_rightController');?>
<?php $this->endContent(); ?>