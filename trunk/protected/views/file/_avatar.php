<?php 

	$image = File::model()->getFileByModel($data, 'avatar', 60, $data->name, array('style'=>'width:60px;margin:3px;','class'=>'roundSection'));
	
	echo CHtml::link($image, '#',array('id'=>$data->id,'onclick'=>'changeAvatar(this.id);return false;'));
?>
