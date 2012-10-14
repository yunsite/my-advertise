<style type="text/css">
	#regionContent{
	
	}
	#regionContent #regionNav{

		padding:10px 0;
		border-bottom:1px solid #ddd;
	}
	#regionContent #regionNav a{
		padding:5px 15px 5px 5px;
		background:url('/public/images/separato.gif') no-repeat right;
	}
	#regionContent #regionNode{
		
	}
	#regionContent #regionNode a{
		display:inline-block;
		border:1px solid grey;
		padding:1px;
		margin:2px;
	}
</style>
<div id="regionContent">
	<div id="regionNav">
		<a href="<?php echo $this->createUrl('/region/regioninfo',array('id'=>0));?>" onclick="eaddress($(this));return false;">家乡</a>
	</div>
	<div id="regionNode">
		<?php echo Region::model()->generateRegionLinks(0, '/region/regioninfo',array('onclick'=>'eaddress($(this));return false;'))?>
	</div>
	<div id="regionAdd" class="row hide">
		<label>新添地区</label>
		<input type="text" id="regionField">
		<span class="button"><a href="javascript:void();" onclick="regionAdd();">提交</a></span>
		<a href="javascript:void();" onclick="$(this).parent().hide();">收起</a>
	</div>
</div>
<input type="hidden" id="lastInputRegion" />
<script type="text/javascript">
<!--
function eaddress(object)
{
	var result = '';
	var show = '';
	
	if(object.parent().attr("id") == "regionNode"){
		$("#regionNav").append(object);
	}else{

		var i = object.index();
		object.siblings("a:gt("+i+")").remove();
		object.next().remove();

	}

	$("#lastInputRegion").val(object.attr("id"));


	
	$("#regionNav>a:gt(0)").each(function(i){
		result += $(this).attr("id")+"-";
	});
	$("#Profile_homeaddressdetail").val(result);
	
	$("#regionNav>a:gt(0)").each(function(i){
		show += $(this).text()+"&nbsp;&nbsp;";
	});

	$("#homeAddressHolder").html(show);
	
	$("#regionNode").load(object.attr('href'));
	return false;


}
//-->
</script>