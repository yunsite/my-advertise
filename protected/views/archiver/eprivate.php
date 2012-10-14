<!-- 此文件用于显示用户个人基本资料 -->
<style type="text/css">

</style>
<section class="span-14">
<h4 class="span-10">私人资料<span class="ico ico_back"></span><a href="#archiver_private" class="more proedit">返回</a></h4>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'profile-form',
	'enableAjaxValidation'=>true,
)); ?>


	<?php echo $form->errorSummary($model); ?>
	<hr class="space" />
	<div style="height:auto;">
		<div id="StatusBar">
		</div>
	
		<div id="Notification">
		</div>
	</div>
	<hr class="space" />
	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>100,'class'=>'span-9  poshy','title'=>'您的常用电子邮箱')); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>
	<hr class="space" />
	<div class="row">
		<?php echo $form->labelEx($model,'phone'); ?>
		<?php echo $form->textField($model,'phone',array('size'=>50,'maxlength'=>50,'class'=>'span-9  poshy','title'=>'您的手机号码')); ?>
		<?php echo $form->error($model,'phone'); ?>
	</div>
	<hr class="space" />
	<div class="row">
		<?php echo $form->labelEx($model,'qq'); ?>
		<?php echo $form->textField($model,'qq',array('class'=>'span-9 poshy','title'=>'您的QQ号码')); ?>
		<?php echo $form->error($model,'qq'); ?>
	</div>
	<hr class="space" />
	<div class="row">
		<?php echo $form->labelEx($model,'alipay'); ?>
		<?php echo $form->textField($model,'alipay',array('size'=>60,'maxlength'=>100,'class'=>'span-9  poshy','title'=>'您的支付宝帐号')); ?>
		<?php echo $form->error($model,'alipay'); ?>
	</div>

	<hr class="space" />

	<div class="row clear buttons">
		<?php //echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'button','style'=>'width:100px;height:30px;')); ?>
		<?php  
		$url = $model->isNewRecord ? 'create':'updateprofile';
		echo CHtml::ajaxSubmitButton($model->isNewRecord ? 'Create' : 'Save',CHtml::normalizeUrl(array($url,'render'=>true,'id'=>$model->id)),array('success'=>'js:function(html){addMessage(html);}'),array('class'=>'button','style'=>'width:100px;height:30px;'));
		?>
	</div>


<?php $this->endWidget(); ?>

</div><!-- form -->

</section>
<section class="span-4 last">
	<?php $this->widget('ext.sidebar.sidebarWidget',array('view'=>'profileinfo'));?>
</section>
<hr class="space" />
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
	
	$regionUrl = $this->createUrl('/remote/region');
	
	Yii::app()->clientScript->registerScript('archiver-form', "
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