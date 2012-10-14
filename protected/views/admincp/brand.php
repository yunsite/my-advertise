<?php
$this->breadcrumbs=array(
	'Profiles'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Profile', 'url'=>array('index')),
	array('label'=>'Create Profile', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('profile-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<section class="span-19">
	<h4 class="pageTitle">广告栏</h4>
	<div class="span-14">
		<p>
		You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
		or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
		</p>
		
		<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
		<div class="search-form" style="display:none">
		<?php $this->renderPartial('/region/_search',array(
			'model'=>$model,
		)); ?>
		</div><!-- search-form -->
		
		<?php $this->widget('zii.widgets.grid.CGridView', array(
			'id'=>'region-grid',
			'dataProvider'=>$model->brand(),
			'filter'=>$model,
			'columns'=>array(		
				array(
		             'class'=>'CCheckBoxColumn',
		             'id'=>'id', 
		             'selectableRows'=>2, 
		       ),
				array(
					'header'=>'广告栏名称',
					'name'=>'region',
					'value'=>'Region::model()->getAreaBrandNameByUser($data->forerunner).广告栏'
				),
				array(
					'header'=>'广告栏开启人',
					'name'=>'forerunner',
					'value'=>'Profile::model()->getUserTrueName($data->forerunner)'
				),
				
				array(
		       		'class'=>'CButtonColumn',
					'header'=>'地区注册人数',
		       		'buttons'=>array(
		       			'preview'=>array(
		       				'label'=>'查看',
		       				'url'=>'',
		       			),
		       			'recommend'=>array(
		       				'label'=>'推荐'
		       			)
		       		),
		       		'template'=>'{preview}{recommend}'
		       ),
			),
		)); ?>
	</div>
	<div class="span-5 last">	
		<?php $this->widget('zii.widgets.CListView', array(
			'dataProvider'=>$sort,
			'itemView'=>'_brand',
		)); ?>
	</div>
</section>
