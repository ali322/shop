<?php

/**
 * This is the model class for table "ol_good_topic".
 *
 * The followings are the available columns in table 'ol_good_topic':
 * @property string $id
 * @property integer $channel_id
 * @property string $topic_name
 * @property string $goods
 * @property integer $add_time
 * @property string $ad_path
 * @property string $topic_ad
 */
class GoodTopic extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return GoodTopic the static model class
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
		return 'ol_good_topic';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('channel_id, topic_name, goods, add_time', 'required'),
			array('channel_id, add_time', 'numerical', 'integerOnly'=>true),
			array('topic_name', 'length', 'max'=>50),
			array('ad_path', 'length', 'max'=>200),
			array('topic_ad', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, channel_id, topic_name, goods, add_time, ad_path, topic_ad', 'safe', 'on'=>'search'),
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
			'id' => 'ID',
			'channel_id' => 'Channel',
			'topic_name' => 'Topic Name',
			'goods' => 'Goods',
			'add_time' => 'Add Time',
			'ad_path' => 'Ad Path',
			'topic_ad' => 'Topic Ad',
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
		$criteria->compare('channel_id',$this->channel_id);
		$criteria->compare('topic_name',$this->topic_name,true);
		$criteria->compare('goods',$this->goods,true);
		$criteria->compare('add_time',$this->add_time);
		$criteria->compare('ad_path',$this->ad_path,true);
		$criteria->compare('topic_ad',$this->topic_ad,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public function getImageUrl(){
        return Yii::app()->request->baseUrl.'/'.Yii::app()->params['topicPath'].'/'.$this->ad_path;
    }
}