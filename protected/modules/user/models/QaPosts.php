<?php

/**
 * This is the model class for table "qa_posts".
 *
 * The followings are the available columns in table 'qa_posts':
 * @property integer $id
 * @property integer $user_id
 * @property string $title
 * @property string $content
 * @property integer $add_time
 * @property integer $cat_id
 */
class QaPosts extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return QaPosts the static model class
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
		return 'qa_posts';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('content', 'required'),
			array('user_id, add_time, cat_id', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, title, content, add_time, cat_id', 'safe', 'on'=>'search'),
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
                    'author'=>array(self::BELONGS_TO,'User','user_id'),
                    'comments'=>array(self::HAS_MANY,'QaComments','post_id'),
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
			'title' => 'Title',
			'content' => UserModule::t('PostContent'),
			'add_time' => 'Add Time',
			'cat_id' => UserModule::t('PostCat'),
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

		$criteria->compare('id',$this->id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('add_time',$this->add_time);
		$criteria->compare('cat_id',$this->cat_id);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
        
        public static function getCates(){
                $criteria=new CDbCriteria;
                $criteria->order='sort_order desc';
                $cates=QaCates::model()->findAll($criteria);
                
                return Chtml::listData($cates,'id','cat_name');
        }
      
        protected function beforeSave(){
                if(parent::beforeSave()){
                    $this->add_time=time();
                    $this->user_id=Yii::app()->user->id;
                    return true;
                }else{
                    return false;
                }
        }
}