<?php

/**
 * This is the model class for table "pro_detail".
 *
 * The followings are the available columns in table 'pro_detail':
 * @property integer $SID
 * @property integer $PRODUCT_SID
 * @property string $PRO_STAN
 * @property integer $PRO_STAN_SID
 * @property integer $PRO_COLOR_SID
 * @property string $PRO_COLOR
 */
class ProDetail extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ProDetail the static model class
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
		return 'pro_detail';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('SID', 'required'),
			array('SID, PRODUCT_SID, PRO_STAN_SID, PRO_COLOR_SID', 'numerical', 'integerOnly'=>true),
			array('PRO_STAN', 'length', 'max'=>40),
			array('PRO_COLOR', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('SID, PRODUCT_SID, PRO_STAN, PRO_STAN_SID, PRO_COLOR_SID, PRO_COLOR', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'SID' => 'Sid',
			'PRODUCT_SID' => 'Product Sid',
			'PRO_STAN' => 'Pro Stan',
			'PRO_STAN_SID' => 'Pro Stan Sid',
			'PRO_COLOR_SID' => 'Pro Color Sid',
			'PRO_COLOR' => 'Pro Color',
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

		$criteria->compare('SID',$this->SID);
		$criteria->compare('PRODUCT_SID',$this->PRODUCT_SID);
		$criteria->compare('PRO_STAN',$this->PRO_STAN,true);
		$criteria->compare('PRO_STAN_SID',$this->PRO_STAN_SID);
		$criteria->compare('PRO_COLOR_SID',$this->PRO_COLOR_SID);
		$criteria->compare('PRO_COLOR',$this->PRO_COLOR,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}