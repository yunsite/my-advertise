<script type="text/javascript">
$(function(){

	function redirect(href){
		location.href = href;
	}
	uu.alert($(".mentionmsg").html(), "错误提示", function(){
		redirect("<?php echo $link;?>");
	});
});
</script>
<div class="mentionmsg hide">
	<div style="text-align:left;text-indent:2em;">
		亲，不好意思，没有找到您需要的内容~<br />
		如果您是此地的住户,马上注册开启<?php echo $_GET['region']; ?>广告栏，有好礼相送哦~<br />
		马上去<a href="<?php echo $this->createUrl('/site/register');?>">注册</a>吧，加入我们，成为名副其实的“悦珂人”。
	</div>
</div>
