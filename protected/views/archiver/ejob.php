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
		<a href="<?php echo $this->createUrl('/archiver/ejob');?>" onclick="$('#cjob').trigger('click');return false;">职业</a>
	</div>
	<div id="regionNode">
		<?php echo Job::model()->generateJobLinks(0, '/job/jobinfo',array('onclick'=>'eaddress($(this));return false;'),false)?>
	</div>
	<div id="regionAdd" class="row hide">
		<label>新添职业</label>
		<input type="text" id="schoolField">
		<span class="button"><a href="javascript:void();" onclick="collegeAdd();">提交</a></span>
		<a href="javascript:void();" onclick="$(this).parent().hide();">收起</a>
	</div>
</div>

<input type="hidden" id="lastInputRegion" value="0" />
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

	if($("#regionNav>a").size() == 3){
		$("#Profile_job").val($("#regionNav a:eq(2)").attr("id"));

		$("#jobHolder").html($("#regionNav a:eq(2)").text());
	}	

	$("#lastInputRegion").val($("#regionNav a:eq(1)").attr("id"));
	
	$("#regionNode").load(object.attr('href'));
	
	return false;


}

//-->
</script>

