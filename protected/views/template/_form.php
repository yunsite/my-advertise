<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'template-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">注：在使用参数时首先需要选择<span class="required">模板分类</span></p>

	<?php echo $form->errorSummary($model); ?>
    
	<div class="row span-4">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>50,'maxlength'=>50,'class'=>'span-3 poshy','title'=>'模板名称')); ?>
        <?php echo $form->error($model,'name',array('class'=>'errorMessage span-4')); ?>
	</div>
 	<div class="row span-4">
		<?php echo $form->labelEx($model,'cname'); ?>
		<?php echo $form->textField($model,'cname',array('size'=>50,'maxlength'=>50,'class'=>'span-3 poshy','title'=>'模板别名')); ?>
        <?php echo $form->error($model,'cname',array('class'=>'errorMessage span-4')); ?>
	</div>   
    <div class="row span-3">
		<?php echo $form->labelEx($model,'sorttype'); ?>
		<?php echo $form->dropDownList($model,'sorttype',Template::model()->generateSortTypeList(),array('class'=>'poshy','title'=>'选择模板类型')); ?>
		<?php echo $form->error($model,'sorttype'); ?>
	</div>
    
    <hr class="space" />
	<div class="row">
		<?php echo $form->labelEx($model,'code'); ?>
		<?php echo $form->textArea($model,'code',array('rows'=>6, 'cols'=>50,'class'=>'poshy', 'title'=>'模板代码')); ?>
		<?php echo $form->error($model,'code'); ?>
	</div>

	<div class="row buttons">
        <?php echo CHtml::Button($model->isNewRecord ? '发表' : '保存',array('class'=>'button','onclick'=>'submitInfo();','style'=>'width:80px;height:30px;')); ?>
	</div>

<?php $this->endWidget(); ?>
<button onclick="uu.alert('dkdk','dkdk');"></button>
<span class="button" onclick="codeeditor.undo();">后退</span>
<span class="button" onclick="codeeditor.redo();">前进</span>
</div><!-- form -->
<script type="text/javascript">

/**
 *格式化内容中定义的类名：prefix-class
 **/ 
function formatTemplateCode()
{   
    var prefix = $("#Template_cname").val();
    

    var html = codeeditor.getValue('Template_code');
    
//    alert(html);
    html = html.replace(/class="(.*?)"/g,function(str,p1,offset,s){
        
        if(p1.indexOf(prefix))      
        {
//            console.log('class= "'+ prefix + '-' + p1 +'"' );
            
            return 'class= "'+ prefix + '-' + p1 +'"' ;
        }
        else
        {
 //           console.log('class="'+p1+'"');
            return 'class="'+p1+'"';
        }        
        
    });
    return html;
    
//    console.log(html);

    
}


function insertData(object)
{
    codeeditor.replaceSelection(object.attr("id"));
}


function updatePreview() {
    var previewFrame = document.getElementById('preview');
    var preview =  previewFrame.contentDocument ||  previewFrame.contentWindow.document;
    preview.open();
    preview.write(codeeditor.getValue());
    preview.close();
}

//将转义的代码显示出来
function previewInfo()
{
    var s = codeeditor.getValue("Template_code");
    
    if(s.length == 0) return '';   
         
    s = s.replace(/&lt;/g, "<");
    s = s.replace(/&gt;/g, ">"); 
    s = s.replace(/&nbsp;/g, " ");
    s = s.replace(/&#39;/g, "\'");
    s = s.replace(/&quot;/g, "\"");
    s = s.replace(/<br>/g, "\n");
  
    $("#previewInfo").html(s);
    
    var html = formatHtml();    
    codeeditor.setValue("Template_code",html);
}

</script>
<?php 
    
    $this->widget('ext.editor.CodeMirror.CodeMirrorWidget',array(
        'id'=>'Template_code',
        'editor'=>'codeeditor',
        'mode'=>'html',
        'lineNumbers'=> true,
        'theme'=>'lesser-dark',
        'syntax'=>'html',
        'onChange'=>'js:function(){
              //实时预览样式
              updatePreview();
 //             previewInfo();
        }',
        
    ));
    
     
 ?>
