<div class="view">
	<div class="span-2">
		<?php 
			$username =  Profile::model()->getUserAvatar($data->uid, array('class'=>'span-2 first adRoundSection bind_hover_card', 'bm_user_id'=>$data->uid),60);
			echo CHtml::link($username, array('archiver/index','uid'=>$data->uid, 'name'=>$data->user->username), array('rel'=>"external"));
		?>	
	</div>	
	<div class="span-5">
		<?php echo CHtml::link(Profile::model()->getUserNickName($_GET['uid']),array('achiver/index','name'=>$data->user->username,'uid'=>$data->uid)); ?>
		<span class="lightview">[<?php echo Channel::model()->getChannelName($data->cid);?>]</span> 
		<?php echo CHtml::link(CHtml::encode($data->title), array('/info/view', 'uid'=>$data->uid,'id'=>$data->id,'t'=>urlencode($data->title)),array('target'=>'_blank')); ?>	
		<br />
		<?php echo UtilHelper::timeFormat(intval($data->moddate));?>
		<br />
		<br />
		<?php echo UtilHelper::pureStrSlice($data->content,0,150); ?>
		<br />
		<hr class="span-5 space" />
		<a href="javascript:void();" xid="<?php echo $data->id;?>" class="button right" onclick="showArticle($(this));">浏览全文</a>
		<a href="javascript:void();" class="right" onclick="">加入收藏</a>
		<input type="hidden" class="span-5" style="border:1px solid #e0e0e0;padding:5px;" />	
	</div>
	
</div>
