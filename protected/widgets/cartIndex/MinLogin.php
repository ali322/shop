<?php
/**
 * Created by JetBrains PhpStorm.
 * User: alichen
 * Date: 12-8-20
 * Time: 上午11:02
 * To change this template use File | Settings | File Templates.
 */
class MinLogin extends CWidget{
    public $trigger;

    public function run(){

        if(Yii::app()->user->isGuest){
        $this->widget('ext.dialogbox.DialogBox');

        $js="
            $('#{$this->trigger}').click(function(){
                $(this).dialogBox({
                    show:true,
                    title:'登陆',
                    requestType:'iframe',
                    opacity:0.2,
                    drag:false,
                    iframeWH:{width:430,height:300},
                    target:'".Yii::app()->createUrl('user/login/minLogin')."'
                });
            });
        ";
        }else{
            $js="
                $('#{$this->trigger}').click(function(){
                    $('#checkout_form').get(0).submit();
                });
            ";
        }
        if(!Yii::app()->clientScript->isScriptRegistered(__CLASS__))
            Yii::app()->clientScript->registerScript(__CLASS__,$js,CClientScript::POS_READY);
    }
}