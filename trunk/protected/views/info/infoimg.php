			<?php foreach ($model as $item):?>			
			<li>
				<?php echo CHtml::link(CHtml::image(Advertisement::model()->getAdvertismentFolder($item->imginfo),$item->title),array('/info/view','id'=>$item->id,'t'=>urlencode($item->title)));?>
				<div class="adTitle"><?php echo CHtml::link($item->title, array('/info/view','id'=>$item->id,'t'=>urlencode($item->title)));?></div>
				<div class="adSpansor"><a href="#"><?php echo CHtml::link(Profile::model()->getUserNickName($item->uid), array('/archiver/index', 'uid'=>$item->uid));?></a></div>
				<div class="adCreated"><?php echo date('Y-m-d', $item->create);?></div>
			</li>
			<?php endforeach;?>