/**
 * 已经完成的组件：
 *  1.  popLayout();    //pop层
 *  2.  destroyPopLayout    //关闭pop层
 *  2.  alertInfo(title,content,fn);    //
 *  1.  ajaxPop();  //ajax加载数据时使用pop层
 *  5.  pagination();   //分页加载
 *  2.  showInfoCard(_object,url);  //Card的将加载到_object中，并从url中异步获取信息
 *  3.  searchInfo(_object,url);    //从url中异步加载表单到_object中，
 */

var uu = {    
    
    alertInfo:function(title,content,fn){
        
        var html = $('<div class="alertNav bannerNav">'+title+'<span class="alertVal"></span></div><div class="alertContent">'+content+'</div>');
        var alertBox = $('<div class="alertBox"></div>');
        alertBox.append(html);
        alertBox.css({
           width:300,
           height:150,
           position:'fixed',
           opacity:1,
           'background-color':'#FFFFFF',
           border:'1px solid #ccc',
           'border-top':'none'

        });
                
        uu.onClosePopLayout = (fn==undefined?function(){}:fn);
        
        uu.popLayout(alertBox,300,150);
        
    },
    //AJAX加载时
    ajaxPop:function(ajaxPop){
        return $(document).ajaxStart(function(e) {
            uu.popLayout();
            
        }).ajaxStop(function() {
            uu.destroyPopLayout();
        });            

    },
    
    //分页
    pagination:function(target){
        
        function setPagination(){
            $(".yiiPager>li a").css({"display":"inline-block","padding-top":"5px","height":'20px'}).addClass("button");
            $("#page-prev").attr("href",$(".previous a").attr("href"));
            $("#page-next").attr("href",$(".next a").attr("href")); 
        }
        
        setPagination();
        
        return $(".yiiPager>li>a").click(function(){
            var href = $(this).attr("href");        
            
            target.load(href,function(){
               setPagination();
            });            

            return false; 
        });
    },
    
    //半透明pop层－－Begin
    
    //设置pop层messageBox样式
    defaultPopMessageBoxSetting:{
        
    },
    //关闭pop层之前的事件
    onClosePopLayout:function(){
        
    },    
    //销毁pop层
    destroyPopLayout:function(){
        $('#popMessage').animate({'opactiry':0,'width':0,'height':0},'easeOutBounce',function(){
            $('#popLayout').animate({'opacity':0},'linear').remove();
        }).remove();
        
    },
    
    popLayout:function(message,width,height){
        
        var messageBox,popBox,closeButton;    //显示信息
        
        var style = {
            width:width?width:250,
            height:height?height:150
        };        
        
        //创建pop层 
        function _createLayout(){
            //创建前先销毁之前创建的popMessage和popBox
            uu.destroyPopLayout();
            
            messageBox = $('<div id="popMessage"></div>');
            popBox = $('<div id="popLayout"></div>');
            closeButton = $('<span id="popCloseButton"></span>');
            
            closeButton.css({
                background:'transparent url(/public/images/close.png) no-repeat center center',
            	width:30,
            	display:'inline-block',	
            	height:30,
            	right:-18,
            	top:-15,
            	position:'absolute',
                cursor:'pointer'
            });
            
            popBox.css({
               'z-index':99999,
               position:'fixed',
               left:0,
               top:0,
               width:$(document).width(),
               height:$(document).height(),
               background:'#000',
               filter:'Alpha(Opacity=40)',
               opacity:0.4, 
               cursor:'pointer'
            });          
            
            messageBox.css({
                //这里设置提示框样式 
                position:'fixed',
                top:($(window).height()-style.height)/3,
                left:($(window).width()-style.width)/2,
                background:'white',
                'z-index':100005,
                width:0,
                height:0,
                padding:10,
                
                  	  

            }); 
            
            //点击popBox关闭pop层
            popBox.click(function(){
                uu.onClosePopLayout();                    
                uu.destroyPopLayout();                
            });
                     
            if(message == undefined){
                messageBox.css({
                    background:'transparent',
                    top:($(window).height()-style.height)*(2/3),
                    'text-align':'center'
                }).html('<img src="/public/images/ajax-loader.gif" />');
            }else{
                
                messageBox.css({
                    border: '2px solid #C0C0C0',
                   	'-moz-border-radius': '5px',    	 
                	'-webkit-border-radius':'5px',  
                	'border-radius':  '5px',	
                	'-moz-box-shadow': '0 0 20px 5px #CCC', /* Firefox */
                	'-webkit-box-shadow': '0 0 20px 5px #CCC', /* Safari and Chrome */
                	'box-shadow': '0 0 20px 5px #CCC', /* Opera 10.5+, future browsers and IE6+ using IE-CSS3 */    
                	behavior:'url(/public/css/ie-css3.htc)'
                });
                
                messageBox.html(message);
                
                closeButton.appendTo(messageBox);
                
                closeButton.click(function(){
                    uu.onClosePopLayout();                    
                    uu.destroyPopLayout();
                });
            
            }
            messageBox.animate({
                height:style.height,
                width:style.width,
                top:($(window).height()-style.height)/3,
                left:($(window).width()-style.width)/2,
            }).appendTo('body');
            
            popBox.appendTo('body');

            
        }
        
        
        
        return _createLayout();
        
        
    },
    
    //单独把一个DIV弹出，进行编辑
    popLayoutAlone:function(object,pop){
           
        object.css({
           'position':'fixed',
           height:450,
           width:950,
           filter:'alpha(opacity=80)',
           opacity:.8,
           top:50,
           left:($(window).width()-950)/2,
           background:'gray',
           'z-index':5000 
        });        
  
        
        closeButton = $('<span id="closeButton"></span>');
            
            closeButton.css({
                background:'transparent url(/public/images/close.png) no-repeat center center',
            	width:30,
            	display:'inline-block',	
            	height:30,
            	right:-18,
            	top:-15,
            	position:'absolute',
                cursor:'pointer'
            });
        pop.hide();
            
        closeButton.click(function(){
            $(this).parent().attr('style','');
            $(this).hide();
            pop.show();
        });
        
        closeButton.appendTo(object);
      
    },
    //显示信息卡片
    showInfoCard:function(_object,url){
        
        var tempCard,infoCard;
        //创建临时显示卡片
        function _createTempCard(_object){
          
            tempCard = $('<div id="tempCard"></div>');
            tempCard.css({
               width:200,
               height:150,
               'z-index':99999,
               border:'1px solid grey',
               padding:5,
               position:'absolute',
               right:0,
               display:'none',
               background:'white'
                
            });             
            tempCard.appendTo(_object);         
        }
        //销毁临时卡片
        function _destroyTempCard(){
            $('#tempCard').remove();
        }
        //创建信息卡片
        function _createInfoCard(_object){
            infoCard = $('<div id="infoCard"></div>'); 
            infoCard.css({
               width:200,
               height:150,
               'z-index':99998,
               border:'1px solid grey',
               position:'absolute',
               right:0,
               display:'none' ,
               padding:5,
               background:'yellow'           
            }); 
            infoCard.appendTo(_object);
        }
        
        function _destroyInfoCard(){
            $('#infoCard').remove();
        } 
        
        _object.click(function(e){
            _destroyInfoCard();
            _createInfoCard($(this));
            
           $(this).siblings().removeClass('selected');
           $(this).addClass('selected');
           infoCard.html(tempCard.html());
           infoCard.css({'top':e.pageY-150,right:0});
           infoCard.show();
        });
        
        return _object.hover(function(e){            
            _createTempCard($(this));    
            
            var html = '<a href="javascript:void();" onclick="">删除</a><a href="javascript:void();" onclick="">修改</a><a href="javascript:void();" onclick="">预览</a>';
                    
            tempCard.html(html);        
                    
            
//              注：此处通过AJAX加载时会启用AjaxStart和AjaxEnd事件            
//            $.get(url,{id:$(this).attr('id')},function(data){
//                console.log(data);
//                
//                tempCard.html(data);
//                
//            })
                      

            tempCard.css({'top':e.pageY-150});
            tempCard.show();
        },function(e){
            _destroyTempCard();
        });       
        
    },
    //搜索信息
    searchInfo:function(_object,url){
        var searchCard;
        
        function _createSearchBox(_object){
            searchCard = $('<div id="searchCard"></div>'); 
            searchCard.css({
               width:230,
               height:380,
               'z-index':100000,
               border:'1px solid grey',
               position:'absolute',
               right:0,
               padding:5,
               background:'#efefef'           
            }); 
            
            $('.form form .row input[type=text],.form>form>.row>input[type=password]').width(218);
            
            $('.form').appendTo(searchCard);
            searchCard.appendTo(_object);
        }
        
        _createSearchBox(_object);  
        
        return $('form').submit(function(){
            console.log($(this).serializeArray());
            
            $.get(url,$(this).serializeArray(),function(data){
                
                console.log(data);
                $('.grid').html(data);
            });
            
            return false;
	   });       
        
    },
    checkItems:function(_object){
        
    }
    
};

