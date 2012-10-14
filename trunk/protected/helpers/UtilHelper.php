<?php
class UtilHelper
{
	public static function dump($variable)
	{
		echo "<pre>";
		var_dump($variable);
		echo "</pre>";
	} 
	
	/**
	 * 格式化空间
	 * @param unknown_type $size
	 */
	public static function formatSize($size) 
	{
	      $sizes = array(" Bytes", " KB", " MB", " GB", " TB", " PB", " EB", " ZB", " YB");
	      if ($size == 0) 
	      { 
	      	return('n/a'); 
	      } 
	      else 
	      {
	      	return (round($size/pow(1024, ($i = floor(log($size, 1024)))), 2) . $sizes[$i]); 
	      }
	}
	

	//代码也可以用于统计目录数
	//格式化输出目录大小 单位：Bytes，KB，MB，GB
	
	/**
	 * 
	 * Enter description here ...
	 * @param unknown_type $path
	 * 
	 * *****************************
	 * $path="./upload";
	 * $ar=getDirectorySize($path);
 	 *
	 * echo "<h4>路径 : $path</h4>";
	 * echo "目录大小 : ".sizeFormat($ar['size'])."<br>";
	 * echo "文件数 : ".$ar['count']."<br>";
	 * echo "目录术 : ".$ar['dircount']."<br>";
	 * ******************************
	 */
	 
	public static function getDirectorySize($path)
	{
	  $totalsize = 0;
	  $totalcount = 0;
	  $dircount = 0;
	  if ($handle = opendir ($path))
	  {
	    while (false !== ($file = readdir($handle)))
	    {
	      $nextpath = $path . '/' . $file;
	      if ($file != '.' && $file != '..' && !is_link ($nextpath))
	      {
	        if (is_dir ($nextpath))
	        {
	          $dircount++;
	          $result = self::getDirectorySize($nextpath);
	          $totalsize += $result['size'];
	          $totalcount += $result['count'];
	          $dircount += $result['dircount'];
	        }
	        elseif (is_file ($nextpath))
	        {
	          $totalsize += filesize ($nextpath);
	          $totalcount++;
	        }
	      }
	    }
	  }
	  closedir ($handle);
	  $total['size'] = $totalsize;
	  $total['count'] = $totalcount;
	  $total['dircount'] = $dircount;
	  return $total;
	}
	
	/**
	 * 
	 * Cut an ASCII string containing the english words into an array
	 * @param string $str
	 * @return array a single word of the ASCII string
	 */
	public static function chineseSplit($str)
	{
		//$str="x个小姑娘去kfc吃chicken，飞刀已出手，nobody看到什么时候出手的，Mr'Li手中仍握着那个木雕，但刀已不在noanymore";

        $ascLen=strlen($str);

        for($i;$i<$ascLen;$i++){

	        $c=ord(substr($str,0,1));
	
	        if(ord(substr($str,0,1)) >252)
	        	$p = 5;
	        elseif($c > 248)
	        	$p = 4;
	        elseif($c > 240)
	        	$p = 3;
	        elseif($c > 224)
	        	$p = 2;
	        elseif($c > 192)
	        	$p = 1;
	        else
	        	$p = 0;	        
	
	        $truekey=substr($str,0,$p+1);
	
	        if($truekey===false){
	        	break;
	        }       
	
	        $splikey[]=$truekey;
	
	        $str=substr($str,$p+1);

        }
        
        return $splikey;
	}
	
	//獲取字符串長度
	public static function strlen_utf8($str) {  
		$i = 0;  
		$count = 0;  
		$len = strlen ($str);  
		while ($i < $len) {  
			$chr = ord ($str[$i]);  
			$count++;  
			$i++;  
			if($i >= $len) break;  
			if($chr & 0x80) {  
				$chr <<= 1;  
				while ($chr & 0x80) {  
					$i++;  
					$chr <<= 1;  
				}  
			}  
		}  
		return $count;  
 	}

 	
/*

    * 中文截取，支持gb2312,gbk,utf-8,big5
    * @param string $str 要截取的字串
    * @param int $start 截取起始位置
    * @param int $length 截取长度
    * @param string $charset utf-8|gb2312|gbk|big5 编码
    * @param $suffix 是否加尾缀

    */

    public static function strSlice($str, $start=0, $length=50, $charset="utf-8", $suffix=true)

    {

        if(function_exists("mb_substr"))

        {

            if(mb_strlen($str, $charset) <= $length) return $str;

            $slice = mb_substr($str, $start, $length, $charset);

        }

        else

        {

            $re['utf-8']  = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";

            $re['gb2312'] = "/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";

            $re['gbk']     = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";

            $re['big5']     = "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";

            preg_match_all($re[$charset], $str, $match);

            if(count($match[0]) <= $length) return $str;

            $slice = join("",array_slice($match[0], $start, $length));

        }

        if($suffix) return $slice."…";

        return $slice;

    }
    
