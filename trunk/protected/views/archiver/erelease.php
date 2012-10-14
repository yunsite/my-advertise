<script type="text/javascript">
<!--
function showChannels()
{

//	$.fancybox.showActivity();
	
	$.fancybox({
		'overlayShow' : true,
		'transitionIn' : 'elastic',
		'transitionOut' : 'elastic',
		'href':'#channelsBox',
		'modal':false,
		'onClosed':function(){
			$("#Advertisement_cid").val($("#channelVal").find("a:last").attr("id"));

			var result = "";

			$("#channelVal>a").each(function(){
				result += $(this).text()+"&nbsp;&nbsp;";
			});
			
			$("#categoryVal").html(result);
		}
	}); 

	return false;
}

function loadChannels(object)
{


	return false;
}

function chooseChannel(object)
{
	var dd = object.parent().parent().parent();
	
	if(dd.attr("id") == "channelNode")
		return ;

	//检查#channelVal是否已经加载了大的分类
	if($("#channelVal").find("a").size() == 0){
		var select = $("#channelNode ul li.selected").clone();
		var text = select.text();
		var html = select.find("a").html(text);	
		$("#channelVal").append(html);
	}

	//如果点击#channelVal下的链接，则加载当前链接，同时移除之后的链接
	if(object.parent().attr("id") == "channelVal"){
		var i = object.index();

		object.siblings("a:gt("+i+")").remove();
		object.next().remove();
	}

	object.find("img").remove();
	object.find("br").remove();
	//移除在#channelNode下链接的button类
	$("#channelVal").append(object.removeClass("button"));

	//加载相关频道的子频道
	$("#channelContent").load(object.attr("href"));


}

function addMessage(data)
{
    $('#StatusBar').jnotifyAddMessage({
        text: data,
        permanent: false,
        type: 'error',
        showIcon: false
    });
}	

function getTags()
{
	if(!editor_a.hasContents()){
		addMessage("你还没有添加内容哦～");
		return ;
	}	

	var content = editor_a.getContent();

	$.post('<?php echo $this->createUrl('archiver/analysis');?>',{'content':content, 'size':15},function(data){

		var val = '';
		var string = '';

		$.each(data,function(key,tag){
			val += tag+',';
		});

		
		$("#Advertisement_tag").val(val);

	},'json');

	return false;
}



function submitInfo()
{

	var title ;
		
//	var data = $("#advertisement_form").serialize();
//	data.Advetisement['content2']=editor_a.getContent();
	if($("#Advertisement_title").val() == '在这里填写标题……'){

		var time = new Date();
		title = time.getFullYear()+'-'+time.getMonth()+'-'+time.getDate()+' '+time.getHours()+':'+time.getMinutes();

		$("#Advertisement_title").val(title);

	}
	
	if(!editor_a.hasContents()){
		addMessage("内容不能为空");
		return ;
	}	

	if($("#Advertisement_cid").val() ==''){
		addMessage("分类不能为空");
		return ;
	}


	
	var data = {
		'Advertisement[title]':$("#Advertisement_title").val(),
//		'Advertisement[title]':title,
		'Advertisement[content]':editor_a.getContent(),
		'Advertisement[cid]':$("#Advertisement_cid").val(),
		'Advertisement[start]':$("#Advertisement_start").val(),
		'Advertisement[end]':$("#Advertisement_end").val(),
		'Advertisement[phone]':$("#Advertisement_phone").val(),
		'Advertisement[address]':$("#Advertisement_address").val(),
		'Advertisement[tag]':$("#Advertisement_tag").val()
	};
//	alert(data);


	$.post('<?php echo $this->createUrl('/archiver/erelease',array('id'=>$model->id));?>',data,function(msg){
		if(msg.status == 'ok'){
//			$.blockUI({
//				message:msg.data
////				timeout:1000
//			});	

			uu.alert(msg.data);
			
		}

	},'json');
}

