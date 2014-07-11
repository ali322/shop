<div class="collect_wrap profile_info">
    <h2>您收藏过的商品</h2>
    <div class="collect_list">
        <div class="collect_nav">
            <div class="collect_navbox clear" id='collect_nav'><b></b><b></b><b></b></div>
        </div>
        <div class="collect_items" id='collect_items'>
                <div class="collect_item">
                    <ul>
                    <?php foreach($goods as $k=>$good){ ?>
                       <li>
                          <div class='p_g_l_good_img'><a href=""><img src="<?php echo $good->goodDetail->getImageUrl().'/'.$good->goodDetail->good_img;?>" alt=""></a></div>
                          <div class='p_g_l_good_name'><a href=""><?php echo $good->good_name; ?></a></div>
                          <div class='p_g_l_good_price'>抢购价:<strong>￥<?php echo $good->shop_price; ?></strong></div>
                       </li>
                    <?php if($k%6==0 && $k>0 && $k<18){ ?>
                    </ul>
                    </div>
                    <div class="collect_item">
                    <ul>
                    <?php } ?>
                    <?php } ?>
                    </ul>
                </div>
        </div>
        <?php $this->widget('ext.omui.OmuiSlider',array(
        'sliderId'=>'collect_items',
        'navId'=>'div#collect_nav',
        'options'=>array(
            'effect'=>'slide-h',
            'directionNav'=>true,
            'directionNavHide'=>false,
            'interval'=>3000
        )
    ));?>
    </div>
</div>