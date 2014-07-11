<?php
/**
 * Created by JetBrains PhpStorm.
 * User: alichen
 * Date: 12-9-18
 * Time: 上午10:22
 * To change this template use File | Settings | File Templates.
 */
class AddressSelector extends CInputWidget{
    public $address;

    public function run(){
        $conn=Yii::app()->db;

        $sql='SELECT * FROM ol_address_provinces ORDER BY province_name';
        $provinces=$conn->createCommand($sql)->queryAll();
      //  array_unshift($provinces,array('province_id'=>0,'province_name'=>'请选择省份'));
      //  $provinces=Helper_Array::toHashmap($provinces,'province_id','province_name');

        if($this->address['province_id']){
            $sql='SELECT city_id,city_name FROM ol_address_citys WHERE province_id =:province_id ORDER BY sort ASC';
            $command=$conn->createCommand($sql);
            $command->bindParam(':province_id',$this->address['province_id'],PDO::PARAM_INT);
            $cities=$command->queryAll();
        }else{
            $cities=null;
        }

        if($this->address['city_id']){
            $sql='SELECT zone_id,zone_name FROM ol_address_zones WHERE city_id =:city_id ORDER BY zone_id DESC';
            $command=$conn->createCommand($sql);
            $command->bindParam(':city_id',$this->address['city_id'],PDO::PARAM_INT);
            $zones=$command->queryAll();
        }else{
            $zones=null;
        }
        $this->render('addressselector',array(
            'provinces'=>$provinces,
            'cities'=>$cities,
            'zones'=>$zones,
        ));
    }
}