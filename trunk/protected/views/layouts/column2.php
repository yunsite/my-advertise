<?php $this->beginContent('//layouts/main'); ?>
<div class="container">
	<div class="span-17 first">
		<?php echo $content; ?>
	</div>
	
	<aside class="span-7 last">
		<?php
			$this->beginWidget('zii.widgets.CPortlet', array(
				'title'=>'悦珂动态',
				'contentCssClass' => 'portlet-content adSection'
			));			
			 $this->widget('ext.sidebar.sidebarWidget',array(
				'view'=>'message'
			));
			$this->endWidget();
			
			$this->beginWidget('zii.widgets.CPortlet', array(
				'title'=>'Operations',
				'contentCssClass' => 'portlet-content adSection'
			));
			$this->widget('zii.widgets.CMenu', array(
				'items'=>$this->menu,
				'htmlOptions'=>array('class'=>'operations'),
			));
			$this->endWidget();
			
			$this->beginWidget('zii.widgets.CPortlet', array(
				'title'=>'Operations',
				'contentCssClass' => 'portlet-content adSection'
			));
			$this->widget('zii.widgets.CMenu', array(
				'items'=>$this->menu,
				'htmlOptions'=>array('class'=>'operations'),
			));
			$this->endWidget();			
		?>
	</aside>
</div>
<?php $this->endContent(); ?>