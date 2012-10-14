<?php
class UtilMatch
{
	public static $pattern = array(
		'img'=>'/<img\s+[^>]*\s*src\s*=\s*([\'\"]?)([^\'\">\s]*)\\1\s*[^>]*>/i'
	);
	
	/**
	 * 查看当前内容是否含有图片
	 * @param unknown_type $subject
	 */
	public static function hasImage($subject)
	{
		return preg_match(self::$pattern['img'], $subject);

	}
	
	/**
	 * 返回当前内容中的所有图片链接信息
	 * @return json
	 */
	public static function getAllImageInfo($subject)
	{
		preg_match_all(self::$pattern['img'], $subject, $matches);
		
		return json_encode($matches[2]);
		
	}
	
	
}