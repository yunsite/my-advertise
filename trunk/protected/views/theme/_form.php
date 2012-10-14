<?php
    $this->widget('ext.editor.CodeMirror.CodeMirrorWidget',array(
        'id'=>'Code_html',
        'syntax'=>array('clike','php','js','css','xml'),
        'theme'=>'ambiance'
    ));
    
    $this->widget('ext.Jcrop.JcropWidget',array(
        'tar_width'=>650,
        'pre_width'=>150
    ));
    
    $htmlcode = <<<HTML
<div class="templateHolder"></div>
HTML;
    $csscode = <<<CSS
.templateHolder{}    
CSS;
    $jscode = <<<JS
    
JS;

    $htmlcode = $model->isNewRecord?$htmlcode:htmlspecialchars($model->html);
    $csscode = $model->isNewRecord?$csscode:htmlspecialchars($model->css);
    $jscode = $model->isNewRecord?$jscode:htmlspecialchars($model->javascript);    


?>
    <section id="codeeditorBox">
        <a name="top"></a>
        <div id="codeeditorPop" style="background: blue;" class="popbutton" onclick="uu.popLayoutAlone($('#codeeditorBox'),$(this));">弹起</div>
        <div id="control">
            <ul class="right input">
                <li>主题截图：<a href="#iframe"><span onclick="getScreenShot();" style="width:22px;height:16px;background:blue;display:inline-block;cursor:pointer;">&nbsp;&nbsp;</span></a></li>
                <li>风格：<?php echo CHtml::dropDownList('Theme_style',$model->style,Theme::model()->generateStyleList());?></li>
                <li>费用：<input type="text" id="Theme_charge" style="width: 60px;" value="<?php echo $model->charge; ?>" />元</li>
                <li><input type="button" value="提交" onclick="submitTheme();" /></li>
            </ul> 
            <ul class="left input">
                <li>名称：<input type="text" id="Theme_name" style="width: 150px;" value="<?php echo $model->name; ?>" /></li>
            </ul>
            <ul id="panels">
                <li><a class="cbutton active first" href="javascript:void();">HTML</a></li>
                <li><a class="cbutton active" href="javascript:void();">CSS</a></li>
                <li><a class="cbutton" href="javascript:void();">JAVASCRIPT</a></li>
            </ul>  
     
        </div>
        <hr class="space" />
        <div class="codeeditor html left">
            <span>HTML ▽</span>
            <textarea id="Html_code"><?php echo $htmlcode;?></textarea>
        </div>
        <div class="codeeditor css left">
            <span>CSS ▽</span>
            <textarea id="Css_code"><?php echo $csscode; ?></textarea>
        </div>
        <div class="codeeditor js left">
            <span>JAVASCRIPT ▽</span>
            <textarea id="Js_code"><?php echo $jscode;?></textarea>
        </div>
     </section>
     <section id="iframeSection">
        <hr />
        <a name="iframe" href="#screenShot" class="right" title="返回顶部" style="margin-top: -15px;"><img src="/public/images/nextbutton.png" /></a>
      
        <iframe id="themepreview" style="width: 100%;"></iframe>     
     </section>
     <section id="shotboxSection">
        <hr class="space" />        
        <div id="screenShotBox">
            <a name="screenShot" href="#top" class="right" title="返回顶部" style="margin-top: -15px;"><img src="/public/images/top.png" /></a>
            <div class="section" id="screenShotTabs" style="margin: 0 auto; padding:0;">
                <ul class="tabs">
                    <li class="current">截取主题图</li>
                    <li onclick="loadUpload();">上传图片</li>
                    <li>主题图库</li>
                    <li>图片本地化</li>
                </ul>
                <div class="box visible">
            		<div class="span-6">
            	       	<div class="center roundSection" style="border:2px solid #efefef;padding:5px;width:650px;">
            			     <img src="/public/images/adtheme.jpg" style="width:650px;" id="target" alt="Flowers" />
            		    </div>    		
            		
            			<input type="hidden" id="x" name="x" />
            			<input type="hidden" id="y" name="y" />
            			<input type="hidden" id="w" name="w" />
            			<input type="hidden" id="h" name="h" />
            			<input type="hidden" id="modelID" name="modelID" value="<?php echo $model->folder; ?>" />
            			
            			<hr class="space" />
            			<br />   			
        	
            		</div>
            		<div class="span-4 right">
            			预览
            			<br />
            			<div style="width:150px;height:150px;overflow:hidden;border:1px dashed #ee0000;">
            				<img src="/public/images/adtheme.jpg" id="preview" alt="Preview" style="width:150px;" />
            			</div>	
            			<br />
            			<input type="button" value="剪切" class="button" style="height:30px;" onclick="checkCoords();"/>		
            			<hr class="space" />
            			当前截图
            			<br />
            			120*120：
            			<div style="width:120px;height:120px;overflow:hidden;border:1px dashed #efefef;" class="roundSection">
            				<img src="/public/images/adtheme.jpg" id="preview2" style="width: 120px;" />						
            			</div>	
        
            		</div>    
                    <hr class="space" />        
                </div>
                <div class="box">
                	<div id="loadUpload" style="padding-top:15px;">
        
        			</div>
                </div>
                <div class="box">
                    <div id="avatarUrl" style="width: 600px;border:dashed 1px gray;"></div>
                    <div id="loadAvatars">
                    
                    </div>            
        
                </div>
                <div class="box">
                    <div style="padding: 20px;">
                        远程图片地址：<input id="remoteImage" style="width: 400px;" />&nbsp;&nbsp;<input type="button" value="转化" onclick="getRemoteImage();" />
                    </div>
                    <div style="width: 300px;">
                        <img style="width:300px;" src="/public/images/adtheme.jpg" id="remotePreview" />
                    </div>
                </div>
            </div>        
        </div>
    </section>
    
    
