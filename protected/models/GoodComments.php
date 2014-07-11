<?php

/**
 * This is the model class for table "ol_good_comments".
 *
 * The followings are the available columns in table 'ol_good_comments':
 * @property string $id
 * @property integer $user_id
 * @property integer $good_id
 * @property string $rank
 * @property string $content
 * @property integer $add_time
 * @property integer $support
 * @property integer $oppose
 * @property string $unique_good
 */
class GoodComments extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return GoodComments the static model class
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
		return 'ol_good_comments';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, good_id', 'required'),
			array('user_id, good_id, add_time, support, oppose', 'numerical', 'integerOnly'=>true),
			array('rank', 'length', 'max'=>50),
			array('unique_good', 'length', 'max'=>20),
			array('content', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, good_id, rank, content, add_time, support, oppose, unique_good', 'safe', 'on'=>'search'),
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
			'user_id' => 'User',
			'good_id' => 'Good',
            'rank' => UserModule::t('Rank'),
            'content' => UserModule::t('Comment Content'),
			'add_time' => 'Add Time',
			'support' => 'Support',
			'oppose' => 'Oppose',
			'unique_good' => 'Unique Good',
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
		$criteria->compare('good_id',$this->good_id);
		$criteria->compare('rank',$this->rank,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('add_time',$this->add_time);
		$criteria->compare('support',$this->support);
		$criteria->compare('oppose',$this->oppose);
		$criteria->compare('unique_good',$this->unique_good,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}