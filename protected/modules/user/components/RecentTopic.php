<?php
class RecentTopic extends CInputWidget{
    public function run(){
        $criteria=new CDbCriteria;
        $criteria->limit=3;
        $topics=Topic::model()->findAll($criteria);
        $this->render('recenttopic',array('topics'=>$topics));
    }
}
?>
