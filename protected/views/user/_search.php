<div class="wide form">
<?php $form=$this->beginWidget('CActiveForm', array(
//	'action'=>Yii::app()->createUrl($this->route),
	'action'=>Yii::app()->createUrl('/user/search'),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id',array('width'=>'100%')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('size'=>16,'maxlength'=>24,'width'=>'100%')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'role'); ?>
		<?php echo $form->dropDownList($model,'role',User::model()->generateRoleList(),array('width'=>'100%')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'created'); ?>
		<?php echo $form->textField($model,'created', array('width'=>'100%')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'lastlogin'); ?>
		<?php echo $form->textField($model,'lastlogin',array('width'=>'100%')); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search',array('class'=>'button','style'=>"width:100px;height:30px;")); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->