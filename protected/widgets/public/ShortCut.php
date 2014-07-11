<?php
class ShortCut extends CWidget{
    public function run() {
        $user= Yii::app()->getModule('user')->user(Yii::app()->user->id);
        $this->render('shortcut',array('user'=>$user));
    }
}
?>
