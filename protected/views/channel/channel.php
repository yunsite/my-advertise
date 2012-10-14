<?php $pinyin = new PinYin(); ?>

<?php foreach ($model as $item):?>
	<li data-id="<?php echo $pinyin->words2PinYin($item->name)?>" style="width:<?php echo rand(100, 200); ?>;">
		<?php echo CHtml::image(Channel::model()->getChannelIco($item->id),$item->name);?>
		<?php echo $item->name;?>
	</li>
<?php endforeach;?>


<?php 
$this->widget('ext.yiinfinite-scroll.YiinfiniteScroller', array(
    'contentSelector' => '#channelBox',
    'itemSelector' => 'li',
    'loadingText' => '<hr /><img src="/public/images/loading.gif" />',
    'donetext' => '<hr />This is the end... my only friend, the end',
    'pages' => $pages,
));
?>
