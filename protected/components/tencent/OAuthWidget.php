<?php
class OAuthWidget extends CWidget{
    public function run(){
       echo CHtml::openTag('div',array('class'=>'oauthlogin_wrap'));
       echo CHtml::link(CHtml::image('../images/icons/qq_login.png'),Yii::app()->createUrl('user/login/sharelogin'));
       echo CHtml::closeTag('div');
       
       echo CHtml::openTag('div',array('class'=>'oauthlogin_wrap'));
       echo CHtml::link(CHtml::image('../images/icons/weibo_login.png'),Yii::app()->createUrl('user/login/weibologin'));
       echo CHtml::closeTag('div');
       Yii::app()->clientScript->registerCss('oauthwidget',"
           .oauthlogin_wrap{height:30px;width:130px;padding-top:5px;padding-left:12px;;float:left;}
           .oauthlogin_wrap img{margin-right:12px;}
        ");
    }
}
?>
