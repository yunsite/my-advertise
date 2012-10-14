<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
	<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon"/> 
	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/public/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/public/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/public/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/public/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/public/css/form.css" />
	
	<title><?php echo Region::model()->getUserArea()->region;?>广告牌</title>
</head>

<body style="background: transparent;">
	<?php echo $content;?>
</body>
</html>

<?php 

	$this->widget('ext.fancybox.fancyboxWidget',array(
		'id'=>'#changeAdress',
		'options' => "'overlayShow'	: true,
			'transitionIn'	: 'elastic',
			'transitionOut'	: 'elastic'"
	));
	Yii::app()->getClientScript()->registerScriptFile('/public/js/jquery.history.js');
//	Yii::app()->getClientScript()->registerScriptFile('/public/js/common.js');
?>