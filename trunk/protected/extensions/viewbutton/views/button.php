<script type="text/javascript">
<!--
function quickSandAjax(url, yema, destination)
{
//	alert(url);

	$.get(url,{'page':yema,'rn':Math.random()},function(data){


//		$(destination+"Hidden").empty().html(data);
//		$(destination+"Box").quicksand($(destination+"Hidden").find('li'), { adjustHeight: 'dynamic' });
		
		//使用BlockUI插件
		$(destination).unblock(); 

		$(destination).html(data);

		

	});


}

$(function(){
	$("#<?php echo $navID; ?> a").click(function(e){

		$("<?php echo $destinationID; ?>").block({message:"<img src=\"/public/images/loading.gif\" />"});
	
		var url = $(this).attr("href");
		
		if($(this).attr("id") == "<?php echo $navID?>_right"){
			var yema = $(this).prev().prev().text();
			var allyema = $(this).prev().text();
			allyema = parseInt(allyema);	
			 
			yema = parseInt(yema) + 1;

			if(yema <= allyema){
				$(this).prev().prev().text(yema);				
			} else {
				$(this).prev().prev().text(1);
				yema = 1;
			}

			quickSandAjax(url,yema,'<?php echo $destinationID; ?>');
						
			e.preventDefault(); 
			
		}else if($(this).attr("id") == "<?php echo $navID;?>_left"){
			
			var yema = $(this).next().text();
			var allyema = $(this).next().next().text();
			allyema = parseInt(allyema);			
			yema = parseInt(yema) - 1;
			
			if(yema < 1){
				$(this).next("span").text(allyema);
				yema = allyema;
			}else{
				$(this).next("span").text(yema);
				
			}
			quickSandAjax(url,yema, '<?php echo $destinationID;?>');
		}
		
		return false;
	});
});
//-->
</script>

<span class="ajaxnav" id="<?php echo $navID;?>">
	<a href="<?php echo Yii::app()->createUrl($url); ?>" id="<?php echo $navID;?>_left"><img src="<?php echo $this->baseUrl;?>/images/ajaxnav_left.png" /></a>
	<span>1</span>/<span><?php echo $pageCount;?></span>
	<a href="<?php echo Yii::app()->createUrl($url); ?>" id="<?php echo $navID;?>_right"><img src="<?php echo $this->baseUrl;?>/images/ajaxnav_right.png" /></a>
</span>