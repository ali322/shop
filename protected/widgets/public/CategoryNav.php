<?php
/**
 * Created by JetBrains PhpStorm.
 * User: alichen
 * Date: 12-7-16
 * Time: 上午11:34
 * To change this template use File | Settings | File Templates.
 */
class CategoryNav extends CWidget{
    public $collapse=false;
    public function run(){
       // $criteria=new CDbCriteria;
      //  $criteria->condition='cat_id >1';
      //  $criteria->condition='t.cat_id in (4,5,6,7,8,9,10)';
        $_criteria=new CDbCriteria;
        $_criteria->order='sort asc';
        $channels=Channel::model()->findAll($_criteria);
        $_channels=array();
        foreach($channels as $k=>$channel){
           // CVarDumper::dump($channel->channel_category);
            $_channels[$k]['channelId']=$channel->channel_id;
            $_channels[$k]['channelName']=$channel->channel_name;
            $criteria=new CDbCriteria;
            $criteria->limit=10;
            $brands=Brand::model()->findAll($criteria);
            $_channels[$k]['recommendedBrands']=$brands;
            foreach(explode(',',$channel->channel_category) as $catId){
                $goodCates=GoodCate::model()->getCategory($catId);
                $catArr=array();
                foreach($goodCates as $goodCate){
                    $catArr[$goodCate['cat_id']]=array(
                        'id'=>$goodCate['cat_id'],
                        'href'=>Yii::app()->createUrl('goods/list',array('cat_id'=>$goodCate['cat_id'])),
                        'text'=>$goodCate['cat_name'],
                        'parentId'=>$goodCate['parent_id'],
                    );
                }
                $catArr=Helper_Array::toTree($catArr,'id','parentId','children');
                $_channels[$k]['category'][]=$catArr;
             //   CVarDumper::dump($catArr);
            }
        }
/*        $goodCates=GoodCate::model()->getCategory(1);
        $catArr=array();
        foreach($goodCates as $goodCate){
            $catArr[$goodCate['cat_id']]=array(
                'id'=>$goodCate['cat_id'],
                'href'=>Yii::app()->createUrl('goods/list',array('cat_id'=>$goodCate['cat_id'])),
                'text'=>$goodCate['cat_name'],
                'parentId'=>$goodCate['parent_id'],
            );
        }
       // CVarDumper::dump($catArr);
        $catArr=Helper_Array::toTree($catArr,'id','parentId','children');
        foreach($catArr as &$topCate){
            $criteria=new CDbCriteria;
            $criteria->limit=10;
            $brands=Brand::model()->findAll($criteria);
            $topCate['recommendedBrands']=$brands;
           // $topCate['href']=Yii::app()->createUrl('main/channel');
           // $topCate['href']=
        }*/
        if($this->collapse)
            $this->render('categorynavholder',array('lftCate'=>$_channels));
        else
            $this->render('categorynav',array('lftCate'=>$_channels));
    }
}