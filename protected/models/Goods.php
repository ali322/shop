<?php

/**
 * This is the model class for table "ol_goods".
 *
 * The followings are the available columns in table 'ol_goods':
 * @property string $good_id
 * @property integer $brand_id
 * @property integer $type_id
 * @property integer $cat_id
 * @property string $good_name
 * @property string $good_sn
 * @property string $market_price
 * @property string $shop_price
 * @property string $unit
 * @property string $good_attr
 * @property string $good_number
 * @property integer $add_time
 * @property integer $sold_count
 * @property integer $collect_count
 * @property integer $is_recommend
 * @property integer $is_on_sale
 */
class Goods extends CActiveRecord
{
    public $priceSec; //价格区间
    public $attrSec=array(); //规格区间
    public $searchKey=null; //搜索关键字
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Goods the static model class
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
		return 'ol_goods';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			/*array('brand_id, type_id, cat_id, good_name, good_sn, market_price, shop_price, unit, add_time', 'required'),
			array('brand_id, type_id, cat_id, add_time, sold_count, collect_count, is_recommend, is_on_sale', 'numerical', 'integerOnly'=>true),
			array('good_name', 'length', 'max'=>120),
			array('good_sn', 'length', 'max'=>60),
			array('market_price, shop_price, unit', 'length', 'max'=>10),
			array('good_attr, good_number', 'safe'),*/
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('good_id, brand_id, type_id, cat_id, good_name, good_sn, market_price, shop_price, unit, good_attr, good_number, add_time, sold_count, collect_count, is_recommend, is_on_sale', 'safe', 'on'=>'search'),
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
            'goodDetail'=>array(self::HAS_ONE,'GoodsDetail','good_id'),
            'cate'=>array(self::BELONGS_TO,'GoodCate','cat_id'),
            'brand'=>array(self::BELONGS_TO,'Brand','brand_id'),
            'goodAttrValues'=>array(self::MANY_MANY,'GoodsAttrValue','ol_good_attr(good_id,value_id)'),
            'goodFavorables'=>array(self::MANY_MANY,'GoodFavorable','ol_good_has_favorable(good_id,favorable_id)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'good_id' => 'Good',
			'brand_id' => 'Brand',
			'type_id' => 'Type',
			'cat_id' => 'Cat',
			'good_name' => 'Good Name',
			'good_sn' => 'Good Sn',
			'market_price' => 'Market Price',
			'shop_price' => 'Shop Price',
			'unit' => 'Unit',
			'good_attr' => 'Good Attr',
			'good_number' => 'Good Number',
			'add_time' => 'Add Time',
			'sold_count' => 'Sold Count',
			'collect_count' => 'Collect Count',
			'is_recommend' => 'Is Recommend',
			'is_on_sale' => 'Is On Sale',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search($pageSize=12)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('good_id',$this->good_id,true);
		$criteria->compare('brand_id',$this->brand_id);
		$criteria->compare('type_id',$this->type_id);
		$criteria->compare('cat_id',$this->cat_id);
		$criteria->compare('good_name',$this->good_name,true);
		$criteria->compare('good_sn',$this->good_sn,true);
		$criteria->compare('market_price',$this->market_price,true);
		$criteria->compare('shop_price',$this->shop_price,true);
		$criteria->compare('unit',$this->unit,true);
		$criteria->compare('good_attr',$this->good_attr,true);
		$criteria->compare('good_number',$this->good_number,true);
		$criteria->compare('add_time',$this->add_time);
		$criteria->compare('sold_count',$this->sold_count);
		$criteria->compare('collect_count',$this->collect_count);
		$criteria->compare('is_recommend',$this->is_recommend);
		$criteria->compare('is_on_sale',$this->is_on_sale);

        if($this->searchKey){
            $criteria->compare('good_name',$this->searchKey,true);
        }
        if($this->priceSec){
            $priceSecArr=explode('-',$this->priceSec);
            $criteria->addBetweenCondition('shop_price',$priceSecArr[0],$priceSecArr[1]);
        }
        if(count($this->attrSec)>0){
            $goodIds=array();
            foreach($this->attrSec as $attrId=>$attrVal){
                $attrId=explode('_',$attrId);
                $_criteria=new CDbCriteria;
                $_criteria->compare('attr_value',$attrVal,true);
                $_criteria->compare('attr_id',$attrId[1]);
                $goodAttrVals=GoodsAttrValue::model()->findAll($_criteria);
                $_goodIds=array();
                foreach($goodAttrVals as $goodAttrVal){
                    $goodAttr=GoodAttr::model()->find('value_id = :value_id',array(':value_id'=>$goodAttrVal->value_id));
                    $_goodIds[]=$goodAttr->good_id;
                }
                $goodIds=$goodIds?array_intersect($goodIds,$_goodIds):$_goodIds;
            }
           // Yii::app()->end();
          //  CVarDumper::dump($goodIds);exit;
            $criteria->addInCondition('good_id',$goodIds);
        }

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'pagination'=>array(
                'pageSize'=>$pageSize,
            ),
        ));
	}

    /*
     * 只处理限时的情况
     * */
    public function getGoodFavorables($price){
        $limitTime=0;
        $limitNum=0;
        $favorablePrice=0;
        if($this->goodFavorables){
            foreach($this->goodFavorables as $goodFavorable){
                $favorableCondition=unserialize(stripslashes($goodFavorable->favorable_condition)); //格式化addslashes(serialize($var))
                $favorableValue=unserialize(stripslashes($goodFavorable->favorable_value)); //格式化addslashes(serialize($var))
                if($goodFavorable->favorable_type == 1){
                    foreach($favorableCondition as $condType=>$condValue){
                        if($condType == 'limitTime'){
                            if(($condValue['symbol'] == 1 && time()>=$condValue['minTime'] && time()<=$condValue['maxTime']) ||
                                $condValue['symbol'] == 3 && time()<=$condValue['maxTime']
                            ){
                                $remainTime=$condValue['maxTime']-time();
                                if($limitTime==0)
                                    $limitTime=$remainTime;
                                else
                                    $limitTime=$remainTime<$limitTime?$remainTime:$limitTime;
                                if(isset($favorableValue['discount'])){
                                    $price=$price*($favorableValue['discount']/10);
                                    $favorablePrice=$price*(1-$favorableValue['discount']/10);
                                }
                                if(isset($favorableValue['reduce'])){
                                    $price=$price-$favorableValue['reduce'];
                                    $favorablePrice=$favorableValue['reduce'];
                                }
                            }
                        }
                    }
                }
            }
            return array(
                'price'=>sprintf('%01.2f',$price),
                'favorablePrice'=>$favorablePrice,
                'limitTime'=>$limitTime,
                'limitNum'=>$limitNum,
            );
        }else{
            return array(
                'price'=>sprintf('%01.2f',$price),
                'favorablePrice'=>$favorablePrice,
                'limitTime'=>$limitTime,
                'limitNum'=>$limitNum,
            );
        }
    }
}