uu.scrollFollow = function(id,paddingTop){
	var offset = (id).offset();
	var window = $(window);
	var topPadding = paddingTop;
	(window).scroll(function(){
		if((window).scrollTop() > offset.top){
			(id).stop().animate({marginTop:(window).scrollTop()-offset.top+topPadding});
		}
	});
};


/**启用blockUI**/
//.blockUI();


uu.alert = function(content, title, fn){
	
	if(title == null)
	{
		title = '操作提示';
		
	}
	
	$.fancybox('<div class="alertBox"><div class="alertNav bannerNav">'+title+'<span class="alertVal"></span></div><div class="alertContent">'+content+'</div></div>',{
		'overlayShow'	: true,
		'transitionIn'	: 'elastic',
		'transitionOut'	: 'elastic',
		'onClosed':fn
		}
	);
};

uu.headerRegionHome = function(homeurl)
{

	$('#headerRegionVal').html('');
	
	$('#headerRegionContent').load(homeurl);
};

uu.loadRegion = function(object){	

	if(object.parent().attr('id') == 'headerRegionContent'){
		//检查#regionlVal是否已经加载了大的分类
			$('#headerRegionVal').append(object.clone());

	} else if(object.parent().attr('id') == 'headerRegionVal'){
			var i = object.index();

			object.siblings('a:gt('+i+')').remove();
			object.next().remove();
	}	
	
	$.get(object.attr('href'),{'rn':Math.random()},function(data){
		info = data.split('_');	
									
		if(info[0] == 'fail'){
			location.href=info[1];
		}else{
			$('#headerRegionContent').html(data);
		}


	});	

};

