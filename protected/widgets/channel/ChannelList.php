<?php
/**
 * Created by JetBrains PhpStorm.
 * User: alichen
 * Date: 12-8-6
 * Time: 下午3:34
 * To change this template use File | Settings | File Templates.
 */
class ChannelList extends CWidget{
    public $channel;

    public function run(){
        $goodTopics=array();
        foreach($this->channel->goodTopics as $goodTopic){
           // CVarDumper::dump($goodTopic->topic_name);
            $criteria=new CDbCriteria;
            $criteria->addInCondition('good_id',explode(',',$goodTopic->goods));
            $topicGoods=Goods::model()->findAll($criteria);
            $goodTopics[$goodTopic->id]=array(
                'topicName'=>$goodTopic->topic_name,
                'topicGoods'=>$topicGoods,
                'topicAd'=>$goodTopic->getImageUrl().'/'.$goodTopic->topic_ad,
            );
        }
        $this->render('channellist',array('goodTopics'=>$goodTopics));
    }
}