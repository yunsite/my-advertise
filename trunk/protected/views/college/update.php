<?php
$this->breadcrumbs=array(
	'Colleges'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List College', 'url'=>array('index')),
	array('label'=>'Create College', 'url'=>array('create')),
	array('label'=>'View College', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage College', 'url'=>array('admin')),
);
?>

<h1>Update College <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>