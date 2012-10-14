<?php $this->beginContent('//layouts/main'); ?>
<script type="text/javascript">
$(function(){
    uu.tabs($("ul.tabs")); 
});
</script>
<div class="container" style="border:0px solid #ffe;background-color:white;">	
		
	<div class="adSection"  id="blankArea">
		<?php echo $content; ?>
	</div>
    <aside class="span-8 last right">
    <!-- <h4 style="background: #FF7F24;padding:5px 10px;margin:5px;color:white;border-radius:5px;">个人中心首页</h4> -->
    <hr />
    <div>
        <div class="span-2 colborder" style="text-align: right;">555<br />点击量</div>
        <div class="span-2 colborder" style="text-align: center;">150<br />评论</div>
        <div class="span-2 last">89<br />收藏</div>
        <hr class="space" />
    </div>
    <div class="section">
        <ul class="tabs">
            <li class="current">珂人资料</li>
        </ul>
        <div class="box visible">
	       <?php			
			$this->widget('ext.sidebar.sidebarWidget',array(
				'view'=>'main'
			));
		  ?>
        </div>

    </div>
    <div class="section">
        <ul class="tabs">
            <li class="current">相关广告</li>
            <li>广告列表</li>
        </ul>
        <div class="box visible stepList">
	       <?php			
			$this->widget('ext.sidebar.sidebarWidget',array(
				'view'=>'adrelated'
			));
		  ?>
        </div>
        <div class="box stepList">
	       <?php			
			$this->widget('ext.sidebar.sidebarWidget',array(
				'view'=>'infolist'
			));
		  ?>
        </div>
        </div>

    </div>

	</aside>
 </div>
<?php $this->endContent(); ?>
