<?php
//$this->breadcrumbs=array(
//	'Channels',
//);

$this->menu=array(
	array('label'=>'Create Channel', 'url'=>array('create')),
	array('label'=>'Manage Channel', 'url'=>array('admin')),
);
?>
<script type="text/javascript">
<!--
$(function(){

	var $container = $('#channelBox');

	$("#channelBanner>a").click(function(){

		
		
//		var selector = '.'+$(this).attr("data-id");
//
//		$container.isotope({
//			filter : selector
//		});
//
////		$('#channelBox').isotope({ filter: selector,masonry:{columnWidth:100} }, function( $items ) {
////			  var id = this.attr('id'),
////			      len = $items.length;
////			  console.log( 'Isotope has filtered for ' + len + ' items in #' + id );
////		});
////	
//		
//		return false;
	});


//	$container.infinitescroll({
//		'loadingText':'<hr /><img src=\"/public/images/loading.gif\" />',
//		'donetext':'<hr />This is the end... my only friend, the end',
//		itemSelector:'#channelBox>li',
//		navSelector:'div.infinite_navigation',
//		nextSelector:'div.infinite_navigation a:first',
//		bufferPx:'300'
////		loading: {
////			finishedMsg: 'No more pages to load.',
////			img: 'http://i.imgur.com/qkKy8.gif'
////		}
//		},
//		function(newElements) {
//			$("#channelBox").isotope( 'appended', $(newElements) );
//		 
//	});
});
//-->
</script>
<?php 
	Channel::model()->showCategories($_GET['id'],8);
?>
<!-- 
<ul id="channelBox" class="image-grid">
<?php foreach ($model as $item):?>
	<li data-id="<?php echo UtilHelper::words2PinYin($item->name)?>" class="<?php echo UtilHelper::words2PinYin(Channel::model()->getChannel(Channel::model()->getChannelModel($item->pid)->type));?>">
		<?php echo CHtml::image(Channel::model()->getChannelIco($item->id),$item->name);?>
		<?php echo $item->name.$item->id;?>
	</li>
<?php endforeach;?>
</ul>
 -->
<?php $this->widget('ext.isotope.IsotopeWidget',array(
	'id'=>'#channelBox',
//	'itemSelector'=>'li',
	'layoutMode'=>'masonry',
	'masonry'=>array('columnWidth'=>100)
));?>
<?php 
$this->widget('ext.yiinfinite-scroll.YiinfiniteScroller', array(
    'contentSelector' => '#channelBox',
    'itemSelector' => '#channelBox>li',
	'loadingImg' => '/public/images/loading.gif',
    'loadingText' => '正在加载内容……',
    'donetext' => '亲，没有了……',
    'pages' => $pages,
	'func'=>'function(newElements) {
			$("#channelBox").isotope( "appended", $(newElements) );
		 
	}'

));
?>