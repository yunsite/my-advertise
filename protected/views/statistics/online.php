<?php
$this->widget('ext.Highcharts.HighchartsWidget',array(
	'id'=>'chart',
	'headCode'=>'js:Highcharts.setOptions({
            global: {
                useUTC: false
            }
        });',
	'chart'=>array(
		'renderTo'=>'online',
		'type'=>'spline',
		'width'=>730,
		'events'=>array(
			'load'=>'js:function(){
				// set up the updating of the chart each second
                var series = this.series[0];
                setInterval(function() {
                	var x = new Date().getTime(), // current time
                    y = 10000+Math.random()*10;
                    series.addPoint([x, y], true, true);
            	}, 1000);			
			}'
		)
	),
	'title'=>array(
		'text'=>'在线人数实时统计'
	),
	'xAxis'=>array(
		'type'=>'datetime',
		'tickPixelInterval'=>150
	),
	'yAxis'=>array(
		'title'=>array(
			'text'=>'Temperature (°C)'
		),
		'plotLines'=>array(
			array(
				'value'=>0,
				'width'=>1,
				'color'=>'#808080'
			)
		)
	),

	'tooltip'=>array(
		formatter=>"js:function(){
			return '<b>'+ this.series.name +'</b><br/>'+
            Highcharts.dateFormat('%Y-%m-%d %H:%M:%S', this.x) +'<br/>'+
            Highcharts.numberFormat(this.y, 2);
       }"
	),
	'legend'=>array(
		'enable'=>false
	),
	'exporting'=>array(
		'enabled'=> false
	),
	'series'=>array(
		array(
			'name'=>'Live Random data',
			'data'=>'js:(function(){
	                    // generate an array of random data
	                    var data = [],
	                        time = (new Date()).getTime(),
	                        i;
	    
	                    for (i = -29; i <= 0; i++) {
	                        data.push({
	                            x: time + i * 1000,
	                            y: Math.random()*10000
	                        });
	                    }
	                    return data;		
			})()'
		)
	)

));
?>

<div id="online"></div>