<?php
$this->breadcrumbs=array(
	'Qa Comments'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List QaComments', 'url'=>array('index')),
	array('label'=>'Create QaComments', 'url'=>array('create')),
	array('label'=>'Update QaComments', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete QaComments', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage QaComments', 'url'=>array('admin')),
);
?>

<h1>View QaComments #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'user_id',
		'post_id',
		'content',
		'add_time',
	),
)); ?>
