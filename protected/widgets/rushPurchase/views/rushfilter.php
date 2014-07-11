<div class="rush_filter list_filter">
    <dl>
        <dt>全部分类:</dt>
        <dd>
            <span class='all'>
                <a href="<?php echo $brandArr['all'];?>"  class='<?php echo $brandArr['showAll']?'curr':'';?>'>全部</a>
            </span>
            <span class='brand_selections selections'>
            <?php
            foreach($brandArr['list'] as $key=>$row){
            ?>
            <a href="<?php echo $row['brandLink'];?>" class="<?php echo $row['currBrand']?'curr':'';?>"><b><?php echo $row['brandName'];?></b></a>
            <?php } ?>
            </span>
        </dd>
    </dl>
    <dl class='last'>
        <dt>状态:</dt>
        <dd>
            <span class='all'><a href=""  class='curr'>全部</a></span><span class='selections'>
            <a href="">抢购中</a>
            <a href="">即将上线</a>
            </span>
        </dd>
    </dl>
</div>