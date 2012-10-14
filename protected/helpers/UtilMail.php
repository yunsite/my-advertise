<?php
		
//		require 'Zend/Mail/Protocol/Smtp/Auth/Login.php';
//        require_once 'Zend/Mail.php';
//        require_once 'Zend/Mail/Transport/Smtp.php';
//
//      $config = array(
//			'auth' => 'login',
//          'username' => 'zclandxy',
//          'password' => 'zclandxy5424346',
//          'ssl' => 'SSL'
//         );
//		$config = array(
//			'auth' => 'login',
//			'username' => 'admin@yuekegu.com',
//			'password' => 'zclandxy5424346'
//		);
//
//        $transport = new Zend_Mail_Transport_Smtp('smtp.yuekegu.com', $config);
//        
//		
//		$model=new ContactForm;
//		if(isset($_POST['ContactForm']))
//		{
//			$model->attributes=$_POST['ContactForm'];
//			
//			$mail = new Email();
//			$mail->mail_body = $model->body;
//			$mail->mail_email = $model->email;
//			$mail->mail_name = $model->name;
//			$mail->mail_subject = $model->subject;
//			$mail->mail_created = time();
//			$mail->mail_ip = ip2long(Yii::app()->request->getUserHostAddress());
//			
//			echo UtilTools::getClientIp();
//			
//			UtilTools::dump($_SERVER);
//			UtilTools::dump($mail->attributes);
//			
//			Yii::app()->end();
		
//			if($model->validate() && $mail->save())
//			{
//				$headers="From: {$model->email}\r\nReply-To: {$model->email}";
//				mail(Yii::app()->params['adminEmail'],$model->subject,$model->body,$headers);

//				if($mail->save())
//				{
//					$mail = new Zend_Mail('UTF-8');
//					
//					$mail->setHeaderEncoding(Zend_Mime::ENCODING_BASE64);
//					
//			        $mail->setBodyHtml($model->email.'<br />'.$model->body);
//			        $mail->setFrom('admin@yuekegu.com', $model->name);
//			        $mail->addTo(Yii::app()->params['mail'], Yii::app()->params['author']);
//					$mail->addTo('dajjwwx@163.com', 'Receiver');
//			        $mail->setSubject($model->subject);
//			        $mail->send($transport);					
//				}	        
//		        
//				
//				
//				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
//				$this->refresh();
//			}
//		}
require 'Zend/Mail/Protocol/Smtp/Auth/Login.php';
require_once 'Zend/Mail.php';
require_once 'Zend/Mail/Transport/Smtp.php';

class UtilMail
{
	private static $_config = array(
		'auth' => 'login',
		'username' => 'admin@yuekegu.com',
		'password' => 'zclandxy5424346',
		'ssl'=>'ssl'
	);
	
	public static function sendMail($to, $subject, $message)
	{

        $transport = new Zend_Mail_Transport_Smtp('smtp.yuekegu.com', self::$_config);
        
        $mail = new Zend_Mail('UTF-8');
					
		$mail->setHeaderEncoding(Zend_Mime::ENCODING_BASE64);
					
		$mail->setBodyHtml($message);
		$mail->setFrom('admin@yuekegu.com', 'Administrator');
//		$mail->addTo(Yii::app()->params['mail'], Yii::app()->params['author']);
		$mail->addTo($to, 'Receiver');
		$mail->setSubject($subject);
		$mail->send($transport);
		
		UtilHelper::writeToFile($mail, 'a+');
	}
}
?>