<?php
class UtilValidator
{
    /**
     * 函数名称：isChinese
     * 简要描述：检查是否输入为汉字 
     * 输入：string
     * 输出：boolean
     **/
     public static function isChinese($str)
     {
		$words = UtilHelper::chineseSplit($str);
		foreach ($words as $word)
		{
			if (ord($word) < 224 || ord($word) > 240)
				return false;
		}
		
		return true;
     }
}
?>