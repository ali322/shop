<?php

/**
 * This is the model class for table "ol_payment".
 *
 * The followings are the available columns in table 'ol_payment':
 * @property string $id
 * @property string $pay_name
 * @property string $pay_url
 * @property integer $ebank
 * @property string $mark
 */
class Payment extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Payment the static model class
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
		return 'ol_payment';
	}

    public function scopes(){
        return array(
            'ebank'=>array(
                'condition'=>'ebank = 1',
            ),
            'normal'=>array(
                'condition'=>'ebank = 0',
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
			array('pay_name', 'required'),
			array('ebank', 'numerical', 'integerOnly'=>true),
			array('pay_name', 'length', 'max'=>50),
			array('pay_url', 'length', 'max'=>200),
			array('mark', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, pay_name, pay_url, ebank, mark', 'safe', 'on'=>'search'),
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
            'orders'=>array(self::HAS_MANY,'Order','pay_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'pay_name' => 'Pay Name',
			'pay_url' => 'Pay Url',
			'ebank' => 'Ebank',
			'mark' => 'Mark',
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
		$criteria->compare('pay_name',$this->pay_name,true);
		$criteria->compare('pay_url',$this->pay_url,true);
		$criteria->compare('ebank',$this->ebank);
		$criteria->compare('mark',$this->mark,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}