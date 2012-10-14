<?php 
$this->breadcrumbs=array(
	'我的广告'=>array('/archiver/index'),
	'个人档',
);
?>


<section class="span-13">
<h4 class="span-10">修改个人信息<span class="ico ico_pencil"></span><a href="" class="more">修改</a></h4>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</section>
<section class="span-4 last">
<?php $this->widget('ext.sidebar.sidebarWidget',array('view'=>'profileinfo'));?>
</section>
<hr class="space" />