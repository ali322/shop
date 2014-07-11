<div class="view">
<span class="view_order_sn cl_1">
	<?php echo CHtml::link(CHtml::encode($data->order_sn), array('view', 'id'=>$data->id),array('target'=>'_blank')); ?>
</span>
<span class="view_order_amount cl_2">
	<?php echo CHtml::encode($data->order_amount); ?>
</span>
<span class="view_pay_name cl_3">
	<?php echo CHtml::encode($data->pay_name); ?>
</span>
<span class="view_pay_status cl_4">
	<?php echo LookUp::payStatus($data->pay_status); ?>
</span>
<span class="view_order_status cl_5">
	<?php echo LookUp::orderStatus($data->order_status); ?>
</span>
<span class="view_add_time cl_6">
	<?php echo CHtml::encode($data->add_time); ?>
</span>
<span class="view_operate cl_7">
</span>
</div>
