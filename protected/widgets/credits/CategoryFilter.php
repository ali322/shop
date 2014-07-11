<?php
/**
 * Created by JetBrains PhpStorm.
 * User: alichen
 * Date: 12-10-22
 * Time: 下午4:17
 * To change this template use File | Settings | File Templates.
 */
class CategoryFilter extends CInputWidget{
    public function run(){
        $queryAttrs=array();
        foreach($_GET as $k=>$v){
            //  if(in_array($k,$this->passVars))
            $queryAttrs[$k]=$v;
        }
        // $criteria=new CDbCriteria;
        $catId=isset($queryAttrs['cat_id'])?$queryAttrs['cat_id']:null;
        if($catId){
            $cate=GoodCate::model()->findByPk($catId);
            $parentCate=GoodCate::model()->findByPk($cate->parent_id);
            $topCate=GoodCate::model()->findByPk($parentCate->parent_id);
            $goodCates=GoodCate::model()->getCategory($topCate->cat_id);
            $catArr=array();
            foreach($goodCates as $goodCate){
                $catArr[$goodCate['cat_id']]=array(
                    'id'=>$goodCate['cat_id'],
                    'href'=>Yii::app()->createUrl('goods/list',array('cat_id'=>$goodCate['cat_id'])),
                    'text'=>$goodCate['cat_name'],
                    'parentId'=>$goodCate['parent_id'],
                );
            }
        }else{
            //  $criteria=new CDbCriteria;
            $criteria=$this->model->search()->criteria;
            $goods=Goods::model()->findAll($criteria);
            if($goods !=null){
                $cat_arr=array();
                foreach ($goods as $row){
                    if($row->cate != null){
                        $cat_arr[]=GoodCate::model()->getCategory($row->cat_id,4);
                    }
                }
                $catArr=array();
                foreach($cat_arr as $row){
                    $hashCatArr=Helper_Array::toHashmap($row,'cat_id');
                    foreach ($row as $v){
                        if($v['cat_id'] >1 && $v['level']>1)
                            $catArr[$v['cat_id']]=array(
                                'id'=>$v['cat_id'],
                                'text'=>CHtml::link($v['level']==2?$hashCatArr[$v['parent_id']]['cat_name'].'&gt'.$v['cat_name']:$v['cat_name'],Yii::app()->createUrl('goods/list',array('cat_id'=>$v['cat_id']))),
                                'parentId'=>$v['parent_id'],
                            );
                    }
                }
            }else{
                $goodCates=GoodCate::model()->getCategory(1);
                $catArr=array();
                foreach($goodCates as $goodCate){
                    $catArr[$goodCate['cat_id']]=array(
                        'id'=>$goodCate['cat_id'],
                        'href'=>Yii::app()->createUrl('goods/list',array('cat_id'=>$goodCate['cat_id'])),
                        'text'=>$goodCate['cat_name'],
                        'parentId'=>$goodCate['parent_id'],
                    );
                }
            }
        }
        $catArr=Helper_Array::toTree($catArr,'id','parentId','children');
        $this->render('categoryfilter',array('cat_arr'=>$catArr));
    }
}