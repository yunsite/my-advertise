<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'aid'); ?>
		<?php echo $form->textField($model,'aid'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ip'); ?>
		<?php echo $form->textField($model,'ip',array('size'=>30,'maxlength'=>30)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'uid'); ?>
		<?php echo $form->textField($model,'uid'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'lasttime'); ?>
		<?php echo $form->textField($model,'lasttime'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'times'); ?>
		<?php echo $form->textField($model,'times'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'alltime'); ?>
		<?php echo $form->textArea($model,'alltime',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'intervals'); ?>
		<?php echo $form->textArea($model,'intervals',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'terminal'); ?>
		<?php echo $form->textField($model,'terminal',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'refer'); ?>
		<?php echo $form->textArea($model,'refer',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->