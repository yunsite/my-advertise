<section class="span-19">
    <div class="span-12">
        <textarea id="online-editor" class="span-12" style="height:550px;width:400px;" name="test_3">
		
        </textarea>    
    </div>
    <hr class="space" />
    <span class="button" onclick="alert(editAreaLoader.getValue('online-editor'));">提交</span>

    <aside class="span-7 last">
        <h4 class="pagetitle">预览</h4>
    </aside>
</section>

	<?php 
		$this->widget('ext.editor.editarea.editareaWidget',array(
			'id'=>'online-editor',
//            'min_width'=>440,
            'min_height'=>200,
            'language'=>'zh',
            'word_wrap'=>true,
            'autocompletion'=>true,
            'save_callback'=>'alert("Hello");',
            'load_callback'=>'alert("yellow");'	,
            'toolbar'=>'search,go_to_line,|,undo,redo,|,select_font,|,syntax_selection,|,change_smooth_selection,highlight,reset_highlight,|,help'
		));
	?>