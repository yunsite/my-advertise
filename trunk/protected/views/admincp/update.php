<?php
	//UtilHelper::dump($advertisement);
?>

<section class="span-19">
	<div class="span-14">
		<h4 class="pageTitle">今日广告</h4>
		<?php $this->widget('zii.widgets.CListView', array(
			'dataProvider'=>$advertisement,
			'itemView'=>'/info/_view',
		)); ?>
	</div>
	<aside class="span-5">
		<h4 class="pageTitle">新成员</h4>
	</aside>
</section>
