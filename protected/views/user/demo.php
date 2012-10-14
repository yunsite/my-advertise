<style>
<!--
#scrollTest{
	margin-top:30px;
	list-style:none;
	line-height:50px;
	background:grey;
}
-->
</style>

<script type="text/javascript">
<!--
$(function(){


	
});

function test(){
	
		$.get("<?php echo $this->createUrl('archiver/message');?>", {"rn":Math.random()}, function(data){

			$(data).hide().prependTo("#scrollTest");
			
//			$("#scrollTest").prepend(data);
		});

				
		$("#scrollTest").find("div:first").fadeIn(2000).slideDown(2000);

		$("#scrollTest div").last().fadeOut(2000).remove();
		
	};

	window.setInterval("test()",5000);
//-->
</script>
		
		<div id="scrollTest" style="height:300px;overflow:hidden;">			
			<div><img src="/public/images/avatar/k.jpg" class="left clear" style="width:50px;"  />你太田馥甄-猖狂<br /><?php echo rand(0, 1000);?>个人在听</div>
			<div><img src="/public/images/avatar/k.jpg" class="left clear"  style="width:50px;"  />你太田馥甄-猖狂<br /><?php echo rand(0, 1000);?>个人在听</div>
			<div><img src="/public/images/avatar/k.jpg" class="left clear"  style="width:50px;"  />你太田馥甄-猖狂<br /><?php echo rand(0, 1000);?>个人在听</div>
			<div class="hide"><img src="/public/images/avatar/k.jpg" class="left clear"  style="width:50px;"  />你太田馥甄-猖狂<br /><?php echo rand(0, 1000);?>个人在听</div>

		</div>