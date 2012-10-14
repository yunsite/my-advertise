<?php
$this->widget('ext.Highcharts.HighchartsWidget',array(
	'id'=>'chart',
	'chart'=>array(
		'renderTo'=>'spaceinfo',
        'plotBackgroundColor'=> null,
        'plotBorderWidth'=> null,
        'plotShadow'=> false,
        'width'=>730,

	),
	
	'title'=>array(
		'text'=>'磁盘空间使用情况统计'
	),
	'xAxis'=>array(
		'title'=>array(
			'text'=>'硬盘使用情况'
		),
		'categories'=>array('系统容量','上传文件占用容量','剩余容量')
	),
	'yAxis'=>array(
		'title'=>array(
			'text'=>'占用空间容量(M)'
		),
	),'plotOptions'=>array(
		'pie'=>array(
		    'allowPointSelect'=> true,
		    'cursor'=> 'pointer',
		    'dataLabels'=>array(
		        'enabled'=> true,
		        'color'=> '#000000',
		        'connectorColor'=> '#000000',
		        'formatter'=>"js:function() {
		            return '<b>'+ this.point.name +'</b>: '+ Highcharts.numberFormat(this.y) +' %';
		        }"
			)
		)
	),
	'tooltip'=>array(
		formatter=>"js:function(){
			return '<b>'+ this.point.name +'</b><br/>'+
            Highcharts.numberFormat(this.y/(1024*1024), 2)+'M';
       }"
	),
	'series'=>array(		
		array(
			'type'=>'pie',
			'name'=>'Browser',
			'data'=>$data,
			'size'=>100,
			'center'=>array(150,80)		
		),
		array(
			'type'=>'column',
			'name'=>'Space',
			'data'=>$column
		)
	)

));
?>              
<h1>磁盘空间使用统计</h1>
<div class="statisticPanel" id="spaceinfo"></div>