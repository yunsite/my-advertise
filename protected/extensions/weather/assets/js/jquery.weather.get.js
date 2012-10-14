/**
 * jQuery 浮云插件
 * jQuery Weather Clouds(Julying) plus v1.0
 *
 * .jQuery{ float : cloud ;}
 *
 * 网址 : http://julying.com/lab/weather
 * 类型： 原创脚本
 * 邮箱 : i@julying.com
 * QQ群 ： 11500749 (jQuery 自习室)
 * 发布 : 2010-09-10 13:55:29 
 * 更新 : 2011-03-10 14:30:00 
 * 地点 : 中国 长沙
 *
 * 版权所有 2010 | julying.com
 * 此插件遵循 MIT、GPL2、GNU 许可.
 * http://julying.com/code/license
 *
 ***************************
 * 所支持的天气类型，此类可以扩展，只要增加相应CSS样式即可 :
 * 		sunshine,cloudy,cloudys,rain,snow
 * 
 * 例子 :
 	html 代码: 
		<div class="wather"></div>
	js 代码:
		$.getSky(function(){
			$('#weather').julyingWather({sky:getSky,imgPath:'images/'});
		});

 * 注意事项 ：
		1、此插件为开源插件
		2、最终版权、解释权归 julying.com 所有有
 */
var cityIdUrl = "http://61.4.185.48:81/g/";
var watherUrl = "getWeather.php?id=";

var getSky = '';

;;(function($){
	$.getSky = function(callBack){
		var sky = $.cookie('watherSky');
		getSky = sky;
		if(!sky){
			loadJs(cityIdUrl,function(){
				if (typeof id != "undefined"){
					$.getJSON(watherUrl+id,function(data){
						var info = data.weatherinfo;
						sky = info.weather1;
						getSky = $.convertWeather(sky);
						$.cookie('watherSky',getSky, {expires: 1 / 24});
						$('#weather').julyingWather({sky:getSky,imgPath:'images/'});
						setTimeout(callBack,1);
					});
				};
			});
		}else{
			setTimeout(callBack,1);
		};
	};	
	
	$.convertWeather = function(skys){
		var weather = 'sunshine';
		if( skys.indexOf('雪') != -1 )
			weather = 'snow';
		else if(skys.indexOf('雨') != -1 )
			weather = 'rain';
		else if(skys.indexOf('云') != -1 )
			weather = 'cloudys';
		else if(skys.indexOf('阴') != -1 )
			weather = 'cloudy';
		return weather;
	};

	function loadJs(jsUrl,fCallBack){
		var _script = document.createElement('script');
		_script.setAttribute('type','text/javascript');
		//_script.setAttribute('charset', 'gb2312');
		_script.setAttribute('src', jsUrl);
		document.getElementsByTagName('head')[0].appendChild(_script);
		if(typeof fCallBack != "undefined"){
			if ($.browser.msie){
				_script.onreadystatechange = function(){
					if (this.readyState=='loaded' || this.readyState=='complete'){
						fCallBack();
					};
				};
			}else{
				_script.onload = function(){fCallBack();};
			}
		};
	};
})(jQuery);