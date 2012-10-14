
/**
 * jQuery Weather Clouds(Julying) plus v1.0
 *
 * .jQuery{ float : cloud ;}
 *
 * url : http://julying.com/lab/weather
 * 类型： 原创脚本
 * Mail : i@julying.com
 * QQ Group： 11500749 
 * created : 2010-09-10 13:55:29 
 * update : 2011-03-10 14:30:00
 * Add : China
 *
 * Copyright 2010 | julying.com
 * MIT、GPL2、GNU 许可.
 * http://julying.com/code/license
 *
 ***************************
 * 		sunshine,cloudy,cloudys,rain,snow
 * 
 * ex :
 	html code: 
		<div class="wather"></div>
	js code:
		$(function(){
			$('#wather').julyingWather({sky:'sunshine'});
		});	
：有
 */
;;;;;;;(function($){
	var path;
	$.fn.julyingWather = function(option){
		var opts = $.extend({},$.fn.julyingWather.defaults,option);
		var sky = opts.sky;
		path = opts.imgPath;
		var automove = opts.move ;
		var skys = Array()
		skys['sunshine'] = [1,false];/*nums, is rain*/
		skys['cloudy'] = [1,false];
		skys['cloudys'] = [2,false];
		skys['rain'] = [2,true];
		skys['snow'] = [2,true];
		
		if(!skys[sky])
			sky = 'sunshine';

		var html = '';
		for(var i=0; i<skys[sky][0];i++){
			var style = '';
			if( $.browser.msie && $.browser.version < 8  )
				style='filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(enabled=true, sizingMethod=noscale, src=\''+path+sky+'_'+i+'.png\');';
			else
				style='background:url('+path+sky+'_'+i+'.png) no-repeat;';
			html += '<div class="'+sky+' child'+i+'" title="'+opts.title+'" style="'+style+'"></div>'
		};
		$(this).addClass('julyingWather').html(html);
		
		var $sky = $(this).find('.'+ sky);
		if( automove )
			setTimeout(function(){ move($sky,sky,skys[sky][1],opts); },1000);
	};
	
	function move(obj,sky,isDrop,opts){
		obj.each(function(i){
			var $this =$(this);
			var widthMax = obj.parent().width();
			var start = end = 0;
			var width = getWidth($this);
			var leftMax = widthMax - width;
			var duration = opts.duration;
			var left = rand( 0 , leftMax );
			var fps = opts.fps;
			var speed = Math.abs( parseInt($this.css('left')) - left ) * rand( fps * 0.8 , fps * 1.2 );
			if( 0 == speed) speed = 100;
			var myTime ;
			
			var time = rand( duration - duration / 2, duration + duration / 2 );
			var ani = $this.animate({left:left},speed ,'linear',function(){
				myTime = setTimeout(function(){
					move($this,sky,isDrop,opts)
				},time);
			});
			
			var dropTime;
			
			$this.hover(function(){
				ani.stop();
				if(myTime) clearTimeout(myTime);				
				
				/*rain*/
				var time = 350 ;
				if(isDrop){
					if(dropTime) clearInterval(dropTime);
					dropTime = setInterval(function(){
						drop($this,sky);
					},time); 
				};				
			},function(){
				if(myTime) clearTimeout(myTime);
				myTime = setTimeout(function(){
					move($this,sky,isDrop,opts);
				},rand( duration - duration / 2,
				 duration + duration / 2 ));				
				if(dropTime) clearInterval(dropTime);
			});
		});
	};
	
	function getWidth(obj){
		var skyWidth = Array();
		obj.each(function(i){
			skyWidth[i] = $(this).width();
		});
		return skyWidth;
	};	
	
	function rand(mi,ma){   
		var range = ma - mi;
		var out = mi + Math.round( Math.random() * range) ;	
		return parseInt(out);   
	};

	function drop(obj,sky){
		makeDrop(obj,sky);
		obj.find('i').each(function(){
			$(this).animate({'top': obj.height() +  parseInt( $(this).attr('end'))},rand(180,300),function(){
				$(this).hide();
			});
		});
	};
	
	function makeDrop(obj,sky){
		var top =  obj.height() ;
		var objWidth = obj.width();
		var objHeight = obj.height();
		var left ;
		var top = 0;
		var end = 0;
		var bg='';
		if( $.browser.msie && $.browser.version < 8  )
			bg='filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(enabled=true, sizingMethod=noscale, src=\''+ path+sky+'_drop.png\');';
		else
			bg='background:url('+path+sky+'_drop.png);';
		
		var is = '' ;
		for(var i = 1 ; i<= rand(3,10) ; i++){
			top = obj.height() - rand(50,60) ;
			left = rand( objWidth * 0.1 , objWidth * 0.9) ;
			end = rand(5,200) ;
			is = is + '<i end="'+ end +'" style="left:'+ left +'px;top:'+ top +'px;'+bg+'"></i>';
		};
		obj.html(is);
	};
	
	$.fn.julyingWather.defaults = {
		imgPath : './images/',
		fps:50,
		duration : 4000,
		title : '',
		move : true
	};
	$.fn.julyingWather.version = '1.0.0';
})(jQuery);