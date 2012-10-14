<div class="section span-19">
    <ul class="tabs">
        <li class="current"><?php echo CHtml::link('在线统计', array('/statistics/online')); ?></li>
        <li><?php echo CHtml::link('空间使用情况',array('/statistics/space')); ?></li>
        <li><?php echo CHtml::link('浏览器使用情况',array('/statistics/agent')); ?></li>
        <li><?php echo CHtml::link('系统平台统计', array('/statistics/platform')); ?></li>
        <li><?php echo CHtml::link('来访国家统计', array('/statistics/regioncountry')); ?></li>
        <li><?php echo CHtml::link('国内统计', array('/statistics/regioncountry')); ?></li>
        <li><?php echo CHtml::link('用户注册统计', array('/statistics/register')); ?></li>
    </ul>
    <div class="box visible"></div>
    <div class="box"></div>
    <div class="box"></div>
    <div class="box"></div>
    <div class="box"></div>    
    <div class="box"></div>
    <div class="box"></div>    
</div>
<script type="text/javascript">
$(function(){
   uu.tabs($("ul.tabs")); 
});
</script>
