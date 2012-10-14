<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'region-form',
	'action'=>$this->createUrl('/region/create'),
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
	<div class="row span-6" id="province">
		<?php echo $form->labelEx($model, 'province');?>
		<?php echo $form->dropDownList($model,'province',Region::model()->generateProvince(0),array('class'=>'span-5')); ?>
		<?php echo $form->error($model,'province'); ?>	
	</div>
	
	<div class="row span-5 hide" id="manicipal">
		<?php echo $form->labelEx($model, 'manicipal');?>
		<?php echo $form->dropDownList($model,'manicipal',array(),array('class'=>'span-5')); ?>
		<?php echo $form->error($model,'manicipal'); ?>	
	</div>

	<div class="row span-6 hide" id="county">
		<?php echo $form->labelEx($model, 'county');?>
		<?php echo $form->dropDownList($model,'county',array(),array('class'=>'span-5')); ?>
		<?php echo $form->error($model,'county'); ?>	
	</div>		

	<div class="row span-5 hide" id="village">
		<?php echo $form->labelEx($model, 'village');?>
		<?php echo $form->dropDownList($model,'village',array(),array('class'=>'span-5')); ?>
		<?php echo $form->error($model,'village'); ?>	
	</div>
	
	<hr />
	
	<div class="hint">如果上面没有您所在地区的信息，请自己填写，注意您所填地区的地区级别</div>
	
	
	<div class="row span-6 hide" id="areatype">
		<?php echo $form->labelEx($model, 'areatype');?>
		<?php echo $form->dropDownList($model, 'areatype',Region::model()->generateRegionType(),array('class'=>'span-5'));?>
		<?php echo $form->error($model, 'areatype');?>	
	</div>
	
	<div class="row span-5 hide"  id="region">
		<?php echo $form->labelEx($model,'region'); ?>
		<?php echo $form->textField($model,'region',array('size'=>50,'maxlength'=>50,'class'=>'span-5 poshy','title'=>'填写县市相关信息')); ?>
		<?php echo $form->error($model,'region'); ?>
	</div>
	


	<div class="row buttons clear">
		<?php //echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('style'=>'width:100px;height:30px;','class'=>"button")); ?>
		<?php 
		$url = $model->isNewRecord ? 'region/create':'region/update';
		echo CHtml::ajaxSubmitButton($model->isNewRecord ? 'Create' : 'Save',CHtml::normalizeUrl(array($url,'render'=>true,'id'=>$model->id)),array('success'=>'js:function(html){addMessage(html);}'),array('class'=>'button','style'=>'width:100px;height:30px;'));
		?>

	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<script type="text/javascript">
<!--
function updateRegion(source,destination)
{

	$("#Region_village").chosen().change(function(){

			$("#Region_region,#Region_areatype").parent().hide();
	});
	
	$("#Region_"+source).chosen().change(function(){

		$("#region").show();
		$("#areatype").show();


		
		$.getJSON("<?php echo $this->createUrl('/remote/region');?>",{'id':$(this).val()},function(msg){

			var pid = document.getElementById("Region_"+destination);

			//清除所有已有选项
			while(pid.childNodes.length>0){
				pid.removeChild(pid.childNodes[0]);
			}
			$.each(msg,function(k,v){
//				dd += (k+v);

				
				var option = new Option(v,k);
				pid.options.add(option);
			});

			$("#"+destination).show();

			$("#Region_"+destination).trigger("liszt:updated");
			
		});	

		
	});
	
}


$(function(){
	
	updateRegion('province', 'manicipal');
	
	updateRegion('manicipal', 'county');

	updateRegion('county', 'village');
	
	$("select").chosen();
	$('.poshy').poshytip({"className":"tip-yellowsimple","showOn":"focus","alignTo":"target","alignX":"right","alignY":"center","offsetX":5});
});
//-->
</script>
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
