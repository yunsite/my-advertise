<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
//	'action'=>Yii::app()->createUrl($this->route),
	'action'=>Yii::app()->createUrl('/info/adminsearch'),    
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'uid'); ?>
		<?php echo $form->textField($model,'uid'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cid'); ?>
		<?php echo $form->textField($model,'cid'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'content'); ?>
		<?php echo $form->textField($model,'content',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tag'); ?>
		<?php echo $form->textField($model,'tag',array('size'=>60,'maxlength'=>100)); ?>
	</div>
<?php 
/**
	<div class="row">
		<?php echo $form->label($model,'theme'); ?>
		<?php echo $form->textField($model,'theme'); ?>
	</div>
    
    <div class="row">
		<?php echo $form->label($model,'start'); ?>
		<?php echo $form->textField($model,'start'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'end'); ?>
		<?php echo $form->textField($model,'end'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'address'); ?>
		<?php echo $form->textField($model,'address',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'phone'); ?>
		<?php echo $form->textField($model,'phone',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'adusername'); ?>
		<?php echo $form->textField($model,'adusername',array('size'=>50,'maxlength'=>50)); ?>
	</div>
*/
?>
	<div class="row buttons">
        <?php echo CHtml::submitButton('Search',array('class'=>'button','style'=>"width:100px;height:30px;")); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->