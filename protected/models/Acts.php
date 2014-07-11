<?php

/**
 * This is the model class for table "ol_acts".
 *
 * The followings are the available columns in table 'ol_acts':
 * @property string $act_id
 * @property string $act_name
 * @property string $act_content
 * @property integer $add_time
 * @property string $brands
 * @property string $act_ad
 * @property string $act_ad_path
 * @property integer $begin_time
 * @property integer $end_time
 */
class Acts extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Acts the static model class
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
		return 'ol_acts';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('act_name, act_content', 'required'),
			array('add_time, begin_time, end_time', 'numerical', 'integerOnly'=>true),
			array('act_name', 'length', 'max'=>150),
			array('brands, act_ad, act_ad_path', 'length', 'max'=>250),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('act_id, act_name, act_content, add_time, brands, act_ad, act_ad_path, begin_time, end_time', 'safe', 'on'=>'search'),
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
			'act_id' => 'Act',
			'act_name' => 'Act Name',
			'act_content' => 'Act Content',
			'add_time' => 'Add Time',
			'brands' => 'Brands',
			'act_ad' => 'Act Ad',
			'act_ad_path' => 'Act Ad Path',
			'begin_time' => 'Begin Time',
			'end_time' => 'End Time',
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

		$criteria->compare('act_id',$this->act_id,true);
		$criteria->compare('act_name',$this->act_name,true);
		$criteria->compare('act_content',$this->act_content,true);
		$criteria->compare('add_time',$this->add_time);
		$criteria->compare('brands',$this->brands,true);
		$criteria->compare('act_ad',$this->act_ad,true);
		$criteria->compare('act_ad_path',$this->act_ad_path,true);
		$criteria->compare('begin_time',$this->begin_time);
		$criteria->compare('end_time',$this->end_time);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'pagination'=>array('pageSize'=>20)
		));
	}

    public function getImageUrl(){
        return Yii::app()->request->baseUrl.'/'.Yii::app()->params['actsPath'].'/'.$this->act_ad_path;
    }
}