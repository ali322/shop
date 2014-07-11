<?php
/**
 * Created by JetBrains PhpStorm.
 * User: alichen
 * Date: 12-8-27
 * Time: 下午3:59
 * To change this template use File | Settings | File Templates.
 */
class PaymentList extends CWidget{
    public function run(){
        $ebankPayments=Payment::model()->ebank()->findAll();
        $normalPayments=Payment::model()->normal()->findAll();
        $this->render('paymentlist',array(
            'ebankPayments'=>$ebankPayments,
            'normalPayments'=>$normalPayments,
        ));
    }
}