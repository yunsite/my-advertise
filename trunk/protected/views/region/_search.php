<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
//	'action'=>Yii::app()->createUrl($this->route),
    'action'=>Yii::app()->createUrl('/region/search'),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'region'); ?>
		<?php echo $form->textField($model,'region',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pid'); ?>
		<?php echo $form->textField($model,'pid'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search',array('style'=>'width:100px;height:30px;','class'=>'button')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->