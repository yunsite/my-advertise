<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'statistics-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'aid'); ?>
		<?php echo $form->textField($model,'aid'); ?>
		<?php echo $form->error($model,'aid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'uid'); ?>
		<?php echo $form->textField($model,'uid'); ?>
		<?php echo $form->error($model,'uid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ip'); ?>
		<?php echo $form->textField($model,'ip'); ?>
		<?php echo $form->error($model,'ip'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'starttime'); ?>
		<?php echo $form->textField($model,'starttime'); ?>
		<?php echo $form->error($model,'starttime'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'endtime'); ?>
		<?php echo $form->textField($model,'endtime'); ?>
		<?php echo $form->error($model,'endtime'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'terminal'); ?>
		<?php echo $form->textField($model,'terminal',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'terminal'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'refer'); ?>
		<?php echo $form->textField($model,'refer',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'refer'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->