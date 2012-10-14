<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id',array('class'=>'poshy span-10', 'title'=>'频道编号')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>50,'maxlength'=>50,'class'=>'poshy span-10', 'title'=>'频道名称')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'type'); ?>
		<?php echo $form->textField($model,'type',array('class'=>'poshy span-10', 'title'=>'频道类型')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'weight'); ?>
		<?php echo $form->textField($model,'weight',array('class'=>'poshy span-10', 'title'=>'频道权重')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'description'); ?>
		<?php echo $form->textField($model,'description',array('size'=>60,'maxlength'=>500,'class'=>'poshy span-10', 'title'=>'频道描述')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'charge'); ?>
		<?php echo $form->textField($model,'charge',array('size'=>10,'maxlength'=>10,'class'=>'poshy span-10', 'title'=>'频道收费')); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search',array('style'=>'width:100px;height:30px;','class'=>'button')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
<?php 
    $this->widget('ext.poshytip.Poshytip', array(
    	"selector"=>".poshy",	
    	'tooltips'=>array(
			'className'=>'tip-yellowsimple',
			'showOn'=>'focus',
			'alignTo'=>'target',
			'alignX'=>'right',
			'alignY'=>'center',
			'offsetX'=>5	
    	)	
    ));
    
    $this->widget('ext.chosen.chosenWidget');
?>