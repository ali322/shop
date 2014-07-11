<?php
/**
 * Created by JetBrains PhpStorm.
 * User: alichen
 * Date: 12-8-17
 * Time: 上午11:16
 * To change this template use File | Settings | File Templates.
 */
class GoodsGallery extends CWidget{
    public $good;
    public function run(){
        $this->widget('ext.imagezoom.ImageZoom');
        $goodImage=$this->good->goodDetail->good_img;
      //  $goodImagePath=$this->good->goodDetail->good_img_path;
        $goodImagePath=$this->good->goodDetail->getImageUrl();
        $goodGallery=explode(',',$this->good->goodDetail->good_gallery);
        $this->render('goodsgallery',array(
            'goodImage'=>$goodImage,
            'goodImagePath'=>$goodImagePath,
            'goodGallery'=>$goodGallery,
        ));
    }
}