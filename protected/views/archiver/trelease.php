<script type="text/javascript">
$(function(){
   $("#themes>a").click(function(){
        $("#contentPage").load($(this).attr("href"));
        return false;
   }); 
});
</script>
<section>
<h3 class="pagetitle">
	<span class="title">发布信息</span> <span class="lightview">|</span> <span class="title"><a href="<?php echo $this->createUrl('releasetemplate');?>">写模板广告</a></span>
	<span class="text right"><a href="">草稿箱</a> | <a href="">使用说明</a></span>
</h3>
<hr />
<div id="themes">
    <?php 
        foreach($themes as $theme){
            echo CHtml::link($theme->name,array('theme/view','id'=>$theme->id),array('style'=>'padding:20px;margin:10px;'));
        }
    ?>
</div>
<div id="contentPage">

</div>

</section>