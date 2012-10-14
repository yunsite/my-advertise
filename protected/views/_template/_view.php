<div class="view">
	<h3 style="border-bottom:1px dashed grey;padding-bottom:5px;">
		<?php echo CHtml::link(CHtml::encode($data->subject), array('view', 'id'=>$data->id),array('class'=>'showDetail')); ?>
	</h3>
	<?php echo $data->message; ?>
	<br />

</div>