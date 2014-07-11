<?php

/**
 * This is the model class for table "ol_shippment".
 *
 * The followings are the available columns in table 'ol_shippment':
 * @property string $id
 * @property string $ship_name
 * @property string $ship_fee
 * @property string $ship_desc
 * @property string $ship_expression
 * @property string $ship_promotion
 */
class Shippment extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Shippment the static model class
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
		return 'ol_shippment';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ship_name', 'required'),
			array('ship_name', 'length', 'max'=>50),
			array('ship_fee', 'length', 'max'=>10),
			array('ship_desc, ship_expression, ship_promotion', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, ship_name, ship_fee, ship_desc, ship_expression, ship_promotion', 'safe', 'on'=>'search'),
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
            'orders'=>array(self::HAS_MANY,'Order','ship_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'ship_name' => 'Ship Name',
			'ship_fee' => 'Ship Fee',
			'ship_desc' => 'Ship Desc',
			'ship_expression' => 'Ship Expression',
			'ship_promotion' => 'Ship Promotion',
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
		$criteria->compare('ship_name',$this->ship_name,true);
		$criteria->compare('ship_fee',$this->ship_fee,true);
		$criteria->compare('ship_desc',$this->ship_desc,true);
		$criteria->compare('ship_expression',$this->ship_expression,true);
		$criteria->compare('ship_promotion',$this->ship_promotion,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}