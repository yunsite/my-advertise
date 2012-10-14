(function($){
	var origContent = '';
	
	function load(hash){
		if(hash != ''){
			if(origContent == ''){
				origContent = $('#blankArea').html();
			}

	
			url = '/'+hash.replace('_','/')+'.html';

	
			$('#blankArea').load(url,function(){prettyPrint();});
		} else if(origContent != ''){
			$('#blankArea').html(origContent);
		
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

//			alert(url.indexOf("_"));
	
	        $.history.load(url);
			
			return false;
		});		
		
	}
	
	$(function(){
		

	
		$('.button-column a').click(function(){
			alert(this.href);

			
			return false;
		});

		
	});
})(jQuery);
