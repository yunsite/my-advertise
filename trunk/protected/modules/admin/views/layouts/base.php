<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title><?php echo $this->pageTitle;?></title>
<meta name="description" content="Administry - Admin Template by www.865171.cn" />
<meta name="keywords" content="Admin,Template" />
<!-- Favicons --> 
<link rel="shortcut icon" type="image/png" HREF="<?php echo $this->getModule()->register('img/favicons/favicon.png');?>"/>
<link rel="icon" type="image/png" HREF="<?php echo $this->getModule()->register('img/favicons/favicon.png');?>"/>
<link rel="apple-touch-icon" HREF="<?php echo $this->getModule()->register('img/favicons/apple.png');?>" />
<!-- --> 

<!-- Colour Schemes
Default colour scheme is blue. Uncomment prefered stylesheet to use it.
<link rel="stylesheet" href="css/brown.css" type="text/css" media="screen" />  
<link rel="stylesheet" href="css/gray.css" type="text/css" media="screen" />  
<link rel="stylesheet" href="css/green.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/pink.css" type="text/css" media="screen" />  
<link rel="stylesheet" href="css/red.css" type="text/css" media="screen" />
-->
<!-- Your Custom Stylesheet --> 
<?php 
	$files = array(
		'css/style.css',	//Main Stylesheet 
		'css/custom.css',
		'js/swfobject.js',	//swfobject - needed only if you require <video> tag support for older browsers
		'js/jquery.ui.core.min.js',
		'js/js/jquery.ui.widget.min.js',
		'js/jquery.ui.tabs.min.js',
		'js/jquery.tipTip.min.js',//jQuery tooltips
		'js/jquery.superfish.min.js',//Superfish navigation
		'js/jquery.supersubs.min.js',
		'js/jquery.validate_pack.js',//'jQuery form validation'
		'js/jquery.nyroModal.pack.js',//jQuery popup box
	 	'js/administry.js'//User interface javascript load

	);
	Yii::app()->clientScript->registerCoreScript('jquery');
	$this->getModule()->registerFiles($files);
	Yii::app()->clientScript->registerScriptFile('/public/js/jquery.history.js');
//	Yii::app()->clientScript->registerScriptFile('/public/js/history.js');
?>


<!-- Internet Explorer Fixes --> 
<!--[if IE]>
<?php 
	$ieFiles = array(
		'css/ie.css',
		'js/html5.js'
	);
	
	$this->getModule()->registerFiles($ieFiles);


?>

<![endif]-->
<!--Upgrade MSIE5.5-7 to be compatible with MSIE8: http://ie7-js.googlecode.com/svn/version/2.1(beta3)/IE8.js -->
<!--[if lt IE 8]>
<?php $this->getModule()->register('js/IE8.js');?>
<![endif]-->
</head>
<body>

<?php echo $content;?>

</body>
</html>