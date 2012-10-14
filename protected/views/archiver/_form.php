<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'profile-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
	<div style="height:auto;">
		<div id="StatusBar">
		</div>
	
		<div id="Notification">
		</div>
	</div>
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
		<?php echo $form->dropDownList($model,'gender',Profile::model()->generateGenderList(),array('class'=>'span-9  poshy','title'=>'您的性别')); ?>
		<?php echo $form->error($model,'gender'); ?>
	</div>

	<div class="row span-3">
		<?php echo $form->labelEx($model,'birthmonth'); ?>
		<?php echo $form->dropDownList($model,'birthmonth',Profile::model()->generateMonth(),array('class'=>'span-2  poshy','title'=>'您的出生月份')); ?>
		<?php echo $form->error($model,'birthmonth'); ?>
	</div>

	<div class="row span-3">
		<?php echo $form->labelEx($model,'birthday'); ?>
		<?php echo $form->dropDownList($model,'birthday',Profile::model()->generateDay(),array('class'=>'span-2  poshy','title'=>'您的出生日')); ?>
		<?php echo $form->error($model,'birthday'); ?>
	</div>
	
	<div class="row span-3">
		<?php echo $form->labelEx($model,'birthyear'); ?>
		<?php echo $form->dropDownList($model,'birthyear',Profile::model()->generateYear(),array('class'=>'span-3  poshy','title'=>'您的出生年份')); ?>
		<?php echo $form->error($model,'birthyear'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>100,'class'=>'span-9  poshy','title'=>'您的常用电子邮箱')); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'phone'); ?>
		<?php echo $form->textField($model,'phone',array('size'=>50,'maxlength'=>50,'class'=>'span-9  poshy','title'=>'您的手机号码')); ?>
		<?php echo $form->error($model,'phone'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'qq'); ?>
		<?php echo $form->textField($model,'qq',array('class'=>'span-9 poshy','title'=>'您的QQ号码')); ?>
		<?php echo $form->error($model,'qq'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'alipay'); ?>
		<?php echo $form->textField($model,'alipay',array('size'=>60,'maxlength'=>100,'class'=>'span-9  poshy','title'=>'您的支付宝帐号')); ?>
		<?php echo $form->error($model,'alipay'); ?>
	</div>
	
	<div class="row span-3 hide">
		<?php echo $form->labelEx($model,'country'); ?>
		<?php echo $form->textField($model,'country',array('size'=>50,'maxlength'=>50,'class'=>'span-2  poshy','value'=>'中国','title'=>'您的国家')); ?>
		<?php echo $form->error($model,'country'); ?>
	</div>

	<div class="row span-5" id="province">
		<?php echo $form->labelEx($model,'province'); ?>
		<?php echo $form->dropDownList($model,'province',Region::model()->generateProvince(0),array('class'=>'span-4  poshy','title'=>'你所在省份')); ?>
		<?php echo $form->error($model,'province'); ?>
	</div>
	
	<div class="row span-4 hide" id="manicipal">
		<?php echo $form->labelEx($model,'manicipal'); ?>
		<?php echo $form->dropDownList($model,'manicipal',array(),array('class'=>'span-4  poshy','title'=>'您所在地所属的市')); ?>
		<?php echo $form->error($model,'manicipal'); ?>
	</div>

	<div class="row span-5 hide" id="county">
		<?php echo $form->labelEx($model,'county'); ?>
		<?php echo $form->dropDownList($model,'county',array(), array('class'=>'span-4  poshy','title'=>'您所在地是什么县')); ?>
		<?php echo $form->error($model,'county'); ?>
	</div>
	
	<div class="row span-4 hide" id="village">
		<?php echo $form->labelEx($model,'village'); ?>
		<?php echo $form->dropDownList($model,'village',array(),array('class'=>'span-4  poshy','title'=>'您所在地是什么镇（乡，区）')); ?>
		<?php echo $form->error($model,'village'); ?>
	</div>
	
	<div class="span-9 hint">注：如果上面的选项中没有您所在的村落，请自行在上面的填写,先选择您所填地区的级别</div>

	<div class="row span-4 hide" id="areatype">
		<?php echo $form->labelEx($model,'areatype'); ?>
		<?php echo $form->dropDownList($model,'areatype',Region::model()->generateRegionType(),array('class'=>'span-3  poshy','title'=>'选择您要添加地的地区类型')); ?>
		<?php echo $form->error($model,'areatype'); ?>
	</div>
		
	<div class="row span-5 hide" id="address">
		<?php echo $form->labelEx($model,'address'); ?>
		<?php echo $form->textField($model,'address',array('size'=>60,'maxlength'=>200,'class'=>'span-5  poshy','title'=>'如果上面的所有选项没有您所在地的信息，请自己增加')); ?>
		<?php echo $form->error($model,'address'); ?>
		
	</div>
	
	

	<div class="row clear buttons">
		<?php //echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'button','style'=>'width:100px;height:30px;')); ?>
		<?php  
		$url = $model->isNewRecord ? 'create':'profile';
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
	
	
");

?>