//codeEditor
uu.codeEditor = function(){
	var boxid='codeEditor_dataBox',
		contentid = 'codeEditor_dataContent',
		dataBox = null;
		
	function _loadDataBox(_object){
		
		
	}
	
	function insertData(object)
	{
		
	    html_codeeditor.replaceSelection(object.attr("id"));
	}

	
	function loadData(_object){
		_object.click(function(){
			
			$('.'+boxid).slideDown();			
			
			var id = location.hash.split('_')[2];
			
			
			if($('.'+contentid).html() == ''){
				$.get('/theme/templatedata.html',{'id':id},function(data){
					$('.'+contentid).html(data);
				});					
			}
						
			return false;		
			
		});
	}
	
	loadData($(".codeToolIcoInsert"));

	
};



uu.tabs = function(object){
    
    function loadAjax(_object){
        var i = _object.index(),
            href = _object.find('a').attr('href');

        
       $.get(href,{},function(data){           
                    
            var object = _object.addClass('current').siblings().removeClass('current').parents('div.section').find('div.box').hide().end().find('div.box:eq('+i+')');
            if(object.html() == '')
                object.html(data);
                
            object.fadeIn(150);
            
            uu.destroyPopLayout();            
       });
    }
    function loadTab(_object){
        var i = _object.index();
        _object.addClass('current').siblings().removeClass('current').parents('div.section').find('div.box').hide().end().find('div.box:eq('+i+')').show();    
    }
    
    //如果.current下有a标签就自动加载
    if($('.current').find('a'))    
        loadAjax(object.find('li:eq(0)'));   
        
          
    object.find('li:has(a)').click(function(){
        uu.popLayout();        
        loadAjax($(this));        
        return false;      
    });
    
    object.find('li:not(:has(a))').click(function(){
        loadTab($(this));
    });
    

    


}

