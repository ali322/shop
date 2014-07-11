<div class="list_breadcrumbs wrap">
    <?php $this->widget('zii.widgets.CBreadcrumbs', array(
        'homeLink'=>'首页',
        'links'=>array(
            '服装',
            '女装'
        ),
    )); ?><!-- breadcrumbs -->
</div>
<div class="credits_intro_wrap wrap clear">
    <div class="list_lft">
        <div class="credits_intro_lft list_lft_panel">
            <h2>
                <button>查看我能兑换的商品</button>
            </h2>
            <div class="credits_number"><p>我的积分</p><b>1</b></div>
            <div class="get_more_credits"><a href="">去购物获取更多积分&gt;</a></div>
        </div>
    </div>
    <div class="list_rgt">
        <div class="credits_intro_rgt_wrap">
            <div class="credits_ad"><img src="<?php echo Yii::app()->request->baseUrl;?>/images/ad/credits_ad.jpg" alt=""></div>
            <div class="credits_announcement">
                <h2>积分兑换公告</h2>
                <ul>
                    <li><a href="">积分常见问题解答</a></li>
                    <li><a href="">积分常见问题解答</a></li>
                    <li><a href="">积分常见问题解答</a></li>
                    <li><a href="">积分常见问题解答</a></li>
                    <li><a href="">积分常见问题解答</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="list_wrap wrap clear">
    <div class='list_lft'>
        <?php $this->widget('widget.credits.CategoryFilter',array('model'=>$model)); ?>
        <?php $this->widget('widget.credits.HotGoods'); ?>
    </div>
    <div class='list_rgt'>
        <?php
        $this->widget('widget.goodsList.EListView', array(
            'dataProvider'=>$model->search(),
            'itemsTagName'=>'ul',
            'emptyText'=>'对不起,没有找到相关的商品',
            'summaryText'=>'共{count}个商品&nbsp;&nbsp;&nbsp;&nbsp;<b>第{page}页</b>',
            'ajaxUpdate'=>false,
            'htmlOptions'=>array('class'=>'list_goods_wrap list_credits_goods_wrap'),
            'itemView'=>'_credit',   // refers to the partial view named '_post'
            'template'=>"<div class='list_goods_bar'><div class='list_goods_sorter_pager'>{sorter}{miniPager}{summary}</div>".$this->widget('widget.credits.ListCreditsFilter',array(),true)."</div>
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