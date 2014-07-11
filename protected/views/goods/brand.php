<div class="list_breadcrumbs wrap">
    <?php $this->widget('zii.widgets.CBreadcrumbs', array(
        'homeLink'=>'首页',
        'links'=>array(
            '服装',
            '女装'
        ),
    )); ?><!-- breadcrumbs -->
</div>
<div class="brand_intro_wrap wrap clear">
    <div class="list_lft">
        <div class="brand_intro_lft">
        <h2><?php echo $brand->brand_name; ?>/<?php echo $brand->brand_alia; ?></h2>
        <div class="brand_intro_logo"><img src="<?php echo $brand->getImageUrl().'/'.$brand->brand_logo; ?>" alt=""></div>
        </div>
    </div>
    <div class="list_rgt">
        <div class="brand_intro_rgt_wrap">
            <div class="brand_intro_rgt">
            <h2><?php echo $brand->brand_name; ?>/<?php echo $brand->brand_alia; ?>品牌故事</h2>
            <div class="brand_intro_text"><?php echo strip_tags($brand->brand_desc); ?></div>
            </div>
        </div>
    </div>
</div>
<div class="list_wrap wrap clear">
    <div class='list_lft'>
        <div class="cat_sort_list list_lft_panel">
            <h2>分类筛选</h2>
            <div class="cat_sort">
                <?php $this->widget('widget.goodsList.CategoryFilter',array('model'=>$model));?>
            </div>
        </div>
        <?php $this->widget('widget.goodsList.HotGoods'); ?>
        <?php $this->widget('widget.goodsList.SearchLookGoods'); ?>
    </div>
    <div class='list_rgt'>
        <?php $this->widget('widget.goodsList.GoodFilter',array('model'=>$model,'route'=>$this->route)); ?>
        <?php
        $this->widget('widget.goodsList.EListView', array(
            'dataProvider'=>$model->search(),
            'itemsTagName'=>'ul',
            'emptyText'=>'对不起,没有找到相关的商品',
            'summaryText'=>'共{count}个商品&nbsp;&nbsp;&nbsp;&nbsp;<b>第{page}页</b>',
            'ajaxUpdate'=>false,
            'htmlOptions'=>array('class'=>'list_goods_wrap'),
            'itemView'=>'_good',   // refers to the partial view named '_post'
            'template'=>"<div class='list_goods_bar'><div class='list_goods_sorter_pager'>{sorter}{miniPager}{summary}</div>".$this->widget('widget.goodsList.ListGoodFilter',array(),true)."</div>
            <div id='list_goods_items'>
            \n{items}\n
            </div>
            <div class='list_goods_pager'>{pager}</div>",
            'pager'=>array('header'=>'&nbsp','cssFile'=>false),
            'sorterCssClass'=>'list_goods_sorter',
            'sortableAttributes'=>array(
                'shop_price'=>'售价',
                'add_time'=>'添加时间',
                'sold_count'=>'销量',
            )
        ));
        ?>
    </div>
</div>