<?php
$this->breadcrumbs=array(
	'Colleges'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List College', 'url'=>array('index')),
	array('label'=>'Manage College', 'url'=>array('admin')),
);
?>

<h1>Create College</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>