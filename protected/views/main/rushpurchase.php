<div class="list_breadcrumbs wrap">
    <?php $this->widget('zii.widgets.CBreadcrumbs', array(
        'homeLink'=>'首页',
        'links'=>array(
            '限时抢购',
        ),
    )); ?><!-- breadcrumbs -->
</div>
<div class="rush_wrap wrap">
    <?php $this->widget('widget.rushPurchase.RushFilter',array('model'=>$model,'route'=>$this->route)); ?>
    <?php
    $this->widget('widget.goodsList.EListView', array(
        'dataProvider'=>$model->search(15),
        'itemsTagName'=>'ul',
        'emptyText'=>'对不起,没有找到相关的商品',
        'summaryText'=>'共{count}个商品&nbsp;&nbsp;&nbsp;&nbsp;<b>第{page}页</b>',
        'ajaxUpdate'=>false,
        'htmlOptions'=>array('class'=>'list_rush_wrap list_goods_wrap'),
        'itemView'=>'_rushGood',   // refers to the partial view named '_post'
        'template'=>"<div class='list_goods_bar'><div class='list_goods_sorter_pager list_rush_sorter_pager'>{sorter}{summary}</div><div class='list_goods_filter'>".$this->widget('widget.rushPurchase.ListRushFilter',array(),true)."{miniPager}</div></div>
            <div id='list_rush_items'>
            \n{items}\n
            </div>
            <div class='list_rush_pager list_goods_pager'>{pager}</div>",
        'pager'=>array('header'=>'&nbsp','cssFile'=>false,'pageSize'=>15),
        'sorterCssClass'=>'list_goods_sorter',
        'sortableAttributes'=>array(
            'shop_price'=>'售价',
            'add_time'=>'添加时间',
            'sold_count'=>'销量',
        )
    ));
    ?>
</div>