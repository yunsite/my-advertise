<script type="text/javascript">
<!--
//initialisation
editAreaLoader.init({
	id: "example_1"	// id of the textarea to transform		
	,start_highlight: true	// if start with highlight
	,allow_resize: "both"
	,allow_toggle: true
	,word_wrap: true
	,language: "zh"
	,syntax: "php"	
});

function createComponent()
{

	var data = {
		'name':''
	};
	
	$.post("<?php echo $this->createUrl('ccomponent');?>",data,function(){

	});
	
}

$(function(){
	$("header").slideUp();
});
//-->
</script>
<?php $this->widget('ext.editor.editarea.editareaWidget');?>
<textarea id="example_1"  style="height: 350px; width: 100%;" name="test_1">
</textarea>
<input type='button' onclick='alert(editAreaLoader.getValue("example_1"));' value='get value' />