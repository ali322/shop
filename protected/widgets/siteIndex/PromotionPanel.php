<?php
/**
 * Created by JetBrains PhpStorm.
 * User: alichen
 * Date: 12-8-6
 * Time: 上午11:44
 * To change this template use File | Settings | File Templates.
 */
class PromotionPanel extends CWidget{
    public function run(){
        $criteria=new CDbCriteria;
        $criteria->limit=15;
        $criteria->offset=10;
        $goods=Goods::model()->findAll($criteria);
        $this->render('promotionpanel',array(
            'goods'=>$goods,
        ));
    }
}