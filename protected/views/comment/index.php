<script type="text/javascript">
$(function(){
    uu.pagination($('#comments-panel')); 
});
</script>
<?php if($comments): ?>

<?php foreach($comments as $comment): ?>
    <?php $this->renderPartial('/comment/_view',array('data'=>$comment)); ?>
<?php endforeach;?>
<hr />
<?php $this->widget('CLinkPager', array('pages' => $pagination)); ?> 
<?php else: ?>
    现在还没有人评论~
<?php endif;?>