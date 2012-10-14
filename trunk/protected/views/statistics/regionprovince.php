<?php

$this->widget('ext.Highcharts.HighchartsWidget',array(
	'id'=>'chart',
	'headCode'=>'
		var colors = Highcharts.getOptions().colors,
			categories = '.$categories.','.
			'name = "国内访问数据",'.	
			'data = '.$data.';'.
		'function setChart(name, categories, data, color) {
			chart.xAxis[0].setCategories(categories);
			chart.series[0].remove();
			chart.addSeries({
				name: name,
				data: data,
				color: color || "grey"
			});
		}'
	,
	'chart'=>array(
		'renderTo'=>'regionprovince',
		'type'=>'column',
        'width'=>730,

	),
	
	'title'=>array(
		'text'=>'国内访问统计'
	),
	'subtitle'=>array(
		'text'=>'点击查看子栏目，再点击子栏目返回'
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
		'categories'=>'js:categories'
	),
	'yAxis'=>array(
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
	'legend'=>array(
		'enabled'=>false	
	),
	'plotOptions'=>array(
		'column'=>array(
			'cursor'=>'pointer',
			'point'=>array(
				'events'=>array(
					'click'=>'js:function(){
						var drilldown = this.drilldown;
						if (drilldown) { // drill down
							setChart(drilldown.name, drilldown.categories, drilldown.data, drilldown.color);
						} else { // restore
							setChart(name, categories, data);
						}					
					
					}'
				)
			)
		),
		'dataLabels'=>array(
			'enabled'=> true,
			'style'=>array(
				'fontWeight'=>'bold',	
			),
			'formatter'=>'js:function(){
				return this.y + "人";
			}',
		)
	),
	'tooltip'=>array(
		'formatter'=>"js:function(){
			var point = this.point,
				s = this.x + ':<b>'+this.y+'</b><br />';
			if(point.drilldown){
				s = point.category + ':' + this.y + '人';
			}else{
				s = point.category + ':' + this.y + '人';
			}
            return s;
       }"
	),
	'series'=>array(	
		array(
			'name'=>'js:name',
			'data'=>'js:data',
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
	),
	'exporting'=>array(
		'enabled'=>false
	)

));
?>              

<div id="regionprovince"></div>