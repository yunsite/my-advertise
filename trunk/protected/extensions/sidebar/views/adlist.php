<div class="span-4 right">
	<div class="button">
		<span class="ico ico_qq"></span>
		<a href="/archiver/release.html?uid=1">最近更新广告</a>
	</div>
	<ul class="effectlist">
		<?php foreach ($model as $item):?>
		<li><?php echo CHtml::link($item->title, array('/info/view','uid'=>$item->uid,'id'=>$item->id));?></li>
		<?php endforeach;?>
	</ul>
</div>