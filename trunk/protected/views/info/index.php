<?php
$this->breadcrumbs=array(
	'Advertisements',
);

$this->menu=array(
	array('label'=>'Create Advertisement', 'url'=>array('create')),
	array('label'=>'Manage Advertisement', 'url'=>array('admin')),
);
?>
<a name="top"></a>
<div class="items">

<?php foreach ($model as $item):?>
	<?php $this->renderPartial('_boxview',array('data'=>$item));?>
<?php endforeach;?>
</div>

<?php 
$this->widget('ext.hoverCard.hoverCardWidget',array(
		'borederRadius'=>true,
		'selector'=>'.bind_hover_card',
		'url'=>$this->createUrl('archiver/card')
));
?>

<?php $this->widget('ext.isotope.IsotopeWidget',array(
	'id'=>'.items',
//	'itemSelector'=>'li',
	'layoutMode'=>'masonry'
));?>
<?php 
$this->widget('ext.yiinfinite-scroll.YiinfiniteScroller', array(
    'contentSelector' => '.items',
    'itemSelector' => '.view',
//	'loadingImg'=>'http://i.imgur.com/qkKy8.gif',
	'loadingImg'=>'/public/images/loading.gif',
	'loadingText'=>'正在加载内容……',
//    'loadingText' => '<hr /><img src="" />',
    'donetext' => '亲，没有了……',
	'extraScrollPx'=>40,
    'pages' => $pages,
	'func'=>'function(newElements) {
			$(".items").isotope( "appended", $(newElements) );
		 
	}'

));
?>
<script type="text/javascript">
<!--
function showArticle(object){

	var url = '<?php echo $this->createUrl('/info/xview');?>';

	url = url.split('.');
	url[2] = url[1];
	url[1] = object.attr("xid");

	surl = url[0]+'/'+url[1]+'.'+url[2];

	console.log(surl);

	$.fancybox({
		height:'98%',
		width:800,
		type:'iframe',
		href:surl,	
		opacity:true
	});
	
}

//-->
</script>
<!-- 侧栏 -->
<div id="sideBar">
	<h5><a href="" class="adSection">筛选信息</a></h5>
</div>
<div id="bottomBar"><a href="#top" class="button">回到顶部</a></div>