<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('aid')); ?>:</b>
	<?php echo CHtml::encode($data->aid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ip')); ?>:</b>
	<?php echo CHtml::encode($data->ip); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('uid')); ?>:</b>
	<?php echo CHtml::encode($data->uid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lasttime')); ?>:</b>
	<?php echo CHtml::encode($data->lasttime); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('times')); ?>:</b>
	<?php echo CHtml::encode($data->times); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('alltime')); ?>:</b>
	<?php echo CHtml::encode($data->alltime); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('intervals')); ?>:</b>
	<?php echo CHtml::encode($data->intervals); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('terminal')); ?>:</b>
	<?php echo CHtml::encode($data->terminal); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('refer')); ?>:</b>
	<?php echo CHtml::encode($data->refer); ?>
	<br />

	*/ ?>

</div>