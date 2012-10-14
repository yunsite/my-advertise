<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('type')); ?>:</b>
	<?php echo CHtml::encode($data->type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('weight')); ?>:</b>
	<?php echo CHtml::encode($data->weight); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('charge')); ?>:</b>
	<?php echo CHtml::encode($data->charge); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pid')); ?>:</b>
	<?php echo CHtml::encode($data->pid); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('uid')); ?>:</b>
	<?php echo CHtml::encode($data->uid); ?>
	<br />

	*/ ?>

</div>