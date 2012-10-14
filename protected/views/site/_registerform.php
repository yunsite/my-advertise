<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'register-form',
	'enableAjaxValidation'=>true,
)); ?>

	<p class="note">带 <span class="required">*</span> 的为必填信息.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row span-5">
		<?php echo $form->labelEx($model,'firstname'); ?>
		<?php echo $form->textField($model,'firstname',array('title'=>'您的中文姓氏', 'class'=>'poshy span-4')); ?>
		
	</div>
	
	<div class="row span-4">
		<?php echo $form->labelEx($model,'lastname'); ?>
		<?php echo $form->textField($model,'lastname',array('title'=>'您的中文名字', 'class'=>'poshy span-4')); ?>
			
	</div>
	<div class="row">
	<?php echo $form->error($model,'firstname'); ?>	
	<?php echo $form->error($model,'lastname'); ?>
	</div>
	
	<div class="row clear">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('title'=>'您的登录帐号，由a-z_0-9组成', 'class'=>'poshy span-9')); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password',array('title'=>'您的登录密码', 'class'=>'poshy span-9')); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'repassword'); ?>
		<?php echo $form->passwordField($model,'repassword',array('title'=>'重复输入，确认登录密码', 'class'=>'poshy span-9')); ?>
		<?php echo $form->error($model,'repassword'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email', array('title'=>'请输入一个您的常用邮箱，用于接收激活码', 'class'=>'poshy span-9')); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'gender'); ?>
		<?php echo $form->dropDownList($model,'gender',Profile::model()->generateGenderList(), array('title'=>'请选择您的性别', 'class'=>'poshy span-9')); ?>
		<?php echo $form->error($model,'gender'); ?>
	</div>
	
	<div class="row span-9">
		<?php echo $form->labelEx($model,'birth'); ?>					
		<?php 
		 $this->widget('zii.widgets.jui.CJuiDatePicker', array(
		 	  'model'=>$model,
		 	  'attribute'=>'birth',
		      // additional javascript options for the date picker plugin
		      'options'=>array(
					'showAnim'=>'fold',
					'changeMonth'=>true,
					'changeYear'=>true,
					'yearRange'=>"1960:{date('Y')}",
					'navigationAsDateFormat'=>true,
					'showMonthAfterYear'=>true,
						
				),
		      'htmlOptions'=>array(
		      	'title'=>'请选择您的出生年月',
		      	'class'=>'poshy span-9'
		      ),
		 ));
		?>
		<?php echo $form->error($model,'birth');?>

	</div>
	
	<div class="row span-9">
		<?php echo $form->labelEx($model,'region',array('class'=>'left')); ?>
		<a href="javascript:void();" class="left" onclick="loadRegionForm();">请选择</a>
		<br />
		
		<div id="regions"></div>
		<input type="hidden" id="Profile_addressdetail" />
		<?php echo $form->hiddenField($model,'region');?>
	</div>
	<br />
	<hr class="space"/>
	
	

	<?php if(CCaptcha::checkRequirements()): ?>
	<div class="row clear">
		<?php echo $form->labelEx($model,'verifyCode'); ?>
		<div>		
		<?php $this->widget('CCaptcha',array('clickableImage'=>true,'showRefreshButton'=>true)); ?><br />
		<?php echo $form->textField($model,'verifyCode', array('title'=>'请输入上面显示的登录验证码', 'class'=>'poshy')); ?>
		</div>
		<div class="hint">请输入上面图片所示的字母
		<br/>不区分大小写。</div>
		<?php echo $form->error($model,'verifyCode'); ?>
	</div>
	<?php endif; ?>

	<div class="row agree">		
		<?php echo $form->checkBox($model,'agree', array('title'=>'同意我们的使用协议书', 'class'=>'poshy')); ?>
		<?php echo $form->labelEx($model,'agree'); ?>
		<?php echo $form->error($model,'agree'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('下一步',array('class'=>'button','style'=>'width:100px;height:30px;')); ?>
		<br />
		已有帐号，现在就	<?php echo CHtml::link('登录',$this->createUrl('/site/login'));?>！
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->