<script type="text/javascript">

    $(function(){       

        //加载主题图库
        loadAvatars();
        //Tabs
        uu.tabs($("ul.tabs")); 
        
        $(".js").hide();
        $(".html,.css").width(50+"%");  
       
   
        
        $(".cbutton").click(function(){            
            var i = $(this).parent().index();
            if($(this).hasClass("active")){
                $(this).removeClass("active");
                $(".codeeditor:eq("+i+")").hide();
            }else{
                $(this).addClass("active");
                $(".codeeditor:eq("+i+")").show();
            }
            
            var width = Math.round(1/$(".active").size()*100);
            
            $(".codeeditor").width(width+"%");
            
            return false;
            
            
        });
        
        $("#remoteImage").blur(function(){
            
            var img = $(this).val();            
            $("#remotePreview").attr("src",img);            
        });

    });
    
    var html_editor = CodeMirror.fromTextArea(document.getElementById("Html_code"), {
      lineNumbers: true,
      theme: "ambiance",
      mode:{name:"xml",alignCDATA:true},
      onChange:function(){
        updateIframePreview()
      },
    });
    
    var js_editor = CodeMirror.fromTextArea(document.getElementById("Js_code"), {
      lineNumbers: true,
      theme: "ambiance",
      mode:'javascript',
      onChange:function(){
        updateIframePreview()
      },
    });
    
    var css_editor = CodeMirror.fromTextArea(document.getElementById("Css_code"), {
      lineNumbers: true,
      theme: "ambiance",
      mode:'css',
      onChange:function(){
       updateIframePreview()
      },
    }); 
    
    updateIframePreview();
    
