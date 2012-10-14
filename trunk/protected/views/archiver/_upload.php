<?php 
	$this->widget('ext.uploadify.uploadifyWidget',array(
		'script'=>$this->createUrl('/archiver/upload'),
		'checkScript'=>$this->createUrl('/archiver/checkupload'),
		'onComplete'=>'js:function(event, ID, fileObj, response, data){updateImage(response);}',
		'fileExt'=>'*.jpg;',
		'auto'=>true
	));		
?>