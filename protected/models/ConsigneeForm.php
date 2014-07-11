<?php
class ConsigneeForm extends CFormModel{
    public $name;
    public $address;
    public $zipcode;
    public $mobile;
    public $ext;
    public $isDefault;
    public function rules() {
        return array(
            array('name,address,zipcode,mobile','required'),
            array('mobile,zipcode','numerical'),
        );
    }
    
    public function attributeLabels() {
        return array(
            'name'=>'收货人',
            'address'=>'收货地址',
            'zipcode'=>'邮编',
            'mobile'=>'联系电话',
            'ext'=>'用户留言',
            'isDefault'=>'是否默认'
        );
    }
}
?>
