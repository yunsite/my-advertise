<?php
$this->breadcrumbs=array(
	'Templates',
);

$this->menu=array(
	array('label'=>'Create Template', 'url'=>array('create')),
	array('label'=>'Manage Template', 'url'=>array('admin')),
);
?>
<script type="text/x-kendo-template" id="template">
    <div class="toolbar">
        <label class="sorttype-label" for="sorttype">模板类型</label>
        <input type="search" id="sorttype" style="width:230px" />
    </div>
</script>
<script type="text/javascript">
$(function(){
    $.frame(); 
    
    $("#grid").kendoGrid({
        dataSource: {
            data: <?php echo $data; ?>,
            schema: {
                model: {
                    fields: {
                        id:{type:"number"},
                        name: { type: "string" },
                        sorttype: {type: "number"},
                        pubdate: {type: "date"}

                    }
                }
            },
            pageSize: 5
        },
        change:function(){
    
         var selected = $.map(this.select(),function(item){
               return $(item).id; 
                
            });
                       
            alert(selected);
        },
        toolbar: kendo.template($("#template").html()),
        height: 400,
        scrollable: true,
        sortable: true,
        filterable: true,
        pageable: true,
        selectable: "single line",
        columns: [
            {
                field: "id",
                title: "ID",
                width: 100
            },
            {
                field: "name",
                title: "模板名称",
                width: 300
            },
            {
                file: "sorttype",
                title: "模板类型",
                
            },
            {
                field: "pubdate",
                title: "发布时间",
 //               template: '#= kendo.toString(BirthDate,"MM/dd/yyyy") #'
            }

        ]
    });
    
    var dropDown = grid.find("#sorttype").kendoDropDownList({
       dataTextField:$("") 
    });
});
</script>
<h1>Templates</h1>
<div id="panels">
    <div id="left-panel">
        <div id="grid"></div>
    </div>
    <div id="right-panel">Right</div>
</div>


