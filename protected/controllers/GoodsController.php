<?php
/**
 * Created by JetBrains PhpStorm.
 * User: alichen
 * Date: 12-7-24
 * Time: 上午10:43
 * To change this template use File | Settings | File Templates.
 */
class GoodsController extends Controller{
    public function actionList(){
        $model=new Goods('search');
        $model->unsetAttributes();  // clear any default values
/*        if(isset($_GET['Goods']))
            $model->attributes=$_GET['Goods'];
        if(isset($_GET['brand_id']))
            $model->brand_id=isset($_GET['brand_id']) && !empty($_GET['brand_id'])?(int)$_GET['brand_id']:'';
        if(isset($_GET['cat_id']))
            $model->brand_id=isset($_GET['cat_id']) && !empty($_GET['cat_id'])?(int)$_GET['cat_id']:'';*/
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
/*        if(isset($_GET['discount']))
            $model->discount=isset($_GET['discount']) && !empty($_GET['discount'])?strip_tags(trim($_GET['discount'])):'';*/
/*        if(isset($_GET['priceSec']))
            $model->priceSec=isset($_GET['price_sec']) && !empty($_GET['price_sec'])?strip_tags(trim($_GET['price_sec'])):'';*/
        $this->render('list',array(
            'model'=>$model,
        ));
    }

    public function actionSearch(){
        $model=new Goods('search');
        $model->unsetAttributes();  // clear any default values

/*        if(isset($_GET['Goods']))
            $model->attributes=$_GET['Goods'];
        if(isset($_GET['sT']) && !empty($_GET['sT']))
            $searchType=strip_tags(trim($_GET['sT']));
        if(isset($_GET['key']) && !empty($_GET['key'])){
            $model->{$searchType}=strip_tags(trim($_GET['key']));
            $key=strip_tags(trim($_GET['key']));
        }
        if(isset($_GET['discount']))
            $model->discount=isset($_GET['discount']) && !empty($_GET['discount'])?strip_tags(trim($_GET['discount'])):'';
        //         if(isset($_GET['price_sec']))
        //                $model->price_sec=isset($_GET['price_sec']) && !empty($_GET['price_sec'])?strip_tags(trim($_GET['price_sec'])):'';
        if(isset($_GET['cat_id']) && !empty($_GET['cat_id'])){
            $cate=GoodsCate::model()->findByPk((int)$_GET['cat_id']);
            $key=$cate->cat_name;
            $model->cat_id=(int)$_GET['cat_id'];
        }*/
        $paramKeys=array_keys($_GET);
        foreach($paramKeys as $paramKey){
            // CVarDumper::dump(strpos($paramKey,'attr_'));
            if(strpos($paramKey,'attr_') === 0){
                $model->attrSec[$paramKey]=$_GET[$paramKey];
            }
            if($model->hasAttribute($paramKey) || $paramKey === 'priceSec'){
                $model->{$paramKey}=$_GET[$paramKey];
            }
            if($paramKey == 'keyWord'){
                $model->searchKey=$_GET[$paramKey];
            }
        }
        // CVarDumper::dump($model->search()->criteria);exit;
        $this->render('search',array(
           // 'key'=>$key,
            // 'dataProvider'=>$model->search(),
            'model'=>$model,
        ));
    }

