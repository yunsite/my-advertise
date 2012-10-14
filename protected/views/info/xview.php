<section class="span-19">
	<h3 class="pagetitle" style="text-align:cetner;">
		
		<span class="title"><a href="" class="bind_hover_card" bm_user_id="1"><?php echo $model->title;?></a></span>
	
	<br />

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

		<hr class="space" />
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
				
		<hr class="space" />
		<div id="friends_view">
			
		</div>
		
	</div>
	<hr class="space" />
	<br />	
</section>
<?php $this->widget('ext.syntaxhighlighter.syntaxhighlighterWidget');?>
