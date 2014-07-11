<li>
    <div class="p_g_l_good_timer rush_good_timer">剩余<b>01</b>小时<b>03</b>分<b>40</b>秒</div>
    <p class='l_good_pic'>
        <a href="<?php echo Yii::app()->createUrl('goods/view',array('id'=>$data->good_id));?>" class='l_good_img' target="_blank"><img src="<?php echo $data->goodDetail->getImageUrl().'/'.$data->goodDetail->good_img;?>" alt=""></a>
    </p>
    <p class='l_good_name'><a href="<?php echo $this->createUrl('goods/view',array('id'=>$data->good_id));?>"  target="_blank"><?php echo $data->good_name;?></a></p>
    <p class='l_good_price'>原价:<strong>￥<?php echo $data->shop_price;?></strong></p>
    <p class='l_good_price l_rush_price'>抢购价:<strong>￥<?php echo $data->shop_price;?></strong></p>
</li>