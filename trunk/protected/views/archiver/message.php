<div class="scrollItem" data-id="scroll-<?php echo $model->id;?>">
	<?php echo Profile::model()->getUserAvatar($model->uid, array('class'=>'left roundSection', 'style'=>'width:50px;padding:10px;'), 50)?>	
	<span style="color:red;font-weight:bold;"><?php echo $model->title;?></span>
	<?php echo UtilHelper::strSlice(str_replace(' ', '', strip_tags($model->content)),0,50);?>
</div>