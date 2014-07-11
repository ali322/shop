<div class="group_goods_list">
    <?php foreach($recommendedList as $k=>$row){?>
    <div class="list_loop <?php if($k===0) echo 'curr'; ?>">
        <h2 style='left:<?php echo $k*200; ?>px;'><?php echo $row['listName']; ?></h2>
        <div class="list_loop_goods_wrap">
            <ul>
                <?php foreach($row['listItems'] as $good){?>
                <li>
                    <div class='l_l_g_img'>
                        <a href="<?php echo Yii::app()->createUrl('goods/view',array('id'=>$good->good_id));?>" target="_blank"><img src="<?php echo $good->goodDetail->getImageUrl().'/'.$good->goodDetail->good_img;?>" alt=""></a>
                    </div>
                    <div class='l_l_g_name'><a href="<?php echo Yii::app()->createUrl('goods/view',array('id'=>$good->good_id));?>" target="_blank"><?php echo $good->good_name; ?></a></div>
                    <div class='l_l_g_price'>折扣价:<strong>￥<?php echo $good->shop_price; ?></strong></div>
                </li>
                <?php } ?>
            </ul>
        </div>
    </div>
    <?php } ?>
</div>
<?php Yii::app()->clientScript->registerScript('group_goods_list',"
    $('.list_loop h2').mouseenter(function(){
        $(this).parent().addClass('curr').siblings().removeClass('curr');
    });
",CClientScript::POS_END); ?>