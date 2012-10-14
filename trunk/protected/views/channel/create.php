<?php
$this->breadcrumbs=array(
	'Channels'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Channel', 'url'=>array('index')),
	array('label'=>'Manage Channel', 'url'=>array('admin')),
);
?>
<section class="span-19">
<h4>Create Channel</h4>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</section>