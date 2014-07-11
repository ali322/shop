<?php $this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Edit");?>
<?php $this->widget('widget.goodsView.MyTabView',array(
    'tabs'=>array(
        'tab1'=>array('title'=>'基本信息','content'=>$this->renderPartial('_edit',array('model'=>$model,'profile'=>$profile),true)),
        'tab2'=>array('title'=>'更多个人信息','content'=>'test'),
    ),
    'htmlOptions'=>array('class'=>'profile_edit'),
    'cssFile'=>false
))?>