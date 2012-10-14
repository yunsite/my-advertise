<?php
class UtilNet
{
	
	//获取Ip地址
	public static function getClientIp() 
	{
		
		$ip=false;
		if(!empty($_SERVER["HTTP_CLIENT_IP"]))
		{
		  $ip = $_SERVER["HTTP_CLIENT_IP"];
		}
		if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
		{
		  	$ips = explode (", ", $_SERVER['HTTP_X_FORWARDED_FOR']);
		  	if($ip)
		  	{
		  		 array_unshift($ips, $ip); $ip = FALSE;
		 	}
		  	for($i = 0; $i < count($ips); $i++)
		  	{
			   if (!eregi ("^(10|172\.16|192\.168)\.", $ips[$i]))
			   {
				    $ip = $ips[$i];
				    break;
			   }
		  	}
		}
		return($ip ? $ip : $_SERVER['REMOTE_ADDR']);
	}
	
	/**
	 *根据腾讯IP分享计划的地址获取IP所在地，比较精确
	 */
//	public static function getIPLoc($queryIP){
//		$url = 'http://ip.qq.com/cgi-bin/searchip?searchip1='.$queryIP;
//		$ch = curl_init($url);
//		curl_setopt($ch,CURLOPT_ENCODING ,'gb2312');
//		curl_setopt($ch, CURLOPT_TIMEOUT, 10);
//		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true) ; // 获取数据返回
//		$result = curl_exec($ch);
//		$result = mb_convert_encoding($result, "utf-8", "gb2312"); // 编码转换，否则乱码
//		curl_close($ch);
//		preg_match("@<span>(.*)</span></p>@iU",$result,$ipArray);
//		$loc = $ipArray[1];
//		return $loc;
//	}
	
	//根据腾讯接口查询ip地址  
	public static function getIPLoc($queryIP){  
      
      
    $url = 'http://ip.qq.com/cgi-bin/searchip?searchip1='.$queryIP;

    $url = 'http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=js&ip='.$queryIP;
      
    $ch = curl_init($url);        
      
    curl_setopt($ch,CURLOPT_ENCODING ,'gb2312');       
      
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);        
      
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true) ; // 获取数据返回        
      
    $result = curl_exec($ch);        
      
    $result = mb_convert_encoding($result, "utf-8", "gb2312"); // 编码转换，否则乱码        
      
    curl_close($ch);  
    
    preg_match_all('/{.*}/',$result,  $matches);
      
      
//    preg_match("/<span>(.*)</span><\/p>/iU",$result,$ipArray);  
//    $loc = $ipArray;  
    
//    return $result;
    return json_decode($matches[0][0]);  

	}
	
	//记录百度，谷歌，雅虎，Bing,搜搜，搜狗，有道的爬行记录
	public static function getNapsBot()
	{
		$useragent = strtolower($_SERVER['HTTP_USER_AGENT']);
				
		if (strpos($useragent, 'googlebot') !== false){
			return 'Google';
		}
				
		if (strpos($useragent, 'baiduspider') !== false){
			return 'Baidu';
		}
		if (strpos($useragent, 'msnbot') !== false){
			return 'Bing';
		}
				
		if (strpos($useragent, 'slurp') !== false){
			return 'Yahoo';
		}
				
		if (strpos($useragent, 'sosospider') !== false){
			return 'Soso';
		}
				
		if (strpos($useragent, 'sogou spider') !== false){
			return 'Sogou';
		}
				
		if (strpos($useragent, 'yodaobot') !== false){
			return 'Yodao';
		}
		return false;
	}
	
	//把爬行情况记录到文件
	public static function writeSearchBot()
	{
		$date=date("Y-m-d.G:i:s");
		
		$searchbot = self::getNapsBot();
		
		if ($searchbot) {
			$tlc_thispage = addslashes($_SERVER['HTTP_USER_AGENT']);
			$url=$_SERVER['HTTP_REFERER'];
			$file=Yii::app()->request->hostInfo.".txt";
			$time=nowtime();
			$data=fopen($file,"a");
			fwrite($data,"Time:$time robot:$searchbot URL:$tlc_thispage\n");
			fclose($data);
		}		
		
	}
		

}
?>