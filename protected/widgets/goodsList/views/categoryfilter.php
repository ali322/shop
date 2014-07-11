<?php
// $this->widget('CTreeView',array('data'=>$cat_arr,'cssFile'=>null));
?>
<?php foreach($cat_arr as $row){ ?>
<dl class='<?php echo $row['children']?'expand':'';?>'>
    <dt><?php echo $row['text']; ?><b></b></dt>
    <dd>
        <ul>
            <?php foreach($row['children'] as $k=>$v){ ?>
            <li><a href="<?php echo Yii::app()->createUrl('goods/list',array('cat_id'=>$v['id']));?>" title='<?php echo $v['text']; ?>' target="_blank"><?php echo $v['text']; ?></a></li>
            <?php }?>
        </ul>
    </dd>
</dl>
<?php } ?>