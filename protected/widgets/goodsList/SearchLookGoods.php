<?php
/**
 * Created by JetBrains PhpStorm.
 * User: alichen
 * Date: 12-9-29
 * Time: 上午10:56
 * To change this template use File | Settings | File Templates.
 */
class SearchLookGoods extends CWidget{
    public function run(){
        $criteria=new CDbCriteria;
        $criteria->limit=3;
        $criteria->order='good_id desc';
        $goods=Goods::model()->findAll($criteria);
        $this->render('searchlookgoods',array(
            'goods'=>$goods,
        ));
    }
}