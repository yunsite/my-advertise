<?php

$this->widget('ext.Highcharts.HighchartsWidget',array(
	'id'=>'chart',
	'chart'=>array(
		'renderTo'=>'regioncountry',
		'type'=>'column',
        'width'=>730,

	),
	
	'title'=>array(
		'text'=>'来访国家统计'
	),
	'xAxis'=>array(
		'labels'=>array(
			'rotation'=>-45,
			'align'=>'right',
			'style'=>array(
				'fontSize'=>'13px',
				'fontFamily'=>'Verdana, sans-serif'
			)
		),
		'categories'=>array_keys($columns)
	),
	'yAxis'=>array(
		'min'=>0,
		'title'=>array(
			'text'=>'访问总人数（人）'
		),
		'labels'=>array(
			'rotation'=>-90,
			'align'=>'right',
			'style'=>array(
				'fontSize'=>'13px',
				'fontFamily'=>'Verdana, sans-serif'
			)
		),
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
		            return '<b>'+ this.point.name +'</b>: '+ Highcharts.numberFormat(this.percentage,2) +' %';
		        }"
			)
		)
	),

	'legend'=>array(
		'enabled'=>false	
	),
	'tooltip'=>array(
		'formatter'=>"js:function(){
			var s;
			if(this.point.name){
				s = this.point.name + ':' + Highcharts.numberFormat(this.y, 2) + '%';
			}else{
				s = this.x + ':' + Highcharts.numberFormat(this.y, 0);
			}
            return s
       }"
	),
	'series'=>array(	
		array(
			'type'=>'column',
			'name'=>'国家访问数据',
			'data'=>array_values($columns),
			'dataLabels'=>array(
                    enabled=> true,
                    rotation=> -90,
                    color=> '#FFFFFF',
                    align=> 'right',
                    x=> -3,
                    y=> 10,
                    formatter=>'js:function() {
                        return this.y;
                    }',
                    style=>array(
                        fontSize=> '13px',
                        fontFamily=> 'Verdana, sans-serif'
                    )		
				
			)
		),
		array(
			'type'=>'pie',
			'name'=>'系统平台',
			'data'=>$pie,
			'size'=>100,
			'center'=>array(500,80),
			'showInLegend'=>false,

		)
	)

));
?>              
<h1>来访国家统计</h1>
<div class="statisticPanel" id="regioncountry"></div>