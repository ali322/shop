<?php
/**
 * Created by JetBrains PhpStorm.
 * User: alichen
 * Date: 12-9-20
 * Time: 下午3:06
 * To change this template use File | Settings | File Templates.
 */
class ViewHistory extends CWidget{
    public function run(){
        $criteria=new CDbCriteria;
        $criteria->limit=5;
        $criteria->order='good_id desc';
        $goods=Goods::model()->findAll($criteria);
        $this->render('viewhistory',array(
           'goods'=>$goods,
        ));
    }
}