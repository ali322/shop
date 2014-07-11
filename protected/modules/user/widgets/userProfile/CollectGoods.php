<?php
/**
 * Created by JetBrains PhpStorm.
 * User: alichen
 * Date: 12-10-23
 * Time: 上午10:50
 * To change this template use File | Settings | File Templates.
 */
class CollectGoods extends CWidget{
    public function run(){
        $criteria=new CDbCriteria;
        $criteria->limit=19;
        $criteria->order='good_id desc';
        $goods=Goods::model()->findAll($criteria);
        $this->render('collectgoods',array('goods'=>$goods));
    }
}