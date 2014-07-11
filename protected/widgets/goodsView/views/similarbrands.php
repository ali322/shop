<div class="list_lft_panel view_lft_brands">
    <h2>同类品牌</h2>
    <ul>
        <?php foreach($brands as $brand){ ?>
        <li><a href="<?php echo Yii::app()->createUrl('goods/brand',array('id'=>$brand->brand_id));?>" title='<?php echo $brand->brand_name;?>'><?php echo $brand->brand_name;?></a></li>
        <?php } ?>
    </ul>
</div>