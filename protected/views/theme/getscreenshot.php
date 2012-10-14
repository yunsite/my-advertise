<?php
    $this->widget('ext.Jcrop.JcropWidget',array(
        'tar_width'=>300,
        'pre_width'=>100
    ));
?>
    <div class="section" id="screenShotTabs" style="margin: 0 auto; padding:0;">
        <ul class="tabs">
            <li class="current">截取主题图</li>
            <li onclick="loadUpload();">上传图片</li>
            <li>我制作的主题</li>
        </ul>
        <div class="box visible">
    		<div class="span-6">
    	       	<div class="center roundSection" style="border:2px solid #efefef;padding:5px;width:320px;">
    			     <img src="/public/images/adtheme.jpg" style="width:300px;" id="target" alt="Flowers" />
    		    </div>    		
    		
    			<input type="hidden" id="x" name="x" />
    			<input type="hidden" id="y" name="y" />
    			<input type="hidden" id="w" name="w" />
    			<input type="hidden" id="h" name="h" />
    			<input type="hidden" id="modelID" name="modelID" />
    			
    			<hr class="space" />
    			<br />   			
	
    		</div>
    		<div class="span-3 right">
    			头像预览
    			<br />
    			<div style="width:100px;height:100px;overflow:hidden;border:1px dashed #ee0000;">
    				<img src="/public/images/adtheme.jpg" id="preview" alt="Preview" style="width:100px;" />
    			</div>	
    			<br />
    			<input type="button" value="更换头像" class="button" style="height:30px;" onclick="checkCoords();"/>		
    			<hr class="space" />
    			当前头像
    			<br />
    			100*100：
    			<div style="width:100px;height:100px;overflow:hidden;border:1px dashed #efefef;" class="roundSection">
    											
    			</div>	

    		</div>    
            <hr class="space" />        
        </div>
        <div class="box">
        	<div id="loadUpload" style="padding-top:15px;">

			</div>
        </div>
        <div class="box">
            <div id="loadAvatars">
            
            </div>            

        </div>
    </div>
    
<script type="text/javascript">
    $(function(){
               
        //加载主题图库
        loadAvatars();
        //Tabs
        uu.tabs($("ul.tabs")); 
    });
    	//检查是否选取了截图
	function checkCoords()
	{	
		if (parseInt($('#w').val())) 
		{
	
			$.post('<?php echo $this->createUrl('/theme/avatar');?>',{'rn':Math.random(),'modelID':parseInt($('#modelID').val()),'x':parseInt($('#x').val()),'y':parseInt($('#y').val()),'w':parseInt($('#w').val()),'h':parseInt($('#h').val())},function(data){


				var handle = setTimeout(function(){
					src = $('#preview').attr('src');
					
					src = src.split('.');
					
					src1 = src[0]+'_150.'+src[1]+'?rn='+Math.random();

					
					$('#prefiew2').attr('src',src1);
					
								
				},1000);
					
				uu.alertInfo('头像已更改');	

			});		
			
			return ;
		}
		
		uu.alertInfo('请选择一个剪切区域，然后点击“更换头像”按钮.');
		return false;
	};
    
    function loadAvatars()
    {
        $("#loadAvatars").load('<?php echo $this->createUrl('/file/avatars',array('uid'=>Yii::app()->user->id, 'pid'=>Lookup::model()->getUserAdThemeAlbum(Yii::app()->user->id)->id,'type'=>Lookup::USER_ADTHEME_PIC_FOLDER)) ;?>');
       
    }
    
    
    
    //加载上传控件
    function loadUpload()
	{
		$('#loadUpload').load('<?php echo $this->createUrl("/theme/uploadimage");?>');
	}
    
    function changeAvatar(object){
        var res = {
            id:object.attr("id"),
            path:object.find("img").attr("src")
        };
        
//        alert('id'+data.id+'path:'+data.path);
        
        $("#target,#preview").attr('src',res.path);
        $("#target").next().find('img').attr('src',res.path);
        
        
        $("#modelID").val(res.id);  updateImage(data);
    }
    
    function updateImage(response)
    {
        loadAvatars();
        
        eval('var res = '+response);
        
        console.log(res);
        
        $("#target,#preview").attr('src',res.path);
        $("#target").next().find('img').attr('src',res.path);
        
        
        $("#modelID").val(res.id);        


    }    
    
</script>