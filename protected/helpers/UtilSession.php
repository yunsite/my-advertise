<?php
class UtilSession
{
	public static function parseSession($data)
	{
		
		$arr = explode('|', $data);
		
		foreach ($arr as $item)
		{
			$temp = explode(';', $item);
				
			$size = count($temp);
			
		//	echo "size=>".$size."\r\n";
			
			$temp2 = explode('}', $item);
			
			$size2 = count($temp2) -1 ;
			
		//	echo "size2=>".$size2."\n\r";
			
			if ($size == 2)
			{
				$result[] = $temp[0];
				$result[] = $temp[1];
			}
			elseif ($size2 == 1)
			{
				$result[] = $temp2[0].'}';
				$result[] = $temp2[1];
			}
			else 
			{
				$result[] = $item;
			}
			
		}
		
		foreach ($result as $key=>$value)
		{
			if (fmod($key, 2) == 0)
			{
				$result[$key] = "s:".strlen($value).':"'.$value.'"';
			}
		}
//		echo serialize($_SESSION)."<br />";

		$serialize = "a:".intval(count($result)/2).":{".implode(';', $result)."}";
		
		$serialize = str_replace('{};', '{}', $serialize);
		
		return unserialize($serialize);
	}
}