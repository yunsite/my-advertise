<?php
class RemoteService
{
	
	/**
	 * 	获取天气信息
	 */
	public static function getWeather()
	{
		header("content-type: text/html");
		$url = 'http://m.weather.com.cn/data/';
		$id = (int)$_GET['id'];
		$data = file_get_contents($url . $id .'.html');
		echo $data;	
	}
	
	/**
	 * @todo 从hao123.com获取关于高校所在地及高校分类信息
	 */
	protected function getCollegesLocation()
	{
		$todo = array();
		
		$src = 'http://www.hao123.com/edu.htm';
		
		$content =  iconv('GB2312', 'UTF-8', file_get_contents($src));

		$pattern = '/<([a-z]*?)[^>]*>.*?<\/\\1>|<.*? \/>/i';
		
		preg_match_all($pattern, $content, $matches);
		
		$result = array_slice($matches[0], 34,155);
		
		$result = array_chunk($result, 5);
		
		foreach ($result as $item)
		{
			$todo[trim(strip_tags($item[0]))]=array(
				$this->matchLocationUrl($item[1]),
				$this->matchLocationUrl($item[2]),
				$this->matchLocationUrl($item[3])
			);
		}
		
		
		return $todo;
	}
	
	/**
	 * @todo 根据匹配得到的html得到需要的链接
	 * @param unknown_type $html
	 */
	protected function matchLocationUrl($html)
	{
		$pattern = '/href=[\'\"]([\w\/\.]*)[\'\"]/';
		
//		$str = '<a class="m" href="eduhtm/xinjiang02.htm" target="_blank">点击查看</a>';
		
		preg_match_all($pattern, $html, $matches);
		
		$src = 'http://www.hao123.com/'.$matches[1][0];
		
		return $src;
	}
	
	/**
	 * @todo 根据上面matchLocationUrl得到的URL获取相应页面中相应学校的名称以及主页地址
	 * @param unknown_type $url
	 */
	protected function getColleges($url)
	{
		
		if ($src == '')
			return null;	
	
		
		$content =  iconv('GB2312', 'UTF-8',file_get_contents($src));
		
		/*
		<p>
		<a href="http://www.ruc.edu.cn/">中国人民大学</a>
		</p>
		*/	
		
		preg_match_all('/<a\s+href="?([^>"]+)"?\s*[^>]*>([^>]+)<\/a><\/p>/i',$content,$matches);
		
		$todo = array();
		if ($matches[1]&&$matches[2])
			$todo = array_combine($matches[2], $matches[1]);		
	
		return $todo;		
	}
	
	/**
	 * @todo 利用上面获取得的相关信息，把其写入文件或数据库，当然写入数据库之前要建立数据库
	 * 
	 * 结构如下： 
	 * 
	 * CREATE TABLE `college` (
	 *	  `id` int(11) NOT NULL AUTO_INCREMENT,
	 *	  `name` varchar(200) NOT NULL COMMENT '高校名称',
	 *	  `type` int(11) NOT NULL COMMENT '高校类型',
	 *	  `province` int(11) NOT NULL COMMENT '高校所在省份',
	 *	  `homepage` varchar(200) NOT NULL COMMENT '高校主页\r\n',
	 *	  PRIMARY KEY (`id`),
	 *	  KEY `province` (`province`)
	 *	) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
	 *
	 *注意：这里只是Yii版的范例，如果需要使用，则需要对应修改一下下面的代码
	 */
	public static function generateCollegesInfo($output = 'file')
	{
		$str = '';
		
		//获取网址
		$urls = self::getCollegesLocation();		
		
		foreach ($urls as $province=>$url)
		{
			
			/**获取provinceID*/
			$criteria = new CDbCriteria();
			$criteria->addSearchCondition('region',$province);
			
			$region = Region::model()->find($criteria);
			
//			UtilHelper::dump($region->attributes);
			
			$provinceID = $region->id;
			
//			UtilHelper::dump($province.'-=-'.$provinceID);
			
			foreach ($url as $k=>$v)
			{
				$type = $k;
				
//				UtilHelper::dump($province.'-'.$k.'=>'.$v);				
				$colleges =self::getColleges($v);				
//				UtilHelper::dump($colleges);
				
				foreach ($colleges as $name=>$homepage)
				{
					/**在这里把要写入数据库的信息写入文件**/
					$str .= $province."\t".$type."\t".$name."\t".$homepage."\r\n"; 
					$college = new College();
					$college->province = $provinceID;
					$college->type = $type;
					$college->name = $name;
					$college->homepage = $homepage;
					
					if ($college->save())
						echo 'yes-'.$college->id.'<br />';
					else 
						echo CHtml::errorSummary($college);
				}				
			}		
			
		}
		
		if ($output == 'file')
		{					
			$fp = fopen('./public/colleges.txt', 'w+');			
			fwrite($fp, $str);
			fclose($fp);
		}
		

	}
	
	
}
?>