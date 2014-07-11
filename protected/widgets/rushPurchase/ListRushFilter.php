<?php
/**
 * Created by JetBrains PhpStorm.
 * User: alichen
 * Date: 12-7-29
 * Time: 下午1:11
 * To change this template use File | Settings | File Templates.
 */
class ListRushFilter extends CWidget{
    public function run(){
        $cs=Yii::app()->getClientScript();
        if(!$cs->isScriptRegistered('jquery'))
            $cs->registerCoreScript('jquery');
        $this->render('listrushfilter');
    }
}