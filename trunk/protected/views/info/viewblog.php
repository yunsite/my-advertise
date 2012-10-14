<?php
 
$this->pageTitle=$model->title.'_'.Yii::app()->name;

//$this->breadcrumbs=array(
//	'Advertisements'=>array('index'),
//	$model->title,
//);

$this->breadcrumbs = Advertisement::model()->generatePageTitle($model->id);

$this->pageTitle = Advertisement::model()->PageTitleArray2String($model->id);

$this->menu=array(
	array('label'=>'List Advertisement', 'url'=>array('index')),
	array('label'=>'Create Advertisement', 'url'=>array('create')),
	array('label'=>'Update Advertisement', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Advertisement', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Advertisement', 'url'=>array('admin')),
);

?>
<script type="text/javascript">
<!--
function showSideBar(object){

	var status = object.attr("title");

	if(status == '展开侧栏'){
		$("aside").animate({"width":0}).fadeOut();

		object.text(status);
		object.attr('title','收起侧栏');
		
		$("#blankArea").removeClass("right");
		$("#blankArea section").removeClass("span-19");

		$("#pagecontent").removeClass("span-14");
	
	}else{
		$("aside").fadeIn();

		object.text(status);
		object.attr('title','展开侧栏');

		$("#blankArea").addClass("right");
		$("#blankArea section").addClass("span-19");

		$("#pagecontent").addClass("span-14");		
	}

}

	
//	window.setInterval("uu.updateDates($('#time'))",1000);
	window.setInterval("uu.updateDates(<?php echo $model->end;?>,$('#time'))",1000);

//	window.setInterval(function(){
//		uu.updateDates.apply(this,'<?php echo $model->end;?>');
//	},1000);

$(function(){

	<?php if($_GET['o'] == 1): ?>
	$("#showSideBar").attr("title","展开侧栏");
	showSideBar($("#showSideBar"));
	<?php endif;?>
//	$.preLoadGUI({load: [
//			['/public/js/test.js','js']
//
//		]
//	});
	//页面载入时记录时间
	var time = new Date();
	var startTime = time.getTime();
	var refer = '<?php echo Yii::app()->request->urlReferrer; ?>';

	var sdata = {
			'id': '<?php echo $_GET['id'];?>',
			'refer': refer,
			'rn':Math.random()
		};
		
						
	$.get("<?php echo $this->createUrl('info/visitstart');?>", sdata, function(data){
		//把返回值写入body属性
		$("body").attr("id",data);
	});	
		

	/**
	 *　 当跳转或关闭时，把浏览者信息写入数据库
	 *　备注：由于必须加入alert()才能捕捉到关闭信息，开启alert()影响用记体验，所以暂时放弃获取以下两种情况的浏览数据
	 *　a.用户关闭浏览器
	 *　b.浏览器的意外关闭
	 * 所以现在只能记录用户在使用过程中页面正常跳转的信息记录
	 */
	 	 
	$(window).unload(function(e){		
		
		var time = new Date();
		var endTime = time.getTime();

		var interval = endTime - startTime;		
		
		var cdata = {
			'id': $("body").attr("id"),
			'aid': '<?php echo $_GET['id'];?>',
			'interval': interval,
			'refer': refer,
			'rn': Math.random()
		};
		

		$.get("<?php echo $this->createUrl('info/visitend');?>", cdata, function(data){
			alert(data);
		});


		

		
	});
	
	$("#pagecontent").find("img").css({
		"max-width":parseInt($("#pagecontent").width())
	});

//	showSideBar($("#showSideBar"));

	$("#float").smartFloat();


});



function showStatistics(object){
	$.fancybox({
		width: 700,
		height: 500,
		href : object.attr("href"),
		ajax : {
		    type	: "POST",
		    data	: 'mydata=test&ter=todk2'
		}
	});


}
function blank(cdata){
	
}
//-->
</script>

<section class="span-19">
	<h3 class="pagetitle">
		
		<span class="title"><a href="" class="bind_hover_card" bm_user_id="1"><?php echo $model->title;?></a></span>
		<span id="float" style="width:340px;margin-left:-11px;right:5px;margin-top:-6px;padding:5px;z-index:999999;">
			<span class="text right" style="padding-top:10px;"><span class="ico ico_statistics"></span><a href="<?php echo $this->createUrl('/info/statistics');?>" id="showStatistics" onclick="showStatistics($(this));return false;" title="显示统计信息">统计信息</a></span>
			<span class="text right" style="padding-top:10px;"><span class="ico ico_balloon"></span><a href="javascript:void();" id="showSideBar" onclick="showSideBar($(this));" title="展开侧栏">收起侧栏</a>&nbsp;&nbsp;</span>		
			<span class="text right" style="padding-top:10px;"> <span class="ico ico_pencil"></span><?php echo CHtml::link('发布信息',array('/archiver/release','uid'=>$_GET['id']))?>&nbsp;&nbsp;</span>
		
		</span>
		
	<br /><br />

	</h3>
	<span class="ico ico_footprint"></span>
	<span>有<?php echo count($model->statistics);?>人路过</span>
	<span class="ico ico_mark"></span>	
	<span>特别提示：<span id="time"><?php echo Advertisement::model()->getAdvertisementExpired($model->end);?></span>过期</span>
	<?php if(Yii::app()->user->id == $model->uid):?>
	<span class="ico ico_pencil"></span>
	<span><a href="<?php echo $this->createUrl('/archiver/erelease',array('id'=>$model->id, 't'=>urlencode($model->title)));?>">编辑</a></span>
	<?php endif;?>	
	<br />
	<hr />
	<div id="pagecontent" class="span-14">
	
		<?php echo $model->content;?>
		
		标签：<?php echo $model->tag;?>

		<hr class="space" />
		<!-- JiaThis Button BEGIN -->
		<div id="ckepop">
			<span class="jiathis_txt">分享到：</span>
			<a class="jiathis_button_tools_1"></a>
			<a class="jiathis_button_tools_2"></a>
			<a class="jiathis_button_tools_3"></a>
			<a class="jiathis_button_tools_4"></a>
			<a href="http://www.jiathis.com/share" class="jiathis jiathis_txt jiathis_separator jtico jtico_jiathis" target="_blank">更多</a>
			<a class="jiathis_counter_style"></a>
		</div>
		<script type="text/javascript" src="http://v2.jiathis.com/code/jia.js" charset="utf-8"></script>
		<!-- JiaThis Button END -->
				
		<hr class="space" />
		<?php $this->widget('ext.links.prenext.PreNextWidget', array('id'=>$model->id));?>
		<hr class="space" />
		<div id="friends_view">
			
		</div>
		<?php 
		

			$ids = Statistics::model()->historyViewStatistics($model);
			

			

			
		?>
		
	</div>
	<aside class="span-5 last right" >
		<br />
		<?php $this->widget('ext.sidebar.sidebarWidget',array(
			'view'=>'adlist'
		))?>
	</aside>
	<hr class="space" />
	<br />	
</section>
<?php $this->widget('ext.syntaxhighlighter.syntaxhighlighterWidget');?>
