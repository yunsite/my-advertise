<section class="span-19">
<h4>创建主题</h4>
<div class="span-14">
     
    <?php $this->renderPartial('_form',array('model'=>$model)); ?>
    <span class="button" onclick="alert(codeeditor.getValue());">click</span>
</div>
<div class="span-5 last">
    <h4 class="right"><?php echo CHtml::dropDownList('sorttype', null,Template::model()->generateSortTypeList()); ?></h4>
    <div id="dataTemplate" class="span-5">
   
    请先选择模板分类
    </div>
</div>

</section>
<hr />
<section class="span-19" id="previewInfo">
<button onclick="uu.alert('dkkd','dkd')">dkd</button>
</section>

<script type="text/javascript">


var html = '';  //html模板内容

//选择sorttype，输出对应的模板
function changeSortType(object){
    $.get('<?php echo $this->createUrl('/template/template'); ?>',{id:object.val()},function(data){
        
        $("#dataTemplate").html(data);
    });
}
//把codeeditor中的CSS代码运用到模板中，并显示在$("#previeInfo")标签中
function performceHtml()
{
     $("#previewInfo").html('<style type=\"text/css\">'+codeeditor.getValue()+'</style>' + html);
}

//加载模板并设置相应的值，为editor加载css代码，对previewInfo加载模板代码
function loadTemplate(object)
{
    object.siblings().removeClass('active');
    
    object.addClass('active');
    
    $("#Style_template").val(object.attr("id"));
    
   
    $.get('<?php echo $this->createUrl('/template/view');?>',{id:object.attr('id')},function(data){
        console.log(data);
        
        html = data.html;
        
        codeeditor.setValue(data.css);
        
        $('#previewInfo').html(html);
    },'json');    

}



$(function(){

    //sorttype的change事件
   $("#sorttype").chosen().change(function(){
        changeSortType($(this));
   }); 
});
</script>