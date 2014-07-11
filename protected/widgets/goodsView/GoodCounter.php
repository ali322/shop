<?php
/**
 * Created by JetBrains PhpStorm.
 * User: alichen
 * Date: 12-9-5
 * Time: 下午3:50
 * To change this template use File | Settings | File Templates.
 */
class GoodCounter extends CWidget{

    public function run(){
        $this->render('goodcounter',array(
           // 'defaultValue'=>$this->defaultValue,
          //  'valueEl'=>$this->valueEl,
        ));
    }
}