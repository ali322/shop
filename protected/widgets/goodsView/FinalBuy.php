<?php
/**
 * Created by JetBrains PhpStorm.
 * User: alichen
 * Date: 12-9-20
 * Time: 下午3:14
 * To change this template use File | Settings | File Templates.
 */
class FinalBuy extends CWidget{
    public function run(){
        $criteria=new CDbCriteria;
        $criteria->limit=5;
        $criteria->order='good_id desc';
        $goods=Goods::model()->findAll($criteria);
        $this->render('finalbuy',array(
            'goods'=>$goods,
        ));
    }
}