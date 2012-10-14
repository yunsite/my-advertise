<?php
return array(
		// this is used in contact page
		'adminEmail'=>'zclandxy@gmail.com',

		'uploadPath' => array(
			'image' => '/public/uploads/images/',
			'avatar' => '/public/uploads/avatars/',
			'document' => '/public/uploads/documents/',
			'channel' => '/public/uploads/channels',
			'advertisement' => '/public/advertisement/',
            'adtheme' =>  '/public/uploads/adtheme/'
		),
		'fullSpace'=>1024*1024*1024,
		'visitIpPath'=>'./public/datas/visitorip.txt',
		'defaultAvatarPath' => '/public/images/avatar/avatar.png',
		'defaultChannelIco' => '/public/images/channel/default.png',
		'template'=>require dirname(__FILE__).'/template.php',
        'adminMenu'=>require dirname(__FILE__).'/adminMenu.php',
        'filters'=>require dirname(__FILE__).'/filters.php'
);
?>
