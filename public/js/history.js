(function($){
	var origContent = '';
	
	function load(hash){
	   
       
		if(hash != ''){
			if(origContent == ''){
//			     uu.ajaxPop();
				origContent = $('#blankArea').html();
			}
			

			if($.cookies.get('online') == null)
			{
				hash = 'site_loginajax';
				
//				alert("Hello ");
			}
			
			
			url = '/'+hash.replace('_','/')+'.html';
			
//			$('#blankArea').load(url,function(){prettyPrint();});
			$('#blankArea').load(url);
		} else if(origContent != ''){
			$('#blankArea').html(origContent);
		
		}
	}
	
	function getCookie(c_name)
	{
	var i,x,y,ARRcookies=document.cookie.split(";");
	for (i=0;i<ARRcookies.length;i++)
	  {
	  x=ARRcookies[i].substr(0,ARRcookies[i].indexOf("="));
	  y=ARRcookies[i].substr(ARRcookies[i].indexOf("=")+1);
	  x=x.replace(/^\s+|\s+$/g,"");
	  if (x==c_name)
	    {
	    return unescape(y);
	    }
	  }
	}
	
	
	
	function historyload(source){
		$.history.init(load);
		
		$(source).click(function(){	
			
            
			
	//		var url = $(this).attr("href");
	
	//		$.get(url,{'rn':Math.random()},function(data){
	//			$("#blankArea").html(data);
	//		});
			
	
	        var url = $(this).attr('href');      
	        

	
//	        <?php if (Yii::app()->user->isGuest):?>
//			location.href = '<?php $this->createUrl('/site/login');?>';
//			<?php else:?>
			url = url.replace(/^.*#/, ''); 
//	    	<?php endif;?>		
			

			if(url.indexOf("_") == -1){
				location.href = url;
//				break;
			}
			
//			alert($.cookies.get('online'));
			
//			alert(url.indexOf("_"));
				
	        $.history.load(url);
			return false;
		});		
		
	}
	
	$(function(){		
		historyload('.history, .history li a');	
	});
})(jQuery);
