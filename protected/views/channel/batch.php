<h1 class="span-11">批量添加频道</h1>
<hr class="space" />
<div id="display" class="span-11" style="height:200px;">

</div>
<hr class="space" />
<div class="section" style="width:450px;">
	<ul class="tabs">
		<li class="current">从文件中批量添加频道</li>
		<li>格式化批量添加频道</li>
		
	</ul>
	<div class="box visible" id="loadAvatars">
	<?php 
		$this->widget('ext.uploadify.uploadifyWidget',array(
			'script'=>$this->createUrl('/archiver/upload'),
			'checkScript'=>$this->createUrl('/archiver/checkupload'),
			'onComplete'=>'js:function(event, ID, fileObj, response, data){alert(response);}',
			'fileExt'=>'*.jpg;',
			'auto'=>true
		));		
	?>	
	<br />
	</div>			
	<div class="box">
		<div class="row" id="loadUpload">
		<textarea rows="" cols="" style="width:100%;height:200px;"></textarea>
		
		</div>
		<br />
		<input type="button" class="button" style="width:100px;height:30px;" value="提交" />
		<hr class="space" />
		<br />
	</div>
</div>



<?php 
	Yii::app()->clientScript->registerCssFile('/public/css/tabs.css');
	
	Yii::app()->clientScript->registerScript('channel-batchcreate', "
	
	/**Tabs**/	
	$('ul.tabs').each(function() {
		$(this).find('li').each(function(i) {
			$(this).click(function(){
				$(this).addClass('current').siblings().removeClass('current')
					.parents('div.section').find('div.box').hide().end().find('div.box:eq('+i+')').fadeIn(150);
			});
		});
	});
	
	");

?>