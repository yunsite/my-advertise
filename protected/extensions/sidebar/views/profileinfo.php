<div class="span-5 center">
	<?php
		$uid = isset($_GET['uid'])?$_GET['uid']:Yii::app()->user->id;
		echo Profile::model()->getUserAvatar($uid, array('class'=>'roundSection','alt'=>Profile::model()->getUserTrueName($uid)), 150);
	?>
	<br />
	<a href="<?php echo Yii::app()->createUrl('/archiver/profile', array('#'=>'archiver_eauththird'));?>">修改头像</a>
</div>
