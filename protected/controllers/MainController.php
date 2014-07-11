<?php
/**
 * Created by JetBrains PhpStorm.
 * User: alichen
 * Date: 12-8-7
 * Time: 上午11:27
 * To change this template use File | Settings | File Templates.
 */
class MainController extends Controller{
    public function actions(){
        return array(
            'dynamicAddress'=>array(
                'class'=>'ext.addressSelector.actions.DynamicAddress',
            )
        );
    }

    public function actionChannel($id){
        $channel=Channel::model()->findByPk((int)$id);
        $channelCategory=array();
        $channelCatIds=array();
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
                if($goodCate['level'] == 3){
                    $channelCatIds[]=$goodCate['cat_id'];
               }
            }
            $catArr=Helper_Array::toTree($catArr,'id','parentId','children');
            $channelCategory[]=$catArr;
        }

        $criteria=new CDbCriteria;
        $criteria->addInCondition('brand_id',explode(',',$channel->recommend_brands));
        $recommendedBrands=Brand::model()->findAll($criteria);

        $_criteria=new CDbCriteria;
        $_criteria->addInCondition('good_id',explode(',',$channel->channel_promotion));
        $promotionGoods=Goods::model()->findAll($_criteria);

        $goodCriteria=new CDbCriteria;
        $goodCriteria->addInCondition('cat_id',$channelCatIds);
        $goodCriteria->order='sold_count desc';
        $goodCriteria->limit=5;
        $hotGoods=Goods::model()->findAll($goodCriteria);

        $this->render('channel',array(
            'channel'=>$channel,
            'channelCategory'=>$channelCategory,
            'recommendedBrands'=>$recommendedBrands,
            'promotionGoods'=>$promotionGoods,
            'hotGoods'=>$hotGoods,
        ));
    }

    public function actionAllCategory(){
        $this->activePage=1;
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
        $catArr=Helper_Array::toTree($catArr,'id','parentId','children');
        $this->render('allcategory',array(
            'catArr'=>$catArr,
        ));
    }

    public function actionAllBrand(){
        $this->activePage=1;
        $goodCates=GoodCate::model()->getCategory(1);
        $catArr=array();
        foreach($goodCates as $goodCate){
            $catArr[$goodCate['cat_id']]=array(
                'id'=>$goodCate['cat_id'],
                'text'=>$goodCate['cat_name'],
                'parentId'=>$goodCate['parent_id'],
            );
        }
        $catArr=Helper_Array::toTree($catArr,'id','parentId','children');
        $formattedCatArr=array();
        foreach($catArr as $cat){
            $catIds=$this->collectBrands($cat['children']);
            $criteria=new CDbCriteria;
            $criteria->addInCondition('cat_id',$catIds);
            $criteria->select='brand_id';
            $goods=Goods::model()->findAll($criteria);
            if($goods){
                $brandArr=array();
                foreach($goods as $good){
                    $brandArr[$good->brand_id]=$good->brand;
                }
                $formattedCatArr[$cat['id']]=array(
                    'catName'=>$cat['text'],
                    'brands'=>$brandArr,
                );
            }
        }
        $this->render('allbrand',array('catArr'=>$formattedCatArr));
    }

    private function collectBrands($catArr){
        $catArr=array('children'=>$catArr);
        $catArr=Helper_Array::treeToArray($catArr);
        array_shift($catArr);
        $catIds=Helper_Array::getCols($catArr,'id');
        return $catIds;
    }

    public function actionPromotion(){
        $this->activePage=2;

        /*最新活动*/
        $criteria=new CDbCriteria;
        $criteria->limit=5;
      //  $criteria->order='add_time desc';
        $newActs=Acts::model()->findAll($criteria);

        $model=new Acts('search');
        $model->unsetAttributes();  // clear any default values
        $this->render('promotion',array(
            'model'=>$model,
            'newActs'=>$newActs,
        ));
    }

    public function actionRushPurchase(){
        $this->activePage=3;
        $model=new Goods('search');
        $model->unsetAttributes();  // clear any default values
        $model->cat_id=61;
        $paramKeys=array_keys($_GET);
        foreach($paramKeys as $paramKey){
            // CVarDumper::dump(strpos($paramKey,'attr_'));
            if(strpos($paramKey,'attr_') === 0){
                $model->attrSec[$paramKey]=$_GET[$paramKey];
            }
            if($model->hasAttribute($paramKey) || $paramKey === 'priceSec'){
                $model->{$paramKey}=$_GET[$paramKey];
            }
        }
        $this->render('rushpurchase',array(
            'model'=>$model
        ));
    }

    public function actionCredits(){
        $this->activePage=5;
        $model=new Goods('search');
        $model->unsetAttributes();  // clear any default values
        $model->brand_id=1983;
        $this->render('credits',array(
            'model'=>$model,
        ));
    }
}