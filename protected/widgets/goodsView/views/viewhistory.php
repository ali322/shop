<div class="list_hot_goods list_lft_panel">
    <h2>浏览过的商品</h2>
    <div class="l_h_goods">
        <ul>
            <?php foreach($goods as $good){ ?>
            <li class='clear'>
                <div class="l_h_good_lft">
                    <a href="<?php echo Yii::app()->createUrl('goods/view',array('id'=>$good->good_id));?>">
                        <img src="<?php echo $good->goodDetail->getImageUrl().'/'.$good->goodDetail->good_img;?>" alt="">
                    </a>
                </div>
                <div class="l_h_good_rgt">
                    <p class='l_h_good_name'><?php echo $good->good_name;?></p>
                    <p class='l_h_good_price'>￥<?php echo $good->shop_price;?></p>
                </div>
            </li>
            <?php } ?>
        </ul>
    </div>
</div>