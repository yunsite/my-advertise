<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'lookup-form',
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
	<div class="row span-11">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>30,'maxlength'=>30,'class'=>'span-11 poshy', 'title'=>'设置项目名称')); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row span-6">
		<?php echo $form->labelEx($model,'ename'); ?>
		<?php echo $form->textField($model,'ename',array('size'=>30,'maxlength'=>30,'class'=>'span-5 poshy','title'=>'项目名称别名，由字母a-z组成')); ?>
		<?php echo $form->error($model,'ename',array('class'=>'clear','style'=>'color:red;')); ?>
	</div>
	
	<div class="row span-5">
		<?php echo $form->labelEx($model,'type'); ?>
		<?php echo $form->dropDownList($model,'type', Lookup::model()->generateLookUpItemList(), array('class'=>'span-5 poshy','title'=>'项目分类')); ?>
		<?php echo $form->error($model,'type'); ?>
	</div>
	
	<div class="row span-11">
		<?php echo $form->labelEx($model,'weight'); ?>
		<?php echo $form->dropDownList($model,'weight',array_combine(range(1, 20), range(1, 20)),array('class'=>'span-11 poshy','title'=>'项目权重')); ?>
		<?php echo $form->error($model,'weight'); ?>
	</div>
	
	<div class="row span-11">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('size'=>60,'maxlength'=>500,'class'=>'span-11 poshy','title'=>'项目名称描述','style'=>'height:50px;')); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>
	
	<div class="row buttons span-11">
		<?php //echo CHtml::Button($model->isNewRecord ? 'Create' : 'Save',array('class'=>'button','style'=>'width:100px;height:30px;','onclick'=>'ajaxSubmit()')); ?>
		<?php  
		$url = $model->isNewRecord ? 'setting/create':'setting/update';
		echo CHtml::ajaxSubmitButton($model->isNewRecord ? 'Create' : 'Save',CHtml::normalizeUrl(array($url,'render'=>true,'id'=>$model->id)),array('update'=>'#job'),array('class'=>'button','style'=>'width:100px;height:30px;'));?>
	</div>
	
<?php $this->endWidget(); ?>

</div><!-- form -->
<div id="job">dk</div>


<script type="text/javascript">
<!--
function ajaxSubmit(){

	$.post($("#lookup-form").attr("action"),$("#lookup-form").serialize(),function(data){
		$.fancybox.resize();
		$.fancybox.showActivity();
		$.fancybox({
			'overlayShow':true,
			'transitionIn':'elastic',
			'transitionOut':'elastic',
			'href':this.href,
			'type':'iframe'
		});
	});
//	$("#lookup-form").serialize();
	
//	alert("KDKL");
}
//-->
</script>
 
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
   	$this->widget('ext.fancybox.fancyboxWidget',array(
		'id'=>'#changeAdress',
		'options' => "'overlayShow'	: false,
			'transitionIn'	: 'elastic',
			'transitionOut'	: 'elastic'"
	));
	
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
function addMessage(data)
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