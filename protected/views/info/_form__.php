<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'advertisement-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'uid'); ?>
		<?php echo $form->textField($model,'uid'); ?>
		<?php echo $form->error($model,'uid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cid'); ?>
		<?php echo $form->textField($model,'cid'); ?>
		<?php echo $form->error($model,'cid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'start'); ?>
		<?php echo $form->textField($model,'start'); ?>
		<?php echo $form->error($model,'start'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'end'); ?>
		<?php echo $form->textField($model,'end'); ?>
		<?php echo $form->error($model,'end'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'theme'); ?>
		<?php echo $form->textField($model,'theme'); ?>
		<?php echo $form->error($model,'theme'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'content'); ?>
		<?php echo $form->textArea($model,'content',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'content'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'address'); ?>
		<?php echo $form->textField($model,'address',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'address'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'phone'); ?>
		<?php echo $form->textField($model,'phone',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'phone'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'adusername'); ?>
		<?php echo $form->textField($model,'adusername',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'adusername'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'price'); ?>
		<?php echo $form->textField($model,'price',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'price'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->