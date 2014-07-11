<ul class="top_category">
    <?php foreach($catArr as $catId=>$row){ ?>
    <li class='<?php echo array_slice(array_keys($catArr),0,1)==array($catId)?'curr':''; ?>'>
        <a href="#brand_<?php echo $catId;?>"><?php echo $row['catName']; ?></a>
    </li>
    <?php } ?>
</ul>
<?php foreach($catArr as $catId=>$row){ ?>
<div class="brand_logo_list brand_list" id='brand_<?php echo $catId;?>'>
    <h2><?php echo $row['catName']; ?></h2>
    <ul>
        <?php foreach($row['brands'] as $brandId=>$brand){ ?>
        <li>
            <div class="brand_list_item">
            <a href="<?php echo Yii::app()->createUrl('goods/brand',array('id'=>$brandId));?>" target="_blank">
                <img src="<?php echo $brand->getImageUrl().'/'.$brand->brand_logo; ?>" alt="" />
            </a>
            <p><?php echo $brand->brand_name; ?></p>
            </div>
        </li>
        <?php }?>
    </ul>
</div>
<?php } ?>
<!--div class="brand_text_list brand_list">
    <h2>更多品牌</h2>
    <ul>
        <li>
            <a href="">测试品牌</a>
        </li>
    </ul>
</div-->