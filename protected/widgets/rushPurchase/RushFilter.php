<?php
/**
 * Created by JetBrains PhpStorm.
 * User: alichen
 * Date: 12-10-6
 * Time: 上午10:29
 * To change this template use File | Settings | File Templates.
 */
class RushFilter extends CWidget{
    public $model;
    public $route;

    /**
     * 获取GET参数
     * @param null $key
     * @return array
     */
    private function getQueryAttrs($key = null)
    {
        $queryAttrs = array();
        //   CVarDumper::dump(Yii::app()->request->queryString);
        foreach ($_GET as $k => $v) {
            //   if(in_array($k,$this->passVars))
            $queryAttrs[$k] = strip_tags(trim($v));
        }
        if ($key)
            unset($queryAttrs[$key]);

        return $queryAttrs;
    }

    public function run(){
        $criteria = $this->model->search()->criteria;
        $criteria->select = 'good_id,brand_id,shop_price,market_price,cat_id';
        $goods = Goods::model()->findAll($criteria);
        if ($goods != null) {
            $queryAttrs = $this->getQueryAttrs();

            /*获取品牌过滤列表开始*/
            $currBrandId = isset($queryAttrs['brand_id']) ? $queryAttrs['brand_id'] : null;
            $brands_arr = array();
            $brands_arr['all'] = Yii::app()->createUrl($this->route, $this->getQueryAttrs('brand_id'));
            $brands_arr['showAll'] = $currBrandId ? false : true;
            // $brands_arr['list']=array();
            foreach ($goods as $good) {
                $brands_arr['list'][] = array(
                    'brandId' => $good->brand_id,
                    'brandName' => $good->brand->brand_name,
                    'currBrand' => $currBrandId ? true : false,
                    'brandLink' => Yii::app()->createUrl($this->route, array_merge($this->getQueryAttrs('brand_id'), array('brand_id' => $good->brand_id))),
                );
            }
            $brands_arr['list'] = Helper_Array::unique_arr($brands_arr['list']);
            sort($brands_arr['list']);
            /*获取品牌过滤列表结束*/

            $this->render('rushfilter',array(
                'queryAttrs' => $this->getQueryAttrs('attr_id'),
                'model' => $this->model,
                //    'brandAll'=>$brands_all,
                'brandArr' => $brands_arr,
            ));
        }
    }
}