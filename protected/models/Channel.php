<?php

/**
 * This is the model class for table "ol_channel".
 *
 * The followings are the available columns in table 'ol_channel':
 * @property string $channel_id
 * @property string $channel_name
 * @property string $channel_category
 * @property string $recommend_brands
 * @property string $channel_promotion
 * @property integer $sort
 * @property string $channel_template
 */
class Channel extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Channel the static model class
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
		return 'ol_channel';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('channel_name, channel_category, recommend_brands, channel_promotion, channel_template', 'required'),
			array('sort', 'numerical', 'integerOnly'=>true),
			array('channel_name', 'length', 'max'=>20),
			array('channel_template', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('channel_id, channel_name, channel_category, recommend_brands, channel_promotion, sort, channel_template', 'safe', 'on'=>'search'),
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
            'goodTopics'=>array(self::HAS_MANY,'GoodTopic','channel_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'channel_id' => 'Channel',
			'channel_name' => 'Channel Name',
			'channel_category' => 'Channel Category',
			'recommend_brands' => 'Recommend Brands',
			'channel_promotion' => 'Channel Promotion',
			'sort' => 'Sort',
			'channel_template' => 'Channel Template',
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

		$criteria->compare('channel_id',$this->channel_id,true);
		$criteria->compare('channel_name',$this->channel_name,true);
		$criteria->compare('channel_category',$this->channel_category,true);
		$criteria->compare('recommend_brands',$this->recommend_brands,true);
		$criteria->compare('channel_promotion',$this->channel_promotion,true);
		$criteria->compare('sort',$this->sort);
		$criteria->compare('channel_template',$this->channel_template,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}