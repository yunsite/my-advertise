<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'channel-form',
	'enableAjaxValidation'=>true,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
	<div style="height:auto;">
		<div id="StatusBar">
		</div>
	
		<div id="Notification">
		</div>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>50,'maxlength'=>50,'class'=>'poshy span-11', 'title'=>'添加频道名称')); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row span-4">
		<?php echo $form->labelEx($model,'type'); ?>
		<?php echo $form->dropDownList($model,'type',Channel::model()->generateChannelList(),array('class'=>'span-3 poshy','title'=>'选择频道分类')); ?>
		<?php echo $form->error($model,'type'); ?>
	</div>
	
	<div class="row span-5">
		<?php echo $form->labelEx($model,'pid'); ?>
		<?php echo $form->dropDownList($model,'pid',Channel::model()->generateChannelList(),array('class'=>'span-4 poshy','title'=>'选择频道分类')); ?>
		<?php echo $form->error($model,'pid'); ?>
	</div>
	
	<div class="row span-2">
		<?php echo $form->labelEx($model,'weight'); ?>
		<?php echo $form->dropDownList($model,'weight',array_combine(range(1, 10), range(1, 10)),array('class'=>'span-2 poshy','title'=>'填写频道权重','value'=>500)); ?>
		<?php echo $form->error($model,'weight'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'charge'); ?>
		<?php echo $form->textField($model,'charge',array('size'=>10,'maxlength'=>10,'class'=>'span-11 poshy','title'=>'当前频道收费')); ?>
		<?php echo $form->error($model,'charge'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>60,'maxlength'=>500,'class'=>'span-11 poshy','title'=>'填写频道描述','style'=>'height:50px;')); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>


	<div class="row buttons">
		<?php //echo CHtml::Button($model->isNewRecord ? 'Create' : 'Save',array('style'=>'width:100px;height:30px;','class'=>'button')); ?>
		<?php  
		$url = $model->isNewRecord ? 'create':'update';
		echo CHtml::ajaxSubmitButton($model->isNewRecord ? 'Create' : 'Save',CHtml::normalizeUrl(array($url,'render'=>true,'id'=>$model->id)),array('success'=>'js:function(html){alert(html);test(html);}'),array('class'=>'button','style'=>'width:100px;height:30px;'));?>
		
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

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
	// Initialize the extension
	$this->widget('ext.jnotify.JNotify', array(
		'statusBarId'=>'StatusBar',
		'notificationId'=>'Notification',
		'notificationHSpace'=>'30px',	
		'notificationWidth'=>'280px',
		'notificationShowAt'=>'topRight',
		//'notificationShowAt'=>'bottomLeft',
		//'notificationAppendType'=>'prepend',
	)); 
	
	Yii::app()->clientScript->registerScript('channel-form', "
function test(data)
{
    $('#StatusBar').jnotifyAddMessage({
        text: data,
        permanent: false,
        type: 'error',
        showIcon: false
    });
}
");

?>

