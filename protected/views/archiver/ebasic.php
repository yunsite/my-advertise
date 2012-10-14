<!-- 此文件用于显示用户个人基本资料 -->
<style type="text/css">

</style>
<section class="span-14">
<h4 class="span-14">个人基本资料<span class="ico ico_back"></span><a href="#archiver_basic" class="more proedit">返回</a></h4>

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
	<hr class="space" />
	<div class="row span-9">
		<?php echo $form->labelEx($model,'nickName'); ?>
		<?php echo $form->textField($model,'nickName',array('size'=>50,'maxlength'=>50,'class'=>'span-9 poshy','title'=>'您的昵称')); ?>
		<?php echo $form->error($model,'nickName'); ?>
	</div>
	<hr class="space"/>
	<div class="row">
		<?php echo $form->labelEx($model,'gender'); ?>
		<?php echo $form->dropDownList($model,'gender',Profile::model()->generateGenderList(),array('class'=>'span-4  poshy','title'=>'您的性别')); ?>
		<?php echo $form->error($model,'gender'); ?>
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
<section class="span-5 last">
	<?php $this->widget('ext.sidebar.sidebarWidget',array('view'=>'profileinfo'));?>
</section>

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
function updateRegion(source,destination)
{
	$('#Profile_'+source).chosen().change(function(){

		$('#address').show();
		$('#areatype').show();
		
		
		$.getJSON('{$regionUrl}',{'id':$(this).val()},function(msg){

			var pid = document.getElementById('Profile_'+destination);

			//清除所有已有选项
			while(pid.childNodes.length>0){
				pid.removeChild(pid.childNodes[0]);
			}
			$.each(msg,function(k,v){
//				dd += (k+v);

				
				var option = new Option(v,k);
				pid.options.add(option);
			});

			$('#'+destination).show();
			
			$('#Profile_'+destination).trigger('liszt:updated');
			
		});	

		
	});
}

	$('#Profile_village').chosen().change(function(){

		$('#Profile_address,#Profile_areatype').parent().hide();
	});

	updateRegion('province', 'manicipal');
	
	updateRegion('manicipal', 'county');

	updateRegion('county', 'village');
	
	
	updateRegion('homeprovince', 'homemanicipal');
	
	updateRegion('homemanicipal', 'homecounty');

	updateRegion('homecounty', 'homevillage');
	
	
");

?>