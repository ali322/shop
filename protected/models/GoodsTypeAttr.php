<?php

/**
 * This is the model class for table "ol_goods_cate_attr".
 *
 * The followings are the available columns in table 'ol_goods_cate_attr':
 * @property string $id
 * @property integer $type_id
 * @property string $attr_name
 */
class GoodsTypeAttr extends CActiveRecord
{
  //  public $originalTypeId;
	/**
	 * Returns the static model of the specified AR class.
	 * @return GoodsCateAttr the static model class
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
		return 'ol_good_type_attr';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('type_id', 'required'),
			array('type_id', 'numerical', 'integerOnly'=>true),
			array('attr_name', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, type_id, attr_name', 'safe', 'on'=>'search'),
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
            'type'=>array(self::BELONGS_TO,'GoodsType','type_id'),
            'goodAttrValues'=>array(self::HAS_MANY,'GoodsAttrValue','attr_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('WebshopModule.webshop','ID'),
			'type_id' => Yii::t('WebshopModule.webshop','Type'),
			'attr_name' => Yii::t('WebshopModule.webshop','Attr Name'),
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
		$criteria->compare('type_id',$this->cat_id);
		$criteria->compare('attr_name',$this->attr_name,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}
