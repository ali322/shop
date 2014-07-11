<?php
/**
 * Created by JetBrains PhpStorm.
 * User: alichen
 * Date: 12-8-6
 * Time: 上午11:49
 * To change this template use File | Settings | File Templates.
 */
class RecommendPanel extends CWidget{
    public function run(){
        $recommendedList=array();

        /*疯狂抢购开始*/
        $criteria=new CDbCriteria;
        $criteria->condition='brand_id = 1773';
        $criteria->limit=6;
        $listItems=Goods::model()->findAll($criteria);
        $recommendedList[]=array(
            'listName'=>'疯狂抢购',
            'listItems'=>$listItems,
        );
        /*疯狂抢购结束*/

        /*热卖商品开始2F*/
        $criteria=new CDbCriteria;
        $criteria->condition='brand_id = 1799';
        $criteria->limit=6;
        $listItems=Goods::model()->findAll($criteria);
        $recommendedList[]=array(
            'listName'=>'热卖商品',
            'listItems'=>$listItems,
        );
        /*热卖商品结束*/

        /*热评商品开始3F*/
        $criteria=new CDbCriteria;
        $criteria->condition='brand_id = 1818';
        $criteria->limit=6;
        $listItems=Goods::model()->findAll($criteria);
        $recommendedList[]=array(
            'listName'=>'热评商品',
            'listItems'=>$listItems,
        );
        /*热评商品结束*/

        /*新片上架开始4F*/
        $criteria=new CDbCriteria;
        $criteria->condition='brand_id = 1847';
        $criteria->limit=6;
        $listItems=Goods::model()->findAll($criteria);
        $recommendedList[]=array(
            'listName'=>'新品上架',
            'listItems'=>$listItems,
        );
        /*新品上架结束*/

        /*猜您喜欢开始5F*/
        $criteria=new CDbCriteria;
        $criteria->condition='brand_id = 1882';
        $criteria->limit=6;
        $listItems=Goods::model()->findAll($criteria);
        $recommendedList[]=array(
            'listName'=>'猜您喜欢',
            'listItems'=>$listItems,
        );
        /*猜您喜欢结束*/

        /*商城首发开始6F*/
        $criteria=new CDbCriteria;
        $criteria->condition='brand_id = 1921';
        $criteria->limit=6;
        $listItems=Goods::model()->findAll($criteria);
        $recommendedList[]=array(
            'listName'=>'商城首发',
            'listItems'=>$listItems,
        );
        /*商城首发结束*/

     //   CVarDumper::dump($recommendedList);
        $this->render('recommendpanel',array('recommendedList'=>$recommendedList));
    }
}