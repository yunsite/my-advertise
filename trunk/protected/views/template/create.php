<section class="span-19">
    <h4>创建模板</h4>
    <div class="span-15">
    <span class="button" onclick="uu.alert('kkkk','ssssss');">Button-Lab</span>
    
        <?php $this->renderPartial('_form',array('model'=>$model)); ?>  
        
        <hr class="space span-15" />

    </div>
    
    <aside class="span-4 last">
        <h4 class="pagetitle right">常用数据</h4>
        <div id="dataTemplate" class="clear">

        </div>
     
    </aside>
</section>
<section>
    <h4 class="pagetitle">预览</h4>
    <iframe id="preview" src="<?php echo $this->createUrl('/theme/preview'); ?>"></iframe>

    
</section>

<?php

    $submitUrl = $this->createUrl('/template/create');
    
    $script = <<<SCRIPT
   //提交模板信息
    function submitInfo()
    {
        if($("#Template_cname").val() == '')
         {
            uu.alert('请填写模板别名','操作提示~',function(){
                $("#Template_cname").focus();
            });       
            
            
            return false;
         }   
        
        
        var data = {
          
          'Template[name]':$("#Template_name").val(),
          'Template[code]':formatTemplateCode(),
          'Template[sorttype]':$("#Template_sorttype").val(),
          'Template[cname]':$("#Template_cname").val()
            
        };    
        
        $.post("{$submitUrl}",data,function(msg){
            console.log(msg);
            
            
            if(msg == 'OK')        
                uu.alert("操作提示","模板添加成功！");
            else{            
                $(".errorSummary").show().html($(msg).html());
            }     
    
        });
    } 
        
SCRIPT;
//    Yii::app()->getClientScript()->registerScript('ext-create-CodeMirrorWidget',$script,CClientScript::POS_END);
  
  UtilHelper::writeToFile(Yii::app()->getClientScript());
?>