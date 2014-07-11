<?php
/**
 * Created by JetBrains PhpStorm.
 * User: alichen
 * Date: 12-8-6
 * Time: 上午11:52
 * To change this template use File | Settings | File Templates.
 */
class FloorPanel extends CWidget{
    public function run(){
        $floorArr=array();
        /*服装配饰楼层开始*/
        $goodCates=GoodCate::model()->getCategory(2);
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

       // $floorName=null;
        $floorContent=array();
        $floorContent[]=array(
            'navName'=>'特价促销',
            'tpl'=>'/site/floor/97promotion',
        );
        foreach($catArr as $topCat){
          //  $floorName=$topCat['text'];
            $catIds=Helper_Array::getCols($topCat['children'],'id');
            $criteria=new CDbCriteria;
            $criteria->limit=8;
            $criteria->addInCondition('cat_id',$catIds);
            $goods=Goods::model()->findAll($criteria);
            $floorContent[]=array(
                'navName'=>$topCat['text'],
                'navItems'=>$goods,
            );
        }

        $brandArr=array();
        foreach($catArr as $topCat){
            $catIds=Helper_Array::getCols($topCat['children'],'id');
            $criteria=new CDbCriteria;
            $criteria->select='brand_id';
            $criteria->addInCondition('cat_id',$catIds);
            $goods=Goods::model()->findAll($criteria);
            foreach($goods as $good){
                $brandArr[$good->brand_id]=$good->brand;
            }
        }

        $floorArr[]=array(
            'floorName'=>'女装',
            'floorCat'=>$catArr,
            'floorBrand'=>$brandArr,
            'floorContent'=>$floorContent,
        );
        /*服装配饰楼层结束*/
        $this->render('floorpanel',array('floorArr'=>$floorArr));
    }
}