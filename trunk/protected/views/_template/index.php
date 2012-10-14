<?php
$this->breadcrumbs=array(
	'Templates',
);

$this->menu=array(
	array('label'=>'Create Template', 'url'=>array('create')),
	array('label'=>'Manage Template', 'url'=>array('admin')),
);
?>
<section class="span-19">

<h4>
	Templates
	<a href="#template_admin" title="表格显示"><span class="lsIco lsDisplayTable right"></span></a>
	<span class="lsIco lsDisplayBlockList right"></span>
	<span class="lsIco lsDisplayList right"></span>
</h4>
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
</section>
