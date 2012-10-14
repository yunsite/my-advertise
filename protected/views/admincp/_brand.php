<?php 
	$pinyin = new PinYin();
				
	$user = User::model()->findByPk($data->forerunner);
	
	$short = $pinyin->words2Short(Region::model()->getAreaName($user->profiles->county));
?>
			
<div class="roundSection left" style="width:190px;text-align:center;margin:0 20px;padding:5px;">
	<?php echo CHtml::link(CHtml::image('/public/images/logo.png', Region::model()->getAreaBrandName($user->profiles->county)), array('site/index','id'=>$user->profiles->county,'area'=>Region::model()->getAreaBrandShortName($user->profiles->county)),array('class'=>'left','title'=>Profile::model()->getUserAddress($data->forerunner, '>'),'style'=>'padding:10px;padding:0px;font-size:60px;font-family:TTF;font-weight:bolder;overflow:hidden;')); ?>
	<div class="right" style="position:absolute;top:50px;right:5px;font-size:12px;">
		<?php echo Region::model()->getAreaBrandName($user->profiles->county);?>广告栏	
	</div>
	<hr />
	<?php echo date('m月d日');?>
</div> 