<?php
Yii::import('zii.widgets.CPortlet');
class OrderGoods extends CPortlet{
    public $cart;
    public $operation=false;
    public $show_thumb=false;
    public function renderContent(){
        $this->render('ordergoods',array(
            'cart'=>$this->cart,
            'operation'=>$this->operation,
            'show_thumb'=>$this->show_thumb,
        ));
    }
}
?>
