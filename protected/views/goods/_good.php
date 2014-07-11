<li>
    <p class='l_good_pic'>
        <a href="<?php echo Yii::app()->createUrl('goods/view',array('id'=>$data->good_id));?>" class='l_good_img' target="_blank"><img src="<?php echo $data->goodDetail->getImageUrl().'/'.$data->goodDetail->good_img;?>" alt=""></a>
    </p>
    <p class='l_good_name'><a href="<?php echo $this->createUrl('goods/view',array('id'=>$data->good_id));?>"  target="_blank"><?php echo $data->good_name;?></a></p>
    <p class='l_good_price'>折扣价:<strong>￥<?php echo $data->shop_price;?></strong></p>
    <p class='l_good_btn'>
        <span class='good_cart'><a href="<?php echo $this->createUrl('goods/view',array('id'=>$data->good_id));?>">购买</a></span>
        <span class='good_collect'><a href="">收藏</a></span>
    </p>
</li>