<div class="p_g_l_title clear">
    <h2>限时抢购</h2>
    <span><a href="">更多</a></span>
</div>
<div class="p_g_l_goods_wrap">
    <a href="javascript:void(0)" class="p_g_l_goods_nav p_g_l_goods_lft"></a>
    <a href='javascript:void(0)' class="p_g_l_goods_nav p_g_l_goods_rgt"></a>
<ul class='clear curr'>
    <?php
    foreach($goods as $key=>$good){
        if($key%5==0 &&$key>=5){
            ?>
                </ul><ul>
                <?php }?>
        <li>
            <div class="p_g_l_good">
                <div class="p_g_l_good_timer">剩余<b>01</b>小时<b>03</b>分<b>40</b>秒</div>
                <div class='p_g_l_good_img'>
                    <a href="<?php echo Yii::app()->createUrl('goods/view',array('id'=>$good->good_id));?>" target="_blank">
                    <img src="<?php echo $good->goodDetail->getImageUrl().'/'.$good->goodDetail->good_img;?>" alt="">
                    </a>
                </div>
                <div class='p_g_l_good_name'>
                    <a href="<?php echo Yii::app()->createUrl('goods/view',array('id'=>$good->good_id));?>" target="_blank"><?php echo $good->good_name; ?></a>
                </div>
                <div class='p_g_l_good_price'>抢购价:<strong>￥<?php echo $good->shop_price; ?></strong></div>
            </div>
        </li>
        <?php } ?>
</ul>
</div>
<?php Yii::app()->clientScript->registerScript('promote_goods_list',"
    $('.p_g_l_goods_lft').click(function(){
        var num=$('.p_g_l_goods_wrap ul').length;
        var cur=$('.p_g_l_goods_wrap ul').index($('.curr'));
        if(cur<=num-1 && cur>0)
            $('.p_g_l_goods_wrap ul.curr').removeClass('curr').prev('ul').addClass('curr');
        else
            return false;
    });
    $('.p_g_l_goods_rgt').click(function(){
        var num=$('.p_g_l_goods_wrap ul').length;
        var cur=$('.p_g_l_goods_wrap ul').index($('.curr'));
        if(cur<num-1){
            $('.p_g_l_goods_wrap ul.curr').removeClass('curr').next('ul').addClass('curr');
        }else
            return false;
    });
",CClientScript::POS_END);?>