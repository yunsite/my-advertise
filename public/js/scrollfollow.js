/**
 * 
 */
function scrollFollow(){
	var offset = $('#notice').offset();
	var topPadding = 15;
	$(window).scroll(function(){
		if($(window).scrollTop() > offset.top){
			$('#notice').stop().animate({marginTop:$(window).scrollTop()-offset.top+topPadding});
		}
	});
}