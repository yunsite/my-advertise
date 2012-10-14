<?php
class UtilHttpRequest extends CHttpRequest
{
	public function init()
	{
		parent::init();
	}
	
	// 说明：获取完整URL
	public static function getCurrentUrl()
	{
	    $pageURL = 'http';
	
	    if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on")
	    {
	        $pageURL .= "s";
	    }
	    $pageURL .= "://";
	
	    if ($_SERVER["SERVER_PORT"] != "80")
	    {
	        $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
	    }
	    else
	    {
	        $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
	    }
	    return $pageURL;
	}
}