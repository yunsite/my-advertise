$(function(){
    $('#loading').ajaxStart(function() {
        $(this).show();
    }).ajaxStop(function() {
        $(this).hide();
    });
});
/**History插件设置 START **/
(function($){
	var origContent = '';
	
	function load(hash){
		if(hash != ''){
			if(origContent == ''){
				origContent = $('#page').html();
			}			

			$('#page').load(hash);
		} else if(origContent != ''){
			$('#page').html(origContent);
		
		}
	}	

	function historyload(source){
		$.history.init(load);   

		
		$(source).click(function(){
         
	
	        var url = $(this).attr('href');         

			url = url.replace(/^.*#/, ''); 
				
	        $.history.load(url);            
            
			return false;
		});		
		
	}
	
	$(function(){
		
		historyload('.k-link');		
	
	});
})(jQuery);

/**History插件设置 END **/

jQuery.extend({
    test:function(){
        alert("Hello");
    },
    //导航菜单：dataSource ---json
    menu:function(dataSource){
        // get a reference to the menu widget                   
        $("#menu").kendoMenu({
           select: function(e){
                console.log($(e.item).children(".k-link").html());
                document.title = $(e.item).children('.k-link').html();
                return false; 
           },
           dataSource: dataSource
        });        
    },
    
    //加载个人信息卡片
    card:function(id){
        console.log(id);
    },
    //page
    page:function(){
        
        function setPage(){
            $(".yiiPager>li a").css({"display":"inline-block","padding-top":"5px","height":'20px'}).addClass("button");
            $("#page-prev").attr("href",$(".previous a").attr("href"));
            $("#page-next").attr("href",$(".next a").attr("href")); 
        }
        
        setPage();
        
        return $(".yiiPager>li>a,.page-button").click(function(){
            var href = $(this).attr("href");
            $("#page").load(href,function(){
               setPage();
            });            

            return false; 
        });
    },
    //页面分栏
    frame:function(){
        $("#panels").kendoSplitter({
            'panes':[
                {collapsible:false},
                {collapsible:false}
            ] 
        });
    },
    //下拉菜单
    dropDownList:function(object){
        
    }
    
    
});


