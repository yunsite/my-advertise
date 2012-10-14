<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'style-form',
	'enableAjaxValidation'=>true,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>50,'maxlength'=>50,'class'=>'span-8 poshy','title'=>'主题名称')); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>
    <hr />
	<div class="row">
		<?php echo $form->labelEx($model,'code'); ?>
		<?php echo $form->textArea($model,'code',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'code'); ?>
	</div>
    
	<div class="row">
		<?php echo $form->labelEx($model,'template'); ?>
		<?php echo $form->textField($model,'template'); ?>
		<?php echo $form->error($model,'template'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>
    <textarea id="Style_code2"></textarea>
<?php $this->endWidget(); ?>

</div><!-- form -->
<?php
    $this->widget('ext.editor.CodeMirror.CodeMirrorWidget',array(
        'id'=>'Style_code',
        'editor'=>'codeeditor',
        'mode'=>'css',
        'lineNumbers'=> true,
        'theme'=>'lesser-dark',
        'syntax'=>'css',
        'onChange'=>'js:function(){
              //实时预览样式
              performceHtml();
        }',
        
    ));
    
   $this->widget('ext.editor.CodeMirror.CodeMirrorWidget',array(
        'id'=>'Style_code2',
        'editor'=>'codeeditor2',
        'mode'=>'css',
        'lineNumbers'=> true,
        'theme'=>'lesser-dark',
        'syntax'=>'css',
        'onChange'=>'js:function(){
              //实时预览样式
              performceHtml();
        }',
        
    ));
    
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
?>
