<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'profile-_form-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
	
		<div class="row span-5">
		<?php echo $form->labelEx($model,'firstname'); ?>
		<?php echo $form->textField($model,'firstname',array('size'=>20,'maxlength'=>20,'class'=>'span-4 poshy','title'=>'您的中文姓氏')); ?>
		<?php echo $form->error($model,'firstname'); ?>
	</div>

	<div class="row span-4">
		<?php echo $form->labelEx($model,'lastname'); ?>
		<?php echo $form->textField($model,'lastname',array('size'=>50,'maxlength'=>50,'class'=>'span-4 poshy','title'=>'您的中文名字')); ?>
		<?php echo $form->error($model,'lastname'); ?>
	</div>
	
		<div class="row">
		<?php echo $form->labelEx($model,'gender'); ?>
		<?php echo $form->dropDownList($model,'gender',Profile::model()->generateGenderList(),array('class'=>'span-9')); ?>
		<?php echo $form->error($model,'gender'); ?>
	</div>

	<div class="row span-3">
		<?php echo $form->labelEx($model,'birthmonth'); ?>
		<?php echo $form->dropDownList($model,'birthmonth',Profile::model()->generateMonth(),array('class'=>'span-2')); ?>
		<?php echo $form->error($model,'birthmonth'); ?>
	</div>

	<div class="row span-3">
		<?php echo $form->labelEx($model,'birthday'); ?>
		<?php echo $form->dropDownList($model,'birthday',Profile::model()->generateDay(),array('class'=>'span-2')); ?>
		<?php echo $form->error($model,'birthday'); ?>
	</div>
	
	<div class="row span-3">
		<?php echo $form->labelEx($model,'birthyear'); ?>
		<?php echo $form->dropDownList($model,'birthyear',Profile::model()->generateYear(),array('class'=>'span-3')); ?>
		<?php echo $form->error($model,'birthyear'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>100,'class'=>'span-9')); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'phone'); ?>
		<?php echo $form->textField($model,'phone',array('size'=>50,'maxlength'=>50,'class'=>'span-9')); ?>
		<?php echo $form->error($model,'phone'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'qq'); ?>
		<?php echo $form->textField($model,'qq',array('class'=>'span-9')); ?>
		<?php echo $form->error($model,'qq'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'alipay'); ?>
		<?php echo $form->textField($model,'alipay',array('size'=>60,'maxlength'=>100,'class'=>'span-9')); ?>
		<?php echo $form->error($model,'alipay'); ?>
	</div>
	
	<div class="row span-3 hide">
		<?php echo $form->labelEx($model,'country'); ?>
		<?php echo $form->textField($model,'country',array('size'=>50,'maxlength'=>50,'class'=>'span-2','value'=>'中国')); ?>
		<?php echo $form->error($model,'country'); ?>
	</div>

	<div class="row span-5">
		<?php echo $form->labelEx($model,'province'); ?>
		<?php echo $form->dropDownList($model,'province',Region::model()->generateProvince(0),array('class'=>'span-4')); ?>
		<?php echo $form->error($model,'province'); ?>
	</div>
	
	<div class="row span-4">
		<?php echo $form->labelEx($model,'manicipal'); ?>
		<?php echo $form->dropDownList($model,'manicipal',array(),array('class'=>'span-4')); ?>
		<?php echo $form->error($model,'manicipal'); ?>
	</div>

	<div class="row span-5">
		<?php echo $form->labelEx($model,'county'); ?>
		<?php echo $form->dropDownList($model,'county',array(), array('class'=>'span-4')); ?>
		<?php echo $form->error($model,'county'); ?>
	</div>
	
	<div class="row span-4">
		<?php echo $form->labelEx($model,'village'); ?>
		<?php echo $form->dropDownList($model,'village',array(),array('class'=>'span-4')); ?>
		<?php echo $form->error($model,'village'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'address'); ?>
		<?php echo $form->textField($model,'address',array('size'=>60,'maxlength'=>200,'class'=>'span-9')); ?>
		<?php echo $form->error($model,'address'); ?>
		<div class="hint">注：如果上面的选项中没有您所在的村落，请自行在上面的填写</div>
	</div>
	
	

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'button','style'=>'width:100px;height:30px;')); ?>
	</div>


<?php $this->endWidget(); ?>

</div><!-- form -->