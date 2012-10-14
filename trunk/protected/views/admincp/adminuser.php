<link type="text/css" rel="stylesheet" href="/public/css/table.css" />
<script type="text/javascript">
$(function(){
    uu.pagination();
    uu.showInfoCard($('.grid table tbody tr'));
});
</script>
<section class="span-19">
    <h4 class="pageTitle">用户信息</h4>
    <span style="position: absolute; right:10px;">
        <a href="javascript:void();" onclick="uu.searchInfo($(this).parent());">查询</a>
    </span>
    <div class="grid gridView">
        <?php $this->renderPartial('search',array('dataProvider'=>$dataProvider,'pagination'=>$pagination)); ?>
    </div>    
</section>
<div style="display: none;">
    <?php $this->renderPartial('_search',array('model'=>$model)); ?>
</div>