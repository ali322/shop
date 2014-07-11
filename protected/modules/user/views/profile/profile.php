<?php $this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Profile");?>
<?php if(Yii::app()->user->hasFlash('profileMessage')): ?>
<div class="success">
<?php echo Yii::app()->user->getFlash('profileMessage'); ?>
</div>
<?php endif; ?>
<div class="profile_info clear">
<span class="info_avatar">
     <?php if(Yii::app()->user->getState('oauth_type') == null){?>
      <a href='' target='_blank'><img class='info_head' src="<?php echo Yii::app()->request->baseUrl.'/images/temp/user_avatar.jpg';?>" alt="" /></a>
      <?php }else{?>
      <a href='' target='_blank'><img class='info_head' src="<?php echo Yii::app()->user->getState('oauth_avatar');?>" alt="" /></a>
      <?php }?>
</span>
<span class='info_content'>
<p class="info_username">您好,&nbsp;
<?php if(Yii::app()->user->getState('oauth_type') == null){?>
       <?php echo CHtml::encode($model->username); ?>
<?php }else{?>
       <?php echo CHtml::encode(Yii::app()->user->name); ?>
<?php }?>,&nbsp;欢迎光临友谊阿波罗网上商城
<span class="last_visit">最后一次访问时间:2011年11月30日</span>
</p>
<dl class="info_rank clear">
    <dd class='rank_name'><a href="">注册用户</a></dd>
    <dd class='rank_notify'>目前已消费<b>￥0</b>，消费满<b>￥100</b>后自动升级为铁牌会员</dd>
    <dd class='rank_close'></dd>
</dl>
<?php Yii::app()->clientScript->registerScript('rank_toggle',"
    $('.rank_close').click(function(){
        $(this).toggleClass('rank_open');
        $(this).prev().toggleClass('unvisible');
        $(this).parent().toggleClass('rank_minify');
    });
",CClientScript::POS_END); ?>
<ul class="info_detail clear">
    <li>等待付款订单(<b>1</b>)</li>
    <li>等待收货订单(<b>1</b>)</li>
    <li>等待评价商品(<b>1</b>)</li>
    <li>账户余额:<em>￥0</em></li>
    <li>可用金额:<em>￥0</em></li>
    <li>我的积分:25</li>
    <li>我的咨询(<b>1</b>)</li>
</ul>
</span>
</div>
<?php $this->widget('user.widgets.userProfile.CollectGoods');?>
<?php $this->widget('user.widgets.userProfile.RecentOrders'); ?>
<p class='info_detail_more'><a href="<?php echo Yii::app()->createUrl('user/order');?>" target="_blank">查看全部订单&gt;</a></p>
<div class="h_c_rgt_ads">
</div>