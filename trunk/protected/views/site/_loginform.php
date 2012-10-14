<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('class'=>'span-9 poshy', 'title'=>'输入您的用户名')); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password',array('class'=>'span-9 poshy','title'=>'输入您的登录密码')); ?>
		<?php echo $form->error($model,'password'); ?>
		<p class="hint">
			Hint: You may login with <tt>demo/demo</tt> or <tt>admin/admin</tt>.
		</p>
	</div>

	<div class="row rememberMe">
		<?php echo $form->checkBox($model,'rememberMe',array('class'=>'poshy','title'=>'记住密码')); ?>
		<?php echo $form->label($model,'rememberMe'); ?>
		<?php echo $form->error($model,'rememberMe'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('登录',array('class'=>'button','style'=>'width:100px;height:30px;')); ?>
		<?php echo CHtml::link('忘记密码?',$this->createUrl('/site/password'));?>
		<br />
		还没有注册，现在就	<?php echo CHtml::link('注册新帐号',$this->createUrl('/site/register'));?>，成为悦珂人！
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->