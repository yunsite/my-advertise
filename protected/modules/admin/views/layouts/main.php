<?php $this->beginContent('/layouts/base'); ?>
	<script type="text/javascript">
	<!--
	(function($){
		var origContent = '';
		
		function load(hash){
			if(hash != ''){
				if(origContent == ''){
					origContent = $("#blankArea").html();
				}
		
				url = '/'+hash.replace('_','/')+'.html';

//				alert(url);
		
				$("#blankArea").load(url,function(){prettyPrint();});
			} else if(origContent != ''){
				$("#blankArea").html(origContent);
			
			}

		}
		
		$(function(){

			
			$.history.init(load);
			
			$(".history").click(function(){
		//		var url = $(this).attr("href");
		
		//		$.get(url,{'rn':Math.random()},function(data){
		//			$("#blankArea").html(data);
		//		});
				
		
		        var url = $(this).attr('href');	               
	
				url = url.replace(/^.*#/, ''); 
	
	
	//	    	alert(url);
		
		        $.history.load(url);
				
				return false;
			});
		
	
		});
	})(jQuery);
	</script>
	<!-- Header -->
	<header id="top">
		<div class="wrapper">
			<!-- Title/Logo - can use text instead of image -->
			<div id="title"><img SRC="<?php echo $this->getModule()->register('img/logo.png')?>" alt="Administry" /><!--<span>Administry</span> demo--></div>
			<!-- Top navigation -->
			<div id="topnav">
				<a href="#"><img class="avatar" SRC="<?php echo $this->getModule()->register('img/user_32.png')?>" alt="" /></a>
				当前用户： <b><?php echo Yii::app()->user->name;?></b>
				<span>|</span> <a href="#">Settings</a>
				<span>|</span> <a href="<?php echo $this->createUrl('/site/logout');?>">注销</a><br />
				<small>You have <a href="#" class="high"><b>1</b> new message!</a></small>
			</div>
			<!-- End of Top navigation -->
			<!-- Main navigation -->
			<nav id="menu">
				<ul class="sf-menu">
					<li><a HREF="<?php echo $this->createUrl('default/index');?>">控制面板</a></li>
					<li>
						<a HREF="styles.html">广告管理</a>
						<ul>
							<li>
								<a HREF="styles.html">Basic Styles</a>
							</li>
							<li>
								<a href="#">Sample Pages...</a>
								<ul>
									<li><a HREF="samples-files.html">Files</a></li>
									<li><a HREF="samples-products.html">Products</a></li>
								</ul>
							</li>
						</ul>
					</li>
					<li><a HREF="<?php echo $this->createUrl('analytics/index');?>">流量统计</a></li>
					<li><a HREF="forms.html">反馈信息</a></li>	
					<li class="current"><a HREF="graphs.html">Graphs</a></li>	
				</ul>
			</nav>
			<!-- End of Main navigation -->
			<!-- Aside links -->
			<aside><b>English</b> &middot; <a href="#">Spanish</a> &middot; <a href="#">German</a></aside>
			<!-- End of Aside links -->
		</div>
	</header>
	<!-- End of Header -->

	<?php echo $content;?>

	<!-- Page footer -->
	<footer id="bottom">
		<div class="wrapper">
			<nav>
				<a href="#">Dashboard</a> &middot;
				<a href="#">Content</a> &middot;
				<a href="#">Reports</a> &middot;
				<a href="#">Users</a> &middot;
				<a href="#">Media</a> &middot;
				<a href="#">Events</a> &middot;
				<a href="#">Newsletter</a> &middot;
				<a href="#">Settings</a>
			</nav>
			<p>Copyright &copy; 2010 <b><a HREF="http://www.865171.cn" title="www.865171.cn">www.865171.cn</a></b> | Icons by <a HREF="http://www.865171.cn">865171.cn</a></p>
		</div>
	</footer>
	<!-- End of Page footer -->
	
	<!-- Animated footer -->
	<footer id="animated">
		<ul>
			<li><a href="#">Dashboard</a></li>
			<li><a href="#">Content</a></li>
			<li><a href="#">Reports</a></li>
			<li><a href="#">Users</a></li>
			<li><a href="#">Media</a></li>
			<li><a href="#">Events</a></li>
			<li><a href="#">Newsletter</a></li>
			<li><a href="#">Settings</a></li>
		</ul>
	</footer>
	<!-- End of Animated footer -->
	
	<!-- Scroll to top link -->
	<a href="#" id="totop">^ scroll to top</a>

<?php $this->endContent();?>