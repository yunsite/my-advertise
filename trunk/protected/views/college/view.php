<?php
$this->breadcrumbs=array(
	'Colleges'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List College', 'url'=>array('index')),
	array('label'=>'Create College', 'url'=>array('create')),
	array('label'=>'Update College', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete College', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage College', 'url'=>array('admin')),
);
?>

<h1>View College #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'type',
		'province',
		'homepage',
	),
)); ?>
