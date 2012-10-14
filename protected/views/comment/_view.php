<div class="view clear">
    <div style="width: 64px;height:64px;text-align:center;margin-right: 5px;" class="left ">
    	<?php         
     
            $uid = $data->uid;        
        ?>
    	<?php echo Profile::model()->getUserAvatar($uid, array('class'=>'roundSection','alt'=>Profile::model()->getUserTrueName($uid)), 60);?>
        <div><?php echo $data->author; ?></div>
    </div>
    <div style="margin-left: 75px;">
        <?php echo $data->content; ?>
    </div>
    <hr class="space" />
</div>