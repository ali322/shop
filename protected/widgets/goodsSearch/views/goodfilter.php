<div class="list_filter search_list_filter">
    <div class="search_list_result">
        <h2><strong>搜索</strong>"<?php echo $queryKeyWord; ?>"<strong>找到<b><?php echo $queryCount; ?></b>件相关商品</strong></h2>
    </div>
    <dl>
        <dt>品牌：</dt>
        <dd>
            <span class='all'>
                <a href="<?php echo $brandArr['all'];?>"  class='<?php echo $brandArr['showAll']?'curr':'';?>'>全部</a>
            </span>
            <span class='brand_selections selections'>
            <?php
            foreach($brandArr['list'] as $key=>$row){
            if($key<21){
            ?>
            <a href="<?php echo $row['brandLink'];?>" class="<?php echo $row['currBrand']?'curr':'';?>"><b><?php echo $row['brandName'];?></b></a>
            <?php }else{ ?>
            <a href="<?php echo $row['brandLink'];?>" class='brand_more <?php echo $row['currBrand']?'curr':'';?>' style='display:none;'><b><?php echo $row['brandName'];?></b></a>
            <?php }}?>
            <div class="more_brand_btn">
                <a class='expand' href="javascript:void(0)">更多</a>
                <a class='fold' style='display:none' href="javascript:void(0)">收起</a>
            </div>
        </span>
        </dd>
    </dl>
    <?php $attrCounts=0;foreach($attrsArr as $attrName=>$attrValues){ $attrCounts++?>
    <dl class="<?php echo $attrCounts>2?'attr_more':'';?>" style="<?php echo $attrCounts>2?'display:none;':'';?>">
        <dt><?php echo $attrName;?>：</dt>
        <dd>
            <span class='all'>
                <a href="<?php echo $attrValues['all'];?>" class='<?php echo $attrValues['showAll']?'curr':'';?>'>全部</a>
            </span>
            <span class='selections'>
            <?php foreach($attrValues['list'] as $attrValue){ ?>
            <a href="<?php echo $attrValue['attrLink'];?>" class="<?php echo $attrValue['currAttr']?'curr':'';?>"><?php echo $attrValue['attrValue'];?></a>
            <?php }?>
            </span>
        </dd>
    </dl>
    <?php }?>
    <dl>
        <dt>价格：</dt>
        <dd>
            <span class='all'>
                <a href="<?php echo $priceArr['all'];?>" class='<?php echo $priceArr['showAll']?'curr':'';?>'>全部</a>
            </span>
            <span class='selections'>
            <?php foreach($priceArr['list'] as $row){ ?>
            <?php echo CHtml::link("{$row['secRange'][0]}-{$row['secRange'][1]}元",$row['secLink'],array('class'=>$row['currSec']?'curr':''));?>
            <?php }?>
            </span>
            <span class="enter_price">
                <div class="enter_price_input">
                <input type="text" name='price_filter_min' class='price_filter'>-<input type="text" name='price_filter_max' class='price_filter'>
                </div>
                <a href="javascript:void(0)" class='price_filter_submit'>确定</a>
            </span>
        </dd>
    </dl>
</div>
<div class="filter_more">
    <p class='filter_more_bg'></p>
    <p class='expand'><span>更多筛选属性</span></p>
    <p class='fold' style='display:none;'><span>收起</span></p>
</div>
<?php Yii::app()->clientScript->registerScript('list_filter',"
    $('.expand span').click(function(){
        $(this).parent().parent().prev().find('.attr_more').show();
        $(this).parent().hide().next().show();
    });
    $('.fold span').click(function(){
        $(this).parent().parent().prev().find('.attr_more').hide();
        $(this).parent().hide().prev().show();
    });
    $('.more_brand_btn .expand').click(function(){
        $(this).parent().siblings('.brand_more').show();
        $(this).hide().next().show();
    });
    $('.more_brand_btn .fold').click(function(){
        $(this).parent().siblings('.brand_more').hide();
        $(this).hide().prev().show();
    });
",CClientScript::POS_END);?>