<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'advertisement-form',
	'action' => $this->createUrl('/info/create'),
	'enableAjaxValidation'=>true,
)); ?>

	<?php echo $form->errorSummary($model); ?>
	<div class="row span-11">
		<?php echo $form->textField($model,'title',array('class'=>'poshy','style'=>'width:917px;height:40px;font-size:32px;color:grey;border:0;border-bottom:1px solid #e8e8e8;text-align:center;','title'=>'在这里填写广告标题')); ?>
	</div>
	<hr class="space" />
	<div class="row">
		<!--style给定宽度可以影响编辑器的最终宽度-->
		<script type="text/plain" id="myEditor" style="width:100%">
		<?php echo $model->content; ?>
		</script>
		<?php //echo $form->textArea($model,'content'); ?>
		<?php //echo $form->error($model,'content'); ?>
	</div>
	<br />
	<hr class="space" />
	<div class="row">	
		<span class="left rowPadding" >广告标签：</span>
		<?php echo $form->textField($model,'tag',array('title'=>'广告标签','class'=>'left poshy span-8')); ?>
		<span class="left rowPadding"><a href="javascript:void();" onclick="getTags();">获取标签</a></span>
		<?php echo $form->error($model,'tag');?>
	</div>	
	<hr class="space" />
	<div class="row">	
		<span class="left">选择分类：</span><a href="javascript:void();" onclick="showChannels();">选择</a>
		<span id="categoryVal"><?php echo Channel::model()->parentString($model->cid);?></span>
	</div>

	<div class="row">
		<?php echo $form->hiddenField($model,'cid',array('title'=>'广告分类')); ?>
		<?php echo $form->error($model,'cid'); ?>
	</div>
	

	
	<div class="row">	
	<span class="right" onclick="$('#moreSetting').slideToggle();">更多设置</span>
	<hr />
	</div>
	<div class="row span-24 hide" id="moreSetting">
		<div class="row span-6">
			<?php echo $form->labelEx($model,'start'); ?>
			<?php echo $form->textField($model,'start',array('value'=>date('m/d/Y'),'class'=>'span-5 poshy','title'=>'广告投放开始时间')); ?>
			<?php echo $form->error($model,'start',array('class'=>'clear','style'=>'color:red;')); ?>
		</div>
	
		<div class="row span-5">
			<?php echo $form->labelEx($model,'end'); ?>
			<?php echo $form->textField($model,'end',array('value'=>date('m/d/Y'),'class'=>'span-5 poshy','title'=>'广告投放结束时间')); ?>		
			<?php echo $form->error($model,'end'); ?>
		</div>	
		<hr class="space" />
		<div class="row span-6">
			<?php echo $form->labelEx($model,'phone'); ?>
			<?php echo $form->textField($model,'phone',array('value'=>Profile::model()->getProfileModel(Yii::app()->user->id)->phone,'size'=>50,'maxlength'=>50,'class'=>'span-5 poshy','title'=>'联系人手机号码')); ?>
			<?php echo $form->error($model,'phone',array('class'=>'clear','style'=>'color:red;')); ?>
		</div>
	
		<div class="row span-5">
			<?php echo $form->labelEx($model,'adusername'); ?>
			<?php echo $form->textField($model,'adusername',array('value'=>Profile::model()->getUserTrueName(Yii::app()->user->id),'size'=>50,'maxlength'=>50,'class'=>'span-5 poshy','title'=>'联系人，请使用真实姓名')); ?>
			<?php echo $form->error($model,'adusername'); ?>
		</div>
		<hr class="space" />
		
		<div class="row span-11">
			<?php echo $form->labelEx($model,'address'); ?>
			<?php echo $form->textField($model,'address',array('size'=>60,'maxlength'=>250,'class'=>'span-11 poshy' ,'title'=>'广告宣传地址')); ?>
			<?php echo $form->error($model,'address'); ?>
		</div>
	</div>
	
	<div class="row span-8">
		<div style="height:auto;">
			<div id="StatusBar">
			</div>
		
			<div id="Notification">
			</div>
		</div>
	</div>
	<hr class="space" />

	<div class="row buttons span-11">
		<?php echo CHtml::Button($model->isNewRecord ? '发表' : '保存',array('class'=>'button','onclick'=>'submitInfo();','style'=>'width:80px;height:30px;')); ?>
		<?php  
		$url = $model->isNewRecord ? '/info/create':'/info/update';
		//echo CHtml::ajaxSubmitButton($model->isNewRecord ? '发表' : '保存',CHtml::normalizeUrl(array($url,'render'=>true,'id'=>$model->id)),array('success'=>'js:function(html){addMessage(html);}'),array('onclick'=>'getContent()','class'=>'button','style'=>'width:100px;height:30px;'));
		?>
	</div> 


<?php $this->endWidget(); ?>

</div><!-- form -->
<?php 
	
	  $this->widget('zii.widgets.jui.CJuiDatePicker', array(
	     'name'=>'Advertisement_start,#Advertisement_end',
		 // additional javascript options for the date picker plugin
		 'options'=>array(
			'showAnim'=>'drop',
	  		'defaultDate' => '+1w',
	  		'numberOfMonths' => 3,
	  		'monthNamesShort' => array('一','二','三','四','五','六','七','八','九','十','十一','十二'),
		 ),
		 'htmlOptions'=>array(
		 	'class'=>'hide'
		 )

	 ));


	$this->widget('ext.editor.ueditor.ueditorWidget',array(
			'id'=>'myEditor',
			'initialContent' => '<span style="color:#ccc">欢迎使用ueditor</span>',
			'initialStyle' => 'body{margin:8px;font-family:"宋体";font-size:16px;}',
			'elementPathEnabled' => true,
			'minFrameHeight' => 300,
//			'autoClearinitialContent' => true,
			'imagePath' => '/',
			'textarea' => 'content',

			'autoHeightEnabled' => true,
	//		'toolbars'=>array(array('Undo','Redo','|','ForeColor','BackColor', 'Bold','Italic','Underline','JustifyLeft','JustifyCenter','JustifyRight','InsertImage','ImageNone','ImageLeft','ImageRight','ImageCenter' )),
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
    
//    $this->widget('ext.syntaxhighlighter.syntaxhighlighterWidget');
    
    $this->widget('ext.chosen.chosenWidget');
    
    // Initialize the extension
	$this->widget('ext.jnotify.JNotify', array(
		'statusBarId'=>'StatusBar',
		'notificationId'=>'Notification',
		'notificationHSpace'=>'30px',	
		'notificationWidth'=>'280px',
		'notificationShowAt'=>'topRight',
//		'notificationShowAt'=>'bottomLeft',
//		'notificationAppendType'=>'prepend',
	));
    Yii::app()->clientScript->registerScript('advertisement-form', "
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