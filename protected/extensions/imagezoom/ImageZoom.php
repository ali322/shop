<?php
/**
 * Created by JetBrains PhpStorm.
 * User: alichen
 * Date: 12-8-22
 * Time: 上午10:33
 * To change this template use File | Settings | File Templates.
 */
class ImageZoom extends  CWidget{
    public $largeImageHref;

    public function init(){
        if(!Yii::app()->clientScript->isScriptRegistered('jquery'))
            Yii::app()->clientScript->registerCoreScript('jquery');

        $assetUrl=Yii::app()->assetManager->publish(Yii::getPathOfAlias('ext.imagezoom.assets'));

        $cssFile=$assetUrl.'/css/jqzoom.css';
        if(!Yii::app()->clientScript->isCssFileRegistered($cssFile))
            Yii::app()->clientScript->registerCssFile($cssFile);

        $jsFile=$assetUrl.'/js/jqzoom-core.js';
        if(!Yii::app()->clientScript->isScriptFileRegistered($jsFile))
            Yii::app()->clientScript->registerScriptFile($jsFile,CClientScript::POS_HEAD);

      //  echo CHtml::openTag('a',array('href'=>$this->largeImageHref,'class'=>'image_zoom'));
    }
    public function run(){
     //   echo CHtml::closeTag('a');

/*        if(!Yii::app()->clientScript->isScriptRegistered('image_zoom'))
            Yii::app()->clientScript->registerScript('image_zoom',"
                $('.image_zoom').jqzoom();
            ",CClientScript::POS_END);*/
    }
}