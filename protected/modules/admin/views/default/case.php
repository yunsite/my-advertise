	<script type="text/javascript">
	$(document).ready(function(){
		
		/* setup navigation, content boxes, etc... */
		Administry.setup();
		
		/* datatable */
		$('#example').dataTable();
		
		/* expandable rows */
		Administry.expandableRows();
	});


	function t1(){alert("1")};
	function t1(){alert("2")};

	t1();
	
	</script>
		<!-- Page title -->
	<div id="pagetitle">
		<div class="wrapper">
			<h1>Table examples</h1>
			<!-- Quick search box -->
			<form action="" method="get"><input class="" type="text" id="q" name="q" /></form>
		</div>
	</div>
	<!-- End of Page title -->
	
	<!-- Page content -->
	<div id="page">
		<!-- Wrapper -->
		<div class="wrapper">
				<!-- Left column/section -->
				<section class="column width6 first" id="blankArea">
				<h1>Hello</h1>
				</section>
				<!-- End of Left column/section -->
				
				<!-- Right column/section -->
				<aside class="column width2">
					<div id="rightmenu">
						<header>
							<h3>You might also want to check out...</h3>
						</header>
						<dl class="first">
							<dt><img width="16" height="16" alt="Basic styles" SRC="<?php echo $this->getModule()->register('img/style.png');?>"></dt>
							<dd><a HREF="#region_admin">Basic styles</a></dd>
							<dd class="last">Basic elements and styles</dd>							
							
							<dt><img width="16" height="16" alt="" SRC="<?php echo  $this->getModule()->register('img/book.png');?>"></dt>
							<dd><a HREF="#region_create">www.865171.cn</a></dd>
							<dd class="last">Datatable documentation</dd>							
						</dl>
					</div>
					<div class="content-box">
						<header>
							<h3>Tables</h3>
						</header>
						<section>
							Try other alternatives:<br/>
							<dl>
								<dt></dt>
								<dd><a HREF="http://www.865171.cn">www.865171.cn</a></dd>
							</dl>
						</section>
					</div>
				</aside>
				<!-- End of Right column/section -->
				
		</div>
		<!-- End of Wrapper -->
	</div>
	<!-- End of Page content -->