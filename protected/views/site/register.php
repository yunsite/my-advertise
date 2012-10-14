<?php
$this->pageTitle= '注册新帐号 - '.Yii::app()->name;
/*
$this->breadcrumbs=array(
	'注册新帐号',
);
*/
$this->menu=array(
	array('label'=>'我把忘记密码了，怎么办？', 'url'=>array('create')),
	array('label'=>'网站使用操作演示', 'url'=>array('admin')),
	array('label'=>'常见问题集', 'url'=>array('create')),
	array('label'=>'在悦珂谷你能做什么，又能得到什么？', 'url'=>array('admin')),
	array('label'=>'我们的宗旨，我们的期待', 'url'=>array('create')),
	array('label'=>'Manage Lookup', 'url'=>array('admin')),
);

?>
<script type="text/javascript">
<!--
function loadRegionForm(){

	$("#regions").load("<?php echo $this->createUrl('/archiver/eaddress');?>").animate({"height":"auto"});

	$(":input").change(function(){
		$("#RegisterForm_region").val($("#Profile_addressdetail").val());
	});
	
}
//-->
</script>
<h1>注册新帐号</h1>
<section class="span-9 adSection" style="opacity:0.8; border:5px;">
<?php if(Yii::app()->user->hasFlash('register')): ?>

	<div class="flash-success">
		<?php echo Yii::app()->user->getFlash('register'); ?>
	</div>

<?php else: ?>
	<?php $this->renderPartial('_registerform',array('model'=>$model));?>
<?php endif;?>

</section>

<section class="span-5 last right">
	<?php 
		$this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>'最近加入的悦珂人',
			'contentCssClass' => 'portlet-content portlet-decoration-underline'
		));
		
		 $this->widget('ext.sidebar.sidebarWidget',array(
			'view'=>'register'
		));
	?>		
	<?php $this->endWidget();?>

	
</section>
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

