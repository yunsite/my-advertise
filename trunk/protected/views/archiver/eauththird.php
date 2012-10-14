<!-- 此文件用于显示用户个人爱好相关资料 -->
<section class="span-18">
<h4 class="span-14">真实资料<span class="ico ico_back"></span><a href="#archiver_authentication" class="more proedit">返回</a></h4>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'profile-form',
	'enableAjaxValidation'=>true,
)); ?>

<?php 	

	$cookie = Yii::app()->getRequest()->getCookies();
	
	$filename = '/public/images/head_crop.png';
	
	$id = null;
	
//	unset($cookie['upload']);
	
//	UtilHelper::dump($_COOKIE);
	
	if (isset($cookie['upload']))
	{
		$id = $cookie['upload']->value;
		
//		$newModel = File::model()->findByPk($id);
		$newModel = File::model()->find(array(
			'condition'=>'uid = :uid AND id = :id',
			'params'=>array(
				':uid'=>Yii::app()->user->id,
				':id'=>$id
			)
		));
		$imgPath = File::model()->generateFileName($newModel, 'avatar',false);	
		
		if (file_exists('.'.$imgPath))
		{
			$filename = $imgPath;
			$id = $newModel->id;
		}	

//		$id = $cookie['upload']->value();
		
	}



?>
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
	<br />
	<hr class="space" />
	<div style="height:auto;">
		<div id="StatusBar">
		</div>	
		<div id="Notification">
		</div>
	</div>
	<hr class="space" />
	<div class="row">
		<div class="span-13">
		<br />
		
		<div class="center roundSection" style="border:2px solid #efefef;padding:5px;width:500px;">
			<img src="<?php echo $filename;?>" style="width:500px;" id="target" alt="Flowers" />
		</div>
		
		
			<input type="hidden" id="x" name="x" />
			<input type="hidden" id="y" name="y" />
			<input type="hidden" id="w" name="w" />
			<input type="hidden" id="h" name="h" />
			<input type="hidden" id="modelID" name="modelID" value="<?php echo $id;?>" />
			
			<hr class="space" />
			<br />
			
			<div class="section span-7" style="width:510px;">
				<ul class="tabs">
					<li class="current">选择已上传头像</li>
					<li onclick="loadUpload();">上传头像</li>
					
				</ul>
				<div class="box visible" id="loadAvatars">
					
				</div>			
				<div class="box" style="min-height:100px;">
					<div id="loadUpload" style="padding-top:15px;">

					</div>
				</div>			
			</div>			
		</div>
		<div class="span-4 right">
			头像预览
			<br />
			<div style="width:150px;height:150px;overflow:hidden;border:1px dashed #ee0000;">
				<img src="<?php echo $filename;?>" id="preview" alt="Preview" style="width:150px;" />
			</div>	
			<br />
			<input type="button" value="更换头像" class="button" style="height:30px;" onclick="checkCoords();"/>		
			<hr class="space" />
			当前头像
			<br />
			150*150：
			<div style="width:150px;height:150px;overflow:hidden;border:1px dashed #efefef;" class="roundSection">
				<?php echo Profile::model()->getUserAvatar(Yii::app()->user->id,array('id'=>'preview2'),150,'Preview');?>							
			</div>	
			60*60:
			<div style="width:60px;height:60px;overflow:hidden;border:1px dashed #efefef;" class="roundSection">
				<?php echo Profile::model()->getUserAvatar(Yii::app()->user->id,array('id'=>'preview3'),60,'Preview');?>							
			</div>
			30*30:
			<div style="width:30px;height:30px;overflow:hidden;border:1px dashed #efefef;" class="roundSection">
				<?php echo Profile::model()->getUserAvatar(Yii::app()->user->id,array('id'=>'preview4'),30,'Preview');?>							
			</div>	
		</div>
	</div>	

	<br />
	<hr class="space" />

	<div class="row clear buttons">
		<?php //echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'button','style'=>'width:100px;height:30px;')); ?>
		<?php  
		$url = $model->isNewRecord ? 'create':'updateprofile';
		echo CHtml::ajaxSubmitButton($model->isNewRecord ? 'Create' : '下一步',CHtml::normalizeUrl(array($url,'render'=>true,'id'=>$model->id)),array('success'=>'js:function(html){addMessage(html);}'),array('class'=>'button','style'=>'width:100px;height:30px;'));
		?>
	</div>

