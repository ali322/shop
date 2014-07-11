<?php
/**
 * Created by JetBrains PhpStorm.
 * User: alichen
 * Date: 12-10-26
 * Time: 上午10:46
 * To change this template use File | Settings | File Templates.
 */
class PromotionList extends CWidget{
    public $goods;

    public function run(){
        $this->render('promotionlist',array('goods'=>$this->goods));
    }
}