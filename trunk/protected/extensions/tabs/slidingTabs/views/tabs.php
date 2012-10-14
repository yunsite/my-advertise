<div class="moving_tab">
 <div class="tabs">
  <div class="lava"></div>
  <span class="item"><a href="http://www.baidu.com">交易频道</a></span>
  <span class="item">交友频道</span>
  <span class="item">求职/招聘</span>
  <span class="item">服务</span>
 </div>
     
<div class="content">      
	<div class="panel">      
		<div class="tab_box">
			<?php Channel::model()->showCategories(1,false,true,'channelItem');?>
		</div> 
		<div class="tab_box">
			<?php Channel::model()->showCategories(2,false,true,'channelItem');?>
		</div>
		<div class="tab_box">
			<?php Channel::model()->showCategories(3,false,true,'channelItem');?>
		</div>
		<div class="tab_box">
			<?php Channel::model()->showCategories(4,false,true,'channelItem');?>
		</div>
  	</div>

</div> 

</div>

