<?php
/**
 * @uses <:{User.getModel.username|para1:1,para2:2}:>
 * 
 * 即User::modle()->getModel($para1=1,$para2=2)->username
 * 
 * @author Administrator
 *
 */

class UtilLabel
{
    
    /**
     * 转换字符串为标准的数据访问格式
     **/
	protected static function exchange($string)
	{
		$_result = explode('|', $string);
		
		//得到需要使用的类及方法
		$c_m = explode('.', $_result[0]);
		$class = $c_m[0];
		$method = $c_m[1];
        $property = $c_m[2];        
		
		//得到参数
        $params = str_replace(',','",$',$_result[1]);
		$params = '$'.str_replace('=:','="',$params).'"';
		
		return $class.'::model()->'.$method.'('.$params.')'.($property?'->'.$property:'');	   
		
	}
	
    /**
     * 检查数据模板，只有在符合基本要求的，并且有返回值时才返回值
     **/
	public static function execute($string)
	{
	   
       if( $string == '') return ;
       echo $string;
       if( strpos($string,'.')&&strpos($string,'|')&&strpos($string, '=:'))
       {
            $command = self::exchange($string);
    
     //       echo $command;       
      
            eval('$str = '.$command.';');  
            
            if($str)
                return $str;        
       }
       
       return ;
		
	}
    
    /**
     * 格式化模板
     * 把模板中的class替换为cname+class的形式
     * 
     * @param Template $model
     **/
    public static function formatTemplate($model=null)
    {
        //替换正则
        $pattern = '/class="(.*)?"/i';
        
    
        //替换匹配内容
        $html = preg_replace($pattern,'class="'.$model->cname.'-\1"',$model->code);
        
        return $html;
    }
    
    /**
     *匹配出所有的class
     **/ 
    public function getTemplateClass($content)
    { 
        $result = '';
        //替换正则
        $pattern = '/class\s*=\s*"\s*(.*?)"\s*/i';
        
        preg_match_all($pattern,$content,$matches);        
        
        $result = '';
        
        foreach($matches[1] as $item)
        {
            $result .= '.'.$item."{\n\n}\n";
        }
        

        
        return $result;
    }
    
    /**
     * @uses 
     * @param String $html 需要格式化的代码
     * @param Integer $id   格式化对应内容的id
     **/ 
    public static function run($html,$id)
    {
                //替换参数
        $html = str_replace(':id',':'.$id,$html);
        //替换正则
        $pattern = '/<:{(.*)}:>?/i';
        //替换匹配内容
        $html = preg_replace($pattern,'".self::execute("\1")."',$html);
        
        //为匹配出来的内容添加首尾的双引号“""”
        $html = '$html= "'.$html.'";';      //{这一步的处理花了我太多的时间，基础太差~~~~}
        //把字符串转化为可以执行的代码，得到需要的处理结果$html;
        eval($html);

        //输出处理结果
        echo $html;
    }
    

}
?>