<div class="bm_hover_card_content udline">
<div class="bm_hover_card_avator">
<?php 
	$username =  Profile::model()->getUserAvatar($model->id, array('class'=>'span-2 first adRoundSection'),60);
	echo CHtml::link($username, array('archiver/index','uid'=>$model->id), array('class'=>'bind_hover_card', 'bm_user_id'=>$model->id));
?>
</div>
<div class="bm_hover_card_name"><a href="http://weibo.com/samnous"><?php echo Profile::model()->getUserNickName($model->id)?></a><img src="images/transparent.gif" class="male" height="14" width="14" /></div>
<div class="bm_hover_card_from"><?php echo Profile::model()->getUserAddress($model->id);?></div>
<div class="bm_hover_card_signaure">俄罗斯方块告诉我们，犯了错误会...</div>
<div class="clear"></div>
<div class="bm_hover_card_info">
	<p><a href="http://meego123.net">关注</a><a href="http://meego123.net">粉丝</a><a href="http://meego123.net">分享</a></p>
    <p><span>1</span><span>12</span><span>1234</span></p>
</div>
</div>
<div class="bm_hover_card_bar"><a href="http://meego123.net" class="add_follow"></a></div>