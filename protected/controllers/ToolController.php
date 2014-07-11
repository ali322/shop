<?php
/**
 * Created by JetBrains PhpStorm.
 * User: alichen
 * Date: 12-9-21
 * Time: 上午10:18
 * To change this template use File | Settings | File Templates.
 */
class ToolController extends Controller{
    public function actionGen(){
        $model=GoodFavorable::model()->findByPk(3);
        $model->favorable_condition=addslashes(serialize(array(
            'limitNum'=>array(
                'symbol'=>2,
                'minNum'=>20,
                // 'minTime'=>1346469365,
                //  'maxTime'=>1348802165
            )
        )));
        $model->favorable_value=addslashes(serialize(array('discount'=>7)));
        $model->save();
    }

    public function actionGenGoods(){
        $criteria=new CDbCriteria;
        $criteria->condition='cat_id =272';
        $criteria->limit=8;
        $goods=Goods::model()->findAll($criteria);
        $goodIds=array();
        foreach($goods as $good){
            $goodIds[]=$good->good_id;
        }
        CVarDumper::dump(implode(',',$goodIds));
    }

    public function actionFixPath(){
        $criteria=new CDbCriteria;
        //  $criteria->condition='good_number = null';
        //  $criteria->limit=500;
        $goods=GoodsDetail::model()->findAll($criteria);
        foreach($goods as $good){
            $good->good_desc=str_replace('www.9448.net','www.9448shop.com',$good->good_desc);
            $good->save();
        }
    }
    public function actionBatch(){
        $criteria=new CDbCriteria;
        $criteria->addBetweenCondition('good_id',845618,846259);
        $criteria->order='good_id desc';
        $criteria->limit=400;
        $goods=Goods::model()->findAll($criteria);
        //  CVarDumper::dump($goods);exit;
        foreach($goods as $good){
            if($good->good_number != ''){
                continue;
            }else{
                $_criteria=new CDbCriteria;
                $_criteria->condition='PRODUCT_SID = :sid';
                $_criteria->params=array(':sid'=>$good->good_id);
                $dicts=ProDetail::model()->findAll($_criteria);
                $specs=array();
                foreach($dicts as $k=>$dict){
                   // header("Content-type: text/html; charset=utf-8");
                  //  CVarDumper::dump($dict->PRO_COLOR);
                  //  CVarDumper::dump($dict->PRO_STAN);
                    $specs[$k]['spec_values']=array(
                        '13_颜色'=>$dict->PRO_COLOR,
                        '14_尺码'=>$dict->PRO_STAN,
                    );
                    $specs[$k]['shop_price']=$good->shop_price;
                    $specs[$k]['good_number']=3;
                    $specs[$k]['good_img']=$good->goodDetail->good_img;
                }
             //   continue;
                // echo $good->good_id;continue;
/*                $specs=array();
                for($i=0;$i<3;$i++){
                    $specs[$i]['shop_price']=$good->shop_price;
                    $specs[$i]['good_number']=3;
                    $specs[$i]['good_img']=$good->goodDetail->good_img;
                }*/
                $good->good_number=addslashes(serialize($specs));
              //  CVarDumper::dump($good->good_number);
                if($good->save())
                    echo $good->good_id.'success<br />';
                else
                    CVarDumper::dump($good->getErrors());
            }
        }
    }

    public function  actionMake(){
        $db=Yii::app()->db;
        $sql="SELECT PRODUCT_SID,PRO_PICT_NAME,PRO_PICT_DIR FROM pro_picture ORDER BY SID ASC";
        $results=$db->createCommand($sql)->queryAll();
       // CVarDumper::dump($results);
        $gallery=array();
        foreach($results as $result){
         //   CVarDumper::dump((int)$result['PRODUCT_SID']);
            $gallery[(int)$result['PRODUCT_SID']]['gallery'][]=$result['PRO_PICT_NAME'];
            $gallery[(int)$result['PRODUCT_SID']]['dir']=$result['PRO_PICT_DIR'];
            $gallery[(int)$result['PRODUCT_SID']]['img']=$result['PRO_PICT_NAME'];
        }
        foreach($gallery as $k=>$row){
            $row['gallery']=implode(',',$row['gallery']);
            echo $k.'-'.$row['img'].'-'.$row['dir'].'-'.$row['gallery'].'<br>';
          //  $sql="UPDATE ol_good_detail SET good_gallery ='{$row}' WHERE good_id ='{$k}'";
          //  $results=$db->createCommand($sql)->execute();
         //   CVarDumper::dump($results);
        }
    }

    public function actionBatchGoodDesc(){
        $criteria=new CDbCriteria;
        $criteria->addBetweenCondition('good_id',852414,852413);
        $criteria->order='good_id asc';
        $criteria->limit=400;
        //  $criteria->condition='good_number = null';
        //  $criteria->limit=500;
        $goods=GoodsDetail::model()->findAll($criteria);
        foreach($goods as $good){
            $content='<br />';
            foreach(explode(',',$good->good_gallery) as $k=>$row){
                if($k == 0)
                    continue;
                $descImg='http://www.9448.com/upload/webshop/good_img/'.$good->good_img_path.'/'.$row;
                $content.='<img src="'.$descImg.'" /><br />';
            }
            $good->good_desc.=$content;
          //  CVarDumper::dump($content);
            if($good->save())
                echo $good->good_id.'success<br />';
        }
    }

    public function actionBuildTree(){
        set_time_limit(0);
        ini_set('memory_limit','512M');
        $conn=mysql_connect('localhost','root',123456);
        if (!$conn)
        {
            die('Could not connect: ' . mysql_error());
        }
        mysql_select_db("shopz", $conn);
        $this->rebuild_tree('女装',1046);
        mysql_close($conn);
    }
    private  function rebuild_tree($parent, $left) {

        // the right value of this node is the left value + 1
        $right = $left+1;
        // get all children of this node
        $result = mysql_query("
        SELECT cat_name
        FROM ol_good_cate
        WHERE parent_id = '" . $parent . "'
        ;"
        );
        while ($row = mysql_fetch_array($result)) {
            // recursive execution of this function for each
            // child of this node
            // $right is the current right value, which is
            // incremented by the rebuild_tree function
            $right = $this->rebuild_tree($row['cat_name'], $right);
        }
        // we've got the left value, and now that we've processed
        // the children of this node we also know the right value
        mysql_query("
        UPDATE ol_good_cate
        SET
            lft = '" . $left . "',
            rgt= '" . $right . "'
        WHERE cat_name = '" . $parent . "'
        ;"
        );

        // return the right value of this node + 1
        return $right + 1;
    }
}