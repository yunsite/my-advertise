<?php
$this->breadcrumbs=array(
	'我的广告',
);

$this->menu=array(
	array('label'=>'Create Profile', 'url'=>array('create')),
	array('label'=>'Manage Profile', 'url'=>array('admin')),
);
?>
<aside class="span-4 right last" >
	<br />
	<div id="adPublish">
	  <div class="button span-3 right"> <span class="ico ico_pencil"></span><?php echo CHtml::link('发布信息',array('release','uid'=>Yii::app()->user->id))?></div>
	</div>
</aside>
<section class="">
<?php $uid = isset($_GET['uid'])?$_GET['uid']:Yii::app()->user->id;?>
<h4><?php echo Profile::model()->getUserTrueName($uid);?></h4>
<!-- 姓别信息 -->
<?php if (Profile::model()->getUserGender($uid) == Profile::GENDER_MALE):?>
<span class="ico ico_male"></span>男
<?php elseif (Profile::model()->getUserGender($uid) == Profile::GENDER_FAMALE):?>
<span class="ico ico_female"></span>女
<?php else: ?>
<span class="ico ico_male"></span>性别不详
<?php endif;?>
<!-- 地址信息 -->
<span class="ico ico_home"></span>
<?php echo Profile::model()->getUserAddress($uid);?>
<!-- 婚姻状态 -->
<span class="ico ico_heart"></span>
<?php echo Profile::model()->getUserMarryState($uid);?>
<!-- 星座 -->
<span class="ico ico_star"></span>
<?php echo Profile::model()->getUserConstellation($uid); ?>

<div class="list-view">
	<div class="items">
		<?php foreach ($model as $data):?>
			<?php $this->renderPartial('/info/_view',array('data'=>$data));?>
		<?php endforeach;?>
	</div>
</div>

</section>
<?php 

$this->widget('ext.isotope.IsotopeWidget',array(
	'id'=>'.items',
//	'itemSelector'=>'li',
	'layoutMode'=>'masonry'
));

//$this->widget('ext.hoverCard.hoverCardWidget',array(
//		'borederRadius'=>true,
//		'selector'=>'.bind_hover_card',
//		'url'=>$this->createUrl('archiver/card')
//));

$this->widget('ext.yiinfinite-scroll.YiinfiniteScroller', array(
    'contentSelector' => '.items',
    'itemSelector' => '.view',
	'loadingImg'=>'/public/images/loading.gif',
	'loadingText'=>'正在加载内容……',
//    'loadingText' => '<hr /><img src="" />',
    'donetext' => '亲，没有了……',
    'pages' => $pages,
	'func'=>'function(newElements) {
			//预留下以待解决附加内容不能停的问题
//			$("#data-page").val(parseInt($("#data-page").val())+1);
			$(".items").isotope( "appended", $(newElements) );
		 
	}'
));

?>
<input type="hidden" value="1" id="data-page" />