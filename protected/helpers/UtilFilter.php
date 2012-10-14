<?php
/**
 * 此类用于过滤提交的内容，如果含有非法的关键词则不能正常提交
 */
 
class UtilFilter
{
    public static function contentFilter($content)
    {
        
        $filters = self::getFilters();
        
        foreach($filters as $filter)
        {
            $pattern = self::generateFilterString($filter);

            preg_match($pattern,$content,$matches);
            
            if(!empty($matches))
                return -1;
            
            
        }
        
        return true;       

    }
    
    /**
     * 字符串变成数组
     */
    public static function strSplit($string)
    {
        # Split at all position not after the start: ^ 
        # and not before the end: $ 
        return preg_split('/(?<!^)(?!$)/u', $string ); 

    }
    
    public static function generateFilterString($filter)
    {
        $result = '';
        $filter = self::strSplit($filter);
        
        for($i=0;$i<count($filter);$i++)
        {
            $result .= $filter[$i].'\s*';
        }
       
        return '/'.$result.'/i';
    }
    
    public static function getFilters()
    {
        return Yii::app()->params->filters;
    }
}
?>