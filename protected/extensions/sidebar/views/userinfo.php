    <div style="text-align:center;">
    	<?php         
            $advertisement = Advertisement::model()->getAdvertisementModel($_GET['id']);        
            $uid = $advertisement->uid;        
            $uid = isset($_GET['uid'])?$_GET['uid']:$uid;         
        ?>
    	<?php echo Profile::model()->getUserAvatar($uid, array('class'=>'roundSection','alt'=>Profile::model()->getUserTrueName($uid)), 120);?>
    </div>
    <hr class="space" />
	<?php 	
		$model = Profile::model()->getProfileModel($uid);
	 ?>     
	<ul class="list">
		<li>姓名：<?php echo $model->firstname.$model->lastname;?></li>
		<li>性别：<?php echo Profile::model()->getGender($model->gender);?></li>
		<li>年龄：<?php echo date('Y') - $model->birthyear.'岁';?></li>
		<li>生日：<?php echo $model->birthmonth.'月'.$model->birthday.'日';?></li>
		<li>星座：<?php echo Profile::model()->getUserConstellation($model->user->id);?></li>
	</ul>