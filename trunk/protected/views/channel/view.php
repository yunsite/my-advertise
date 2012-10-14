<?php
$this->breadcrumbs=array(
	'Channels'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Channel', 'url'=>array('index')),
	array('label'=>'Create Channel', 'url'=>array('create')),
	array('label'=>'Update Channel', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Channel', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Channel', 'url'=>array('admin')),
);
?>

<h1>View Channel #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'type',
		'weight',
		'description',
		'charge',
		'pid',
		'uid',
	),
)); ?>
