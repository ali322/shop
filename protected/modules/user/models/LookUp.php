<?php
class LookUp{
    public static function orderStatus($flag){
        switch ($flag) {
            case 0:
                echo '新订单';
                break;
            case 1:
                echo '已打印';
                break;
            case 2:
                echo '已完成';
                break;
            case 4:
                echo '已退单';
                break;
            default:
                break;
        }
    }
    
  public static function payStatus($flag){
        switch ($flag) {
            case 0:
                return '未付款';
                break;
            case 1:
                return '已付款';
                break;
            default:
                break;
        }
    }
  public static function orderBtn($model){
      Yii::import('application.modules.webshop.models.Shop');
      $btn='';
      if($model->pay_status==0)
            $btn.=CHtml::link('付款',  Shop::getRedirectUrl($model)).'&nbsp;|&nbsp;';
      $btn.=CHtml::link('退单',array('/webshop/order/refund', 'id'=>$model->id),array('class'=>'del_order'));
      
      return $btn;
  }
}
?>
