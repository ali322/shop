<?php
/**
 * Created by JetBrains PhpStorm.
 * User: alichen
 * Date: 12-9-29
 * Time: 上午11:03
 * To change this template use File | Settings | File Templates.
 */
class HotGoods extends CWidget{
    public function run(){
        $criteria=new CDbCriteria;
        $criteria->limit=3;
        $criteria->order='good_id desc';
        $goods=Goods::model()->findAll($criteria);
        $this->render('hotgoods',array(
            'goods'=>$goods,
        ));
    }
}