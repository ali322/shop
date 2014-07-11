<?php
/**
 * Created by JetBrains PhpStorm.
 * User: alichen
 * Date: 12-9-18
 * Time: 上午11:20
 * To change this template use File | Settings | File Templates.
 */
class DynamicAddress extends CAction{
    public function run(){
        $conn=Yii::app()->db;

        if(isset($_POST['provinceId'])){
            $provinceId=(int)$_POST['provinceId'];
            $sql='SELECT city_id,city_name FROM ol_address_citys WHERE province_id =:province_id ORDER BY sort ASC';
            $command=$conn->createCommand($sql);
            $command->bindParam(':province_id',$provinceId,PDO::PARAM_INT);
            $cities=$command->queryAll();
           // array_unshift($cities,array('city_id'=>0,'city_name'=>'请选择市/区'));
            //$cities=Helper_Array::toHashmap($cities,'city_id','city_name');
            echo CJSON::encode($cities);
            Yii::app()->end();
        }
        if(isset($_POST['cityId'])){
            $cityId=(int)$_POST['cityId'];
            $sql='SELECT zone_id,zone_name FROM ol_address_zones WHERE city_id =:city_id ORDER BY zone_id DESC';
            $command=$conn->createCommand($sql);
            $command->bindParam(':city_id',$cityId,PDO::PARAM_INT);
            $zones=$command->queryAll();
          //  array_unshift($zones,array('zone_id'=>0,'zone_name'=>'请选择区/县/街道'));
          //  $zones=Helper_Array::toHashmap($zones,'zone_id','zone_name');
            echo CJSON::encode($zones);
            Yii::app()->end();
        }
    }
}