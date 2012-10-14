<div class="view">
	<div class="span-2">
		<?php 
			$username =  Profile::model()->getUserAvatar($data->uid, array('class'=>'span-2 first adRoundSection'),60);
			echo CHtml::link($username, array('archiver/index','uid'=>$data->uid,'name'=>$data->user->username), array('class'=>'bind_hover_card', 'bm_user_id'=>$data->uid));
		?>	
	</div>	
	<div class="span-10">
		<?php echo CHtml::link(Profile::model()->getUserNickName($_GET['uid']),array('achiver/index','uid'=>$data->uid)); ?>
		<span class="lightview">发布广告</span> 
		<?php echo CHtml::link(CHtml::encode($data->title), array('/info/view', 'uid'=>$data->uid,'id'=>$data->id,)); ?>	
		<br />
		<?php echo UtilHelper::timeFormat(intval($data->moddate));?>
		<br />
		<br />
		<?php echo UtilHelper::pureStrSlice($data->content,0,150); ?>
		<br />
		<br />
		<input type="text" class="span-10" style="border:1px solid #e0e0e0;padding:5px;" />	
	</div>
	<hr class="space" />
</div>