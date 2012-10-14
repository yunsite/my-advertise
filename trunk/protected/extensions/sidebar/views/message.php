<style>
<!--
#scrollBox{
	margin-top:10px;
	list-style:none;
}
#scrollBox .scrollItem
{
	padding-bottom:10px;
	clear:both;
}
#scrollBox .scrollItem img{
	padding:5px;
	margin:0 5px 5px 0;

}
-->
</style>

<script type="text/javascript">
<!--
function scrollMessage(){

	$.get("<?php echo Yii::app()->createUrl('archiver/message');?>", {"rn":Math.random()}, function(data){


		var loadID = $(data).attr("data-id");

		var firstID = $("#scrollBox").find("div:first").attr("data-id");

		if(loadID != firstID){
			$(data).prependTo("#scrollBox"); 

			$("#scrollBox").find("div:first").fadeIn(2000).slideDown(2000);

			$("#scrollBox div").last().fadeOut(2000).remove();
		}


	});


};

window.setInterval("scrollMessage()",5000);
//-->
</script>
		
<div id="scrollBox" style="height:300px;overflow:hidden;">			
	<?php foreach ($model as $data):?>
	<div class="scrollItem" data-id="scroll-<?php echo $data->id;?>">
		<?php echo Profile::model()->getUserAvatar($data->uid, array('class'=>'left roundSection', 'style'=>'width:50px;margin:10px;padding:10px;'), 50)?>	
		<span style="color:red;font-weight:bold;"><?php echo $data->title;?></span>
		<?php echo UtilHelper::strSlice(str_replace(' ', '', strip_tags($data->content)),0,50);?>
	</div>
	<?php endforeach;?>
	<div class="hide scrollItem">
	</div>
	
</div>