<script type="text/javascript">
$(function(){
   uu.tabs($("ul.tabs")); 
   
   uu.codeEditor();
   

});

function insertData(object)
{
    html_codeeditor.replaceSelection(object.attr("id"));
}


function updatePreview() {
	
    var previewFrame = document.getElementById('preview');
    var preview =  previewFrame.contentDocument ||  previewFrame.contentWindow.document;
    var head=preview.getElementsByTagName('head').item(0); 
    
    preview.open();
    preview.write(html_codeeditor.getValue());
    preview.close();   
    
    
   
	uu.loadCssFile('/public/css/main',preview,'css_file');
	uu.loadCss(css_codeeditor.getValue(),preview,'css_code');
	uu.loadScriptFile('https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min', preview, 'js_file');
	uu.loadScript(js_codeeditor.getValue(),preview, 'js_code');
	
}

function submitTheme()
{
    
   
    var data = {
        Theme:{
            name:$("#Theme_name").val(),
            html:html_codeeditor.getValue(),
            css:css_codeeditor.getValue(),
            javascript:js_codeeditor.getValue(),
            charge:$("#Theme_charge").val(),
            style:$("#Theme_style").val()
            
        }
    };
    
    console.log(data);
    
    
    $.post('<?php echo $this->createUrl('/theme/create'); ?>',data,function(msg){
        alert(msg);
    })
}

</script>
<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'theme-form',
	'enableAjaxValidation'=>true,
)); ?>

	<?php echo $form->errorSummary($model); ?>
    
	<div class="row span-4">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>16,'maxlength'=>24)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>
    <div class="row span-4">
		<?php echo $form->labelEx($model,'style'); ?>
		<?php echo $form->dropDownList($model,'style',Theme::model()->generateStyleList()); ?>
		<?php echo $form->error($model,'style'); ?>
	</div>
    <div class="row span-4">
		<?php echo $form->labelEx($model,'charge'); ?>
		<?php echo $form->textField($model,'charge',array('size'=>16)); ?>
		<?php echo $form->error($model,'charge'); ?>
	</div>
    <div class="row buttons span-2">
		<?php echo CHtml::Button($model->isNewRecord ? 'Create' : 'Save',array('onclick'=>'submitTheme();')); ?>
	</div>
    <hr class="space" />
    <div class="section" style="width:738px;">
        <ul class="tabs">
            <li class="current">HTML</li>
            <li>CSS</li>
            <li>JAVASCRIPT</li>
        </ul>
        <div class="box visible">
            <div class="codeToolBar">
                <span class="codeToolIco codeToolIcoPrev first" title="后退" onclick="html_codeeditor.undo();"></span>
                <span class="codeToolIco codeToolIcoNext" title="前进" onclick="html_codeeditor.redo();"></span>
                <span class="codeToolIco codeToolIcoInsert" title="插入数据"></span>
                <span class="codeToolIco codeToolIcoUpdate" title="更新数据"></span>
                <span class="codeToolIco codeToolIcoSave" onclick="uu.alertInfo('kdkd');" title="保存"></span>
            </div>
            <div class="codeEditor_dataBox">
            	<div class="codeEditor_dataContent"></div>
            	<div class="codeEditor_closeButton" onclick="$(this).parent().slideUp();"></div>
            </div>
            <textarea id="Html_code"></textarea>
        </div>
        <div class="box">
            <div class="codeToolBar">
                <span class="codeToolIco codeToolIcoPrev first" title="后退"></span>
                <span class="codeToolIco codeToolIcoNext" title="前进"></span>
                <span class="codeToolIco codeToolIcoUpdate" title="更新数据"></span>
                <span class="codeToolIco codeToolIcoSave" title="保存"></span>
            </div>
            <textarea id="Css_code"></textarea>
        </div>
        <div class="box">
            <div class="codeToolBar">
                <span class="codeToolIco codeToolIcoPrev first" title="后退"></span>
                <span class="codeToolIco codeToolIcoNext" title="前进"></span>
                <span class="codeToolIco codeToolIcoUpdate" title="更新数据"></span>
                <span class="codeToolIco codeToolIcoSave" title="保存"></span>
            </div>
            <textarea id="Js_code"></textarea>        
        </div>        
    </div>
    <iframe id="preview" style="width:98%;height:400px;"></iframe>

	


<?php $this->endWidget(); ?>

</div><!-- form -->


<?php 
    
    $this->widget('ext.editor.CodeMirror.CodeMirrorWidget',array(
        'id'=>'Html_code',
        'editor'=>'html_codeeditor',
        'mode'=>'html',
        'lineNumbers'=> true,
        'theme'=>'ambiance',
        'syntax'=>'html',
        'onChange'=>'js:function(){
              //实时预览样式
              updatePreview();
 //             previewInfo();
        }',
        
    ));
    
     $this->widget('ext.editor.CodeMirror.CodeMirrorWidget',array(
        'id'=>'Css_code',
        'editor'=>'css_codeeditor',
        'mode'=>'css',
        'lineNumbers'=> true,
        'theme'=>'ambiance',
        'syntax'=>'css',
        'onChange'=>'js:function(){
              //实时预览样式
              updatePreview();
 //             previewInfo();
        }',
        
    ));
    
    $this->widget('ext.editor.CodeMirror.CodeMirrorWidget',array(
        'id'=>'Js_code',
        'editor'=>'js_codeeditor',
        'mode'=>'javascript',
        'lineNumbers'=> true,
        'theme'=>'ambiance',
        'syntax'=>'javascript',
        'onChange'=>'js:function(){
              //实时预览样式
              updatePreview();
 //             previewInfo();
        }',
        
    ));   
     
 ?>