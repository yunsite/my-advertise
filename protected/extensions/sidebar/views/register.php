<ul>
	<?php foreach ($model as $data):?>
	<li class="right" style="margin:2px;text-align:center;width:54px;">
		<?php UtilHelper::writeToFile($data->attributes, 'a+');?>
		<?php 
			
			$avatar = Profile::model()->getUserAvatar($data->id, array('class'=>'left roundSection', 'style'=>'width:50px;margin:10px;padding:10px;'), 50);
			
			echo CHtml::link($avatar, array('/archiver/index','uid'=>$data->id,'name'=>$data->username),array('title'=>$data->username));
		
		?>
		<br />
		<?php // echo UtilHelper::strlen_utf8($data->username)>=8?$data->username:UtilHelper::strSlice($data->username,0,5);?>
	</li>
<?php endforeach;?>	
</ul>	