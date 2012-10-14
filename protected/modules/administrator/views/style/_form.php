<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'style-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'code'); ?>
		<?php echo $form->textArea($model,'code',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'code'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'template'); ?>
		<?php echo $form->textField($model,'template'); ?>
		<?php echo $form->error($model,'template'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'owner'); ?>
		<?php echo $form->textField($model,'owner'); ?>
		<?php echo $form->error($model,'owner'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pubdate'); ?>
		<?php echo $form->textField($model,'pubdate'); ?>
		<?php echo $form->error($model,'pubdate'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->