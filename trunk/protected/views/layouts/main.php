<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="zh_cn" />
	<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon"/> 
	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/public/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/public/css/print.css" media="print" />
	<!--[if lt IE 9]>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/public/js/html5.js"></script>
    < ![endif]-->
    <!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/public/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/public/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/public/css/form.css" />
	<!--	<script src="http://woocall.sina.com.cn/rls/utf8/stable.js" type="text/javascript"></script>  -->
	<title><?php echo CHtml::encode($this->pageTitle);?></title>
</head>

<body>
<header>
	<div class="container">
   	<hgroup class="span-6 first left">
       	<h1 id="logo"><a href="<?php echo $this->createUrl('/site/index',array('area'=>Region::model()->getUserArea()->short,'id'=>Region::model()->getUserArea()->id));?>"><img src="/public/images/logo.png"  alt="<?php echo CHtml::encode(Yii::app()->name); ?>" /></a></h1>
       	<h3 id="subTitle" class="prepend-3"><br /><a href="#headerRegionArea" id="changeAdress"><?php echo Region::model()->getUserArea()->region;?></a>广告栏-beta</h3>       	
     </hgroup> 
     <nav class="span-11 left">
        <?php $this->widget('zii.widgets.CMenu',array(
                'items'=>array(
                    array('label'=>'广告栏', 'url'=>array('/site/index')),
                    array('label'=>'排行榜', 'url'=>array('/info/index')),
                    array('label'=>' 频道 ', 'url'=>array('/channel/index')),
                    array('label'=>'我的广告', 'url'=>array('/archiver/index','uid'=>Yii::app()->user->id), 'visible'=>!Yii::app()->user->isGuest)
                ),
            )); ?>   	 

         <?php if ($this->id == 'site' && $this->action->id == 'index'):?>
	   	 <ul id="subNav">
	   	 	<li><a href="">首页</a></li>
	   	 	<li><a href="">广告云</a></li>
	   	 	<li><a href="">本地推荐</a></li>
	   	 	<li><a href="">本地公示</a></li>
	   	 	<li><a href="">活动</a></li>
	   	 </ul>
	   	 <?php elseif ($this->id == 'info'):?>
	   	 <ul id="subNav">
	   	 	<li><a href="">悦淘</a></li>
	   	 	<li><a href="">食堂</a></li>
	   	 	<li><a href="">职吧</a></li>
	   	 	
	   	 </ul>	   	 
	   	 <?php elseif ($this->id == 'archiver' && !Yii::app()->user->isGuest):?>
	   	 <ul id="subNav">
	   	 	<li><a href="<?php echo $this->createUrl('archiver/index',array('uid'=>Yii::app()->user->id));?>">我的主页</a></li>
	   	 	<li><a href="<?php echo $this->createurl('archiver/channel',array('uid'=>Yii::app()->user->id));?>">我的频道</a></li>
	   	 	<li><a href="#archiver_myad">我的广告</a></li>
	   	 	<li><a href="<?php echo $this->createUrl('archiver/profile',array('uid'=>Yii::app()->user->id));?>">个人档</a></li>
	   	 	<li><a href="#archiver_mypartin">我的参与</a></li>
	   	 </ul>	   	 
	   	 <?php endif;?>
   	 </nav><!-- navigator -->
   	 <div class="span-7 last right">
	   	<div id="quickNav">	     	
	   		<span class="login">
		     	<?php if (Yii::app()->user->isGuest):?>
		     	<?php echo CHtml::link('登录',$this->createUrl('/site/login',array('referer'=>Yii::app()->request->getUrl())),array('title'=>'Login'));?>
		     	/
		     	<?php echo CHtml::link('注册',$this->createUrl('/site/register'),array('title'=>'注册'));?>	   		
		     	<?php else:?>
		     	<?php echo CHtml::link(Yii::app()->user->name.'(注销)', $this->createUrl('/site/logout'), array('title'=>'Logout','class'=>'login'));?>
		     	<?php endif;?>	   		
	     	</span>
	     	<?php if (Yii::app()->user->name == 'admin'):?>
	     	<span class="rss">
	     	<?php echo CHtml::link('管理面板',$this->createUrl('/admincp/index'),array('title'=>'管理面板'));?>
	     	</span>	     	
	     	<?php else:?>
			<span class="rss">
	    		<?php echo CHtml::link('RSS',$this->createUrl('/info/rss'),array('title'=>"RSS"));?>
 			</span>
 			<?php endif;?>
	     </div>  
	   	 <div id="search" class="right">
	   	 	<?php 
