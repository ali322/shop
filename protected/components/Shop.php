<?php
class Shop{
    public static function getCartContent(){
        return CJavaScript::jsonDecode(Yii::app()->user->getState('cart'));
    }
    public static function setCartContent($cart){
        if($cart == null){
            Yii::app()->user->setState('cart', CJavaScript::jsonEncode($cart));
            return false;
        }else{
            Yii::app()->user->setState('cart',  CJavaScript::jsonEncode($cart));
            return true;
        }
    }
    public static function getGoodsAmount($id,$params){
        $good=Goods::model()->findByPk($id);
        $goodsAmount=$params['price']*$params['number'];
        return sprintf('%01.2f',$goodsAmount);
    }
    
    public static function getCartAmount($cart){
        $order_amount=array();
        $order_amount['good_amount']=0;
        foreach($cart as $row){
            $order_amount['good_amount']+=$row['good_amount'];
        }
        
        $order_amount['ship_fee']=$order_amount['good_amount']>=68?0:8; //满68包邮
        
        $order_amount['order_amount']=$order_amount['good_amount']+$order_amount['ship_fee'];
        
        return $order_amount;
    }

    public static function checkGoodFavorable($arr,$goodFavorable){
        foreach($goodFavorable['condition'] as $condType=>$condValue){
            if($condType == 'limitTime'){
                if($condValue['symbol'] == 1 && time()>=$condValue['minTime'] && time()<=$condValue['maxTime']){
                    return true;
                }elseif($condValue['symbol'] == 2 && time()>=$condValue['minTime']){
                    return true;
                }elseif($condValue['symbol'] == 3 && time()<=$condValue['maxTime']){
                    return true;
                }else{
                    return false;
                }
            }
            if($condType == 'limitNum'){
                if($condValue['symbol'] == 1 && $arr['buyNum']>=$condValue['minNum'] && $arr['buyNum']<=$condValue['maxNum']){
                    return true;
                }elseif($condValue['symbol'] == 2 && $arr['buyNum']>=$condValue['minNum']){
                    return true;
                }elseif($condValue['symbol'] == 3 && $arr['buyNum']<=$condValue['maxNum']){
                    return true;
                }else{
                    return false;
                }
            }
            if($condType == 'limitPrice'){
                if($condValue['symbol'] == 1 && $arr['totalPrice']>=$condValue['minPrice'] && $arr['totalPrice']<=$condValue['maxPrice']){
                    return true;
                }elseif($condValue['symbol'] == 2 && $arr['totalPrice']>=$condValue['minPrice']){
                    return true;
                }elseif($condValue['symbol'] == 3 && $arr['totalPrice']<=$condValue['maxPrice']){
                    return true;
                }else{
                    return false;
                }
            }
        }
    }

    Public static function insertOrder($data){
        $order =new Order;
        $order->attributes=$data;

      //  $conn=Yii::app()->db;
      //  $seqid=$conn->createCommand('select seq("webshop2011") seqid')->queryScalar();
       // $order->order_sn=date('Ymd',time()).$seqid;
        $order->order_sn=date('Ymd').str_pad(mt_rand(1, 9999999),7,'0',STR_PAD_LEFT);
        $order->user_id=Yii::app()->user->id;
        $order->add_time=time();
        $order->delivery_id=(int)$_POST['Order']['delivery_selected'];
        $order->ship_id=(int)$_POST['Order']['shippment_selected'];
        $order->pay_id=(int)$_POST['Order']['payment_selected'];
        $order->ship_fee=(int)$_POST['Order']['shipfee'];

        $order_=array();
        if($order->save()){
            $order_['order_sn']=$order->order_sn;
            $order_['order_amount']=$order->order_amount;
            $order_['url']=self::getRedirectUrl($order);
        }else{
            $order_['errors']=$order->getErrors();
        }
        return $order_;
    }
    public  static function refundSend($order_id){
        $order=Order::model()->findByPk($order_id);
        $order_=array();
        if($order !=null && $order->pay_status ==1){
            $order_['order_sn']=$order->order_sn;
            $order_['order_amount']=$order->order_amount;
            $order_['url']=self::getRefundUrl($order);
        }else{
            $order_['errors']="退款订单不存在";
        }
        return $order_;
    }
    
