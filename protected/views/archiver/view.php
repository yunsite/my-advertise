<?php
$this->breadcrumbs=array(
	'我的广告'=>array('index'),
	'个人档',
);

$this->menu=array(
	array('label'=>'List Profile', 'url'=>array('index')),
	array('label'=>'Create Profile', 'url'=>array('create')),
	array('label'=>'Update Profile', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Profile', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Profile', 'url'=>array('admin')),
);
?>
<section class="span-14">
<h4 class="span-10">个人基本资料</h4>

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
		'favoriteStar',
		'favoriteFood',
		'favoriteMusic',
		'favoriteMovie',
		'favoriteGames',
		'favoriteSports',
		'favoriteBooks',
		'favoriteTourism',
		'favoriteDigital',
		'favoriteOther',
		'primaryschool',
		'middleschool',
		'highschool',
		'university',
		'country',
		'province',
		'manicipal',
		'village',
		'county',
		'homeprovince',
		'homemanicipal',
		'homecounty',
		'homevillage',
		'addressdetail',
		'homeaddressdetail',
	),
)); ?>
</section>
<section class="span-4 last">
	<?php $this->widget('ext.sidebar.sidebarWidget',array('view'=>'profileinfo'));?>
</section>
<hr class="space" />
