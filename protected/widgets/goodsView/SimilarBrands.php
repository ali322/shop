<?php
/**
 * Created by JetBrains PhpStorm.
 * User: alichen
 * Date: 12-9-20
 * Time: 下午2:56
 * To change this template use File | Settings | File Templates.
 */
class SimilarBrands extends CWidget{
    public function run(){
        $criteria=new CDbCriteria;
        $criteria->limit=6;
        $brands=Brand::model()->findAll($criteria);
        $this->render('similarbrands',array(
            'brands'=>$brands,
        ));
    }
}