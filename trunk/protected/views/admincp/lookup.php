<?php 
$this->breadcrumbs=array(
	'管理面板'=>array('index'),
	'系统设置',
);
?>
<br />

<?php
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('region-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<section class="span-11 colborder" id="blankArea">
<h1 class="span-11">系统设置</h1>
<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('/setting/_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'lookup-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'type',
		'name',
		'ename',
		'description',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>


</section>
<section class="span-4 last">
<?php 
	$this->beginWidget('zii.widgets.CPortlet', array(
		'title'=>'Operations',
		'contentCssClass' => 'portlet-content adSection'
	));
			
	$this->widget('zii.widgets.CMenu', array(
		'items'=>array(
				array('label'=>'List Settings', 'url'=>'#setting_admin'),
				array('label'=>'Create Item', 'url'=>'#setting_create'),
		),
		'htmlOptions'=>array('class'=>'operations')
	));
	$this->endWidget();
?>
</section>