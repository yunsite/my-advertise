<!-- 此文件用于显示用户的个人爱好资料 -->
<section class="span-14">
<h4 class="span-10">我的爱好<span class="ico ico_pencil"></span><a href="#archiver_efavorite" class="more">修改</a></h4>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		array(
			'name'=>'favoriteStar',
			'type'=>'raw',
			'value'=>Tag::model()->generateTags($model->favoriteStar,'','','&nbsp;&nbsp;')
		),
		array(
			'name'=>'favoriteFood',
			'type'=>'raw',
			'value'=>Tag::model()->generateTags($model->favoriteFood,'','','&nbsp;&nbsp;')
		),
		array(
			'name'=>'favoriteMusic',
			'type'=>'raw',
			'value'=>Tag::model()->generateTags($model->favoriteMusic,'','','&nbsp;&nbsp;')
		),
		array(
			'name'=>'favoriteMovie',
			'type'=>'raw',
			'value'=>Tag::model()->generateTags($model->favoriteMovie,'','','&nbsp;&nbsp;')
		),
		array(
			'name'=>'favoriteGames',
			'type'=>'raw',
			'value'=>Tag::model()->generateTags($model->favoriteGames,'','','&nbsp;&nbsp;')
		),
		array(
			'name'=>'favoriteSports',
			'type'=>'raw',
			'value'=>Tag::model()->generateTags($model->favoriteSports,'','','&nbsp;&nbsp;')
		),
		array(
			'name'=>'favoriteBooks',
			'type'=>'raw',
			'value'=>Tag::model()->generateTags($model->favoriteBooks,'《','》','&nbsp;&nbsp;')
		),
		array(
			'name'=>'favoriteTourism',
			'type'=>'raw',
			'value'=>Tag::model()->generateTags($model->favoriteTourism,'','','&nbsp;&nbsp;')
		),
		array(
			'name'=>'favoriteDigital',
			'type'=>'raw',
			'value'=>Tag::model()->generateTags($model->favoriteDigital,'','','&nbsp;&nbsp;')
		),
		array(
			'name'=>'favoriteOther',
			'type'=>'raw',
			'value'=>Tag::model()->generateTags($model->favoriteOther,'','','&nbsp;&nbsp;')
		),

	),
)); ?>
</section>
<section class="span-4 last">
	<?php $this->widget('ext.sidebar.sidebarWidget',array('view'=>'profileinfo'));?>
</section>
<hr class="space" />