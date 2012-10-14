<?php 
$this->menu=array(
	array('label'=>'Create Profile', 'url'=>array('create')),
	array('label'=>'Manage Profile', 'url'=>array('admin')),
);

?>
<?php $this->beginContent('//layouts/main'); ?>
<div id="content" class="container adSection" style="background: white;border:1px solid #ffe;">
	<aside class="span-8 first colborder" style="padding:10px;">
		<h4 style="background: #FF7F24;padding:5px 10px;margin:5px;color:white;border-radius:5px;">广告频道首页</h4>
		<hr class="space" />
		<?php
		
			$this->widget('ext.sidebar.sidebarWidget',array(
				'view'=>'channel'
			));
			
			$this->widget('zii.widgets.CMenu', array(
				'items'=>$this->menu,
				'htmlOptions'=>array('class'=>'operations'),
			));
			
	
		?>
	</aside>
	<div class="span-19 last" id="blankArea">
		<?php echo $content; ?>
	</div>
</div>
<?php $this->endContent(); ?>