    public  static function getRefundUrl($order){
        $url='';
        $orderId=$order->order_sn;
        $orderAmount=$order->order_amount;
        
        switch($order->pay_id){
            case 1:
                $url="http://www.9448.net/ccbcn/refund.php?&orderId={$orderId}&orderAmount={$orderAmount}&merchant_id=1000004";
                break;
            case 2:
                $url="http://www.9448.net/paycenter/cmb/refund?&orderId={$orderId}&orderAmount={$orderAmount}&merchant_id=1000004";
                break;
            case 3:
                $url="http://www.9448.net:8080/payment/abc/refund.jsp&orderId={$orderId}&orderAmount={$orderAmount}&merchant_id=1000004";
                break;
        }
        return $url;
    }
    
    public  static function getRedirectUrl($order){
        $url='';
        $orderId=$order->order_sn;
        $orderAmount=$order->order_amount;
        
        switch($order->pay_id){
            case 1:
                $url="http://www.9448.net/ccbcn/send.php?&orderId={$orderId}&orderAmount={$orderAmount}&merchant_id=1000004";
                break;
            case 2:
                $url="http://www.9448.net/paycenter/cmb/send?&orderId={$orderId}&orderAmount={$orderAmount}&merchant_id=1000004";
                break;
            case 3:
                $url="http://www.9448.net:8080/payment/abc/send.jsp&orderId={$orderId}&orderAmount={$orderAmount}&merchant_id=1000001";
                break;
        }
        return $url;
    }
    
    public static function receiveOrder($data){
        $merchant_id=1000004;
        $order_sn=$data['order_sn'];
        $order_amount=$data['orderAmount'];
        
        $res=array();
        if($data['md_code']==md5($merchant_id.$order_sn.$order_amount)){
            $order=Order::model()->find('order_sn=:order_sn and pay_status=0 and order_status=0',array(':order_sn'=>$order_sn));
            if($order == null)
                $res['error']='支付的订单不存在!';
            else{
                $order->pay_status=1;
                $order->money_paid=$order_amount;
                $order->pay_time=(int)$data['pay_time'];
                if($order->save()){
                    self::modifyGoods(CJavaScript::jsonDecode($order->good_info));
                      $res['order']=$order;
                }else
                      $res['error']='支付失败!';
            }
        }else{
            $res['error']='支付验证失败!';
        }
            return $res;
    }
    
    protected function modifyGoods($good_info,$plus=true){
        $good_id=array();
        foreach ($good_info as $good)
            $good_id[]=$good->good_id;
        if($plus)
            Goods::model()->updateAll('sold_count=sold_count+1','good_id in ('.implode(',',$good_id).')');
        else
            Goods::model()->updateAll('sold_count=sold_count-1','good_id in ('.implode(',',$good_id).') and sold_count>0');
    }
    
   public static function refundOrder($data){
        $merchant_id=1000004;
        $order_sn=$data['order_sn'];
        $order_amount=$data['orderAmount'];
        
        $res=array();
        if($data['md_code']==md5($merchant_id.$order_sn.$order_amount)){
            $order=Order::model()->find('order_sn=:order_sn and pay_status=1 and order_status=0',array(':order_sn'=>$order_sn));
            if($order == null)
                $res['error']='退款的订单不存在!';
            else{
                $order->order_status=4;
                $order->money_refund=$order_amount;
                $order->refund_time=(int)$data['refund_time'];
                if($order->save()){
                    self::modifyGoods(CJavaScript::jsonDecode($order->good_info),false);
                      $res['order']=$order;
                }else
                      $res['error']='支付失败!';
            }
        }else{
            $res['error']='支付验证失败!';
        }
            return $res;
    }

   public static function randStr($len=6){
      // $chars='abcdefghijklmnopqrstuvwxyz0123456789';
       $chars='abcdefghijklmnopqrstuvwxyz0123456789';
       mt_srand((double)microtime()*1000000*getmypid());
       $str='';
       while(strlen($str)<$len)
           $str.=substr($chars,(mt_rand()%strlen($chars)),1);
       return $str;
   }
}
?>
