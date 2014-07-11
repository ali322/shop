<p class="post_create_title"><?php echo UserModule::t('View QaPosts')?></p>
<div class="qalist">
<p class='qaask'><i></i><span>提问:<?php echo CHtml::encode($model->content);?></span><b><?php echo date('Y-m-d H:i:s',$model->add_time);?></b></p>
<?php if($model->comments==null){?>
<div class="qaanswer">
        <dl class="answer">
            <dt><i></i>回复:</dt>
            <dd>您好，欢迎访问库巴！ 很抱歉！该商品目前不支持此地区的配送，给您带来的不便我们深表歉意；无法配送将无法下单； 感谢您对库巴的关注与支持，祝您购物愉快！33333333333333333333333333333333</dd>
        </dl>
    <b class="extra"></b>
</div>
<?php }else{?>
<div class="qaanswer">
    <dl class="answer">
        <dt><i></i>回复:</dt>
        <dd>您好，欢迎访问库巴！ 很抱歉！该商品目前不支持此地区的配送，给您带来的不便我们深表歉意；无法配送将无法下单； 感谢您对库巴的关注与支持，祝您购物愉快！</dd>
    </dl>
    <b class="extra"></b>
</div>
<?php }?>
<div class="profile_edit_wrap">
<?php
   // $this->renderPartial('/comments/_form',array('model'=>$comment));
?>
</div>
</div>