    public function actionView($id){
        $good=Goods::model()->findByPk((int)$id);
        $goodProducts=$good->good_number;
        $goodProducts=unserialize(stripslashes($goodProducts));
        $goodSpecsArr=array(); //规格列表
        $formattedGoodSpecs=array(); //格式化的规格列表
        $defaultProduct=array();   //默认货品
       // $goodSpecs=null;
        $goodFavorables=null;
        if($goodProducts){
            foreach($goodProducts as $goodProduct){
                if(isset($goodProduct['spec_values']))
                    $goodSpecsArr[]=$goodProduct['spec_values'];
            }
            if($goodSpecsArr){
                $specNames=array_keys($goodSpecsArr[0]);
                $goodSpecs=$this->loadGoodSpecs($goodSpecsArr,$refs); //获取规格树
            }
            /*点击规格项后台响应开始*/
            if(isset($_POST['selectedSpec']) && isset($_POST['specs'])){
                $specIndex=array_search($_POST['selectedSpec'],$specNames);
                $specs=explode(',',$_POST['specs']);
                $searchSpec=array_slice($specs,0,$specIndex+1);
                foreach($goodProducts as $goodProduct){
                    if(implode(',',$searchSpec) == implode(',',array_slice($goodProduct['spec_values'],0,$specIndex+1))){
                        $defaultProduct=$goodProduct;
                    }
                }
                /*根据POST参数查询获取货品,根据货品的规格值对规格树进行过滤生成规格列表*/
                $formattedGoodSpecs=$this->displaySpecs($goodSpecs,$specNames,$defaultProduct,$formattedGoodSpecs);

                $goodFavorables=$good->getGoodFavorables($defaultProduct['shop_price']);
                $defaultProduct['shop_price']=$goodFavorables['price'];
                echo $this->renderPartial('_products',array(
                    'goodSpecs'=>$formattedGoodSpecs,
                    'good'=>$good,
                    'defaultProduct'=>$defaultProduct,
                ),true);
                Yii::app()->end();
            }
            /*点击规格项后台响应结束*/
            $defaultProduct=$goodProducts[0];
            $goodFavorables=$good->getGoodFavorables($defaultProduct['shop_price']);
        //    $originalPrice=$defaultProduct['shop_price'];
            $defaultProduct['shop_price']=$goodFavorables['price'];
            $defaultProduct['spec_values']=isset($defaultProduct['spec_values'])?$defaultProduct['spec_values']:null;
            if($goodSpecsArr)
                $formattedGoodSpecs=$this->displaySpecs($goodSpecs,$specNames,$defaultProduct,$formattedGoodSpecs);
        }
       // CVarDumper::dump($goodProducts);
        $goodAttrs=array();
        $goodAttrs['商品名']=$good->good_name;
        $goodAttrs['品牌']=$good->brand->brand_name;
        $goodAttrs['商品编码']=$good->good_sn;
        $goodAttrs['商品分类']=$good->cate->cat_name;
        foreach($good->goodAttrValues as $row){
            $goodAttrs[$row->typeAttr->attr_name]=$row->attr_value;
        }
        if($good==null)
            throw new CHttpException(404,'The requested good does not exist.');
        $this->render('view',array(
            'good'=>$good,
           // 'rows'=>$goodSpecs,
            'goodAttrs'=>$goodAttrs,
            'goodSpecs'=>$formattedGoodSpecs,
            'defaultProduct'=>$defaultProduct,
            'goodFavorables'=>$goodFavorables,
        ));
    }

    public function actionBrand($id){
        $model=new Goods('search');
        $model->unsetAttributes();  // clear any default values
        $model->brand_id=(int)$id;
        $brand=Brand::model()->findByPk((int)$id);

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
        $this->render('brand',array(
            'brand'=>$brand,
            'model'=>$model,
        ));
    }

    public function actionAllComments(){
        $this->render('allcomments');
    }

    public function actionBigView($id){
        $this->layout='//layouts/simpleLayout';

        $good=Goods::model()->findByPk((int)$id);
        $this->render('bigview',array(
            'good'=>$good,
        ));
    }

    /*
   * 生成规格树
   * @param array $specsArr 原货品规格列表
   * @param array $refs 保存规格树节点的引用
   *
   * @return array $rows 规格树
   * */
    private function loadGoodSpecs($specsArr,&$refs){
        if(!$specsArr)
            return null;
        $rows=array();
        foreach($specsArr as $specs){
            $specValues=array_values($specs);
            $specId='';
            $specParent='';
            $deep=0;
            foreach($specValues as $key=>$spec){
                if($key > 1){
                    $specId.=$spec;
                    $specParent.=$specValues[$key-1];
                    $deep++;
                }elseif($key == 1){
                    $specParent=$specId;
                    $specId.=$spec;
                    $deep++;
                }else{
                    $specId.=$spec;
                    $specParent=0;
                    $deep=0;
                }
                /*生成符合树转换要求的数组(id使用规格值累加原则)*/
                $rows[]=array('id'=>$specId,'text'=>$spec,'deep'=>$deep,'parent'=>$specParent);
            }
        }
        $rows=Helper_Array::unique_arr($rows); //去除重复项
        $rows=Helper_Array::toTree($rows,'id','parent','children',$refs);
        return $rows;
    }

    /*
     * 递归调用过滤规格树,生成规格列表
     * @param array $rows 规格树数组
     * @param array $specNames 规格名数组
     * @param array $product 参考货品
     * @param array $formattedGoodSpecs 格式化后的规格列表
     *
     * @return array $formattedGoodSpecs 格式化后的规格列表
     * */
    private static function displaySpecs($rows,$specNames,$product,&$formattedGoodSpecs){
        $productSpecs=array_values($product['spec_values']);
        foreach($rows as $node){
            $formattedGoodSpecs[$specNames[$node['deep']]][]=$node['text'];
            //如果子节点不为空且值等于参考货品的相同索引位置的规格值展开此树进入递归
            if(!empty($node['children']) && $productSpecs[$node['deep']] == $node['text']){
                self::displaySpecs($node['children'],$specNames,$product,$formattedGoodSpecs);
            }
        }
        return $formattedGoodSpecs;
    }
}