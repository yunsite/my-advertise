<?php 
$this->breadcrumbs=array(
	'管理面板'=>array('index'),
	'会员管理',
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

<section class="span-11" id="blankArea">
<h1 class="span-11">会员信息浏览</h1>
<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('/channel/_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'category-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'name',
		'type',
		'weight',
		'description',
		'charge',
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
				array('label'=>'频道列表', 'url'=>'#channel_admin'),
				array('label'=>'创建频道', 'url'=>'#channel_create'),
				array('label'=>'批量创建频道', 'url'=>'#channel_batchcreate')
		),
		'htmlOptions'=>array('class'=>'operations')
	));
	$this->endWidget();
?>
</section>