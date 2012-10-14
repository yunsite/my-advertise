<?php $this->beginContent('//layouts/main'); ?>
<div class="container">
	<aside class="span-7 first" id="stepPortlet">
		<h1>&nbsp;</h1>
		<?php		
			
			$this->widget('zii.widgets.CMenu', array(
				'items'=>$this->menu,
				'htmlOptions'=>array('class'=>'operations'),
			));

		?>
		<?php
			
			echo CHtml::image('/public/images/contactbg.png');
		?>
	</aside>
	
	<div class="span-16 last" style="min-height:500px; background: url(/public/images/registerbg.png) bottom right no-repeat;">
		<?php echo $content; ?>
	</div>
</div>
<?php $this->endContent(); ?>
