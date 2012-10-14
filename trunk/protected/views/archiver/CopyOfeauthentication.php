<!-- 此文件用于显示用户个人爱好相关资料 -->
<section class="span-19">
	<h4 class="span-14">真实资料<span class="ico ico_back"></span><a href="#archiver_authentication" class="more proedit">返回</a></h4>
	
	<div class="form">
	<div id="todo"></div>
	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'profile-form',
		'enableAjaxValidation'=>true,
	)); ?>
	
		<hr class="space" />
	
		<div id="authprocess">
			<ul>
				<li id="eauthentication"><a href="#archiver_eauthentication" >第一步：基本资料</a></li>
				<li id="eauthsecond"><a href="#archiver_eauthsecond">第二步：学历/工作</a></li>
				<li id="eauththird"><a href="#archiver_eauththird">第三步：真实形象</a></li>
				<li id="eauthfinish"><a href="#archiver_eauthfinish">完成</a></li>
			</ul>
		</div>
	
		<?php echo $form->errorSummary($model); ?>
		<hr class="space" />
		<br />
		<div class="row span-5">
			<?php echo $form->labelEx($model,'firstname'); ?>
			<?php echo $form->textField($model,'firstname',array('size'=>20,'maxlength'=>20,'class'=>'span-4 poshy','title'=>'您的中文姓氏')); ?>
			<?php echo $form->error($model,'firstname'); ?>
		</div>
	
	<div class="row span-5">
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
		
		<div class="row span-5">
			<?php echo $form->labelEx($model,'birth');?>
			<?php 
				$this->widget('zii.widgets.jui.CJuiDatePicker', array(
				    'name'=>'Profile[birth]',
					'id'=>'Profile_birth',
					'value'=>$model->birth,
					'model'=>$model,				
				    // additional javascript options for the date picker plugin
				    'options'=>array(
				        'showAnim'=>'fold',
						'changeMonth'=>true,
						'changeYear'=>true,
						'yearRange'=>"1978:{date('Y')}",
						'navigationAsDateFormat'=>true,
						'showMonthAfterYear'=>true,
						
				    ),
			//	    'theme'=>'base'
			//	    'language'=>'zh-CN',
				    'htmlOptions'=>array(
				    	'value'=>date('m/d/Y'),
			//	        'style'=>'height:20px;'
				    ),
				));
			?>
			<?php echo $form->error($model,'birth');?>
		</div>
		<div class="row span-4">
			<?php echo $form->labelEx($model,'calendar');?>
			<?php echo $form->dropDownList($model,'calendar',Profile::model()->generateCalendar(),array('class'=>'span-4 poshy','title'=>'选择历法'))?>
			<?php echo $form->error($model,'calendar');?>
		</div>
		<hr />
		<div class="span-8">
			<div class="row">
				<label>现居地</label>
				<span id="addressHolder"><?php echo Profile::model()->getUserAddress(Yii::app()->user->id);?></span>
				<?php echo $form->hiddenField($model,'addressdetail');?>
				<span><a href="<?php echo $this->createUrl('eaddress');?>" onclick="showAddress(this.href);return false;">修改</a></span>
				<br />
			</div>
			
			<hr class="space" />
			<div class="row">
				<label>家乡</label>
				<span id="homeAddressHolder"><?php echo Profile::model()->getUserHomeAddress(Yii::app()->user->id)?></span>
				<?php echo $form->hiddenField($model,'homeaddressdetail');?>
				<span><a href="<?php echo $this->createUrl('ehomeaddress');?>" onclick="showAddress(this.href);return false;">修改</a></span>
				<br />
			</div>
		</div>
		<div class="span-10 last" id="profileAddress"">		
		
		</div>		
		<hr />
		<hr class="space" />
		<div class="row clear buttons">
			<?php //echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'button','style'=>'width:100px;height:30px;')); ?>
			<?php  
			$url = $model->isNewRecord ? 'create':'updateprofile';
			echo CHtml::ajaxSubmitButton($model->isNewRecord ? 'Create' : '提交',CHtml::normalizeUrl(array($url,'render'=>true,'id'=>$model->id)),array('success'=>'js:function(html){addMessage(html);}'),array('class'=>'button','style'=>'width:100px;height:30px;'));
			?>
			&nbsp;&nbsp;
			<?php echo CHtml::link('下一步','javascript:void();', array('onclick'=>'nextStep();'));?>
			
		</div>
		<hr class="space" />
		<div class="span-6" style="height:auto;">
			<div id="StatusBar">
			</div>
		
			<div id="Notification">
			</div>
		</div>
	
	<?php $this->endWidget(); ?>
	
	</div><!-- form -->
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
	
	$actionid = $this->action->id;
	
	Yii::app()->clientScript->registerScript('archiver-form', "
	
	function addRegion(){
		$('#regionAdd').show();
	}
	
	function regionAdd(){
		if($('#regionField').val() != ''){			
		
			$.post('{$this->createUrl('/region/createregion')}',{'region':$('#regionField').val(),'pid':$('#lastInputRegion').val()},function(data){
				
				if(data == 'ok'){
					$('#regionNav a:last').trigger('click');
				}else{
					alert(data);
				}

				$('#regionField').val('');
				
			});
		}else{
			alert('地区名称不能为空');
		}
	}
	
	function showAddress(href)
	{
		$('#profileAddress').load(href);
		return false;
	}
	
	function addMessage(data)
	{
	    $('#StatusBar').jnotifyAddMessage({
	        text: data,
	        permanent: false,
	        type: 'error',
	        showIcon: false
	    });	    
	     
	}
	function nextStep()
	{
		location.href='#archiver_eauthsecond';
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
	
		
//	function addRegion()
//	{
//		alert('KKKK');
//	
//	  	$.fancybox({
//  	  		'overlayShow':false,
//			'transitionIn':'elastic',
//			'transitionOut':'elastic',
//			'href' : '#regionField'
//		});
//	}
	
	   		

	$('#Profile_village').chosen().change(function(){

		$('#Profile_address,#Profile_areatype').parent().hide();
	});

	updateRegion('province', 'manicipal');
	
	updateRegion('manicipal', 'county');

	updateRegion('county', 'village');
	
	
	updateRegion('homeprovince', 'homemanicipal');
	
	updateRegion('homemanicipal', 'homecounty');

	updateRegion('homecounty', 'homevillage');
	
	url = location.href;
	
	url = url.replace(/^.*#/, ''); 
	
	$('#authprocess ul>li').each(function(i){
	
//		alert($(this).attr('id'));
//		alert('{$actionid}');
		if($(this).attr('id') == '{$actionid}')
		{
//			$(this).slibings().removeClass('active');
			$(this).addClass('active');
		}
	});
	
");
?>