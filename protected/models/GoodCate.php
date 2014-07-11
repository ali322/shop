<?php

/**
 * This is the model class for table "ol_good_cate".
 *
 * The followings are the available columns in table 'ol_good_cate':
 * @property string $cat_id
 * @property string $cat_name
 * @property string $cat_desc
 * @property integer $sort_order
 * @property integer $parent_id
 * @property integer $lft
 * @property integer $rgt
 * @property integer $level
 */
class GoodCate extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return GoodCate the static model class
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
		return 'ol_good_cate';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('sort_order, parent_id, lft, rgt, level', 'numerical', 'integerOnly'=>true),
			array('cat_name', 'length', 'max'=>90),
			array('cat_desc', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('cat_id, cat_name, cat_desc, sort_order, parent_id, lft, rgt, level', 'safe', 'on'=>'search'),
		);
	}

    public function behaviors(){
        return array(
            'array_sort'=>array(
                'class'=>'ext.behaviors.array_sort',
                'db'=>$this->getDbConnection(),
                'table'=>'ol_good_cate',
                'cat_id'=>'cat_id',
                'cat_name'=>'cat_name',
            ),
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
            'goods'=>array(self::HAS_MANY,'Goods','cat_id')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'cat_id' => 'Cat',
			'cat_name' => 'Cat Name',
			'cat_desc' => 'Cat Desc',
			'sort_order' => 'Sort Order',
			'parent_id' => 'Parent',
			'lft' => 'Lft',
			'rgt' => 'Rgt',
			'level' => 'Level',
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

		$criteria->compare('cat_id',$this->cat_id,true);
		$criteria->compare('cat_name',$this->cat_name,true);
		$criteria->compare('cat_desc',$this->cat_desc,true);
		$criteria->compare('sort_order',$this->sort_order);
		$criteria->compare('parent_id',$this->parent_id);
		$criteria->compare('lft',$this->lft);
		$criteria->compare('rgt',$this->rgt);
		$criteria->compare('level',$this->level);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}