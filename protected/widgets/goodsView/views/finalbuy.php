<div class="list_searchlook_goods list_searchbuy_goods list_lft_panel">
    <h2>浏览此商品的用户最终购买</h2>
    <ul>
        <?php foreach($goods as $good){ ?>
        <li>
            <div class='list_searchlook_good_pic'>
                <a href="<?php echo Yii::app()->createUrl('goods/view',array('id'=>$good->good_id));?>">
                    <img src="<?php echo $good->goodDetail->getImageUrl().'/'.$good->goodDetail->good_img;?>" alt="">
                </a>
            </div>
            <p class='list_searchlook_good_name'><?php echo $good->good_name;?></p>
            <p class='list_searchlook_good_price'>￥<?php echo $good->shop_price;?></p>
        </li>
        <?php } ?>
    </ul>
</div>