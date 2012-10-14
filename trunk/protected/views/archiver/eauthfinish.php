<section class="span-18">
	<h4 class="span-14">真实资料<span class="ico ico_back"></span><a href="#archiver_authentication" class="more proedit">返回</a></h4>
	<div class="form">
	<hr class="space" />
	<div id="authprocess">
		<ul>
			<li id="eauthentication"><a href="#archiver_eauthentication" >第一步：基本资料</a></li>
			<li id="eauthsecond"><a href="#archiver_eauthsecond">第二步：学历/工作</a></li>
			<li id="eauththird"><a href="#archiver_eauththird">第三步：真实形象</a></li>
			<li id="eauthfinish"><a href="#archiver_eauthfinish">完成</a></li>
		</ul>
	</div>
	<br />
	<hr class="space" />
    <div>现在已经完成个人信息的<?php echo printf('%.1f',$percent); ?>%</div>
	
	</div>
</section>
<hr class="space" />
<?php 
$actionid = $this->action->id;
Yii::app()->clientScript->registerScript('archiver-form', "


	$('#authprocess ul>li').each(function(i){
		if($(this).attr('id') == '{$actionid}')
		{
//			$(this).slibings().removeClass('active');
			$(this).addClass('active');
		}
	});
");
?>