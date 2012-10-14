<?php 
	$this->pageTitle=Yii::app()->name; 
//	$this->breadcrumbs=array(
//		'Home',
//	);
//	
	$this->menu=array(
		array('label'=>'Create Advertisement', 'url'=>array('create')),
		array('label'=>'Manage Advertisement', 'url'=>array('admin')),
	);	
?>
<section id="" class="span-16  adSection">
	<article id="adRecommend">
		<h3>新鲜事推荐
			<?php $this->widget('ext.viewbutton.ViewButtonWidget',array('url'=>'/info/infoimg','navID'=>'ajaxnavAdRecommend','destinationID'=>'#adRecommendBox','pageCount'=>Advertisement::model()->getAdvertisementSize()));?>
			<span class="right more"><?php echo CHtml::link('更多', array('/info/infolist'));?></span>
		</h3>
		<ul id="adRecommendBox">
		
			<?php foreach ($newInfo as $item):?>			
			<li>
				<?php echo CHtml::link(CHtml::image(Advertisement::model()->getAdvertismentFolder($item->imginfo),$item->title),array('/info/view','id'=>$item->id,'t'=>urlencode($item->title)));?>
				<div class="adTitle"><?php echo CHtml::link($item->title, array('/info/view','id'=>$item->id,'t'=>urlencode($item->title)));?></div>
				<div class="adSpansor"><a href="#"><?php echo CHtml::link(Profile::model()->getUserNickName($item->uid), array('/archiver/index', 'uid'=>$item->uid));?></a></div>
				<div class="adCreated"><?php echo date('Y-m-d', $item->pubdate);?></div>
			</li>
			<?php endforeach;?>
	
		</ul>
	</article>
	<article id="adLatest">
		<h3>最近广告
		<?php $this->widget('ext.viewbutton.ViewButtonWidget',array('url'=>'info/infolist','navID'=>'ajaxnavadLatest','destinationID'=>'#adLatestBox','pageCount'=>Advertisement::model()->getAdvertisementSize(false)));?>
		<span class="right more"><?php echo CHtml::link('更多', array('/info/infolist'));?></span>
		</h3>
		<ul id="adLatestBox">
			<?php foreach ($latestInfo as $info):?>
			<li>
				<a href="<?php echo $this->createUrl('/info/view/',array('id'=>$info->id,'t'=>urlencode($info->title)));?>" title="<?php echo $info->title;?>" class="span-4 adLatestTitle">[<?php echo UtilHelper::strSlice(Channel::model()->getChannelName($info->cid),0,4);?>]<?php echo UtilHelper::strSlice($info->title,0,4);?></a>
				<span class="span-8 adLatestDes">&nbsp;<?php echo UtilHelper::strSlice(str_replace(' ', '', strip_tags($info->content)),0,20);?></span>
				<span class="span-2 adLatestDate"><?php echo date('Y-m-d',$info->moddate);?></span>
			</li>
			<?php endforeach;?>
		</ul>
	</article>	
</section>
<hr class="span-16 space" />
<section class="span-16" style="padding:0px;margin:0px;overflow:hidden;width:930px;">
		<img src="/public/images/banner_1.png" />

</section>
<hr class="span-16 space" />
<section class="span-16 adSection">

<div class="section">
	<?php //$this->widget('ext.tabs.slidingTabs.slidingTabsWidget');?>
</div> 


</section>


<section class="span-16 adSection">	
	<article class="span-7">
		<h5>在</h5>
		<input type="button" value="ell" id="ell" />
<ul id="source">
  <li data-id="anto">Antonovka</li>
  <li data-id="jonat">Jonathan</li>
  <li data-id="mac">McIntosh</li>
</ul>

<ul id="destination" style="display: none">
  <li data-id="blood">Blood orange</li>
  <li data-id="pers">Persian orange</li>
  <li data-id="valen">Valencia orange</li>
</ul>
	
	</article>
	<article class="span-1" style="border-left:1px solid grey;border-right:1px solid grey;">
	&nbsp;
	</article>
	
	
	
	<article class="span-7">
		<h5>在</h5>
		<?php 
			$session = Yii::app()->getSession()->getSessionId();
			
			UtilHelper::dump($session);
		?>
	
	</article>
</section>

<?php 
	$this->widget('ext.weather.WeatherWidget');
	$this->widget('ext.isotope.IsotopeWidget',array(
		'id'=>'.items',
	//	'itemSelector'=>'li',
		'layoutMode'=>'masonry'
	));
?>



