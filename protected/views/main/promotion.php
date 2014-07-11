<div class="list_breadcrumbs wrap">
    <?php $this->widget('zii.widgets.CBreadcrumbs', array(
        'homeLink'=>'首页',
        'links'=>array(
            '服装',
            '女装'
        ),
    )); ?><!-- breadcrumbs -->
</div>
<div class="promotion_slider_wrap wrap clear">
    <div class="promotion_slider_wrap_lft">
        <div class="hot_promotion">
            <h2>最新活动</h2>
            <ul>
                <?php foreach($newActs as $newAct){ ?>
                <li>
                    <a href="<?php echo Yii::app()->createUrl('main/actView',array('id'=>$newAct->act_id));?>" title='<?php echo $newAct->act_name;?>' target='_blank'><img src="<?php echo $newAct->getImageUrl().'/'.$newAct->act_ad; ?>" alt=""></a>
                </li>
                <?php } ?>
            </ul>
        </div>
        <div class="subscribe_promotion">
            <h2>订阅促销信息</h2>
            <div class="subscribe_promotion_box">
                <input type="text" class='text' value='请输入您的Email地址' onblur="if(this.value==''){this.value='请输入您的Email地址';this.style.color='#999'}" onfocus="if(this.value=='请输入您的Email地址'){this.value='';this.style.color='#333'};$('#subscription-prompt').hide()" />
                <button type='button'>订阅</button>
            </div>
        </div>
    </div>
    <div class="promotion_slider_wrap_rgt">
        <div class="promotion_list_wrap">
            <div class="promotion_list_title">
                <span><b></b></span>
                <ul>
                    <li class='curr'><a href="">男装</a></li>
                    <li><a href="">女装</a></li>
                    <li><a href="">皮鞋皮具</a></li>
                </ul>
                <?php Yii::app()->clientScript->registerScript('promotion_list_tabs',"
                    $('.promotion_list_title ul li').mouseover(function(){
                        $(this).addClass('curr').siblings().removeClass('curr');
                    });
                ",CClientScript::POS_END);?>
            </div>
            <div class="promotion_lists">
                <?php
                $this->widget('widget.goodsList.EListView', array(
                    'dataProvider'=>$model->search(),
                    'itemsTagName'=>'ul',
                    'emptyText'=>'对不起,没有找到相关的活动',
                    'ajaxUpdate'=>false,
                    'htmlOptions'=>array('class'=>'list_promotion_wrap'),
                    'itemView'=>'_promotion',   // refers to the partial view named '_post'
                    'template'=>"<div id='list_promotion_items'>\n{items}\n</div><div class='list_goods_pager list_promotion_pager'>{pager}</div>",
                    'pager'=>array('header'=>'&nbsp','cssFile'=>false),
                ));
                ?>
            </div>
        </div>
    </div>
</div>