<?php
$this->breadcrumbs=array(
	'Visitors'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Visitor', 'url'=>array('index')),
	array('label'=>'Create Visitor', 'url'=>array('create')),
	array('label'=>'Update Visitor', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Visitor', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Visitor', 'url'=>array('admin')),
);
?>

<h1>View Visitor #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'aid',
		'ip',
		'uid',
		'lasttime',
		'times',
		'alltime',
		'intervals',
		'terminal',
		'refer',
	),
)); ?>
