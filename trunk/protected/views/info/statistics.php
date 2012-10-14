<?php
$this->widget('ext.Highcharts.HighchartsWidget',array(
			'container'=>'todo',
			'title'=>array(
				'text'=>'Average fruit consumption during one week'
			),
			'legend'=>array(
                'layout'=>'vertical',
                'align'=>'left',
                'verticalAlign'=>'top',
                'x'=>150,
                'y'=>100,
                'floating'=>true,
                'borderWidth'=>1,
                'backgroundColor'=>'#FFFFFF'			
			),
			'xAxis'=>array(
				'categories'=>array(
                    'Monday',
                    'Tuesday',
                    'Wednesday',
                    'Thursday',
                    'Friday',
                    'Saturday',
                    'Sunday'					
				),
				'plotBands'=>array(
					array(
						'from'=>4.5,
						'to'=>6.5,
						'color'=>'rgba(68,170,213,.2)'
					)
				)
			),
			'yAxis'=>array(
				'title'=>array(
					'text'=>'Fruit units'
				)
			),
            'tooltip'=>array(
				'formatter'=>'function(){return ""+ this.x + ": "+ this.y + " units";}'
			),
            'credits'=>array(
				 'enabled'=>false
			),
            'plotOptions'=>array(
				'areaspline'=>array(
					'fillOpacity'=>0.5
				)
			),
			'series'=>array(
				array(
					'name'=>'John',
					'data'=>array(3,5,3,5,4,10,12)
				),
				array(
					'name'=>'Jane',
					'data'=>array(1, 3, 4, 3, 3, 5, 4)
				)
			)
));


?>
<div id="todo" style="min-width: 400px; height: 400px; margin: 0 auto"></div>
