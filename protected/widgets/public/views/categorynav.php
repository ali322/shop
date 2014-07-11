<h2 class='category_bar_title'><a href="<?php echo Yii::app()->createUrl('main/allCategory');?>">所有商品分类</a></h2>
<div class="category_droplist">
<ul class='category_items'>
    <?php foreach($lftCate as $channel):?>
    <li>
        <a  class="category_item_name" href="<?php echo Yii::app()->createUrl('main/channel',array('id'=>$channel['channelId']));?>" target="_blank"><?php echo $channel['channelName'];?></a>
        <div class="category_sub_items">
            <div class="c_s_i_lft">
            <?php foreach($channel['category'] as $row){
                foreach($row as $v){
            ?>
            <dl>
                <dt><a href="<?php echo $v['href'];?>"><?php echo $v['text'];?></a></dt>
                <?php foreach($v['children'] as $item):?>
                <dd><a href="<?php echo $item['href'];?>"><?php echo $item['text']; ?></a></dd>
                <?php endforeach;?>
            </dl>
            <?php }} ?>
            </div>
            <div class="c_s_i_rgt">
                <div class="c_s_i_rgt_recommended_acts">
                    <h3>推荐活动</h3>
                    <a href=""><img src="<?php echo Yii::app()->request->baseUrl;?>/images/temp/c_s_i_rgt_recommend.jpg" alt=""></a>
                </div>
                <div class="c_s_i_rgt_recommend_brands">
                <h3>推荐品牌</h3>
                <ul>
                    <?php foreach($channel['recommendedBrands'] as $brand){ ?>
                    <li>
                        <a href="<?php echo Yii::app()->createUrl('goods/list',array('brand_id'=>$brand->brand_id));?>"><?php echo $brand->brand_name; ?></a>
                    </li>
                    <?php } ?>
                </ul>
                </div>
                <span class="close_category_sub_items">关闭</span>
            </div>
        </div>
    </li>
    <?php endforeach;?>
</ul>
</div>
<?php
Yii::app()->clientScript->registerScript("categorynav","
    $('.category_items li').mouseover(function(){
        $(this).addClass('item_on').siblings().removeClass('item_on');
        $(this).find('.category_sub_items').show();
    }).mouseleave(function(){
        $(this).find('.category_sub_items').hide();
        $(this).removeClass('item_on');
    });
    $('.close_category_sub_items').click(function(){
        $(this).parent().parent().parent().trigger('mouseleave');
    });
    $('.c_s_i_lft dl').mouseenter(function(){
        $(this).css('background','#FFF9E6');
    }).mouseleave(function(){
        $(this).css('background','#FFF');
    });
");
?>