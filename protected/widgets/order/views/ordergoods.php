<div class="cart_table order_goods_table">
<table border="0" cellpadding="0" cellspacing="0">
    <thead>
    <tr>
        <th width='600'>商品名称</th>
        <th width='120'>单价</th>
        <th width='100'>数量</th>
        <th width='100'>优惠</th>
        <th width='150'>小计</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($goodInfo as $row){ ?>
    <tr>
        <td class='cart_good_info'>
            <span class='cart_good_thumb'>
                <a href="<?php echo Yii::app()->createUrl('goods/view',array('id'=>$row['good_id']));?>">
                    <img src="<?php echo $row['goodImageUrl'].'/'.$row['good_thumb'];?>" alt="">
                </a>
            </span>
            <span class='cart_good_name'>
                <p><a href=""><?php echo $row['good_name'];?></a></p>
                <p>
                    <?php foreach($row['good_specs'] as $v){?>
                    <small><?php echo $v;?></small>
                    <?php }?>
                </p>
            </span>
        </td>
        <td class='cart_good_price'>¥<?php echo $row['shop_price'];?></td>
        <td>
            <div class="cart_number"><?php echo $row['buy_number'];?></div>
        </td>
        <td class='cart_good_price'>-</td>
        <td class='cart_good_price'>¥<?php echo $row['good_amount'];?></td>
    </tr>
    <?php } ?>
    </tbody>
</table>
</div>