<?php
/**
 * Created by JetBrains PhpStorm.
 * User: alichen
 * Date: 12-7-30
 * Time: 下午2:20
 * To change this template use File | Settings | File Templates.
 */
class OrderController extends Controller{
    public function actionCheckOut(){
        $this->layout='//layouts/simpleLayout';

        $deliveryCriteria=new CDbCriteria;
        $deliveryCriteria->condition='user_id = :user_id';
        $deliveryCriteria->params=array(':user_id'=>Yii::app()->user->id);
        $consigneeModel=new UserDelivery;
        $userDeliverys=$consigneeModel->findAll($deliveryCriteria);

        $current_user=User::model()->findByPk(Yii::app()->user->id);

        $carts=Shop::getCartContent();
        foreach($carts as &$cart){
            $cart['good_specs']=explode('，',$cart['good_specs']);
        }
        $cartAmount=$_POST['cartSum'];
        $this->render('checkout',array(
            'user'=>$current_user,
            'carts'=>$carts,
            'cartAmount'=>$cartAmount,
            'consigneeModel'=>$consigneeModel,
            'userDeliverys'=>$userDeliverys,
            'shippments'=>Shippment::model()->findAll(),
        ));
    }

    public function actionPay(){
        $this->layout='//layouts/simpleLayout';
        $order=Shop::insertOrder($_POST['Order']);
        $this->render('pay',array('order'=>$order));
    }

    public function actionReceive(){
        $this->layout='//layouts/simpleLayout';
        $this->render('receive');
    }

    public function actionCheckBonus(){
        $bonus=(int)$_POST['bonus'];
        $result=array();
        $result['status']=1;
        $result['bonus']=10;

        echo CJSON::encode($result);
        Yii::app()->end();
    }

    public function actionCheckShipfee(){
        if(isset($_POST['payId'])){
            $payId=(int)$_POST['payId'];
            $shipFee=(int)$_POST['shipfee'];
            $res=array();
            if($payId == 1){
                $res=array('ship_fee_bonus'=>$shipFee,'status'=>1);
            }else{
                $res=array('status'=>0);
            }
            echo CJSON::encode($res);
            Yii::app()->end();
        }
    }
}