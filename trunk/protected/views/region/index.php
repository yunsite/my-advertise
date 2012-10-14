<?php
$this->breadcrumbs=array(
	'Regions',
);

$this->menu=array(
	array('label'=>'Create Region', 'url'=>array('create')),
	array('label'=>'Manage Region', 'url'=>array('admin')),
);
?>
<section class="span-19">
	<h4>Regions</h4>
	<div id="region">		
			
	</div>	
</section>
<script type="text/javascript">
$(function(){
	$("#region").load("<?php echo $this->createUrl('/archiver/eaddress');?>");
});
</script>