<?php

/**
 * This is the model class for table "ol_goods_spec".
 *
 * The followings are the available columns in table 'ol_goods_spec':
 * @property integer $spec_id
 * @property integer $type_id
 * @property string $spec_name
 * @property integer $spec_type
 * @property string $spec_value
 * @property string $spec_memo
 */
class GoodsSpec extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return GoodsSpec the static model class
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
		return 'ol_good_spec';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('spec_name, type_id', 'required'),
			array('spec_name,  spec_memo', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('spec_id, type_id,spec_name,spec_type, spec_value, spec_memo', 'safe', 'on'=>'search'),
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
                 //   'spec_values'=>array(self::HAS_MANY,'GoodsSpecValue','spec_id'),
                    'type'=>array(self::BELONGS_TO,'GoodsType','type_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'spec_id' => Yii::t('WebshopModule.webshop','Spec'),
            'type_id' => Yii::t('WebshopModule.webshop','Type'),
			'spec_name' => Yii::t('WebshopModule.webshop','Spec Name'),
			'spec_type' => Yii::t('WebshopModule.webshop','Spec Type'),
			'spec_value' => Yii::t('WebshopModule.webshop','Spec Value'),
			'spec_memo' => Yii::t('WebshopModule.webshop','Spec Memo'),
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

		$criteria->compare('spec_id',$this->spec_id);
		$criteria->compare('spec_name',$this->spec_name,true);
		$criteria->compare('spec_type',$this->spec_type,true);
		$criteria->compare('spec_value',$this->spec_value,true);
		$criteria->compare('spec_memo',$this->spec_memo,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}