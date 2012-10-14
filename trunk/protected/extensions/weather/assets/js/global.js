$(function(){
	$Menu = $('#Menu');
	$Menu.find('.Down a').each(function(){
			var Top = parseInt($(this).parent().css('top'));
			$(this).parent().attr({'default_Top': Top , 'change_Top': Top + 20 });
		}).hover(function(){  $(this).parent().stop(false,false).animate({top: $(this).parent().attr('change_Top')  },'normal');
	},function(){ $(this).parent().stop(false,false).animate({top:	$(this).parent().attr('default_Top')},'normal');
	});
	
	
	$('#Position a').each(function(){ $(this).after('&gt;');});

	
	
	
	
	
});

function menuActive(now_catid){
	$('#Nav li').each(function(){ if($(this).attr('value') == parseInt(now_catid)) $(this).addClass('Active') ;  });
};

function ranNum(Min,Max){   
	var Range = Max - Min;   
	var Rand = Math.random();   
	return (Min + Math.round(Rand * Range));   
}   
