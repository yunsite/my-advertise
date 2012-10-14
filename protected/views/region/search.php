 <script type="text/javascript">
$(function(){
    uu.pagination($('.grid'));
    uu.showInfoCard($('.grid table tbody tr'));
});
</script>
<?php $this->renderPartial('_list',array('dataProvider'=>$dataProvider,'pagination'=>$pagination));?>