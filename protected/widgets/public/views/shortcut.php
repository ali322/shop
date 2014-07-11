<div class="top_bar">
    <div class="wrap">
        <ul class='top_bar_lft top_bar_ul'>
            <li><a href="">收藏本站</a></li>
            <li><a href="">官方微博</a></li>
        </ul>
        <ul class='top_bar_rgt top_bar_ul'>
            <li class='top_bar_li login_info'>
                <?php if(Yii::app()->user->isGuest){?>
                您好，欢迎来到友谊阿波罗网上商城！<span><a href="<?php echo Yii::app()->createUrl('user/login');?>">[登录]</a> <a class="link-regist" href="<?php echo Yii::app()->createUrl('user/registration');?>">[免费注册]</a></span>
                <?php }else{ ?>
                <a href="<?php echo Yii::app()->createUrl('user/profile');?>"><?php echo mb_substr(Yii::app()->user->name,0,20);?></a>您好，欢迎来到友谊阿波罗网上商城！<span><a href="<?php echo Yii::app()->createUrl('user/logout');?>">[注销]</a></span>
                <?php }?>
            </li>
            <li class='top_bar_li'><a href="<?php echo Yii::app()->createUrl('user/order');?>"  target='_blank'>我的订单</a></li>
            <li class='top_bar_li t_b_u_droplist'>
                <a href="<?php echo Yii::app()->createUrl('user/profile');?>" class='t_b_u_drop' target='_blank'>个人中心<b></b></a>
                <ul style='display:none;'>
                    <li><a href=""  target='_blank'>我的咨询</a></li>
                    <li><a href=""  target='_blank'>我的积分</a></li>
                    <li><a href=""  target='_blank'>我的收藏夹</a></li>
                </ul>
            </li>
            <li class='top_bar_li t_b_u_droplist'>
                <a href="" class='t_b_u_drop'>帮助中心<b></b></a>
                <ul style='display:none;'>
                    <li><a href="" target='_blank'>购物流程</a></li>
                    <li><a href="" target='_blank'>网上支付</a></li>
                    <li><a href="" target='_blank'>配送说明</a></li>
                </ul>
            </li>
        </ul>
        <div class="clearfix"></div>
        <?php Yii::app()->clientScript->registerScript('top_bar_drop',"
            $('.t_b_u_droplist').mouseenter(function(){
                $(this).find('.t_b_u_drop').addClass('t_b_u_expand').next().show();
            }).mouseleave(function(){
                $(this).find('.t_b_u_drop').removeClass('t_b_u_expand').next().hide();
            });
        ",CClientScript::POS_END);?>
    </div>
</div>