<div class="all_wrap wrap">
    <?php $this->widget('widget.goodsView.MyTabView',array(
    'tabs'=>array(
        'tab1'=>array('title'=>'所有商品分类','url'=>Yii::app()->createUrl('main/allCategory')),
        'tab2'=>array('title'=>'所有品牌','content'=>$this->renderPartial('_allbrand',array('catArr'=>$catArr),true)),
    ),
    'htmlOptions'=>array('class'=>'all_tabs'),
    'activeTab'=>'tab2',
    'cssFile'=>false
))?>
</div>