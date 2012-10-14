<?php 
$this->menu=array(
	array('label'=>'发布信息', 'url'=>'#archiver_cinfo'),
	array('label'=>'Manage Profile', 'url'=>'#archiver_index'),
);

?>
<?php $this->beginContent('//layouts/main'); ?>
<div id="content" class="container adSection" style="background: white;border:0px solid #ffe;">
	<div class="span-17" id="blankArea">
		<?php echo $content; ?>
	</div>
	<aside class="span-6 last right" style="padding:10px;">
		<h4 style="background: #FF7F24;padding:5px 10px;margin:5px;color:white;border-radius:5px;">个人中心首页</h4>
		<hr class="space" />
		<?php
			
			$this->widget('zii.widgets.CMenu', array(
				'items'=>$this->menu,
				'htmlOptions'=>array('class'=>'operations'),
			));
			
	
		?>
	</aside>
</div>
<?php $this->endContent(); ?>
<?php Yii::import('application.views.layouts.include');?>
<script type="text/javascript">

$(function(){
	historyload("#yw1 li a,yw3 li a");
});
</script>