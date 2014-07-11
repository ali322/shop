<div class="all_wrap wrap">
    <?php $this->widget('widget.goodsView.MyTabView',array(
    'tabs'=>array(
        'tab1'=>array('title'=>'所有商品分类','content'=>$this->renderPartial('_allcategory',array('catArr'=>$catArr),true)),
        'tab2'=>array('title'=>'所有品牌','url'=>Yii::app()->createUrl('main/allBrand')),
    ),
    'htmlOptions'=>array('class'=>'all_tabs'),
    'cssFile'=>false
))?>
</div>