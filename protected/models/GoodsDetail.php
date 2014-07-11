<?php

/**
 * This is the model class for table "ol_goods_detail".
 *
 * The followings are the available columns in table 'ol_goods_detail':
 * @property string $id
 * @property integer $good_id
 * @property string $good_img
 * @property string $good_img_path
 * @property string $good_gallery
 * @property string $good_thumb
 * @property string $good_color
 * @property string $good_weight
 * @property string $unit
 * @property string $good_desc
 * @property string $good_brief
 */
class GoodsDetail extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return GoodsDetail the static model class
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
		return 'ol_good_detail';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('good_id', 'required'),
			array('good_id', 'numerical', 'integerOnly'=>true),
			array('good_img, good_img_path, good_gallery, good_thumb', 'length', 'max'=>255),
			array('good_color, good_weight', 'length', 'max'=>50),
			array('unit', 'length', 'max'=>20),
			array('good_brief', 'length', 'max'=>200),
			array('good_desc', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, good_id, good_img, good_img_path, good_gallery, good_thumb, good_color, good_weight, unit, good_desc, good_brief', 'safe', 'on'=>'search'),
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
            'good'=>array(self::BELONGS_TO,'Goods','good_id')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'good_id' => 'Good',
			'good_img' => 'Good Img',
			'good_img_path' => 'Good Img Path',
			'good_gallery' => 'Good Gallery',
			'good_thumb' => 'Good Thumb',
			'good_color' => 'Good Color',
			'good_weight' => 'Good Weight',
			'unit' => 'Unit',
			'good_desc' => 'Good Desc',
			'good_brief' => 'Good Brief',
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
		$criteria->compare('good_id',$this->good_id);
		$criteria->compare('good_img',$this->good_img,true);
		$criteria->compare('good_img_path',$this->good_img_path,true);
		$criteria->compare('good_gallery',$this->good_gallery,true);
		$criteria->compare('good_thumb',$this->good_thumb,true);
		$criteria->compare('good_color',$this->good_color,true);
		$criteria->compare('good_weight',$this->good_weight,true);
		$criteria->compare('unit',$this->unit,true);
		$criteria->compare('good_desc',$this->good_desc,true);
		$criteria->compare('good_brief',$this->good_brief,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public function getImageUrl(){
        return Yii::app()->request->baseUrl.'/'.Yii::app()->params['goodImgPath'].'/'.$this->good_img_path;
    }
}