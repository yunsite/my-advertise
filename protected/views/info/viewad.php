<script type="text/javascript">
$(function(){
   loadComments();
});

function loadComments(){
    $("#comments-panel").load('<?php echo $this->createUrl('/comment/index',array('id'=>$_GET['id'])); ?>');   
}
</script>
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
<section class="span-15">
	<h3 class="pagetitle">
		
		<span class="title"><a href="" class="bind_hover_card"><?php echo $model->title;?></a></span>
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
	<div id="pagecontent">
	
		<?php echo $model->content;?>
		
		标签：<?php echo $model->tag;?>

		<hr class="space span-14" />
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
				
		<hr class="space span-14" />
		<?php $this->widget('ext.links.prenext.PreNextWidget', array('id'=>$model->id));?>
		<hr class="space" />
		<div id="friends_view">
			
		</div>
		
	</div>
	<hr class="space" />
    <div class="section">
        <ul class="tabs">
            <li class="current">我有话要说</li>
        </ul>
        <div class="box visible">
            <?php $this->renderPartial('/comment/_form',array('model'=>$comment));?>
            
            <hr />
            <div id="comments-panel">
                <img src="/public/images/loading.gif" />
            </div>

        </div>
    </div>

    
</section>
<?php $this->widget('ext.syntaxhighlighter.syntaxhighlighterWidget');?>