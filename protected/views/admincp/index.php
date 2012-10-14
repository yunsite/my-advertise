<?php
$this->breadcrumbs=array(
	'管理面板'=>array('admincp/index'),
	'Hello'
);

?>
<script type="text/javascript">
$(function(){
   $(".statisticsPanel").load('<?php echo $this->createUrl('/admincp/statistics'); ?>');
});
</script>
<div id="todo"></div>
<section class="span-19">
	<h4 class="pageTitle">管理面板</h4>
    <div class="statisticsPanel">
 
    </div>
	<hr />
	<div class="span-13">
		<h4 class="pageTitle">
			今日广告
			<div class="right">
				<span style="font-size:12px;">显示方式:</span>
				<a href="<?php echo $this->createUrl('/admincp/info',array('view'=>'table'));?>" title="列表显示"><span class="lsIco lsDisplayTable"></span></a>
				<a href="<?php echo $this->createUrl('/admincp/info',array('view'=>'table'));?>" title="全文显示"><span class="lsIco lsDisplayList"></span></a>
				<a href="<?php echo $this->createUrl('/admincp/info',array('view'=>'table'));?>" title="摘要显示"><span class="lsIco lsDisplayBlockList"></span></a>
				
			</div>
		</h4>
		<?php $this->widget('zii.widgets.CListView', array(
			'dataProvider'=>$advertisement,
			'itemView'=>'/info/_view',
		)); ?>
	</div>
	<aside class="span-6 last">
		<h4 class="pageTitle right">今日注册新成员</h4>
		<hr class="space" />
		<?php $this->widget('zii.widgets.CListView', array(
			'dataProvider'=>$user,
			'itemView'=>'/user/_view',
		)); ?>
		<div class="right" style="border:1px dashed grey;">

		</div>
	</aside>
</section>