$(function(){

		var href = $("#channelNode ul li.selected").find("a").attr("href");


		//标题文本框添加到编辑器之中
		$("#edui1_toolbarbox").after($("#Advertisement_title"));

		$("#channelContent").load(href);
		
		$("#channelNode ul li").click(function(){
			$(this).siblings().removeClass("selected");
			$(this).addClass("selected");

			var link = $(this).find("a").attr("href");

	
			//清空导航
			$("#channelVal").html("");
			//加载相关内容
			$("#channelContent").load(link);

			return false;
		});

//		var title = "在这里填写标题……";
//		//初始化标题
//		$("#Advertisement_title").attr("autocomplete","off").val(title).focus(function(){
//			if($(this).val() == title){
//				$(this).val("");
//			}
//		}).blur(function(){
//			if($(this).val() == ""){
//				$(this).val(title);
//			}
//		});

});
//-->
</script>
<?php 
//$this->widget('ext.artDialog.artDialogWidget',array(
//	'theme'=>'opera',
//	'okValue'=>'确定',
//	'ok'=>'function(){alert("dkdk");}'
//));
?>

<section>
<h3 class="pagetitle">
	<span class="title">发布信息</span> <span class="lightview">|</span> <span class="title"><a href="<?php echo $this->createUrl('releasetemplate');?>">写模板广告</a></span>
	<span class="text right"><a href="">草稿箱</a> | <a href="">使用说明</a></span>
</h3>

<?php echo $this->renderPartial('/info/_form', array('model'=>$model)); ?>

</section>

<style type="text/css">
<!--
	#channelsBox
	{
		width:640px;

	}	
	#channelsBox #channelNav
	{
		
	}
	#channelsBox #channelNav #channelVal a
	{
		padding:0px 15px 0px 5px;
		background:url('/public/images/separato.gif') no-repeat right;
	}
	#channelsBox #channelNode ul
	{
		border-bottom:1px solid grey;
	}
	#channelsBox #channelNode ul li
	{
		display:inline-block;
		width:100px;
		padding:10px;
		margin:10px;
		margin-bottom:-1px;
		text-align:center;
		vertical-align:middle;	
	}
	#channelsBox #channelNode ul li.selected
	{
		border:1px solid grey;
		border-bottom:1px solid white;	
	}
	#channelsBox #channelNode ul li a img
	{
		width:80px;
	}
	#channelsBox #channelContent
	{
		line-height:2em;
	}
	#channelsBox #channelContent a
	{
		border:1px solid grey;
		padding:2px;
		margin:2px;
		width:60px;
		height:150px;
		overflow:hidden;
		display:inline-block;
		vertical-align:middle;
		text-align:center;
	}
	#channelsBox #channelContent a img
	{
		width:50px;
	}

-->
</style>

<div class="hide">
	<div id="channelsBox">
		<div id="channelNav" class="bannerNav">选择频道<span id="channelVal"></span></div>
		<div id="channelNode">
			<ul>
				<li class="selected">
					<a href="<?php echo $this->createUrl('/channel/channelinfo',array('type'=>Channel::CHANNEL_MARKET,'id'=>0));?>" onclick="chooseChannel($(this));return false;" ><img src="/public/images/channel/shopping_cart.png"/></a>
					<br />
					<span class="bannerVav">购物</span>
				</li>
				<li>
					<a href="<?php echo $this->createUrl('/channel/channelinfo',array('type'=>Channel::CHANNEL_JOB,'id'=>0));?>" onclick="chooseChannel($(this));return false;" ><img src="/public/images/channel/job.png" /></a>
					<br />
					<span class="bannerVav">招聘</span>
				</li>
				<li>
					<a href="<?php echo $this->createUrl('/channel/channelinfo',array('type'=>Channel::CHANNEL_SERVICE,'id'=>0));?>" onclick="chooseChannel($(this));return false;" ><img src="/public/images/channel/service.png" /></a>
					<br />
					<span class="bannerVav">服务</span>
				</li>
				<li>
					<a href="<?php echo $this->createUrl('/channel/channelinfo',array('type'=>Channel::CHANNEL_FREIND,'id'=>0));?>" onclick="chooseChannel($(this));return false;" ><img src="/public/images/channel/friends.png" /></a>
					<br />
					<span class="bannerVav">交友</span>
				</li>			
			</ul>
		</div>	
		<div id="channelContent">
			
		</div>	
	</div>
</div>
