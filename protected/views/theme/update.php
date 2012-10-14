<?php
$this->breadcrumbs=array(
	'Themes'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Theme', 'url'=>array('index')),
	array('label'=>'Create Theme', 'url'=>array('create')),
	array('label'=>'View Theme', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Theme', 'url'=>array('admin')),
);
?>

<section style="overflow: hidden;">
<h4>创建主题</h4>
<?php $this->renderPartial('_form',array('model'=>$model));?>
</section>
