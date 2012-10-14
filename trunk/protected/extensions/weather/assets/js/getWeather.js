var watherSky;
var cityIpUrl = "http://61.4.185.48:81/g/";
var watherUrl = "http://m.weather.com.cn/data/"; //http://m.weather.com.cn/data/101010400.html

$(function(){
	//cityid = $.cookie('watherCityId');
	watherSky =  $.cookie('watherSky');	
	if( !watherSky ){
		loadJs(cityIpUrl,function(){
			if (typeof id != "undefined"){
				//$.cookie('watherSky',cityid );
				getWather(id);
			}
			
			
		});
	}else{
		setWeather(watherSky);
	};
});
 
function setWeather(sky){
	alert(sky);
}

function getWather(cityId){
	var url = watherUrl+cityId+'.html';
	url = 'http://m.weather.com.cn/data/101010400.html';
	$.getJSON( url +'?jsoncallback=?',function(data){
		eval('var json = ' + data);
		alert(json.toSource());
	});
};


function loadJs(jsUrl,fCallBack){
	var _script = document.createElement('script');
	_script.setAttribute('type', 'text/javascript');
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
		}else if ($.browser.mozilla){
			_script.onload = function(){fCallBack();};
		}else{
			fCallBack();
		};
	};
};