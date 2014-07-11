<?php

/**
 * This is the model class for table "ol_orders".
 *
 * The followings are the available columns in table 'ol_orders':
 * @property string $id
 * @property string $order_sn
 * @property string $good_info
 * @property string $money_refund
 * @property string $money_paid
 * @property string $order_amount
 * @property string $good_amount
 * @property integer $operator_id
 * @property integer $user_id
 * @property integer $order_status
 * @property integer $pay_status
 * @property integer $delivery_id
 * @property integer $ship_id
 * @property string $ship_fee
 * @property string $bonus_fee
 * @property integer $pay_id
 * @property integer $add_time
 * @property integer $confirm_time
 * @property integer $pay_time
 * @property integer $shipping_time
 * @property integer $refund_time
 * @property integer $finish_time
 */
class Order extends CActiveRecord
{
    /*付款状态*/
    public $formattedPayStatus;
    /*订单状态*/
    public $formattedOrderStatus;

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Order the static model class
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
		return 'ol_orders';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('order_sn, good_info, order_amount, user_id, ship_fee, add_time', 'required'),
			array('operator_id, user_id, order_status, pay_status, delivery_id, ship_id, pay_id, add_time, confirm_time, pay_time, shipping_time, refund_time, finish_time', 'numerical', 'integerOnly'=>true),
			array('order_sn', 'length', 'max'=>20),
			array('money_refund, money_paid, order_amount, ship_fee, bonus_fee', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, order_sn, good_info, money_refund, money_paid, order_amount, good_amount, operator_id, user_id, order_status, pay_status, delivery_id, ship_id, ship_fee, bonus_fee, pay_id, add_time, confirm_time, pay_time, shipping_time, refund_time, finish_time', 'safe', 'on'=>'search'),
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
            'user'=>array(self::BELONGS_TO,'ShopUser','user_id'),
            'delivery'=>array(self::BELONGS_TO,'UserDelivery','delivery_id'),
            'shippment'=>array(self::BELONGS_TO,'Shippment','ship_id'),
            'payment'=>array(self::BELONGS_TO,'Payment','pay_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'order_sn' => 'Order Sn',
			'good_info' => 'Good Info',
			'money_refund' => 'Money Refund',
			'money_paid' => 'Money Paid',
			'order_amount' => 'Order Amount',
			'good_amount' => 'Good Amount',
			'operator_id' => 'Operator',
			'user_id' => 'User',
			'order_status' => 'Order Status',
			'pay_status' => 'Pay Status',
			'delivery_id' => 'Delivery',
			'ship_id' => 'Ship',
			'ship_fee' => 'Ship Fee',
			'bonus_fee' => 'Bonus Fee',
			'pay_id' => 'Pay',
			'add_time' => 'Add Time',
			'confirm_time' => 'Confirm Time',
			'pay_time' => 'Pay Time',
			'shipping_time' => 'Shipping Time',
			'refund_time' => 'Refund Time',
			'finish_time' => 'Finish Time',
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
		$criteria->compare('order_sn',$this->order_sn,true);
		$criteria->compare('good_info',$this->good_info,true);
		$criteria->compare('money_refund',$this->money_refund,true);
		$criteria->compare('money_paid',$this->money_paid,true);
		$criteria->compare('order_amount',$this->order_amount,true);
		$criteria->compare('good_amount',$this->good_amount,true);
		$criteria->compare('operator_id',$this->operator_id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('order_status',$this->order_status);
		$criteria->compare('pay_status',$this->pay_status);
		$criteria->compare('delivery_id',$this->delivery_id);
		$criteria->compare('ship_id',$this->ship_id);
		$criteria->compare('ship_fee',$this->ship_fee,true);
		$criteria->compare('bonus_fee',$this->bonus_fee,true);
		$criteria->compare('pay_id',$this->pay_id);
		$criteria->compare('add_time',$this->add_time);
		$criteria->compare('confirm_time',$this->confirm_time);
		$criteria->compare('pay_time',$this->pay_time);
		$criteria->compare('shipping_time',$this->shipping_time);
		$criteria->compare('refund_time',$this->refund_time);
		$criteria->compare('finish_time',$this->finish_time);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    protected function afterFind(){
        parent::afterFind();
        switch($this->order_status){
            case 0:
                $this->formattedOrderStatus='新订单';
            case 1:
                $this->formattedOrderStatus='已完成';
            case 2:
                $this->formattedOrderStatus='已退单';
            default:
                $this->formattedOrderStatus='无效单';
        }
        $this->formattedPayStatus=$this->pay_status===0?'未付款':'已付款';
    }
}