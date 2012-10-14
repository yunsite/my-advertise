<div class="left">
<?php if($preview):?>
<?php $string = strlen(strip_tags($preview->title))?strip_tags($preview->title):date('y-m-d',$preview->create);?>
	前一篇：<?php echo CHtml::link(UtilHelper::strSlice($string,0,$this->length),array($this->linkview,'id'=>$preview->id, 't'=>urlencode($preview->title),),array('title'=>$preview->title));?>
<?php else:?>
	已经是第一篇了！
<?php endif;?>
</div>
<div class="right">
<?php if($next):?>
<?php $string = strlen(strip_tags($next->title))?strip_tags($next->title):date('y-m-d',$next->create);?>
	前一篇：<?php echo CHtml::link(UtilHelper::strSlice($string,0,$this->length),array($this->linkview,'id'=>$next->id, 't'=>urlencode($next->title)),array('title'=>$next->title));?>
<?php else:?>
	已经是第一篇了！
<?php endif;?>
</div>