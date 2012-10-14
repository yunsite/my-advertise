<?php 
$this->breadcrumbs = Advertisement::model()->generatePageTitle($_GET['id'], true);

$this->pageTitle = Advertisement::model()->PageTitleArray2String($_GET['id']);
?>
<div class="items">
<?php foreach ($model as $item):?>
	<?php $this->renderPartial('_boxview',array('data'=>$item));?>
<?php endforeach;?>
</div>

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
<!-- 侧栏 -->
<div id="sideBar">
	<h5><a href="">筛选信息</a></h5>
</div>
<div id="bottomBar">底部选项</div>