//	   	 		$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
//				     'name'=>'keyword',
//				     'source'=>Advertisement::model()->getAdvertisementByKeywords(''),
//				     // additional javascript options for the autocomplete plugin
//				     'options'=>array(
//				         'minLength'=>'2',
//				     ),
//				     'htmlOptions'=>array(
//				         'style'=>'height:20px;'
//				     ),
//				));
	   	 	?>
	   	 	<div id="searchButton" class="right"></div>
	   	 </div> 	 
   	 </div>
     </div>
</header><!-- header -->

<?php $this->widget('ext.navigator.NavigatorWidget',array(
			'controller'=>$this->id,
			'action'=>$this->action->id		
		));
?>

<div class="container" id="page">

	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('ext.jbreadcrumbs.jbreadcrumbsWidget', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->

	<?php endif?>
		<?php echo $content; ?>


</div><!-- page -->	
<footer>	
		<ul>
			<li><?php echo CHtml::link('About',$this->createUrl('/site/page',array('view'=>'about')));?></li>
			<li><?php echo CHtml::link('Contact',$this->createUrl('/site/contact'));?></li>
		</ul>
		
		Copyright &copy; <?php echo date('Y'); ?> by My Company.All Rights Reserved.<br/>
		<?php echo Yii::powered(); ?>
  </footer><!-- footer -->
<div style="display: none;">
	<div id="headerRegionArea">
		<div id="headerRegionNav" class="bannerNav">
			<span id="headerRegionHome" onclick="uu.headerRegionHome('<?php echo $this->createUrl('/region/regionhome')?>')">选择地区</span>
			<div id="headerRegionVal"></div>
		</div>
		<div id="headerRegionContent">
			<?php $this->widget('application.components.RegionInfo',array('isList'=>false));?>
		</div>
		
	</div>
</div>
<script type="text/javascript">


//$(function(){
//	$.preLoadGUI({load: [
//	                 	
//		['/public/js/jquery.history.js', 'js'],
//		['/public/js/history.js', 'js'],
//		['/public/js/jquery.cookies.2.2.0.min.js','js'],
//		['/public/js/jquery.smartFloat.js', 'js'],
//		['/public/js/jquery.blockUI.js','js'],
//		['/public/js/common.js','js']			
//
//		]
//
//	});
//});

</script>
<?php 

	$this->widget('ext.fancybox.fancyboxWidget',array(
		'id'=>'#changeAdress',
		'overlayShow'=>true,
		'transitionIn'=>'elastic',
		'transitionOut'=>'elastic'
 ));
	
	$this->beginWidget('zii.widgets.jui.CJuiDraggable', array(
	     // additional javascript options for the draggable plugin
	     'options'=>array(
	         'scope'=>'myScope',
	     ),
	 ));

	     
	$this->endWidget();

		
	
//	Yii::app()->getClientScript()->registerScriptFile('/public/js/jquery.loader.js');
	Yii::app()->getClientScript()->registerScriptFile('/public/js/jquery.history.js');
//	Yii::app()->getClientScript()->registerScriptFile('/public/js/prettify.js');
	Yii::app()->getClientScript()->registerScriptFile('/public/js/history.js');
	Yii::app()->getClientScript()->registerScriptFile('/public/js/jquery.cookies.2.2.0.min.js');	
	Yii::app()->getClientScript()->registerScriptFile('/public/js/jquery.smartFloat.js');
	Yii::app()->getClientScript()->registerScriptFile('/public/js/jquery.blockUI.js');
	Yii::app()->getClientScript()->registerScriptFile('/public/js/common.js');
	
	Yii::app()->clientScript->registerScript('main-js', "
	

	$('#searchButton').click(function(){
		var keyword = $('#keyword').val();

//		keyword = encodeURI(keyword);

		
		location.href='{$this->createUrl('info/search')}?keyword=' + keyword;
	});		
	

	");
?>

</body>
</html>