//显示当前时间
uu.showTime = function(object){
	 var day = new Date();
	 var Y = day.getFullYear();
	 var M = day.getMonth()+1;
	 var D = day.getDate();
	 var H = day.getHours();
	 var i = day.getMinutes()>=10?day.getMinutes():'0'+day.getMinutes();
	 var S = day.getSeconds()>=10?day.getSeconds():'0'+day.getSeconds();
	 var W = "日一二三四五六".charAt(day.getDay());
	 var timeString = Y+'年'+M+'月'+D+'日 '+H+':'+i+':'+S+' 星期'+W;
	 object.html(timeString);
};

//显示广告到期时间
uu.updateDates = function(endtime,object){
	
	var result = '';
	
	var now = Math.round(new Date().getTime()/1000);
	
	var remainDate = endtime - now;	
	
	var oneday = 60*60*24;
	var onehour = 60*60;
	var oneminuts = 60;
	
//	//天数
	var day = Math.ceil(remainDate/oneday);
//	//剩余小时
	var remainHours = remainDate % oneday;
	var hour = Math.ceil(remainHours/onehour);
//	//剩余分钟
	var remainMinuts = remainDate % onehour;
	var minuts = Math.ceil(remainMinuts/oneminuts);
//	//剩余秒数
	var seconds = remainDate % oneminuts;
	
	if (remainDate > 0){
		result = '还有'+day+'天'+hour+'小时'+minuts+'分'+seconds+'秒';
	}else {
		result = '此信息已经过期';
	}
	
	object.html(result);
};

uu.loadCssFile = function(file, parent, id){
	var cssTag=parent.getElementById(id);
	var head=parent.getElementsByTagName('head').item(0);
	if(cssTag) head.removeChild(cssTag);
	css=parent.createElement('link');
	css.href=""+file+".css";
	css.rel='stylesheet';
	css.type='text/css';
	css.id=id;
	head.appendChild(css);
};


uu.loadCss = function (content, parent, id) {
	var cssTag=parent.getElementById(id);
	var head=parent.getElementsByTagName('head').item(0);
	if(cssTag) head.removeChild(cssTag);
	css=parent.createElement('style');
	css.innerHTML = content;
	css.type='text/css';
	css.id=id;
	head.appendChild(css);	

};

uu.loadScriptFile = function(file, parent, id){
	var scriptTag=parent.getElementById(id);
	var head=parent.getElementsByTagName('head').item(0);
	if(scriptTag) head.removeChild(scriptTag);
	script=parent.createElement('script');
	script.type='text/javascript';
	script.language="javascript";
	script.id=id;
	script.src=file + '.js';
	head.appendChild(script);
	
};

uu.loadScript = function (content, parent, id) {
	var scriptTag=parent.getElementById(id);
	var head=parent.getElementsByTagName('head').item(0);
	if(scriptTag) head.removeChild(scriptTag);
	script=parent.createElement('script');
	script.type='text/javascript';
	script.language="javascript";
	script.id=id;
	script.innerHTML=content;
	head.appendChild(script);

};

uu.collapse = function(object){
	$(object + '> li').hover(function(){
		var $this = $(this);
		
	},function(){
		
		
	});
};

function UrlEncode(str){   
	   var ret="";   
	   var strSpecial="!\"#$%&'()*+,/:;<=>?[]^`{|}~%";   
	   for(var i=0;i<str.length;i++){   
	   var chr = str.charAt(i);   
	     var c=str2asc(chr);   
	     if(parseInt("0x"+c) > 0x7f){   
	       ret+="%"+c.slice(0,2)+"%"+c.slice(-2);   
	     }else{   
	       if(chr==" ")   
	         ret+="+";   
	       else if(strSpecial.indexOf(chr)!=-1)   
	         ret+="%"+c.toString(16);   
	       else   
	         ret+=chr;   
	     }   
	   }   
	   return ret;   
	}  


$(function(){
	
//	uu.alert('dkdkd');

//    uu.ajaxPop(true);
    
    $("<button></button>").addClass("button").css({
        
        position:'fixed',
        top:0,
        right:0
        
    }).appendTo('body').click(function(e){
        uu.alertInfo('Title','Content');
        
    });  
    
//    uu.popLayout('hello world@');

//	$.fancybox('<div style="width:400px"><h1>FancyBox2 is released!</h1><p>&nbsp;</p><p style="line-height:2;">I\'m very pleased to announce that <br /><a href="http://fancyapps.com/fancybox/">fancyBox reborn as part of the fancyApps</a>!</p></div>', {padding: 20});
});


