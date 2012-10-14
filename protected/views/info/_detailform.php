	<div class="row span-6">
		<?php echo $form->labelEx($model,'start'); ?>
		<?php echo $form->textField($model,'start',array('class'=>'span-5 poshy','title'=>'广告投放开始时间')); ?>
		<?php echo $form->error($model,'start',array('class'=>'clear','style'=>'color:red;')); ?>
	</div>

	<div class="row span-5">
		<?php echo $form->labelEx($model,'end'); ?>
		<?php echo $form->textField($model,'end',array('class'=>'span-5 poshy','title'=>'广告投放结束时间')); ?>		
		<?php echo $form->error($model,'end'); ?>
	</div>

	<div class="row span-11">
		<?php echo $form->labelEx($model,'address'); ?>
		<?php echo $form->textField($model,'address',array('size'=>60,'maxlength'=>250,'class'=>'span-11 poshy' ,'title'=>'广告宣传地址')); ?>
		<?php echo $form->error($model,'address'); ?>
	</div>

	<div class="row span-6">
		<?php echo $form->labelEx($model,'phone'); ?>
		<?php echo $form->textField($model,'phone',array('size'=>50,'maxlength'=>50,'class'=>'span-5 poshy','title'=>'联系人手机号码')); ?>
		<?php echo $form->error($model,'phone',array('class'=>'clear','style'=>'color:red;')); ?>
	</div>

	<div class="row span-5">
		<?php echo $form->labelEx($model,'adusername'); ?>
		<?php echo $form->textField($model,'adusername',array('size'=>50,'maxlength'=>50,'class'=>'span-5 poshy','title'=>'联系人，请使用真实姓名')); ?>
		<?php echo $form->error($model,'adusername'); ?>
	</div>

	<div class="row span-11">
		<?php echo $form->labelEx($model,'price'); ?>
		<?php echo $form->textField($model,'price',array('size'=>10,'maxlength'=>10,'class'=>'span-5 poshy','title'=>'支付的广告费用')); ?>
		<?php echo $form->error($model,'price'); ?>
	</div>
