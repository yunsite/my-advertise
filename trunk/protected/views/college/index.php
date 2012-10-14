<?php
$this->breadcrumbs=array(
	'Colleges',
);

$this->menu=array(
	array('label'=>'Create College', 'url'=>array('create')),
	array('label'=>'Manage College', 'url'=>array('admin')),
);
?>

<h1>Colleges</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
