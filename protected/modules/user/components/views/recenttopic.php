    <h2>
        <div>MORE&gt;</div>
    </h2>
    <ul>
       <?php foreach($topics as $row):?>
        <li><a href="<?php echo Yii::app()->createUrl('topic/view',array('id'=>$row->topic_id));?>" target='_blank'><img src="<?php echo $row->topic_ad;?>" alt="" /></a></li>
        <?php endforeach;?>
    </ul>
