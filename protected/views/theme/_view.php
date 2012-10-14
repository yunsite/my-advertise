<div class="view left" style="border: 1px solid #efefef; margin:5px;" >

    <?php $image = File::model()->getFileByModel($data->themefolder, 'adtheme', 120,$data->name); ?>
	<?php echo CHtml::link($image, array('view', 'id'=>$data->id)); ?>
	<br />    
    <b><?php echo $data->name; ?></b>    
    <?php
        echo CHtml::link('修改',array('update','id'=>$data->id));
    ?>


</div>