<?php

$this->widget('ext.Highcharts.HighchartsWidget',array(
	'id'=>'chart',
	'chart'=>array(
		'renderTo'=>'register',
		'type'=>'spline',
		'width'=>730,
	),
	'title'=>array(
		'text'=>'系统数据统计'
	),
	'xAxis'=>array(
		'title'=>array(
			'text'=>'月份'
		),
		'categories'=>array('一月','二月','三月','四月','五月','六月','七月','八月','九月','十月','十一月','十二月')
	),
	'yAxis'=>array(
		'title'=>array(
			'text'=>'新用户注册量（人）'
		),
		'plotLines'=>array(
			array(
				'value'=>0,
				'width'=>1,
				'color'=>'#808080'
			)
		)
	),
	'credits'=>false,
	'tooltip'=>array(
		formatter=>"js:function(){return '<b>'+this.series.name+'</b><br />'+this.x+':'+this.y+'人'}"
	),
	'legend'=>array(
		'layout'=> 'vertical',
        'align'=> 'right',
        'verticalAlign'=> 'top',
        'x'=> -10,
        'y'=> 100,
        'borderWidth'=>0	
	),
	'series'=>$data,

));
?>

<div class="statisticPanel" id="register"></div>