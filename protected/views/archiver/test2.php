
<?php $this->widget('ext.editor.ueditor.ueditorWidget',array(
		'id'=>'myEditor',
		'initialContent' => '<span style="color:#ccc">欢迎使用ueditor</span>',
		'initialStyle' => 'body{margin:8px;font-family:"宋体";font-size:16px;}',
		'elementPathEnabled' => true,
		'minFrameHeight' => 300,
		'autoClearinitialContent' => true,
		'imagePath' => '/',
		'textarea' => 'myValue'
//		'autoHeightEnabled' => false,
//		'toolbars'=>array(array('Undo','Redo','|','ForeColor','BackColor', 'Bold','Italic','Underline','JustifyLeft','JustifyCenter','JustifyRight','InsertImage','ImageNone','ImageLeft','ImageRight','ImageCenter' )),
));?>
<h1>UEditor自定义插件</h1>
<form id="myForm" action="" method="post">
	<!--style给定宽度可以影响编辑器的最终宽度-->
	<script type="text/plain" id="myEditor" style="width:100%">
		
	</script>
    <input type="submit" value="Form内部提交数据" />
</form>



