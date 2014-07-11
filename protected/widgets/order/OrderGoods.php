<?php
/**
 * Created by JetBrains PhpStorm.
 * User: alichen
 * Date: 12-7-30
 * Time: 下午3:31
 * To change this template use File | Settings | File Templates.
 */
class OrderGoods extends CWidget{
    public $goodInfo;
    public $operation=false;
    public $show_thumb=false;

    public function run(){
        $this->render('ordergoods',array(
            'goodInfo'=>$this->goodInfo,
            'operation'=>$this->operation,
            'show_thumb'=>$this->show_thumb,
        ));
    }
}