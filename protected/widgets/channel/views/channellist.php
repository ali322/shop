<?php foreach($goodTopics as $goodTopic){ ?>
<div class="channel_list_wrap">
    <div class="channel_list_title clear">
        <h2><?php echo $goodTopic['topicName']; ?></h2><b></b>
    </div>
    <div class="channel_list clear">
        <div class="channel_list_lft floor_content">
            <ul class='floor_goods clear'>
                <?php foreach($goodTopic['topicGoods'] as $good){?>
                <li>
                    <div class='floor_good_img l_l_g_img'>
                        <a href="<?php echo Yii::app()->createUrl('goods/view',array('id'=>$good->good_id));?>" target="_blank">
                        <img src="<?php echo $good->goodDetail->getImageUrl().'/'.$good->goodDetail->good_img;?>" alt="">
                        </a>
                    </div>
                    <div class='floor_good_name l_l_g_name'><a href=""><?php echo $good->good_name; ?></a></div>
                    <div class='floor_good_price l_l_g_price'>折扣价:<strong>￥<?php echo $good->shop_price;?></strong></div>
                </li>
                <?php } ?>
            </ul>
        </div>
        <div class="channel_list_rgt">
            <a href=""><img src="<?php echo $goodTopic['topicAd'];?>" alt=""></a>
        </div>
    </div>
</div>
<?php } ?>