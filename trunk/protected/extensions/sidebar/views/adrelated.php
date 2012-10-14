<ul class="list">
<?php foreach($model as $data):?>
    <li><?php echo CHtml::link($data->title.'<span>'.date('m/d',$data->pubdate).'</span>',array('/info/view','id'=>$data->id,'t'=>$data->title)); ?></li>
<?php endforeach; ?>
</ul>
