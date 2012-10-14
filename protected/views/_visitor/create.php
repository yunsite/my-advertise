<?php
$this->breadcrumbs=array(
	'Visitors'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Visitor', 'url'=>array('index')),
	array('label'=>'Manage Visitor', 'url'=>array('admin')),
);
?>

<h1>Create Visitor</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>