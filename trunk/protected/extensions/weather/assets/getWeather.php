<?php
	header("content-type: text/html");
	$url = 'http://m.weather.com.cn/data/';
	$id = (int)$_GET['id'];
	$data = file_get_contents($url . $id .'.html');
	echo $data;
?>