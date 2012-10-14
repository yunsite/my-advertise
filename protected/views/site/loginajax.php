<section class="span-19 last" style="opacity:0.8;">
<h4>用户登录</h4>
<div class="span-9">
	<p>请使用您的登录凭证填写下表单:</p>
	<?php $this->renderPartial('_loginform',array('model'=>$model));?>
</div>
</section>
<hr class="space" />
<?php	

    $this->widget('ext.poshytip.Poshytip', array(
    	"selector"=>".poshy",	
    	'tooltips'=>array(
			'className'=>'tip-yellowsimple',
			'showOn'=>'focus',
			'alignTo'=>'target',
			'alignX'=>'right',
			'alignY'=>'center',
			'offsetX'=>5	
    	)	
    ));
    
    $this->widget('ext.chosen.chosenWidget');
    
?>
