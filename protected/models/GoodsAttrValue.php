<?php

/**
 * This is the model class for table "ol_goods_attr_value".
 *
 * The followings are the available columns in table 'ol_goods_attr_value':
 * @property string $value_id
 * @property string $attr_id
 * @property string $attr_value
 */
class GoodsAttrValue extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return GoodsAttrValue the static model class
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
		return 'ol_good_attr_value';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('attr_id, attr_value', 'required'),
			array('attr_id', 'length', 'max'=>10),
			array('attr_value', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('value_id, attr_id, attr_value', 'safe', 'on'=>'search'),
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
            'goods'=>array(self::MANY_MANY,'Goods','ol_good_attr(value_id,good_id)'),
            'typeAttr'=>array(self::BELONGS_TO,'GoodsTypeAttr','attr_id'),
            'goodAttr'=>array(self::BELONGS_TO,'GoodAttr','value_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'value id' => 'Value ID',
			'attr_id' => 'Attr',
			'attr_value' => 'Attr Value',
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

		$criteria->compare('value_id',$this->value_id,true);
		$criteria->compare('attr_id',$this->attr_id,true);
		$criteria->compare('attr_value',$this->attr_value,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}