<?php foreach($model as $data): ?>
    <a href="<?php echo $this->createUrl('/template/view',array('id'=>$data->id)); ?>" id="<?php echo $data->id;?>" onclick="loadTemplate($(this));return false;"><?php echo $data->name; ?></a>
<?php endforeach;?>