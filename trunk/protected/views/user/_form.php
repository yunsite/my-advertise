<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
//	'action'=>$this->createUrl('/user/create'),
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
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('size'=>50,'maxlength'=>50,'class'=>'span-11 poshy','title'=>'输入用户名')); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row span-11">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password',array('size'=>60,'maxlength'=>128,'class'=>'span-11 poshy','title'=>'输入用户登录密码')); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>

	<div class="row span-11">
		<?php echo $form->labelEx($model,'role'); ?>
		<?php echo $form->dropDownList($model,'role',User::model()->generateRoleList(),array('class'=>'span-11 poshy')); ?>
		<?php echo $form->error($model,'role'); ?>
	</div>

	<div class="row buttons span-11">
		<?php// echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('style'=>'width:100px;height:30px;','class'=>'button')); ?>
		<?php 
		$url = $model->isNewRecord ? 'user/create':'user/update';
		echo CHtml::ajaxSubmitButton($model->isNewRecord ? 'Create' : 'Save',CHtml::normalizeUrl(array($url,'render'=>true,'id'=>$model->id)),array('success'=>'js:function(html){addMessage(html);}'),array('class'=>'button','style'=>'width:100px;height:30px;'));
		?>
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