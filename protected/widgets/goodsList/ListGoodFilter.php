<?php
/**
 * Created by JetBrains PhpStorm.
 * User: alichen
 * Date: 12-7-29
 * Time: 下午1:11
 * To change this template use File | Settings | File Templates.
 */
class ListGoodFilter extends CWidget{
    public function run(){
        $cs=Yii::app()->getClientScript();
        if(!$cs->isScriptRegistered('jquery'))
            $cs->registerCoreScript('jquery');
        $jsUrl=Yii::app()->assetManager->publish(Yii::getPathOfAlias('widget.goodsList.scripts'));
        $jsFile=$jsUrl.'/listgoodfilter.js';
        if(!$cs->isScriptFileRegistered($jsFile))
            $cs->registerScriptFile($jsFile,CClientScript::POS_READY);

        $this->render('listgoodfilter');
    }
}