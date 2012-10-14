<!-- 此文件用于显示用户的个人爱好资料 -->
<section class="span-14">
<h4 class="span-14">真实资料<span class="ico ico_pencil"></span><a href="#archiver_eauthentication" class="more">修改</a></h4>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		array(
			'label'=>'姓名',
			'type'=>'raw',
			'value'=>$model->firstname.$model->lastname
		),
		'nickName',
		array(
			'name'=>'gender',
			'value'=>Profile::model()->getGender($model->gender)
		),
		array(
			'label'=>'年龄',
			'value'=>date('Y') - $model->birthyear.'岁'
		),

		array(
			'label'=>'生日',
			'value'=>$model->birthmonth.'月'.$model->birthday.'日'
		),
		array(
			'label'=>'星座',
			'value'=>Profile::model()->getUserConstellation($model->user->id)
		),
		array(
			'name'=>'marry',
			'value'=>Profile::model()->getUserMarryState($model->marry)
		),
		array(
			'label'=>'家乡',
			'type'=>'raw',
			'value'=>Profile::model()->getUserAddress($model->user->id)
		),
		'email',
		'phone',
		'qq',
		'alipay',
		'job',
		'companyname',
		'companyaddress',
		'primaryschool',
		'middleschool',
		'highschool',
		'university',
		'country',
		'province',
		'manicipal',
		'village',
		'county',
	),
)); ?>
</section>
<section class="span-4 last">
	<?php $this->widget('ext.sidebar.sidebarWidget',array('view'=>'profileinfo'));?>
</section>
<hr class="space" />