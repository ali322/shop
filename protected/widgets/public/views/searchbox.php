<div class='search_box'>
    <div class="search_box_header"></div>
    <div class="search_form">
        <?php echo CHtml::beginForm(Yii::app()->createUrl('goods/search'),'get'); ?>
        <?php echo CHtml::textField('keyWord','请输入',array('class'=>'search_text')); ?>
        <?php echo CHtml::submitButton('搜索',array('class'=>'search_button')); ?>
        <?php echo CHtml::endForm(); ?>
    </div>
    <div class="search_box_footer"></div>
    <div class="hot_search_word">
        <strong>热门搜索:</strong>
        <?php echo CHtml::link('小帆船',Yii::app()->createUrl('goods/search',array('keyWord'=>'小帆船'))); ?>
        <?php echo CHtml::link('圣弗莱',Yii::app()->createUrl('goods/search',array('keyWord'=>'圣弗莱'))); ?>
    </div>
</div>
