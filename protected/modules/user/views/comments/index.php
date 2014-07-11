<?php $this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Your Comments");?>
<?php $this->widget('widget.goodsView.MyTabView',array(
    'tabs'=>array(
        'tab1'=>array('title'=>'全部评价商品','content'=>$this->renderPartial('_comments',array('goods'=>$goods),true)),
        'tab2'=>array('title'=>'未评价商品','content'=>'test'),
        'tab3'=>array('title'=>'已评价商品','content'=>'test'),
    ),
    'htmlOptions'=>array('class'=>'profile_edit'),
    'cssFile'=>false
))?>
