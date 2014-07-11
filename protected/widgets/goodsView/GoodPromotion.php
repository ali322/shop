<?php
/**
 * Created by JetBrains PhpStorm.
 * User: alichen
 * Date: 12-9-6
 * Time: 上午11:42
 * To change this template use File | Settings | File Templates.
 */
class GoodPromotion extends CWidget{
    public $good; //商品
    public $favorables; //原货品价格

    public function run(){
        $goodPromotions=$this->favorables;
        $price=$goodPromotions['price'];
        $limitTime=$goodPromotions['limitTime'];
        $limitNum=$goodPromotions['limitNum'];
        $favorablePrice=$goodPromotions['favorablePrice'];
        $promotionVisible=false;
        $limitInfo='';
        if($limitTime>0){
            $promotionVisible=true;
            $timeRemain=date('m:H:i:s',$limitTime);
            $timeRemain=explode(':',$timeRemain);
            $limitInfo='<b>'.$timeRemain[0].'</b>天'
                       .'<b>'.$timeRemain[1].'</b>小时'
                       .'<b>'.$timeRemain[2].'</b>分'
                       .'<b>'.$timeRemain[3].'</b>秒';
        }
        if($limitNum>0){
            $promotionVisible=true;
            $limitInfo='<b>'.$limitNum.'</b>件';
        }
        $this->render('goodpromotion',array(
            'price'=>$price,
            'favorablePrice'=>$favorablePrice,
            'promotionVisible'=>$promotionVisible,
            'limitInfo'=>$limitInfo,
        ));
    }
}