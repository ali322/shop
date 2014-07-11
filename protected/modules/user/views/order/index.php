<?php $this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Order");?>
<?php $this->widget('widget.goodsView.MyTabView',array(
    'tabs'=>array(
        'tab1'=>array('title'=>'近期订单','content'=>$this->renderPartial('_orders',array('orders'=>$orders,'pager'=>$pager),true)),
        'tab2'=>array('title'=>'更多订单','content'=>'test'),
    ),
    'htmlOptions'=>array('class'=>'profile_edit'),
    'cssFile'=>false
))?>