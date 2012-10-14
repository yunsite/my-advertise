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
		<a href="<?php echo $this->createUrl('/archiver/ehighschool');?>" onclick="$('#chighschool').trigger('click');return false;">高中</a>
	</div>
	<div id="regionNode">
		<?php echo Region::model()->generateRegionLinks(0, '/college/collegeinfo',array('onclick'=>'eaddress($(this));return false;'),false)?>
	</div>
	<div id="regionAdd" class="row hide">
		<label>新添学校</label>
		<input type="text" id="schoolField">
		<span class="button"><a href="javascript:void();" onclick="collegeAdd();">提交</a></span>
		<a href="javascript:void();" onclick="$(this).parent().hide();">收起</a>
	</div>
</div>
<input type="hidden" id="lastInputRegion" />
<input type="hidden" id="schoolType" value="<?php echo College::COLLEGE_TYPE_HIGHSCHOOL;?>" />
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
	
	$("#regionNav>a:gt(0)").each(function(i){
		result += $(this).attr("id")+"-";
	});

	if($("#regionNav>a").size() == 3){
		$("#Profile_highschool").val($("#regionNav a:eq(2)").attr("id"));

		$("#highschoolHolder").html($("#regionNav a:eq(2)").text());
	}	

	$("#lastInputRegion").val($("#regionNav a:eq(1)").attr("id"));


	

	//在这里作一标记，防止不必要的请求
//	if($("#record").val() == ''){
//
//		$("#record").val("yes");
		
		$.get(object.attr('href'),{'type':'<?php echo College::COLLEGE_TYPE_HIGHSCHOOL;?>'},function(data){
			$("#regionNode").html(data);
		});
//	}else{
//		$("#regionNode").html('如果选择不对，请返回上一级');
//		$("#record").val('');
//	}


	return false;


}
//-->
</script>