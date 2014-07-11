<?php $this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Post");?>
<?php $this->widget('widget.goodsView.MyTabView',array(
    'tabs'=>array(
        'tab1'=>array('title'=>'全部咨询','content'=>$this->renderPartial('_posts',array('posts'=>$posts,'pager'=>$pager),true)),
        'tab2'=>array('title'=>'已回复的咨询','content'=>'test'),
    ),
    'htmlOptions'=>array('class'=>'profile_edit'),
    'cssFile'=>false
))?>