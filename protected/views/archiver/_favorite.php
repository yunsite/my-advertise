<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'profile-favorite-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'uid'); ?>
		<?php echo $form->textField($model,'uid'); ?>
		<?php echo $form->error($model,'uid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'gender'); ?>
		<?php echo $form->textField($model,'gender'); ?>
		<?php echo $form->error($model,'gender'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'birthyear'); ?>
		<?php echo $form->textField($model,'birthyear'); ?>
		<?php echo $form->error($model,'birthyear'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'birthmonth'); ?>
		<?php echo $form->textField($model,'birthmonth'); ?>
		<?php echo $form->error($model,'birthmonth'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'birthday'); ?>
		<?php echo $form->textField($model,'birthday'); ?>
		<?php echo $form->error($model,'birthday'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'marry'); ?>
		<?php echo $form->textField($model,'marry'); ?>
		<?php echo $form->error($model,'marry'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'qq'); ?>
		<?php echo $form->textField($model,'qq'); ?>
		<?php echo $form->error($model,'qq'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'firstname'); ?>
		<?php echo $form->textField($model,'firstname'); ?>
		<?php echo $form->error($model,'firstname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'lastname'); ?>
		<?php echo $form->textField($model,'lastname'); ?>
		<?php echo $form->error($model,'lastname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'phone'); ?>
		<?php echo $form->textField($model,'phone'); ?>
		<?php echo $form->error($model,'phone'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'country'); ?>
		<?php echo $form->textField($model,'country'); ?>
		<?php echo $form->error($model,'country'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'province'); ?>
		<?php echo $form->textField($model,'province'); ?>
		<?php echo $form->error($model,'province'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'manicipal'); ?>
		<?php echo $form->textField($model,'manicipal'); ?>
		<?php echo $form->error($model,'manicipal'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'village'); ?>
		<?php echo $form->textField($model,'village'); ?>
		<?php echo $form->error($model,'village'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'county'); ?>
		<?php echo $form->textField($model,'county'); ?>
		<?php echo $form->error($model,'county'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email'); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'alipay'); ?>
		<?php echo $form->textField($model,'alipay'); ?>
		<?php echo $form->error($model,'alipay'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'job'); ?>
		<?php echo $form->textField($model,'job'); ?>
		<?php echo $form->error($model,'job'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'companyaddress'); ?>
		<?php echo $form->textField($model,'companyaddress'); ?>
		<?php echo $form->error($model,'companyaddress'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'favoriteStar'); ?>
		<?php echo $form->textField($model,'favoriteStar'); ?>
		<?php echo $form->error($model,'favoriteStar'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'favoriteFood'); ?>
		<?php echo $form->textField($model,'favoriteFood'); ?>
		<?php echo $form->error($model,'favoriteFood'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'favoriteMusic'); ?>
		<?php echo $form->textField($model,'favoriteMusic'); ?>
		<?php echo $form->error($model,'favoriteMusic'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'favoriteMovie'); ?>
		<?php echo $form->textField($model,'favoriteMovie'); ?>
		<?php echo $form->error($model,'favoriteMovie'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'favoriteGames'); ?>
		<?php echo $form->textField($model,'favoriteGames'); ?>
		<?php echo $form->error($model,'favoriteGames'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'favoriteSports'); ?>
		<?php echo $form->textField($model,'favoriteSports'); ?>
		<?php echo $form->error($model,'favoriteSports'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'favoriteBooks'); ?>
		<?php echo $form->textField($model,'favoriteBooks'); ?>
		<?php echo $form->error($model,'favoriteBooks'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'favoriteTourism'); ?>
		<?php echo $form->textField($model,'favoriteTourism'); ?>
		<?php echo $form->error($model,'favoriteTourism'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'favoriteDigital'); ?>
		<?php echo $form->textField($model,'favoriteDigital'); ?>
		<?php echo $form->error($model,'favoriteDigital'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'favoriteOther'); ?>
		<?php echo $form->textField($model,'favoriteOther'); ?>
		<?php echo $form->error($model,'favoriteOther'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'companyname'); ?>
		<?php echo $form->textField($model,'companyname'); ?>
		<?php echo $form->error($model,'companyname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'primaryschool'); ?>
		<?php echo $form->textField($model,'primaryschool'); ?>
		<?php echo $form->error($model,'primaryschool'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'middelshool'); ?>
		<?php echo $form->textField($model,'middelshool'); ?>
		<?php echo $form->error($model,'middelshool'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'highschool'); ?>
		<?php echo $form->textField($model,'highschool'); ?>
		<?php echo $form->error($model,'highschool'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'university'); ?>
		<?php echo $form->textField($model,'university'); ?>
		<?php echo $form->error($model,'university'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'address'); ?>
		<?php echo $form->textField($model,'address'); ?>
		<?php echo $form->error($model,'address'); ?>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->