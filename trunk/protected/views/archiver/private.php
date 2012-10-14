<section class="span-14">
<h4 class="span-10">私人资料<span class="ico ico_pencil"></span><a href="#archiver_eprivate" class="more">修改</a></h4>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'email',
		'phone',
		'qq',
		'alipay',
		'job',
	),
)); ?>
</section>
<section class="span-4 last">
	<?php $this->widget('ext.sidebar.sidebarWidget',array('view'=>'profileinfo'));?>
</section>
<hr class="space" />