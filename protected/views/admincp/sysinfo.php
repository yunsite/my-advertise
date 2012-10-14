<section class="span-19">
<h4 class="pageTitle">服务器参数</h4>

<?php 
$log = new CFileLogRoute();
UtilHelper::dump($log->getLogFile());
?>
<ul id="sys-info">
	<li>系统类型及版本号：<?php echo php_uname();?></li>
	<li>服务器解译引擎：<?php echo $_SERVER['SERVER_SOFTWARE'];?></li>
	<li>域名：<?php echo $_SERVER["HTTP_HOST"];?></li>
	<li>Zend 版本：<?php echo zend_version();?></li>
	<li>PHP安装路径：<?php echo DEFAULT_INCLUDE_PATH;?></li>
	<li>可用扩展：<?php var_dump(extension_loaded('id3'));?></li>
	<li>服务器IP：<?php echo gethostbyname($_SERVER['SERVER_NAME']);?></li>
	<li>接受请求的服务器IP：<?php echo $_SERVER['SERVER_ADDR'];?></li>
	<li>获取服务器Web端口：<?php echo $_SERVER['SERVER_PORT'];?></li>
	<li>客户端IP：<?php echo $_SERVER['REMOTE_ADDR'];?></li>
	<li>服务器CPU数量：<?php echo $_SERVER['PROCESSOR_IDENTIFIER'];?></li>
	<li>服务器系统目录：<?php echo $_SERVER['SystemRoot'];?></li>
	<li>服务器语言：<?php echo $_SERVER['HTTP_ACCEPT_LANGUAGE'];?></li>
	<li>当前文件绝对路径：<?php echo __FILE__;?></li>
</ul>	
</section>