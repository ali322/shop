<?php

/**
 * This is the model class for table "ol_user_delivery".
 *
 * The followings are the available columns in table 'ol_user_delivery':
 * @property string $id
 * @property integer $user_id
 * @property string $consignee
 * @property integer $province_id
 * @property integer $city_id
 * @property integer $zone_id
 * @property string $address
 * @property integer $zipcode
 * @property integer $phone
 * @property string $ext
 * @property integer $is_default
 */
class UserDelivery extends CActiveRecord
{
    public $formatedProvince;
    public $formatedCity;
    public $formatedZone;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return UserDelivery the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ol_user_delivery';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, consignee, phone', 'required'),
			array('user_id, zipcode, phone, is_default,province_id, city_id, zone_id', 'numerical', 'integerOnly'=>true),
			array('consignee', 'length', 'max'=>50),
			array('address', 'length', 'max'=>200),
			array('ext', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, consignee,province_id, city_id, zone_id, address, zipcode, phone, ext, is_default', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
            'user'=>array(self::BELONGS_TO,'User','user_id'),
            'orders'=>array(self::HAS_MANY,'Order','delivery_id'),
            'province'=>array(self::BELONGS_TO,'Provinces','province_id'),
            'city'=>array(self::BELONGS_TO,'Citys','city_id'),
            'zone'=>array(self::BELONGS_TO,'Zones','zone_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_id' => 'User',
			'consignee' => Yii::t('core','Consignee'),
			'province_id' => 'Province',
			'city_id' => 'City',
			'zone_id' => 'Zone',
			'address' =>Yii::t('core', 'Address'),
			'zipcode' => Yii::t('core','Zipcode'),
			'phone' => Yii::t('core','Phone'),
			'ext' => Yii::t('core','Ext'),
			'is_default' => Yii::t('core','Is Default'),
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('consignee',$this->consignee,true);
		$criteria->compare('province_id',$this->province_id,true);
		$criteria->compare('city_id',$this->city_id,true);
		$criteria->compare('zone_id',$this->zone_id,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('zipcode',$this->zipcode);
		$criteria->compare('phone',$this->phone);
		$criteria->compare('ext',$this->ext,true);
		$criteria->compare('is_default',$this->is_default);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    protected function beforeSave(){
        if(parent::beforeSave()){
            if($this->is_default == 1){
                $criteria=new CDbCriteria;
                $criteria->condition='user_id = :user_id';
                $criteria->params=array(':user_id'=>Yii::app()->user->id);
                $this->updateAll(array('is_default'=>0),$criteria);
            }
            return true;
        }else{
            return false;
        }
    }

    protected function afterFind(){
        $this->formatedProvince=$this->province->province_name;
        $this->formatedCity=$this->city->city_name;
        $this->formatedZone=$this->zone->zone_name;
    }
}