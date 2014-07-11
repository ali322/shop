<?php
/**
 * Created by JetBrains PhpStorm.
 * User: alichen
 * Date: 12-7-25
 * Time: 上午10:59
 * 商品列表过滤框
 */
class GoodFilter extends CWidget
{
    public $model;
    public $route;

    /*    public $passVars=array(
        'brand_id',
        'cat_id',
        'priceSec',
    );*/

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

    public function run()
    {
        $criteria = $this->model->search()->criteria;
        $criteria->select = 'good_id,brand_id,shop_price,market_price,cat_id';
        $goods = Goods::model()->findAll($criteria);
        if ($goods != null) {
            $queryAttrs = $this->getQueryAttrs();
            $queryKeyWord=isset($_GET['keyWord'])?$_GET['keyWord']:null;
            $queryCount=count($goods);

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

            /*获取属性筛选列表开始*/
            $attrParams = array();
            foreach ($queryAttrs as $paramKey => $paramValue) {
                // CVarDumper::dump(strpos($paramKey,'attr_'));
                if (strpos($paramKey, 'attr_') === 0) {
                    $paramKey = explode('_', $paramKey);
                    $attrParams[$paramKey[1]] = $paramValue;
                }
            }

            $attrs_arr = array();
            foreach ($goods as $good) {
                foreach ($good->goodAttrValues as $goodAttrValue) {
                    $attrs_arr[$goodAttrValue->typeAttr->attr_name]['all'] = Yii::app()->createUrl($this->route, $this->getQueryAttrs('attr_' . $goodAttrValue->attr_id));
                    $attrs_arr[$goodAttrValue->typeAttr->attr_name]['showAll'] = isset($attrParams[$goodAttrValue->attr_id]) && $attrParams[$goodAttrValue->attr_id] == $goodAttrValue->attr_value ? false : true;
                    $attrs_arr[$goodAttrValue->typeAttr->attr_name]['list'][] = array(
                        'attrValue' => $goodAttrValue->attr_value,
                        'currAttr' => isset($attrParams[$goodAttrValue->attr_id]) && $attrParams[$goodAttrValue->attr_id] == $goodAttrValue->attr_value ? true : false,
                        'attrLink' => Yii::app()->createUrl($this->route, array_merge(
                            $this->getQueryAttrs('attr_' . $goodAttrValue->attr_id),
                            array('attr_' . $goodAttrValue->attr_id . '' => $goodAttrValue->attr_value))),
                    );
                }
            }
            foreach ($attrs_arr as &$attrRows) {
                $attrRows['list'] = Helper_Array::unique_arr($attrRows['list']);
            }
            /*获取属性筛选列表结束*/

            /*获取价格过滤列表开始*/
            $currPriceSec = isset($queryAttrs['priceSec']) ? $queryAttrs['priceSec'] : null;
            if ($currPriceSec) {
                $priceSecs = array(array(
                    'secRange' => explode('-', $currPriceSec),
                    'currSec' => true,
                    'secLink' => Yii::app()->createUrl($this->route, array_merge($this->getQueryAttrs('priceSec'), array('priceSec' => $currPriceSec))),
                ));
            } else {
                $price_arr = array();
                foreach ($goods as $row)
                    $price_arr[] = $row->shop_price;
                $min_price = round(min($price_arr));
                $max_price = round(max($price_arr));
                //   echo $min_price;
                $price_step = round(($max_price - $min_price) / 5, -2);

                if ($price_step < 100) {
                    $price_arr_[] = array($min_price, $max_price);
                } else {
                    for ($i = 0; $i < 6; $i++) {
                        $price_arr_[$i][] = $min_price + $i * $price_step;
                        if ($i == 5)
                            $price_arr_[$i][] = $max_price;
                        else {
                            if ($min_price + ($i + 1) * $price_step >= $max_price) {
                                $price_arr_[$i][] = $max_price;
                                break;
                            } else
                                $price_arr_[$i][] = $min_price + ($i + 1) * $price_step;
                        }
                    }
                }
                $priceSecs = array();
                foreach ($price_arr_ as $priceSec) {
                    $priceSecs[] = array(
                        'secRange' => $priceSec,
                        'currSec' => $currPriceSec == implode('-', $priceSec) ? true : false,
                        'secLink' => Yii::app()->createUrl($this->route, array_merge($this->getQueryAttrs('priceSec'), array('priceSec' => implode('-', $priceSec)))),
                    );
                }
            }
            $priceArr = array(
                'list' => $priceSecs,
                'showAll' => $currPriceSec ? false : true,
                'all' => Yii::app()->createUrl($this->route, $this->getQueryAttrs('priceSec')),
            );
            /*获取价格过滤列表结束*/

            /*获取折扣过滤列表开始
            $discount_arr=array();
            foreach($goods as $row)
                $discount_arr[]=round(($row->shop_price/$row->market_price)*10,0);
            $min_discount=round(min($discount_arr));
            $max_discount=round(max($discount_arr))>9?9:round(max($discount_arr));
            $discount_step=round(($max_discount-$min_discount)/5,0);

            if($discount_step <1){
                $discount_arr_[]=array($min_discount,$max_discount);
            }else{
                for($i=0;$i<6;$i++){
                    $discount_arr_[$i][]=$min_discount+$i*$discount_step;
                    if($i==5)
                        $discount_arr_[$i][]=$max_discount;
                    else{
                        if($min_discount+($i+1)*$discount_step >= $max_discount){
                            $discount_arr_[$i][]=$max_discount;
                            break;
                        }else
                            $discount_arr_[$i][]=$min_discount+($i+1)*$discount_step;
                    }
                }
            }
            获取折扣过滤列表结束*/
            $this->render('goodfilter', array(
                'queryKeyWord'=>$queryKeyWord,
                'queryCount'=>$queryCount,
                'queryAttrs' => $this->getQueryAttrs('attr_id'),
                'model' => $this->model,
                //    'brandAll'=>$brands_all,
                'brandArr' => $brands_arr,
                'attrsArr' => $attrs_arr,
                'priceArr' => $priceArr,
                // 'discountArr'=>$discount_arr_
            ));
        }
    }
}