<?php
	$this->widget('ext.hoverCard.hoverCardWidget',array(
		'url'=>"error url",
		'errorText'=>"出错后，输出自定义文本"
	));
?>

<script type="text/javascript">
$(function(){
	$(".bind_hover_card").hoverCard({
		url:"<?php echo $this->createUrl('archiver/card');?>",
		borederRadius:true
	});
	$("#error").hoverCard({
		url:"error url",
		errorText:"出错后，输出自定义文本"
	});

	
});
</script>

<a href="http://meego123.net" class="bind_hover_card" bm_user_id="2" target="_blank">鼠标悬停在这里</a>
<a href="http://meego123.net" id="error" target="_blank">数据加载失败</a>
