<?php $this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Conllect");?>
<?php $this->widget('widget.goodsView.MyTabView',array(
    'tabs'=>array(
        'tab1'=>array('title'=>'全部收藏','content'=>$this->renderPartial('_collects',array('goods'=>$goods),true)),
        'tab2'=>array('title'=>'商品收藏','content'=>'test'),
    ),
    'htmlOptions'=>array('class'=>'profile_edit'),
    'cssFile'=>false
))?>
