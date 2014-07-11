<?php $this->beginContent('//layouts/basicLayout'); ?>
<?php
if(!Yii::app()->clientScript->isScriptRegistered('jquery'))
    Yii::app()->clientScript->registerCoreScript('jquery');
?>
<?php $this->widget('widget.public.ShortCut');?>
<div class="simple_header">
    <div class="wrap clearfix header">
        <div class='logo_wrap'>
            <a href="<?php echo Yii::app()->request->baseUrl;?>"><img src="<?php echo Yii::app()->request->baseUrl;?>/images/ad/logo.jpg" alt="" /></a>
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
<?php $this->endContent(); ?>