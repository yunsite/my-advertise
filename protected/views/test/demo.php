<?php 
Yii::app()->getClientScript()->registerCoreScript('jquery');
?>
<div class="pic"></div>
<script type="text/javascript" language="javascript">
$(function(){
	$.get('<?php echo $this->createUrl('/test/zip');?>',{},function(data){
		$(".pic").html(data);
	});
});
</script>