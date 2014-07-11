<?php
/**
 * Created by JetBrains PhpStorm.
 * User: alichen
 * Date: 12-7-24
 * Time: 下午3:26
 * To change this template use File | Settings | File Templates.
 */
class CartWidget extends  CWidget{
    public function run(){
        $carts=Shop::getCartContent();
        $cartAmount=$this->getCartFavorables($carts);
        if($cartAmount){
            foreach($cartAmount['carts'] as &$cart){
                $cart['good_specs']=explode('，',$cart['good_specs']);
            }
        }
        $this->render('cartwidget',array(
            'cartsAmount'=>$cartAmount,
        ));
    }

    /*
     * 处理限量,限满情况
     * */
    private function getCartFavorables($carts){
        if(!$carts){
            return null;
        }
        $goodIds=Helper_Array::getCols($carts,'good_id');

        $criteria=new CDbCriteria;
        $criteria->addInCondition('good_id',$goodIds);
        $goodHasFavorables=GoodHasFavorable::model()->findAll($criteria);

        $favorableGoods=array();
        foreach($goodHasFavorables as $row){
            if(in_array($row->goodFavorable->favorable_type,array(2,3,4,5,6,7))){
                $favorableGoods[$row->goodFavorable->favorable_id]['goodIds'][]=$row->good_id;
                $favorableGoods[$row->goodFavorable->favorable_id]['type']=$row->goodFavorable->favorable_type;
                $favorableGoods[$row->goodFavorable->favorable_id]['name']=$row->goodFavorable->favorable_name;
                $favorableGoods[$row->goodFavorable->favorable_id]['condition']=unserialize(stripslashes($row->goodFavorable->favorable_condition));
                $favorableGoods[$row->goodFavorable->favorable_id]['value']=unserialize(stripslashes($row->goodFavorable->favorable_value));
                $favorableGoods[$row->goodFavorable->favorable_id]['buy_number']=0;
                $favorableGoods[$row->goodFavorable->favorable_id]['sumPrice']=0;
            }
        }
        $sumPrice=array();
        //   $favorableGroups=array();
        $favorablePrice=0;

        foreach($carts as $cartId=>$cartGood){
            foreach($favorableGoods as &$favorableGood){
                if(in_array($cartGood['good_id'],$favorableGood['goodIds'])){
                    $favorableGood['buy_number']+=$cartGood['buy_number'];
                    $favorableGood['sumPrice']+=$cartGood['shop_price']*$cartGood['buy_number'];
                    $goodFavorabled=false;
                    //  echo '<'.$favorableGood['name'].'>';
                    foreach($favorableGood['condition'] as $condType=>$condValue){
                        if($condType == 'limitTime'){
                            if(($condValue['symbol'] == 1 && time()>=$condValue['minTime'] && time()<=$condValue['maxTime']) ||
                                ($condValue['symbol'] == 2 && isset($condValue['minTime']) && time()>=$condValue['minTime']) ||
                                ($condValue['symbol'] == 3 && isset($condValue['maxTime']) && time()<=$condValue['maxTime'])
                            ){
                                $goodFavorabled=true;//echo 'timetrue';
                            }else{
                                $goodFavorabled=false;//echo 'timefalse';
                                break;
                            }
                        }
                        if($condType == 'limitNum'){
                            if(($condValue['symbol'] == 1 && $favorableGood['buy_number']>=$condValue['minNum'] && $favorableGood['buy_number']<=$condValue['maxNum']) ||
                                ($condValue['symbol'] == 2 && isset($condValue['minNum']) && $favorableGood['buy_number']>=$condValue['minNum']) ||
                                ($condValue['symbol'] == 3 && isset($condValue['maxNum']) && $favorableGood['buy_number']<=$condValue['maxNum'])
                            ){
                                $goodFavorabled=true;//echo 'numtrue';
                            }else{
                                $goodFavorabled=false;//echo 'numfalse';
                                break;
                            }
                        }
                        //CVarDumper::dump($goodFavorabled);
                        if($condType == 'limitPrice'){
                            if(($condValue['symbol'] == 1 && $favorableGood['sumPrice']>=$condValue['minPrice'] && $favorableGood['sumPrice']<=$condValue['maxPrice']) ||
                                ($condValue['symbol'] == 2 && isset($condValue['minPrice']) && $favorableGood['sumPrice']>=$condValue['minPrice']) ||
                                ($condValue['symbol'] == 3 && isset($condValue['maxPrice']) && $favorableGood['sumPrice']<=$condValue['maxPrice'])
                            ){
                                $goodFavorabled=true;//echo 'pricetrue';
                            }else{
                                $goodFavorabled=false;//echo 'pricefalse';
                                break;
                            }
                        }
                    }
                    //CVarDumper::dump($favorableGood['name'].'=>');
                    // CVarDumper::dump($goodFavorabled);
                    if($goodFavorabled){
                        if(isset($favorableGood['value']['reduce'])){
                            $favorablePrice+=$favorableGood['value']['reduce'];
                        }
                        if(isset($favorableGood['value']['discount'])){
                            $favorablePrice+=($favorableGood['sumPrice']*(1-$favorableGood['value']['discount']/10));
                        }
                    }
                }
            }

            $sumPrice[]=$cartGood['shop_price']*$cartGood['buy_number']; //计算购物车总金额
        }
        $sumPrice=array_sum($sumPrice);
        $cartPrice=$sumPrice-$favorablePrice;
        Shop::setCartContent($carts);
        return array(
            'carts'=>$carts,
            'sumPrice'=>sprintf('%01.2f',$sumPrice),
            'cartPrice'=>sprintf('%01.2f',$cartPrice),
            'favorablePrice'=>$favorablePrice,
        );
    }
}