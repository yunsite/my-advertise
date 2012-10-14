			<?php foreach ($model as $info):?>
			<li>
				<a href="<?php echo $this->createUrl('/info/view/',array('id'=>$info->id,'t'=>urlencode($info->title)));?>" title="<?php echo $info->title;?>" class="span-4 adLatestTitle">[<?php echo UtilHelper::strSlice(Channel::model()->getChannelName($info->cid),0,4);?>]<?php echo UtilHelper::strSlice($info->title,0,4);?></a>
				<span class="span-8 adLatestDes">&nbsp;<?php echo UtilHelper::strSlice(str_replace(' ', '', strip_tags($info->content)),0,20);?></span>
				<span class="span-2 adLatestDate"><?php echo date('Y-m-d',$info->update);?></span>
			</li>
			<?php endforeach;?>