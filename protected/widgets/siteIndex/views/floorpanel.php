<?php foreach($floorArr as $k=>$floor){ ?>
<div class="floor clear">
    <div class="floor_lft floor_column">
        <div class="floor_name">
            <strong><?php echo ++$k; ?>F</strong><a href=""><?php echo $floor['floorName']; ?></a>
        </div>
        <div class="floor_categorys clear">
            <?php foreach($floor['floorCat'] as $topCat){?>
            <dl>
                <dt><a href="javascript:void(0)"><?php echo $topCat['text']; ?></a></dt>
                <?php foreach($topCat['children'] as $subCat){ ?>
                <dd><a href="<?php echo Yii::app()->createUrl('goods/list',array('cat_id'=>$subCat['id']));?>" title='<?php echo $subCat['text'];?>'><?php echo $subCat['text']; ?></a></dd>
                <?php } ?>
            </dl>
            <?php }?>
        </div>
        <div class="floor_ad">
            <img src="<?php echo Yii::app()->request->baseUrl;?>/images/ad/floor_ad.jpg" alt="">
        </div>
    </div>
    <div class="floor_center floor_column">
        <div class="floor_nav">
            <ul class='clear'>
                <?php foreach($floor['floorContent'] as $k=>$floorContent){ ?>
                <li class='<?php echo $k==0?'curr':''; ?>'><?php echo $floorContent['navName']; ?></li>
                <?php } ?>
                <li class='<?php echo ++$k==count($floor['floorContent'])?'last':'';?>'>精品男装</li>
            </ul>
        </div>
        <div class="floor_contents">
            <?php foreach($floor['floorContent'] as $k=>$floorContent){ ?>
            <div class="floor_content">
            <?php if(isset($floorContent['tpl'])){ ?>
            <?php $this->owner->renderPartial($floorContent['tpl']); ?>
            <?php } ?>
            <?php if(isset($floorContent['navItems'])){ ?>
                <ul class='floor_goods clear'>
                    <?php foreach($floorContent['navItems'] as $good){?>
                    <li>
                        <div class='floor_good_img l_l_g_img'>
                            <a href="<?php echo Yii::app()->createUrl('goods/view',array('id'=>$good->good_id));?>" target="_blank"><img src="<?php echo $good->goodDetail->getImageUrl().'/'.$good->goodDetail->good_img;?>" alt=""></a>
                        </div>
                        <div class='floor_good_name l_l_g_name'><a href=""><?php echo $good->good_name; ?></a></div>
                        <div class='floor_good_price l_l_g_price'>折扣价:<strong>￥<?php echo $good->shop_price; ?></strong></div>
                    </li>
                    <?php } ?>
                </ul>
            <?php } ?>
            </div>
            <?php } ?>
        </div>
    </div>
    <div class="floor_rgt floor_column">
        <div class="floor_brands">
            <h2>推荐品牌</h2>
            <div class="floor_brands_loop">
                <ul class='clear'>
                <?php foreach($floor['floorBrand'] as $brandId=>$brand){?>
                <li>
                    <a class='brand_logo' href="<?php echo Yii::app()->createUrl('goods/brand',array('id'=>$brandId));?>" target="_blank"><img src="<?php echo $brand->getImageUrl().'/'.$brand->brand_logo;?>" alt=""></a>
                </li>
                <?php } ?>
                </ul>
            </div>
        </div>
        <div class="floor_topics">
            <h2>推荐活动</h2>
            <ul>
                <li><a href="">运动户外“疯狂团购”天天送惊喜！</a></li>
                <li><a href="">运动户外“疯狂团购”天天送惊喜！</a></li>
                <li><a href="">运动户外“疯狂团购”天天送惊喜！</a></li>
            </ul>
            <div class="floor_topic_ad">
                <a href=""><img src="<?php echo Yii::app()->request->baseUrl;?>/images/temp/floor_topic_ad.jpg" alt=""></a>
            </div>
        </div>
    </div>
</div>
<?php } ?>
<?php Yii::app()->clientScript->registerScript('floor_panel',"
    $('.floor_pieces').find('a').mouseover(function(){
        $(this).find('.floor_piece_mask').hide().parent().siblings().find('.floor_piece_mask').show();
    }).parent().mouseleave(function(){
        $(this).find('.floor_piece_mask').hide();
    });
    $('.floor_nav ul li').mouseenter(function(){
        var tabIndex=$(this).index();
        $(this).addClass('curr').siblings().removeClass('curr');
        $('.floor_content').eq(tabIndex).show().siblings().hide();
    });
",CClientScript::POS_END);?>

