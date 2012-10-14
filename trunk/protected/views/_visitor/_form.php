<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'visitor-form',
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
		<?php echo $form->labelEx($model,'ip'); ?>
		<?php echo $form->textField($model,'ip',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'ip'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'uid'); ?>
		<?php echo $form->textField($model,'uid'); ?>
		<?php echo $form->error($model,'uid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'lasttime'); ?>
		<?php echo $form->textField($model,'lasttime'); ?>
		<?php echo $form->error($model,'lasttime'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'times'); ?>
		<?php echo $form->textField($model,'times'); ?>
		<?php echo $form->error($model,'times'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'alltime'); ?>
		<?php echo $form->textArea($model,'alltime',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'alltime'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'intervals'); ?>
		<?php echo $form->textArea($model,'intervals',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'intervals'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'terminal'); ?>
		<?php echo $form->textField($model,'terminal',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'terminal'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'refer'); ?>
		<?php echo $form->textArea($model,'refer',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'refer'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->