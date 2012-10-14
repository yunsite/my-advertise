<?php
$this->breadcrumbs=array(
	'Users',
);

$this->menu=array(
	array('label'=>'Create User', 'url'=>array('create')),
	array('label'=>'Manage User', 'url'=>array('admin')),
);
?>
<script type="text/javascript">
$(function(){
    $.page();
});
</script>
<h1>注册用户</h1>
<?php foreach($model as $item): ?>
    <?php $this->renderPartial('_view',array('data'=>$item)); ?>
<?php endforeach;?>
<hr />
<?php $this->widget('CLinkPager', array(
     'pages' => $pages,
)); ?>


<a class="button page-button" id="page-prev"></a>
<a class="button page-button" id="page-next"></a>