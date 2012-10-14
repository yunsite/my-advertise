<?php
$this->breadcrumbs=array(
	'Themes'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Theme', 'url'=>array('index')),
	array('label'=>'Create Theme', 'url'=>array('create')),
	array('label'=>'Update Theme', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Theme', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Theme', 'url'=>array('admin')),
);
?>
<style type="text/css">
    <?php echo $model->css; ?>
</style>
<script type="text/javascript">
    <?php echo $model->javascript; ?>
</script>
<?php

    $pattern = '/<textarea.*>(.*)</textarea>/';
    
    
    echo $model->html;
?>
