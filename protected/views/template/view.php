<?php
$this->breadcrumbs=array(
	'Templates'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Template', 'url'=>array('index')),
	array('label'=>'Create Template', 'url'=>array('create')),
	array('label'=>'Update Template', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Template', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Template', 'url'=>array('admin')),
);
?>

<?php echo $model->code; ?>