<?php $this->endWidget(); ?>
<div id="tte"></div>
</div><!-- form -->
</section>
<hr class="space" />
<?php 	
	
	$this->widget('ext.Jcrop.JcropWidget',array(
        'pre_width'=>150,
        'tar_width'=>500
    ));
	
	$regionUrl = $this->createUrl('/remote/region');
	
	$avatarUrl = $this->createUrl('/archiver/avatar');
	
	$loadAvartarsUrl = $this->createUrl('/file/avatars',array('uid'=>Yii::app()->user->id));
	
	$actionid = $this->action->id;
	
	Yii::app()->clientScript->registerCssFile('/public/css/tabs.css');
	
	Yii::app()->clientScript->registerScript('archiver-form', "
	
	/**Tabs**/	
	$('ul.tabs').each(function() {
		$(this).find('li').each(function(i) {
			$(this).click(function(){
				$(this).addClass('current').siblings().removeClass('current')
					.parents('div.section').find('div.box').hide().end().find('div.box:eq('+i+')').fadeIn(150);
			});
		});
	});	

	//检查是否选取了截图
	function checkCoords()
	{	
		if (parseInt($('#w').val())) 
		{
	
			$.post('{$this->createUrl('/archiver/avatar')}',{'rn':Math.random(),'modelID':parseInt($('#modelID').val()),'x':parseInt($('#x').val()),'y':parseInt($('#y').val()),'w':parseInt($('#w').val()),'h':parseInt($('#h').val())},function(data){
			
				$.get('{$this->createUrl('/archiver/generateavatar')}',{},function(msg){
					
				});	

				var handle = setTimeout(function(){
					src = $('#preview').attr('src');
					
					src = src.split('.');
					
					src1 = src[0]+'_150.'+src[1]+'?rn='+Math.random();
					src2 = src[0]+'_150.'+src[1]+'?rn='+Math.random();
					src3 = src[0]+'_150.'+src[1]+'?rn='+Math.random();
					
					$('#preview2').attr('src',src1);
					$('#preview3').attr('src',src2);
					$('#preview4').attr('src',src3);					
								
				},1000);
					
				Message('头像已更改');	

			});		
			
			return ;
		}
		
		Message('请选择一个剪切区域，然后点击“更换头像”按钮.');
		return false;
	};
	
	function Message(data)
	{
	    $('#StatusBar').html(data).show().fadeOut(2000);
	}
	
	function addMessage(data)
	{
		Message(data);
	    
	    location.href='#archiver_eauthfinish';
	}
	
	function loadUpload()
	{
		$('#loadUpload').load('{$this->createUrl("/archiver/uploadavatar")}');
	}
//	loadUpload();
	
	function updateImage(response)
	{
	   //将返回的JSON字符串转化可为可执行的javascript语句
       eval('res='+response);
		
		id = res.id;
		
		$('#modelID').val(id);
		
//		alert(id);
		
		if(isNumber(id))
		{		
			setCookie('upload',id);	
			reload();
		}
		else
		{
			Message(response);
		}

	}	
	
	function reload()
	{
//		$('#blankArea').css({'background':'yellow','opacity':0.2}).load(url).css({'background':'transparent','opacity':1});

		$('#blankArea').load('{$this->createUrl('/archiver/eauththird',array('rn'=>time()))}').hide().fadeIn(1500,function(){
//			alert('ok');	
		});
		
		
	}
	
	function changeAvatar(id)
	{
	
		setCookie('upload',id);
	
		$.get('{$this->createUrl('/archiver/setavatar')}',{'id':id,'rn':Math.random()},function(){
	
		});
		reload();
		return false;
	}
	
	function isNumber(s){
		var regu = '^[0-9]+$';
		var re = new RegExp(regu);
		if (s.search(re) != -1) {
			return true;
		} else {
			return false;
		}
	} 
	
	function setCookie(cookieName,value)	
	{
		var expires = new Date();
		
		expires.setTime(expires.getTime() + 3 * 30 * 24 * 60 * 60 * 1000);

		document.cookie = cookieName + '=' + value + ';expires=' + expires.toGMTString();
		
//		alert(document.cookie);
	}	
	
	function getCookie(cookieName) {
		var cookieString = document.cookie;
		var start = cookieString.indexOf(cookieName + '=');
		// 加上等号的原因是避免在某些 Cookie 的值里有
		// 与 cookieName 一样的字符串。
		if (start == -1) // 找不到
			return null;
		start += cookieName.length + 1;
		var end = cookieString.indexOf(';', start);
		if (end == -1) return unescape(cookieString.substring(start));
		return unescape(cookieString.substring(start, end));
	}
	
	/**加载头像文件**/	
	function loadAvatars()
	{
		$('#loadAvatars').load('{$loadAvartarsUrl}');
	}
	
	
//	jQuery('#loadAvatars').load('{$loadAvartarsUrl}');

//	$.get('{$loadAvartarsUrl}',{},function(data){
//		$('#loadAvatars').html(data);
//	});
	loadAvatars();
	
	function reload()
	{
//		$('#blankArea').css({'background':'yellow','opacity':0.2}).load(url).css({'background':'transparent','opacity':1});

		$('#blankArea').load('{$this->createUrl('/archiver/eauththird',array('rn'=>time()))}').hide().fadeIn(1500,function(){
//			alert('ok');	
		});
		
		
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

<script type="text/javascript">
$(function(){
   initJcrop(); 
});
</script>