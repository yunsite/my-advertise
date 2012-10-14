<span class="view" style="display: inline-block;height: 100px;width:95px;text-align:center;">
    <?php echo Profile::model()->getUserAvatar($data->id,array('onmouseover'=>'$.card(1);')); ?>
    <br />
	<?php echo $data->username; ?>
	
</span>