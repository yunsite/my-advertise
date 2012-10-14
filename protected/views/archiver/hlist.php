 <script type="text/javascript">
$(function(){
    uu.pagination($('#blankArea'));
});
</script>
<section class="">
    <h4 class="pageTitle span-10">我的文章</h4>
    <div class="grid gridView left">
        <?php $this->renderPartial('_list',array('dataProvider'=>$dataProvider,'pagination'=>$pagination)); ?>
    </div>
    <hr class="space" />
</section>