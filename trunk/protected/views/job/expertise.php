<section class="span-19">
<h4>专业管理</h4>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'job-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',		
		'name',
		'pid',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
</section>