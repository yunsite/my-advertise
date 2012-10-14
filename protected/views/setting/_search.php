<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row span-11">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id',array('class'=>'span-10 poshy','title'=>'项目编号')); ?>
	</div>

	<div class="row span-11">
		<?php echo $form->label($model,'type'); ?>
		<?php echo $form->textField($model,'type',array('class'=>'span-10 poshy','title'=>'项目类型')); ?>
	</div>

	<div class="row span-11">
		<?php echo $form->label($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>30,'maxlength'=>30,'class'=>'span-10 poshy','title'=>'项目名称')); ?>
	</div>

	<div class="row span-11">
		<?php echo $form->label($model,'ename'); ?>
		<?php echo $form->textField($model,'ename',array('size'=>30,'maxlength'=>30,'class'=>'span-10 poshy','title'=>'项目名称别名')); ?>
	</div>

	<div class="row span-11">
		<?php echo $form->label($model,'description'); ?>
		<?php echo $form->textField($model,'description',array('size'=>60,'maxlength'=>500,'class'=>'span-10 poshy','title'=>'项目描述')); ?>
	</div>

	<div class="row span-11 buttons">
		<?php echo CHtml::submitButton('Search',array('class'=>'button','style'=>'width:100px;height:30px;')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->