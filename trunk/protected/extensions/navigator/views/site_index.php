<section id="wall">
	<div id="wall-tools" class="adSection">		
		<?php for ($i=0;$i<10;$i++):?>
			<span style="width:30px;height:30px;border:1px grey solid;margin:5px;display:inline-block;"><?php echo $i;?></span>
		<?php endfor;?>
		<a href="javascript:void();" onclick="closeThemePanel($(this));"><span id="wall-close"></span></a>
	</div>
	<span id="wall-change" class="button"><a href="javascript:void();" onclick="adState($(this));">关闭广告栏</a>/<a href="javascript:void();" onclick="changeTheme($(this));">切换主题</a> </span>
	<span id="wall-prev" class="button wall-button"></span>
	<span id="wall-next" class="button wall-button"></span>
	<?php for($i=0;$i<15;$i++):?>
	<div onclick="hoverUp($(this))" class="wall-card" style="top:<?php echo rand(140, 500);?>px;left:<?php echo rand(0, 1000);?>px;">
		<h3>我是第<?php echo $i;?>号</h3>
	sfsdfsfs
	
	</div>
	<?php endfor;?>
</section>
<section class="container">	
	<article class="span-17" id="onlineStatistics">
		<h3><span class="left">看看其他网友正在关注什么</span><?php $this->widget('ext.viewbutton.ViewButtonWidget',array('url'=>'user/online','navID'=>'ajaxnav','destinationID'=>'#onlineStatisticsBox'));?></h3>
		<ul id="onlineStatisticsBox">
			<li><img src="/public/images/avatar/k.jpg" />你太猖狂-田馥甄<br />257个人在听</li>
			<li><img src="/public/images/avatar/k.jpg" />你太猖狂-田馥甄<br />257个人在听</li>
			<li><img src="/public/images/avatar/k.jpg" />你太猖狂-田馥甄<br />257个人在听</li>
		</ul>
	</article>
	<aside class="span-7 last" id="adWelcome">
		<div id="desInfo" class="right">
			欢迎来到悦珂广告平台，我们真诚的欢迎您的加入！
		</div>
	</aside>
</section>

<script type="text/javascript" >

$(function(){    
   $('#wall .wall-card').draggable({stack:'#wall .wall-card'}); 
});

var next = setInterval('getNext()',1000);	//每隔一秒加载一个card
var addlayout = 1;	//用于控制加载的广告数
var index = 1000;	//默认的z-index值

//使card上升到最顶层
function hoverUp(object)
{
	index += 1;
	object.css('zIndex', index);
}

//生成随机数，用于定位
function getDegit(num){
	return Math.ceil(Math.random()*num);
}
//加载刚发布的广告
function getNext(){       

	addlayout++;
	index++;

	var left = (getDegit($(window).width()-350));
	var top = (150+getDegit(350));

//	console.log('top:'+top+'<--->left:'+left+'<--->window width:'+$(window).width()+'document width:'+$(document).width());

	if(addlayout > 10)
		clearInterval(next);
//	console.log($.browser);
	$("<div>Hello everyone, I'm a new-commer!</div>")
	.addClass('wall-card')
	.addClass('ui-draggable')	
	.attr('onclick', 'hoverUp($(this))')
	.css({
//		'background':'rgb('+getDegit(255)+','+getDegit(255)+','+getDegit(255)+')',
		'left':(getDegit($(window).width()+500)-500)+'px',
		'top':(getDegit(700)-100)+'px',
		'z-index':index,
		'position':'absolute'
	})
	.draggable({stack:'#wall .wall-card'})
	.appendTo($('#wall'))
	.animate({
		'left':left+'px',
		'top':top+'px'
	});
	
}
//更改显示布局
function changeLayout()
{
	$("#wall .wall-card").css({
		'position':'relative',
		'top':'0px',
		'left':'5px'
	});

}

//关闭广告栏
function adState(object)
{
	$("#wall").slideToggle();
}

function changeTheme(object)
{
	$("#wall-tools").fadeIn();

	object.parent().hide();
}

function closeThemePanel(object)
{
	$("#wall-tools").fadeOut();
	$("#wall-change").show();
}
</script>