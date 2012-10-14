<?php $this->beginContent('//layouts/main'); ?>


<?php 
	if ($this->action->id == 'index')
		$bakground = 'transparent';
	else 
		$bakground = 'white';
?>

<div class="container" style="background:transparent;border:0px solid #ffe;">
	<aside class="span-4 first left">
		<!-- <h4 style="background: #FF7F24;padding:5px 10px;margin:5px;color:white;border-radius:5px;">个人中心首页</h4> -->
		<?php			
			$this->widget('ext.sidebar.sidebarWidget',array(
				'view'=>'userinfo'
			));

			$this->widget('ext.sidebar.sidebarWidget',array(
				'view'=>'applications'
			));
		?>
	</aside>
	<div class="adSection" style="margin-left: 160px;"  id="blankArea">
		<?php echo $content; ?>
	</div>
</div>
<?php $this->endContent(); ?>
