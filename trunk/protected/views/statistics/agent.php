<?php
$result = array(

);

$this->widget('ext.Highcharts.HighchartsWidget',array(
	'id'=>'chart',
	'chart'=>array(
		'renderTo'=>'agent',
        'plotBackgroundColor'=> null,
        'plotBorderWidth'=> null,
        'plotShadow'=> false,
        'width'=>730,

	),
	
	'title'=>array(
		'text'=>'浏览器使用情况统计'
	),
	'plotOptions'=>array(
		'pie'=>array(
		    'allowPointSelect'=> true,
		    'cursor'=> 'pointer',
		    'dataLabels'=>array(
		        'enabled'=> true,
		        'color'=> '#000000',
		        'connectorColor'=> '#000000',
		        'formatter'=>"js:function() {
		            return '<b>'+ this.point.name +'</b>: '+ Highcharts.numberFormat(this.percentage) +' %';
		        }"
			)
		)
	),
	'tooltip'=>array(
		formatter=>"js:function(){
			return '<b>'+ this.point.name +'</b><br/>'+
            Highcharts.numberFormat(this.y, 2)+'%';
       }"
	),
	'series'=>array(		
		array(
			'type'=>'pie',
			'name'=>'Browser',
			'data'=>$agent		
		)
	)

));
?>              

<div id="agent"></div>