<?php

/**
 * This is the model class for table "ol_good_favorable".
 *
 * The followings are the available columns in table 'ol_good_favorable':
 * @property string $favorable_id
 * @property integer $favorable_type
 * @property string $favorable_name
 * @property string $favorable_condition
 * @property integer $add_time
 * @property string $favorable_value
 */
class GoodFavorable extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return GoodFavorable the static model class
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
		return 'ol_good_favorable';
	}

    /*
     * 优惠类型说明 :1 - 限时,2 - 限量,3 - 限满,4 - 限时限量,5 - 限时限满,6 - 限量限满,7 - 限时限量限满
     * */
    public function scopes(){
        return array(
          'minBuy'=>array(
            'condition'=>'favorable_type in (3,5,6,7)'
          ),
          'limitTime'=>array(
            'condition'=>'favorable_type in (1,4,5,7)'
          ),
          'maxBuy'=>array(
            'condition'=>'favorable_type in (2,4,6,7)'
          ),
        );
    }

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('favorable_name, add_time', 'required'),
			array('favorable_type, add_time', 'numerical', 'integerOnly'=>true),
			array('favorable_name, favorable_value', 'length', 'max'=>200),
			array('favorable_condition', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('favorable_id, favorable_type, favorable_name, favorable_condition, add_time, favorable_value', 'safe', 'on'=>'search'),
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
            'goods'=>array(self::MANY_MANY,'GoodFavorable','ol_good_has_favorable(favorable_id,good_id)'),
           // 'goodHasFavorables'=>array(self::HAS_MANY,'GoodHasFavorable','favorable_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'favorable_id' => 'Favorable',
			'favorable_type' => 'Favorable Type',
			'favorable_name' => 'Favorable Name',
			'favorable_condition' => 'Favorable Condition',
			'add_time' => 'Add Time',
			'favorable_value' => 'Favorable Value',
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

		$criteria->compare('favorable_id',$this->favorable_id,true);
		$criteria->compare('favorable_type',$this->favorable_type);
		$criteria->compare('favorable_name',$this->favorable_name,true);
		$criteria->compare('favorable_condition',$this->favorable_condition,true);
		$criteria->compare('add_time',$this->add_time);
		$criteria->compare('favorable_value',$this->favorable_value,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}