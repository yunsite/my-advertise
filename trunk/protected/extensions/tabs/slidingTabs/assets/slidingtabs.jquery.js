/**
 * 
 */
 $(function () {
  	
 	var height = $('.tab_box:first').height();
 	 
 	$('.panel').parent().animate({height:height});
 
  	$('.lava').css({left:$('span.item:first').position()['left']});
  
  	$('.item').mouseover(function () {  	

  		var index = $(this).index();		
  
  	
   		$('.lava').stop().animate({left:$(this).position()['left']}, {duration:200});  
   
   		var panelHeight = $('.tab_box:eq('+( index - 1) +')').height();
   	
   		$('.panel').parent().animate({height:panelHeight});
   	
   		$('.panel').stop().animate({left:$(this).position()['left'] * (-630/150), height:panelHeight}, {duration:200});
  });
  
 }); 
 