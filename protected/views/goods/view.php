<div class="list_breadcrumbs wrap">
    <?php $this->widget('zii.widgets.CBreadcrumbs', array(
        'homeLink'=>'首页',
        'links'=>array(
            '服装',
            '女装'
        ),
    )); ?><!-- breadcrumbs -->
</div>
<div class="list_wrap wrap clear">
    <div class='list_lft'>
        <?php $this->widget('widget.goodsView.SimilarBrands');?>
        <?php $this->widget('widget.goodsView.ViewHistory');?>
        <?php $this->widget('widget.goodsView.FinalBuy');?>
    </div>
    <div class="list_rgt">
        <div class="product clear">
            <div class="product_title">
                <h2><?php echo $good->good_name;?></h2>
            </div>
            <div class="product_gallery">
                <?php $this->widget('widget.goodsView.GoodsGallery',array('good'=>$good));?>
                <div class="product_gallery_bar">
                    <div class="share_product">
                        <span>分享到</span>sina
                    </div>
                    <div class="product_bigview">
                        <a href="<?php echo $this->createUrl('goods/bigview',array('id'=>$good->good_id));?>">查看大图</a>
                    </div>
                </div>
            </div>
            <div class="product_property">
                <p class='product_name'><label>品牌名:</label><?php echo $good->brand->brand_alia;?></p>
                <p class='product_sn'><label>商品编码:</label><?php echo $good->good_sn;?></p>
                <p class='product_market_price'><label>市场价:</label><del><?php echo $good->market_price;?></del></p>
                <?php
                    if($goodFavorables){
                    $this->widget('widget.goodsView.GoodPromotion',array('favorables'=>$goodFavorables,'good'=>$good));
                    }else{
                ?>
                <p class='product_shop_price'><label>折扣价:</label><i>&yen;</i><strong class='shop_price'><?php echo $good->shop_price;?></strong></p>
                <?php } ?>
                <p class="product_rank">
                    <label>商品评分:</label>
                    <span class="product_rank_value">
                        <b class="product_rank_value_5"></b>
                    </span>
                    <a href="">(已有433人评价)</a
                ></p>
                <p class="product_supplier">本商品由<a href="">友谊商城</a>提供</p>
                <div class="product_info">
                    <?php $this->renderPartial('_products',array(
                    'good'=>$good,
                    'goodSpecs'=>$goodSpecs,
                    'defaultProduct'=>$defaultProduct,
                   // 'rows'=>$rows
                    ))?>
                </div>
            </div>
        </div>
        <div class="product_detail">
            <?php $this->widget('widget.goodsView.MyTabView',array(
            'tabs'=>array(
                'tab1'=>array('title'=>'商品详情','content'=>$good->goodDetail->good_desc),
                'tab2'=>array('title'=>'规格参数','content'=>$this->renderPartial('_paramter',array('goodAttrs'=>$goodAttrs),true)),
                'tab3'=>array('title'=>'售后服务','content'=>$this->renderPartial('_saleservice',array(),true)),
                'tab4'=>array('title'=>'商品评价','content'=>$this->widget('widget.goodsView.GoodComments',array(),true)),
            ),
            'activeTab'=>'tab1',
            'cssFile'=>false
        ))?>
        </div>
    </div>
</div>