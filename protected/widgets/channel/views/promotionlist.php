<div class="channel_promotion">
    <h2><div class="channel_promotion_icon"></div><b>限时抢购</b><span>更多&gt;</span></h2>
    <ul>
        <?php foreach($goods as $good){ ?>
        <li>
            <div class="simple">
                <a href="<?php echo Yii::app()->createUrl('goods/view',array('id'=>$good->good_id));?>" target="_blank"><?php echo $good->good_name; ?></a>
                <span>原价:¥<?php echo $good->market_price; ?><b>抢购价:¥<?php echo $good->shop_price; ?></b></span>
            </div>
        </li>
        <?php }?>
    </ul>
</div>