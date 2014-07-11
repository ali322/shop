<?php
/**
 * Created by JetBrains PhpStorm.
 * User: alichen
 * Date: 12-10-24
 * Time: 下午2:32
 * To change this template use File | Settings | File Templates.
 */
class RecentOrders extends CWidget{
    public function run(){
        $criteria=new CDbCriteria;
        $criteria->condition='user_id = :user_id';
        $criteria->params=array(':user_id'=>  Yii::app()->user->id);
        $criteria->order='add_time desc';
        $criteria->limit=5;
        $orders=Order::model()->findAll($criteria);
        $this->render('recentorders',array('orders'=>$orders));
    }
}