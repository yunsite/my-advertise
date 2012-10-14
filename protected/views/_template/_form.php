<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'template-form',
	'enableAjaxValidation'=>true,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row span-14">
		<?php echo $form->labelEx($model,'subject'); ?>
		<?php echo $form->textField($model,'subject',array('class'=>'span-14 poshy','title'=>'您的昵称','size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'subject'); ?>
	</div>
	<hr class="space" />

	<div class="row">
		<?php echo $form->labelEx($model,'message'); ?>
			<!--style给定宽度可以影响编辑器的最终宽度-->
		<script type="text/plain" id="myEditor" name="Template[message]" style="width:100%">
		<?php echo $model->message; ?>
		</script>
		<?php echo $form->error($model,'message'); ?>
	</div>
	<hr class="space" />
	<div class="row">
		<?php echo $form->hiddenField($model,'type',array('class'=>'span-9 poshy','value'=>$_GET['id'],'title'=>'您的昵称')); ?>
	</div>
	<hr class="space" />
	<div class="row">
		<?php echo $form->labelEx($model,'style'); ?>
		<?php echo $form->textField($model,'style',array('class'=>'span-9 poshy','title'=>'您的昵称')); ?>
		<?php echo $form->error($model,'style'); ?>
	</div>
	<hr class="space" />
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class'=>'button','style'=>'height:30px;')); ?>
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
	
	$this->widget('ext.editor.ueditor.ueditorWidget',array(
			'id'=>'myEditor',
			'initialContent' => '<span style="color:#ccc">欢迎使用模板编辑器</span>',
			'initialStyle' => 'body{margin:8px;font-family:"宋体";font-size:16px;}',
			'elementPathEnabled' => true,
			'minFrameHeight' => 250,
			'autoClearinitialContent' => true,
			'imagePath' => '/',
			'textarea' => 'content',
			'autoHeightEnabled' => true,
//			'toolbars'=>array(array('Undo','Redo','|','ForeColor','BackColor', 'Bold','Italic','Underline','JustifyLeft','JustifyCenter','JustifyRight','InsertImage','ImageNone','ImageLeft','ImageRight','ImageCenter' )),
	));
?>