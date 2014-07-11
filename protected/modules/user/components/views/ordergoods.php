<?php echo CHtml::openTag('table',array('class'=>'cart_list','border'=>0,'celspacing'=>0,'celpadding'=>0));?>
<tr>
    <th class='cart_row_p'>商品名称</th>
    <th>单价</th>
    <th>数量</th>
    
    <?php if($operation):?>
    <th>总价</th>
    <th class='cart_row_n'>操作</th>
    <?php else: ?>
    <th class='cart_row_n'>总价</th>
    <?php endif;?>
</tr>
<?php foreach ($cart as $row):?>
<tr>
    <td class='cart_row_p'>
        <?php if($show_thumb){?><span><a href="<?php echo Yii::app()->createUrl('webshop/goods/view',array('id'=>$row['good_id']))?>" target='_blank'><img src="<?php echo $row['good_thumb'];?>" alt="" /></a></span><?php }?>
        <span><a href="<?php echo Yii::app()->createUrl('webshop/goods/view',array('id'=>$row['good_id']))?>" target='_blank'><?php echo $row['good_name'];?></a><br /><small>颜色:<?php echo $row['good_color'];?></small><small>尺码:<?php echo $row['good_weight'];?></small></span>
    </td>
    <td><?php echo $row['shop_price'];?></td>
    <td><?php echo $row['good_number'];?></td>
    
    <?php if($operation):?>
    <td><?php echo $row['good_amount'];?></td>
    <td class='cart_row_n'><span><a href="">加入收藏</a></span><span><a href="">删除</a></span></td>
    <?php else: ?>
    <td class='cart_row_n'><?php echo $row['good_amount'];?></td>
    <?php endif;?>
</tr>
<?php endforeach;?>
<?php echo CHtml::closeTag('table');?>