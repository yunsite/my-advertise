<?php
$this->breadcrumbs=array(
	'Channels'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Channel', 'url'=>array('index')),
	array('label'=>'Create Channel', 'url'=>array('create')),
	array('label'=>'View Channel', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Channel', 'url'=>array('admin')),
);
?>

<h1>Update Channel <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>