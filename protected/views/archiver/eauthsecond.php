<!-- 此文件用于显示用户个人爱好相关资料 -->
<section class="span-18">
<h4 class="span-14">真实资料<span class="ico ico_back"></span><a href="#archiver_authentication" class="more proedit">返回</a></h4>

<div class="form">

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
	<div class="span-9">

		<div class="row">
			<?php echo $form->labelEx($model,'primaryschool'); ?>
			<span id="primaryHolder"><?php echo College::model()->getCollegeName($model->primaryschool);?></span>
			<?php echo $form->hiddenField($model,'primaryschool',array('size'=>20,'maxlength'=>20,'class'=>'span-9 poshy','title'=>'您就读的小学')); ?>
			<span><a href="<?php echo $this->createUrl('eprimary');?>" id="cprimary" onclick="showAddress(this.href);return false;">修改</a></span>
			<?php echo $form->error($model,'primaryschool'); ?>
		</div>
		<hr class="space" />
		<div class="row">
			<?php echo $form->labelEx($model,'middleschool'); ?>
			<span id="middleschoolHolder"><?php echo College::model()->getCollegeName($model->middleschool);?></span>
			<?php echo $form->hiddenField($model,'middleschool',array('size'=>20,'maxlength'=>20,'class'=>'span-9 poshy','title'=>'您就读的初中')); ?>
			<span><a href="<?php echo $this->createUrl('emiddelschool');?>" id="cmiddleschool" onclick="showAddress(this.href);return false;">修改</a></span>


			<?php echo $form->error($model,'middleschool'); ?>
		</div>
		<hr class="space" />
		<div class="row">
			<?php echo $form->labelEx($model,'highschool'); ?>
			<span id="highschoolHolder"><?php echo College::model()->getCollegeName($model->highschool);?></span>
			<?php echo $form->hiddenField($model,'highschool',array('size'=>20,'maxlength'=>20,'class'=>'span-9 poshy','title'=>'您就读的高中')); ?>
			<span><a href="<?php echo $this->createUrl('ehighschool');?>" id="chighschool" onclick="showAddress(this.href);return false;">修改</a></span>
			<?php echo $form->error($model,'highschool'); ?>
		</div>
		<hr class="space" />
		<div class="row">
			<?php echo $form->labelEx($model,'university'); ?>
			<span id="universityHolder"><?php echo College::model()->getCollegeName($model->university);?></span>
			<?php echo $form->hiddenField($model,'university',array('size'=>20,'maxlength'=>20,'class'=>'span-9 poshy','title'=>'您就读的大学')); ?>
			<span><a href="<?php echo $this->createUrl('euniversity');?>" id="cuniversity" onclick="showAddress(this.href);return false;">修改</a></span>
			<?php echo $form->error($model,'university'); ?>
		</div>
		<hr class="space" />	
		<div class="row">
			<?php echo $form->labelEx($model,'job'); ?>
			<span id="jobHolder"><?php echo Job::model()->getJobName($model->job);?></span>
			<?php echo $form->hiddenField($model,'job',array('size'=>20,'maxlength'=>20,'class'=>'span-9 poshy','title'=>'你的职业')); ?>
			<span><a href="<?php echo $this->createUrl('ejob');?>" id="cjob" onclick="showAddress(this.href);return false;">修改</a></span>
			<?php echo $form->error($model,'job'); ?>
		</div>
		<hr class="space" />	
		<div class="row">
			<?php echo $form->labelEx($model,'companyname'); ?>
			<?php echo $form->textField($model,'companyname',array('size'=>20,'maxlength'=>20,'class'=>'span-9 poshy','title'=>'您所在公司的名称')); ?>
			<?php echo $form->error($model,'companyname'); ?>
		</div>
		<hr class="space" />
		<div class="row">
			<?php echo $form->labelEx($model,'companyaddress'); ?>
			<?php echo $form->textField($model,'companyaddress',array('size'=>20,'maxlength'=>20,'class'=>'span-9 poshy','title'=>'您的中文姓氏')); ?>
			<?php echo $form->error($model,'companyaddress'); ?>
		</div>
		<hr class="space" />
	
		<div class="row clear buttons">
			<?php //echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'button','style'=>'width:100px;height:30px;')); ?>
			<?php  
			$url = $model->isNewRecord ? 'create':'updateprofile';
			echo CHtml::ajaxSubmitButton($model->isNewRecord ? 'Create' : '下一步',CHtml::normalizeUrl(array($url,'render'=>true,'id'=>$model->id)),array('success'=>'js:function(html){addMessage(html);}'),array('class'=>'button','style'=>'width:100px;height:30px;'));
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
	</div>
	<div class="span-9" id="profileAddress">
	此处显示学校相关信息
	</div>


<?php $this->endWidget(); ?>

</div><!-- form -->

</section>
<hr class="space" />
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

		function collegeAdd(){
		if($('#schoolField').val() != ''){			
		
			$.post('{$this->createUrl('/college/createcollege')}',{'name':$('#schoolField').val(),'type':$('#schoolType').val(),'province':$('#lastInputRegion').val()},function(data){
				
				if(data == 'ok'){
					$('#regionNav a:eq(1)').trigger('click');
				}else{
					alert(data);
				}

				$('#schoolField').val('');
				
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
		location.href='#archiver_eauththird';
	}
	
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

