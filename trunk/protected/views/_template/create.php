<?php
$this->breadcrumbs=array(
	'Templates'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Template', 'url'=>array('index')),
	array('label'=>'Manage Template', 'url'=>array('admin')),
);
?>
<section class="span-19">
	<h4 class="pageTitle">创建模板</h4>
	<div class="span-14">
		<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
	</div>
	<aside class="span-5 right last">
		<div style="text-align:right;">
			<h4>常用模板参数</h4>
			<?php foreach (Yii::app()->params['template'] as $key=>$value):?>
			<a name="<?php echo $value;?>" onclick="editor_a.execCommand('insertHtml','<{['+this.name+']}>');"><?php echo $key;?></a>
			<?php endforeach;?>	
		</div>

	</aside>
</section>