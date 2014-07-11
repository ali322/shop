<div class="channel_wrap wrap clear">
    <div class="channel_lft">
        <div class="channel_category">
            <h2><?php echo $channel->channel_name; ?></h2>
            <ul>
                <?php foreach($channelCategory as $row){
                      foreach($row as $v){  ?>
                <li>
                    <h3><?php echo $v['text'];?></h3>
                    <div class="channel_category_box">
                        <?php foreach($v['children'] as $item):?>
                        <a href="<?php echo $item['href'];?>" title='<?php echo $item['text']; ?>'><?php echo $item['text']; ?></a>
                        <?php endforeach;?>
                    </div>
                </li>
                <?php }} ?>
            </ul>
        </div>
        <div class="channel_brand">
            <h2>推荐品牌</h2>
            <dl>
                <?php foreach($recommendedBrands as $recommendedBrand){ ?>
                <dd><a href="<?php echo Yii::app()->createUrl('goods/brand',array('id'=>$recommendedBrand->brand_id));?>" target="_blank">
                    <img src="<?php echo $recommendedBrand->getImageUrl().'/'.$recommendedBrand->brand_logo;?>" alt=""></a>
                </dd>
                <?php }?>
            </dl>
        </div>
        <div class="channel_hot list_hot_goods list_lft_panel">
            <h2>本周热销商品</h2>
            <div class="l_h_goods">
            <ul>
                <?php foreach($hotGoods as $k=>$good){ ?>
                <li class='clear'>
                    <div class="l_h_good_lft">
                        <a href=""><img src="<?php echo $good->goodDetail->getImageUrl().'/'.$good->goodDetail->good_img;?>" alt=""></a>
                        <sup class='<?php echo ++$k>3?'gray':'';?>'><?php echo $k; ?></sup>
                    </div>
                    <div class="l_h_good_rgt">
                        <p class='l_h_good_name'><?php echo $good->good_name; ?></p>
                        <p class='l_h_good_price'>￥<?php echo $good->shop_price;?></p>
                    </div>
                </li>
                <?php } ?>
            </ul>
            </div>
        </div>
    </div>
    <div class="channel_rgt">
        <div class='wrap first_panel channel_slider'>
            <div class="slider_wrap">
                <?php $this->widget('widget.siteIndex.SliderAd'); ?>
            </div>
            <div class="f_p_rgt">
                <!--频道抢购开始-->
                <?php $this->widget('widget.channel.PromotionList',array('goods'=>$promotionGoods)); ?>
                <!--频道抢购结束-->
            </div>
        </div>
        <?php $this->widget('widget.channel.ChannelList',array('channel'=>$channel));?>
    </div>
</div>