function submitTheme()
{
    
   
    var data = {
        Theme:{
            name:$("#Theme_name").val(),
            html:html_editor.getValue(),
            css:css_editor.getValue(),
            javascript:js_editor.getValue(),
            charge:$("#Theme_charge").val(),
            style:$("#Theme_style").val(),
            folder:$("#modelID").val()
            
        }
    };
    
    console.log(data);
    
    
    $.post('<?php echo $model->isNewRecord?$this->createUrl('/theme/create'):$this->createUrl('/theme/update',array('id'=>$model->id)); ?>',data,function(msg){
        alert(msg);
    })
}
    
   	//检查是否选取了截图
	function checkCoords()
	{	
	   
       if(!$("#modelID").val()){
            uu.alertInfo('操作提示','请先选择您要剪切的图片');
            return false;
       }
       
		if (parseInt($('#w').val())) 
		{
	
			$.post('<?php echo $this->createUrl('/theme/avatar');?>',{'rn':Math.random(),'modelID':parseInt($('#modelID').val()),'x':parseInt($('#x').val()),'y':parseInt($('#y').val()),'w':parseInt($('#w').val()),'h':parseInt($('#h').val())},function(data){
 	
                alert(data);
                $('#preview2').attr('src',data);
					
				uu.alertInfo('操作提示','头像已更改');	

			});		
			
			return ;
		}
		
		uu.alertInfo('操作提示','请选择一个剪切区域，然后点击“更换头像”按钮.');
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
    
    function resizeImage(res)
    {
        $("#preview").attr('src',res.path); 
        $("#preview2").attr('src',res.path);
        $("#target").attr({'src':res.path}); 
        
        //生成一个Image对象，用于读取图片的大小
        var img = new Image();
        img.src = res.path;
        
//        alert(img.height);
        
        var rn = 600/img.width;
        
        var height = Math.round(rn*img.height);
        
//       alert(height); 
                  
              
        
        $("#target").height(height);
           
               
        $("#target").next().height(height);
        $("#target").next().find(".jcrop-tracker").height(height);
        $("#target").next().find('img').height(height).attr({'src':res.path});
        
        
        $("#modelID").val(res.id);
    }
    
    
    //此处有一点小问题，重新加载图片过后，选择框的大小无法控制,
    //如果可以让Jcrop重新加载一次就好了
    function changeAvatar(object){
        
        if(object.hasClass('testAvatar')){
            object.removeClass('testAvatar');
            
            $(".tabs li:eq(0)").trigger('click');
            
        }else{
            object.siblings().removeClass('test');
            object.addClass('test');
        }
        
        
        var path = object.find("img").attr("src");
        
        path = path.split('_')[0]+'.'+path.split('.')[1];
       
        
        var res = {
            id:object.attr("id"),
            path:path
        };        
       
//        alert('id'+data.id+'path:'+data.path);

        resizeImage(res);        

    }
    
    function updateImage(response)
    {
        loadAvatars();
        
        eval('var res = '+response);
        

        resizeImage(res);        


    }    

    function updateIframePreview() {    	
        var previewFrame = document.getElementById('themepreview');
        var preview =  previewFrame.contentDocument || previewFrame.contentWindow.document;
        var head=preview.getElementsByTagName('head').item(0);
        
        preview.open();
        preview.write(html_editor.getValue());
        preview.close();

        
    	uu.loadCssFile('/public/css/main',preview,'cssFile');
    	uu.loadCss(css_editor.getValue(),preview,'cssCode');
    	uu.loadScriptFile('https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min', preview, 'jsFile');
    	uu.loadScript(js_editor.getValue(),preview, 'jsCode');
        
        //iframe自适高度
        $("#themepreview").height($("#themepreview").contents().find(".templateHolder").height());   
    }
    
    //显示图片地址
    function showUrl(object){
        
        var url =  object.find("img").attr("src");
        
        url = url.split('_')[0]+'.'+url.split('.')[1];
        $("#avatarUrl").html(url);
    }
    
    function getRemoteImage()
    {
        var img = $("#remoteImage").val();
        
        $("#remotePreview").attr("src",img);
        
        $.post('<?php echo $this->createUrl('/theme/getremoteimage'); ?>',{url:img},function(data){
            uu.alertInfo('操作提示',data); 
            
            updateImage(data);
        },'json');
    }
    

     
      
  </script>