<?php

class CartController extends Controller
{
    private $returnUrl;

    public function filters()
    {
        return array(
         //   'accessControl', // perform access control for CRUD operations
        );
    }

    public function accessRules()
    {
        return array(
            array('allow',  // allow all users to perform 'index' and 'view' actions
                'actions'=>array('view'),
                'users'=>array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions'=>array('index','add','delete'),
                'users'=>array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions'=>array('admin'),
                'users'=>array('admin'),
            ),
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
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
        if(isset($_POST['cartGoods'])){
            foreach($_POST['cartGoods'] as $cartId=>$cartGood){
                $carts[$cartId]['buy_number']=$cartGood['cart_number'];
            }
        }
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
        if(isset($_POST['cartGoods'])){
            echo CJSON::encode(array(
                'sumPrice'=>sprintf('%01.2f',$sumPrice),
                'cartPrice'=>sprintf('%01.2f',$cartPrice),
                'favorablePrice'=>$favorablePrice,
            ));
            Yii::app()->end();
        }else{
            return array(
              'carts'=>$carts,
              'sumPrice'=>sprintf('%01.2f',$sumPrice),
              'cartPrice'=>sprintf('%01.2f',$cartPrice),
              'favorablePrice'=>$favorablePrice,
            );
        }
    }

    public function actionIndex()
    {
        $this->layout='//layouts/simpleLayout';

        $carts=Shop::getCartContent();
        $cartAmount=$this->getCartFavorables($carts);
        if($cartAmount){
            foreach($cartAmount['carts'] as &$cart){
                $cart['good_specs']=explode('，',$cart['good_specs']);
            }
        }
     //   CVarDumper::dump($cartAmount['carts']);
        $this->render('index',array(
            'cartsAmount'=>$cartAmount,
        ));
    }

    public function actionAdd(){
        // remove potential clutter
        if(isset($_POST['cart'])){
            if(isset($_POST['yt0']))
                unset($_POST['yt0']);
            if(isset($_POST['yt1']))
                unset($_POST['yt1']);

            $carts=Shop::getCartContent();
            if($carts == null){  //如果购物车为空添加
                $cart=$_POST['cart'];
               // $cart['cart_id']=Shop::randStr(8);
                $cart['good_amount']=Shop::getGoodsAmount($cart['good_id'],array(
                    'number'=>$cart['buy_number'],
                    'price'=>$cart['shop_price'],
                ));
                $carts[Shop::randStr(8)]=$cart;
            }elseif(!in_array($_POST['cart']['good_specs'],Helper_Array::getCols($carts,'good_specs'))){ //如果购物车不为空而且商品Id和商品规格不同添加
                $cart=$_POST['cart'];
               // $cart['cart_id']=Shop::randStr(8);
                $cart['good_amount']=Shop::getGoodsAmount($cart['good_id'],array(
                    'number'=>$cart['buy_number'],
                    'price'=>$cart['shop_price'],
                ));
                $carts[Shop::randStr(8)]=$cart;
            }else{       //如果购物车不为空而且商品ID和商品规格相同,只增加购买数量
                foreach($carts as &$cart){
                    if($cart['good_id'] == $_POST['cart']['good_id'] && $cart['good_specs'] == $_POST['cart']['good_specs']){
                       // $cart['cart_id']=Shop::randStr(8);
                        $cart['buy_number']=$cart['buy_number']+$_POST['cart']['buy_number'];
                        $cart['good_amount']=Shop::getGoodsAmount($cart['good_id'],array(
                            'number'=>$cart['buy_number'],
                            'price'=>$cart['shop_price'],
                        ));
                    }
                }
            }
           // CVarDumper::dump($carts);exit;
            Shop::setCartContent($carts);
            Yii::app()->user->setFlash('webshop','添加购物车成功!');
            $this->redirect(array('index'));
        }else{
            $this->redirect(array('default/index'));
        }
    }

    public function actionDelete(){
        $carts=Shop::getCartContent();
        $cartIds=explode(',',strip_tags(trim($_GET['cartId'])));
        foreach($cartIds as $cartId){
            unset($carts[$cartId]);
        }
       // CVarDumper::dump($carts);exit;
        Shop::setCartContent($carts);
        $this->redirect(array('index'));
    }


    // Uncomment the following methods and override them if needed
    /*
     public function filters()
     {
         // return the filter configuration for this controller, e.g.:
         return array(
             'inlineFilterName',
             array(
                 'class'=>'path.to.FilterClass',
                 'propertyName'=>'propertyValue',
             ),
         );
     }

     public function actions()
     {
         // return external action classes, e.g.:
         return array(
             'action1'=>'path.to.ActionClass',
             'action2'=>array(
                 'class'=>'path.to.AnotherActionClass',
                 'propertyName'=>'propertyValue',
             ),
         );
     }
     */
}