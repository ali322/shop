<?php
/**
 * Created by JetBrains PhpStorm.
 * User: alichen
 * Date: 12-8-20
 * Time: 下午2:02
 * To change this template use File | Settings | File Templates.
 */
class DialogBox extends CWidget{
    public function run(){
        if(!Yii::app()->clientScript->isScriptRegistered('jquery'))
            Yii::app()->clientScript->registerCoreScript('jquery');

        $assetUrl=Yii::app()->assetManager->publish(Yii::getPathOfAlias('ext.dialogbox.assets'));


/*      css改在 widget.css中定义
          $cssFile=$assetUrl.'/css/dialogbox.css';
        if(!Yii::app()->clientScript->isCssFileRegistered($cssFile))
            Yii::app()->clientScript->registerCssFile($cssFile);*/

        $jsFile=$assetUrl.'/js/dialogbox.js';
        if(!Yii::app()->clientScript->isScriptFileRegistered($jsFile))
            Yii::app()->clientScript->registerScriptFile($jsFile,CClientScript::POS_HEAD);
    }
}