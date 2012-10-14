<?php
$this->widget('ext.Highcharts.HighchartsWidget',array(
	'id'=>'chart',
	'chart'=>array(
		'renderTo'=>'platform',
        'plotBackgroundColor'=> null,
        'plotBorderWidth'=> null,
        'plotShadow'=> false,
        'width'=>730,

	),
	
	'title'=>array(
		'text'=>'系统平台统计'
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
			return '<b>'+ this.point.name +'</b><br/>'+this.y + '%';
       }"
	),
	'series'=>array(		
		array(
		'type'=>'pie',
		'name'=>'系统平台',
		'data'=>$platform,


		)
	)

));
?>              

<div id="platform"></div>