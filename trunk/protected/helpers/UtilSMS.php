<?php
class UtilSMS
{
	const SMS_USERNAME = '14780624962';
	const SMS_PASSWORD = 'zclandxy5424346';
	
	public static function sendSMS($message, $to = self::SMS_USERNAME)
	{
		$fetion = new PHPFetion(self::SMS_USERNAME, self::SMS_PASSWORD);
		$fetion->send($to, $message);
	}
}
?>