<div class="qapost_list <?php echo $data->id%2==0?'':'qaanswer_r_2'?>">
<div class="r_info">咨询:<?php echo $data->author->username;?>&nbsp;&nbsp;<?php echo date('Y-m-d H:i:s',$data->add_time);?></div>
<p class='qaask'><span>咨询内容:</span><?php echo CHtml::encode($data->content);?></p>
<?php if($data->comments==null){?>
<p class='qaanswer'><span>客服回复:</span>暂无</p>
<div class="r_info">请耐心等待回复</div>
<?php }else{?>
<?php $this->renderPartial('_comments',array('comments'=>$data->comments));?>
<?php }?>
<?php echo Yii::app()->getModule('user')->isAdmin()?CHtml::link('回复咨询',Yii::app()->createUrl('qa/posts/view',array('id'=>$data->id))):'';?>
</div>