<div class='slider_items' id='slider_items'>
    <a href=""><img src="<?php echo Yii::app()->request->baseUrl;?>/images/ad/slider_ad_1.jpg" alt=""></a>
    <a href=""><img src="<?php echo Yii::app()->request->baseUrl;?>/images/ad/slider_ad_2.jpg" alt=""></a>
    <a href=""><img src="<?php echo Yii::app()->request->baseUrl;?>/images/ad/slider_ad_3.jpg" alt=""></a>
</div>
<?php $this->widget('ext.omui.OmuiSlider',array(
    'sliderId'=>'slider_items',
    'navId'=>true,
    'options'=>array(
        'interval'=>3000
    )
));?>