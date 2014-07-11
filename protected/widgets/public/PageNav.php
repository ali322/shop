<?php
/**
 * Created by JetBrains PhpStorm.
 * User: alichen
 * Date: 12-8-28
 * Time: 下午2:29
 * To change this template use File | Settings | File Templates.
 */
class PageNav extends CWidget{
    public $active=null;

    public function run(){
        $pageNavItems=array(
            array('label'=>'首页','url'=>Yii::app()->createUrl('site/index')),
            array('label'=>'所有品牌','url'=>Yii::app()->createUrl('main/allbrand')),
            array('label'=>'商城促销','url'=>Yii::app()->createUrl('main/promotion')),
            array('label'=>'限时抢购','url'=>Yii::app()->createUrl('main/rushpurchase')),
            array('label'=>'团购','url'=>Yii::app()->createUrl('groupon')),
            array('label'=>'积分兑换','url'=>Yii::app()->createUrl('main/credits')),
        );
        foreach($pageNavItems as $key=>&$value){
            if($key==$this->active){
                $value['active']=true;
            }
        }
        $this->render('pagenav',array('pageNavItems'=>$pageNavItems));
    }
}