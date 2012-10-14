	<?php //UtilTools::dump($visitors);?>		
	<?php if (!Yii::app()->user->isGuest):?>
		最近访客：<br />
		<?php foreach ($visitors as $vdata):?>
			<?php //UtilTools::dump($vdata->attributes);?>
			<?php //echo $vdata->visitors_ip;?>
			<?php echo Visitors::model()->getVisitorHead($vdata->visitors_ip,array('style'=>'width:50px;'), '最后访问时间:'.date('Y-m-d h:i:s', $vdata->visitors_lasttime));?>
		<?php endforeach;?>
	<?php endif;?>