    public static function pureStrSlice($str, $start=0, $length=50, $charset="utf-8", $suffix=true)
    {
    	$str = strip_tags($str);
    	$str = self::strSlice($str,$start, $length, $charset, $suffix);
    	
    	return $str;
    }
 	
	public static function multiArraySearch($needle, $haystackArray){
	    $Key;
	    foreach($haystackArray as $key => $value){
	        if(is_array($value)){
	            $value = array_search($needle, $value);
	
	            if(!empty($value)){//needle is found
	                $Key = $key;
	                break;
	            }
	        }
	    }
	   
	   return $Key;
	}
	

	/**
	 * 创建多级目录
	 */
	public static function createFolder($dir)
	{
		if (!file_exists($dir))
		{
			self::createFolder(dirname($dir));
			mkdir($dir, 0777);
		}
	}
	
	public static function getZodiacPath($year)
	{
		return '/public/images/Zodiac/Chinese_Zodiac_'.fmod($year - 3, 12).'.png';
	}
	
	/**
	 * @uses 此方法用于获取某一年的属相图标 
	 * @param unknown_type $year
	 * @param unknown_type $alt
	 * @param unknown_type $htmlOption
	 * 
	 * @return the zodiac image
	 */
	public static function getZodiac($year, $alt='',$htmlOption = array('style'=>'width:60px;'))
	{
		$src = self::getZodiacPath($year);
		
		return CHtml::image($src, $alt, $htmlOption);
	}
	
	/******************
	*@email - Email address to show gravatar for
	*@size - size of gravatar
	*@default - URL of default gravatar to use
	*@rating - rating of Gravatar(G, PG, R, X)
	*/
	public static function showGravatar($email, $size, $default, $rating)
	{
			echo '<img src="http://www.gravatar.com/avatar.php?gravatar_id='.md5($email).
			'&default='.$default.'&size='.$size.'&rating='.$rating.'" width="'.$size.'px"
			height="'.$size.'px" />';
	}
	
	public static function formatRightAnswer($info,$htmlOptions = array('style'=>'background:url(/public/images/done.png) left center no-repeat; height:20px; padding:5px 0 2px 30px;','class'=>'errorSummary'))
	{
//		$info = CHtml::image('/public/images/done.png').$info;
		echo CHtml::tag('div',$htmlOptions,$info);
		
	}
	
	public static function commonWord($word = '你不是好人！')
	{
		echo $word;
		Yii::app()->end();
		
	}
	
	/**
	 * @todo 远程文件本地化
	 * @param unknown_type $url
	 */
	public static function resourceLocalize($filename)
	{
//		$filename = 'http://a.hiphotos.baidu.com/ting/pic/item/dcc451da81cb39db2a8f6ce2d0160924ab183032.jpg';
		
		$header = get_headers($filename,1);
		
//		UtilHelper::dump($header);
		
//		echo strpos($header[0],'OK');
		
		if ( strpos($header[0],'OK') < 0)
		{
			echo '远程文件不存在';
            die();
		}else{
			
			$pathinfo = pathinfo($filename);
			
			$target = './public/favorite/'.$pathinfo['basename'];
			
//			UtilHelper::createFolder(dirname($target));
			
//    		UtilHelper::dump($pathinfo);
            
            $pathinfo['size'] = $header['Content-Length'];
            $pathinfo['mime'] = $header['Content-Type'];
			
			$content = file_get_contents($filename);
			if(file_put_contents($target, $content))
            {
                $pathinfo['state'] = "OK";
                
                return $pathinfo;  
            }
		}	
	} 
	
	public static function writeToFile($content, $mode="w+", $filename = './public/log.txt',$separate = "\r\n")
	{
/**
 * 		$content = array(
 * 			'Create Date'=>date('y/m/d h:i:s'),
 * 			'Compare Url'=>Yii::app()->request->url,
 * 			'Content'=>$content
 * 		);
 */
		
		$content = print_r($content,true);

		$file = fopen($filename, $mode);
		fwrite($file, $content.$separate);
		fclose($file);	
	}
	
	public static function timeFormat($time) {
	    $ntime=time()- $time;
	    if ($ntime<60) 
	        return("刚才");
	    elseif ($ntime<3600) 
	        return(intval($ntime/60)."分钟前");
		elseif ($ntime<3600*24)
	        return(intval($ntime/3600)."小时前");
	    else
	        return(gmdate('Y-m-d H:i',$time+8*3600));
	}
	
	public static function words2PinYin($string,$isshort=false,$length=5,$code = 'gb2312')
	{
		$pinyin = new PinYin();
		
		if ($isshort)
			return $pinyin->words2Short($string,$code,$length);
		else			
			return $pinyin->words2pinyin($string,1);
	}
	
	
	
}