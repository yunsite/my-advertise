<?php

class RemoteController extends Controller
{
	public $layout = '//layouts/blank';
	
	public function actionIndex()
	{

		$this->layout = '//layouts/column1';
		
		$this->render('index');
	}
	
	public function actionCategory()
	{
		
		$this->layout = '//layouts/column1';
		
		Channel::model()->showCategories($_GET['id'], false);
	}
	
	public function actionAvatar()
	{
		echo Profile::model()->getUserAvatarPath(2, null);
	}
	
	public function actionDownload()
	{
		$filename = 'http://wt.mt30.com//201103/iemmei_wish.rar';

		UtilHelper::resourceLocalize($filename);
	}
	
	public function actionCom()
	{
		
	
		$file = "./public/test2.txt";
		
		$lines = file_get_contents($file);
		
//		echo $lines;
		
		$lines = mb_convert_encoding($lines, "UTF8");
		
		UtilHelper::dump($lines);
		
		try {
			$word = new com("word.application") or die("Can't start word~");
			
	
			echo "Loading word, Version {$word->Version}";
			
			$word->Visible = 1;		

			UtilHelper::dump($word);
			
		} catch (Exception $e) {
			$e->getMessage();
		}
		

//		
//		$word->Documents->Open($file) or die("无法打开文件");
//		
//		$marks = $word->ActiveDocument->BookMarks->Count;
//		
//		UtilHelper::dump($marks);
		
//		$word->Documents->Add();
//		
//		$word->Selection->TypeText("Testing 1-2-3-4....");
//		
//		try {
//		$word->Documents[1]->SaveAs('D:/todo.docx');
//		} catch (Exception $e)
//		{
//			echo $e->getMessage();
//		}
//		$word->Quit();
//		
//		echo "Check for the file....";
	}
	
	public function actionScreenShot()
	{
		$word=new COM("word.application") or die("Cannot start word for you");
		print "Loaded word version ($word->Version)n";
		$word->visible =1 ;
		$word->Documents->Add();
		$word->Selection->Typetext("Dit is een test");
		//$word->Documents[1]->SaveAs("burb ofzo.doc");
		
		UtilHelper::dump($word);
		$word->Quit();
		
		die();
		
		$browser = new COM("InternetExplorer.Application");
		
		UtilHelper::dump($browser);
		
		die();
		$handle = $browser->HWND;
		$browser->Visible = true;
		$browser->Navigate("http://www.libgd.org");
		
		/* Still working? */
		while ($browser->Busy) {
		    com_message_pump(4000);
		}
		$im = imagegrabwindow($handle, 0);
		$browser->Quit();
		imagepng($im, "iesnap.png");
		imagedestroy($im);
	}
	

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
	
	/**
	 * 功能：根据ID输出相关省份下的市县
	 * @return array()
	 */
	public function actionRegion($id)
	{

		$result = Region::model()->generateProvince($id);
		
		echo json_encode($result);

	}
	
	public function actionOnlineStatistics()
	{
		$arr = $_SERVER;
		
//		UtilHelper::dump($_REQUEST);
//		Yii::app()->end();	
		$page = isset($_GET['page'])?$_GET['page']:1;
		
//		echo '<ul>';
		foreach (array_slice($arr, 3*$_GET['page'], 3) as $item)
		{
			echo '<li>'.$item.'</li>';
		}
//		echo '</ul>';

	}
	
	public function actionTest2()
	{
		$src = 'http://www.hao123.com/edu.htm';
		
		$content =  iconv('GB2312', 'UTF-8', file_get_contents($src));

		$pattern = '/<([a-z]*?)[^>]*>.*?<\/\\1>|<.*? \/>/i';
		
		preg_match_all($pattern, $content, $matches);
		
		$result = array_slice($matches[0], 34,155);
		
		$result = array_chunk($result, 5);
		
		$todo = array();
		
		foreach ($result as $item)
		{
			$todo[trim(strip_tags($item[0]))]=array(
				$this->matche($item[1]),
				$this->matche($item[2]),
				$this->matche($item[3])
			);
		}
		
		
		return $todo;
	}
	
	public function matche($str)
	{
		$pattern = '/href=[\'\"]([\w\/\.]*)[\'\"]/';
		
//		$str = '<a class="m" href="eduhtm/xinjiang02.htm" target="_blank">点击查看</a>';
		
		preg_match_all($pattern, $str, $matches);
		
		$src = 'http://www.hao123.com/'.$matches[1][0];
		
		return $src;
		
//		return array(
//			$src=>$this->actionTest($src)
//		);
	}
	
	public function actionTest3()
	{
		$str = '';
		
		$fp = fopen('./public/colleges.txt', 'w+');
		
		//获取网址
		$urls = $this->actionTest2();
		
		
		
		foreach ($urls as $province=>$url)
		{
			
			/**获取provinceID*/
			$criteria = new CDbCriteria();
			$criteria->addSearchCondition('region',$province);
			
			$region = Region::model()->find($criteria);
			
			UtilHelper::dump($region->attributes);
			
			$provinceID = $region->id;
			
//			UtilHelper::dump($province.'-=-'.$provinceID);
			
			foreach ($url as $k=>$v)
			{
				$type = $k;
				
//				UtilHelper::dump($province.'-'.$k.'=>'.$v);				
				$colleges = $this->actionTest($v);				
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
		
		fwrite($fp, $str);
		fclose($fp);
	}
	

	
	public function actionTest($src)
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
	
	public function check($str)
	{
		if (is_int($str))
			return '';
		
	}
	
	public function actionTest4()
	{
		
		$filename = './public/highscholls.txt';
		$school = file($filename);
		
		$school = array_map('check', $school);
//		foreach ($school as $k=>$v)
//		{
////			$school = str_replace($ufo, '',str_replace("\r", '',str_replace("\n", '', $v),$v),$v);
//
////			$school[$k] = str_replace("\r", '',str_replace("\n", '', $v),$v);
//			if (intval($v)||trim($v) == ''||trim($v)=='　'||trim($v) ==' '||strpos(' ', $v))
//			{
//				unset($school[$k]);
//			}
//		}		
		
		$school = array_chunk($school, 2);
		
		foreach ($school as $value)
		{
//			$todo[$value[1]] = $value[0];

			$province = $value[0];
			$name = $value[1];
			
			echo $province;
			echo $name;
			
			/**获取provinceID*/
			$criteria = new CDbCriteria();
			$criteria->addSearchCondition('region',$province);
			
			$region = Region::model()->find($criteria);
			
			UtilHelper::dump($region->attributes);
			
			$provinceID = $region->id;
			
			$type = College::COLLEGE_TYPE_GAOZHONG;
			
			$college = new College();
			$college->province = $provinceID;
			$college->type = $type;
			$college->name = $name;
			
			if ($college->isNewRecord && $college->save())
				echo 'yes-'.$college->id.'<br />';
			else 
				echo CHtml::errorSummary($college);
		}
//		UtilHelper::dump($todo);
	}
	
	public function actionZhuanye()
	{
		
		$todo = array();
		$i = 0;
		
		$filename = './public/zhuanye.txt';
		$result = file($filename);
		$result = array_map('check', $result);
		
		$keys = array();
		$keys[0] = null;
		$values = array();
		$values[0] = null;
		
		foreach ($result as $item)
		{
			$zhuanye = explode('=', $item);
			
			$keys[] = $zhuanye[0];
			$values[] = $zhuanye[1];
		}
		
//		echo array_search('0101', $keys);
		
		for ($t = 1;$t <= count($keys);$t++)
		{
//			$zhuanyedaima = strlen($zhuanye[0]);
			
//			$zhuanyedaima = chunk_split($zhuanye[0],2);

			preg_match_all('/(\d{2})(\d{2})?(\d{2})?/i', $keys[$t], $zhuanyedaima);
			
			
			$todo[$t] = array(
				'id'=>$t,
				'daima'=>$zhuanyedaima[0][0],
				'name'=>$values[$t]
			);
			
			
			
			
			if (intval($zhuanyedaima[1][0]) && !intval($zhuanyedaima[2][0]))
			{
				$todo[$t]['pid'] = 0;//array_search($zhuanyedaima[1][0], $keys);
			}
			
			if (intval($zhuanyedaima[2][0]) && !intval($zhuanyedaima[3][0]))
			{
				$todo[$t]['pid'] = array_search(strval($zhuanyedaima[1][0]), $keys);
				
//				echo '2'.$zhuanyedaima[1][0]."\n\r";
			}
			
			if (intval($zhuanyedaima[2][0]) && intval($zhuanyedaima[3][0]))
			{
				$todo[$t]['pid'] = array_search($zhuanyedaima[1][0].$zhuanyedaima[2][0], $keys);
			}
		}
		$todo[1]['pid'] = 0;
		$todo[2]['pid'] = 1;
		
		array_pop($todo);
//		UtilHelper::dump($todo);
		foreach ($todo as $item)
		{
			
//			echo "id:".$item['id']."\t pid:".$item['pid']."\t name:".$item['name']."\tdaima:".$item['daima']."<br />";
			$expertise = new Expertise();
			$expertise->id = $item['id'];
			$expertise->pid = $item['pid'];
			$expertise->name = $item['name'];
			
			if ($expertise->save())
				echo 'ok'.$expertise->id;
			else 
				echo CHtml::errorSummary($expertise);
		}
	}
	
	public function actionGoods()
	{
		$src = 'http://category.jiaomai.com/';
		
		$content = file_get_contents($src);
		$content = iconv('GB2312', 'UTF-8', $content);
		
//		$pattern = '/<div\sclass="Categorylisthd"><a.*>(.*?)<\/a><\/div>/'; //ok匹配大类名称
//		$pattern = '/<div\sclass="Categorylist_01">(.*?)<\/div>/i';

		$pattern = '/<div.*class="Categorybox">(.*?)<\/div>/i';
		
		preg_match_all($pattern, $content, $matches);
		
		UtilHelper::dump($matches);
	}
	
	public function actionGoods2()
	{
		
		$todo = array();
		$todo[0] = null;
		
		$filename = './public/goods.txt';		
		$goods = file($filename);
		
		$goods = array_map('check', $goods);
		
		$specialChar = '-';
		
		$pid = 0;	//当前
		$prePid = 0; //前一个分类的的
		
		for ($i=1;$i<count($goods);$i++)
		{
			
			$id = $i;
			$name = $goods[$i-1];
			$next = $goods[$i];
			$todo[$i]['id'] = $i;
			$todo[$i]['name'] = trim(str_replace($specialChar, '', $name));
//			$todo[$i]['current'] = $name;
//			$todo[$i]['next'] = $next;
			

			$currentPos = strstr($goods[$i-1],$specialChar);
			$nextPos = strstr($goods[$i],$specialChar);
			
			//当前没有，下一个也没有
			if (!$currentPos &&  !$nextPos)
			{	
				$todo[$i]['pid'] = 0;
				$pid = $i;
				$prePid = $i;
			}
			//当前没有，下一个有	
			if (!$currentPos && $nextPos)
			{
				$todo[$i]['pid'] = $prePid;
				$pid = $i;
			}
			//当前有，下一个没有
			if ($currentPos && !$nextPos)
			{
				$todo[$i]['pid'] = $pid;
			}
			
			//当前有，下一个也有
			if($currentPos && $nextPos)
			{
				$todo[$i]['pid'] = $pid;
			}
			
		}
		
		foreach ($todo as $item)
		{
			$goods = new Goods();
			$goods->id = $item['id'];
			$goods->pid = $item['pid'];
			$goods->name = $item['name'];
			if ($goods->save())
				echo 'ok'.$goods->id."<br />";
			else 
				echo CHtml::errorSummary($goods);
		}
		
		
		UtilHelper::dump($todo);
	}
	
	public function actionChannel()
	{
		
		$todo = array();
		$filename = './public/channel.txt';
		$result = file($filename);
		
		$result = array_map('check', $result);
		
		$specialChar = ':';
		
		$pid = 0;
		$i = 1;
		foreach ($result as $item)
		{
			$todo[$i]['name'] = str_replace($specialChar, '', $item);
			$todo[$i]['id'] = $i;
			$todo[$i]['weight'] = rand(1, 9);
			$todo[$i]['description'] = '此频道提供'.$todo[$i]['name'].'相关信息';
			$todo[$i]['charge'] = 1;
			$todo[$i]['uid'] = 1;
			
			
			if (strpos($item, $specialChar))
			{
				$todo[$i]['pid'] = 0;
				$pid = $i;
			}
			else 
			{
				$todo[$i]['pid'] = $pid;
			}
			
			$i++;
		}
		
		foreach ($todo as $item)
		{
			$channels = new Channels();
			$channels->id = $item['id'];
			$channels->name = $item['name'];
			$channels->weight = $item['weight'];
			$channels->description = $item['description'];
			$channels->charge = $item['charge'];
			$channels->uid = $item['uid'];
			$channels->pid = $item['pid'];
			
			if ($channels->save())
			{
				echo 'ok'.$channels->id."<br />";
			}
			else 
			{
				echo CHtml::errorSummary($channels);
			}
		}
		
		UtilHelper::dump($todo);
	}
	
	public function actionHangye()
	{
		$todo = array();
		$filename = './public/hangye.txt';
		$result = file($filename);
		
		$result = array_map('check', $result);
		
		$specialChar = ':';
		
		$pid = 0;
		$i = 1;
		foreach ($result as $item)
		{
			$todo[$i]['name'] = str_replace($specialChar, '', $item);
			$todo[$i]['id'] = $i;			
			
			if (strpos($item, $specialChar))
			{
				$todo[$i]['pid'] = 0;
				$pid = $i;
			}
			else 
			{
				$todo[$i]['pid'] = $pid;
			}
			
			$i++;
		}
		
		foreach ($todo as $item)
		{
			$channels = new Hangye();
			$channels->id = $item['id'];
			$channels->name = $item['name'];
			$channels->pid = $item['pid'];
			
			if ($channels->save())
			{
				echo 'ok'.$channels->id."<br />";
			}
			else 
			{
				echo CHtml::errorSummary($channels);
			}
		}
		
		UtilHelper::dump($todo);		
	}
	
	public function actionZhiyelocation()
	{
		$todo = array();
		$filename = './public/zhiye.txt';
		$result = file($filename);
		
		$result = array_map('check', $result);
		
		$specialChar = ':';
		
		$pid = 0;
		$i = 1;
		foreach ($result as $item)
		{
			$todo[$i]['name'] = str_replace($specialChar, '', $item);
			$todo[$i]['id'] = $i;			
			
			if (strpos($item, $specialChar))
			{
				$todo[$i]['pid'] = 0;
				$pid = $i;
			}
			else 
			{
				$todo[$i]['pid'] = $pid;
			}
			
			$i++;
		}
		
		foreach ($todo as $item)
		{
			$channels = new Job();
			$channels->id = $item['id'];
			$channels->name = $item['name'];
			$channels->pid = $item['pid'];
			
			if ($channels->save())
			{
				echo 'ok'.$channels->id."<br />";
			}
			else 
			{
				echo CHtml::errorSummary($channels);
			}
		}
		
		UtilHelper::dump($todo);	
	}
	
	public function actionZhiye()
	{
		$todo = array();
		$url = 'http://yuncheng.58.com/jianzhi.shtml';
		
		$content = file_get_contents($url);
//		$content = iconv('GB2312', 'UTF-8', $content);

		$pattern = '/<h2><a.*?>(.*?)<\/a><\/h2>\s*<p>(.*?)<\/p>/i';
		
		preg_match_all($pattern, $content, $matches);
		
		for($i=0;$i<count($matches[1]);$i++)
		{
			$pattern2 = '/<a.*?>(.*?)<\/a>/i';
			
			preg_match_all($pattern2, $matches[2][$i], $matches2);
			
			$todo[$matches[1][$i]] = $matches2[1];
			
		}
		
		$result = '';
		
		foreach ($todo as $Key=>$value)
		{
			$result .= $Key.":\r\n";
			foreach ($value as $item)
			{
				$result .= $item."\r\n";
			}
		}
		
		$filename = './public/jianzhi.txt';
		$fp = fopen($filename, 'w+');
		fwrite($fp, $result);
		fclose($fp);
//		UtilHelper::dump($todo);
		
	}
	
	public function actionData()
	{
		
		$todo = array();
		
		$filename = './public/friend.txt';
		
		$data = file($filename);
		
		$data = array_map('check', $data);
		
		$i = 1;
		$pid = 0;

		foreach ($data as $item)
		{
			$channel = new Channel();

			$channel->charge = 1;
			$channel->uid = Yii::app()->user->id;			
			$channel->type = Channel::CHANNEL_FREIND;	
			$channel->weight = rand(1, 10);
					
			if (strpos($item, '.'))
			{
				$todo[$i]['pid'] = 0;
				$todo[$i]['name'] = str_replace('.', '', $item);
				
				$channel->pid = 0;
				$channel->name = str_replace('.', '', $item);		
				$channel->description = '此频道提供'.$channel->name.'相关信息';
				
				if ($channel->save())
					$pid = $channel->id;
				else 
					echo CHtml::errorSummary($channel);				
			
			}
			elseif (strpos($item, ':'))
			{				
				$todo[$i]['name'] = str_replace(':', '', $item);
				$todo[$i]['pid'] = $pid;
				
				$model = Channel::model()->find(array(
					'condition'=>'pid = :pid',
					'order'=>'id DESC',
					'params'=>array(
						':pid'=>0
					)
				));
				
//				UtilHelper::dump($model->attributes);
				
								
				$channel->pid = $model->id;
				$channel->name = str_replace(':', '', $item);		
				$channel->description = '此频道提供'.$channel->name.'相关信息';
				
				if ($channel->save())
					$pid = $channel->id;
				else 
					echo CHtml::errorSummary($channel);				
				
			}
			else 
			{
				$todo[$i]['pid'] = $pid;
				$todo[$i]['name'] = $item;			

				$channel->pid = $pid;
				$channel->name = $item;		
				$channel->description = '此频道提供'.$channel->name.'相关信息';
				
				if ($channel->save())
					echo CHtml::errorSummary($channel);	
			}			

			
			$i++;
		}
		
		UtilHelper::dump($todo);
		

	}
	
	public function actionTagFile()
	{
		
		$start = microtime();
		$filename = './public/feeling.txt';
		$result = file($filename);
		
		foreach ($result as $item)
		{				
			$tag = new Tag();
			$tag->name = $item;
			$tag->tid = Tag::TAG_FEELING;
			
			if ($tag->save())
				echo $tag->id.'OK<br />';
			else 
				echo CHtml::errorSummary($tag);
		}
		$end = microtime();
		
		echo date('m:s',$end-$start);
	}
	
	public function actionTag()
	{
		$start = microtime();
		
		$item = 'A';
//		$latter = range('A', 'Z');
//		$todo = array();
//		
//		
//		
//		foreach ($latter as $item)
//		{
//			$filename = 'http://list.mp3.baidu.com/top/singer/'.$item.'.html';
			$filename = 'http://music.sogou.com/song/topsinger.html';
			$header = get_headers($filename);
			
			if (!strpos($header[0], 'OK'))
				continue;
		
			
			$content = file_get_contents($filename);	
			$content = iconv('GB2312', 'UTF-8', $content);	
			
			if (!$content)
				return NULL;
			
			$pattern = '/<a.*?>(.*?)<\/a><\/h3>/i';		

	
			preg_match_all($pattern, $content, $matches);
			
			$todo = $matches;
			$result = '';
			foreach ($todo as $item)
			{
				$result .= $item."\r\n";
				
//				$tag = new Tag();
//				$tag->name = $item;
//				$tag->tid = Tag::TAG_STAR;
//				
//				if ($tag->save())
//					echo $tag->id.'OK<br />';
//				else 
//					echo CHtml::errorSummary($tag);
			}
			
//			$fp = fopen('./public/star.txt', 'w+');
//			fwrite($fp, $result);
//			fclose($fp);
//					

//		}
		UtilHelper::dump($todo);	
//		echo $content;
		$end = microtime();
		
		echo date('m:s',$end-$start);
	}
	
	
	
	public function actionFangchan()
	{
		$todo = array();
//		$filename = 'http://yuncheng.58.com/house.shtml';
//		$filename = 'http://yuncheng.58.com/car.shtml';
//		$filename = 'http://yuncheng.58.com/sale.shtml#qblist';
		$filename = 'http://liangshan.58.com/huangye/';
		$content = file_get_contents($filename);
		

		

/*		
		$pattern = '/<h2.*?><a.*>(.*?)<\/a><\/h2>\s*<p>(.*?)<\/p>/i';
		
		$pattern0 = '/<b><a.*?>(.*?)<\/a>\s*<\/b>\s*<br \/>/i';
		
		$pattern1 = '/<td\s*class=\"dogclass".*><a.*>(.*?)<\/a>.*?<\/td>/i';
*/		
		
		/*
		 * 
		 * <li><h3><a href="/shuma/">数码产品»</a></h3>
                    <a class="red" href="/shumaxiangji/">数码相机</a>
                    <a href="/shexiangji/">摄像机</a>
                    <a href="/youxiji/">游戏机/PSP</a>
                    <a href="/mpsanmpsi/">MP3/MP4</a>
                    <a href="/koudaishuma/">口袋数码</a>
                </li>
   <div class="c_b">
     <h2 class="ypic2"><a href="/shangwu.shtml">商务服务</a></h2>
    <a href="/pingmian/">设计策划</a><br>
    <a href="/fanyi/">翻译/速记</a><br>
    <a href="/chuanmei/">广告传媒</a><br>
    <a href="/wangzhan/">网站建设/推广</a><br>
    <a href="/xitong/">网络维护及布线</a><br>
    <a href="/zixunzhongjie/">咨询服务</a> | <a href="/kuaidi/">快递</a><br>
<a href="/huoyun/">物流服务</a> | <a href="/wuliu/">货运专线</a><br>
    <a href="/yinshua/">印刷包装</a><br>
    <a href="/penhui/">喷绘招牌</a> | <a href="/allzhika/">制卡</a><br>
    <h2 class="ypic3">维修/装修</h2>
    <a href="/dianqi/">家电维修</a> | <a href="/kongtiao/">空调维修</a><br>
    <a href="/weixiu/">电脑维修</a><br>
    <a href="/bgsbwx/">办公设备维修</a><br>
    <a href="/jiajuweixiu/">家居维修</a> | <a href="/kaisuo/">开锁换锁</a><br>
    <a href="/zhuangxiu/">装修装饰</a><br>
    <a href="/fangweixiu/">房屋维修/防水</a><br>
    <a href="/jiancai/">建材</a><br>
</div>
		 */
		
/*		$pattern = '/<li><h3><a.*>(.*?)<\/a><\/h3>\s*(<a.*>.*?<\/a>\s*)*<\/li>/';
	$pattern = '/<li.*?><span\sclass="dlb">(.*)<\/span>/i';
		
		$pattern = '/(<li><b><a.*?>(.*?)<\/a><\/b>\s*<span>(.*?)<\/span>)+/';
			
		$pattern = '/<a.*?>(.*?)<\/a>[<br>|]/i';
*/		
		$pattern = '/<h2.*?><a.*?>(.*?)/';
		preg_match_all($pattern, $content, $matches);

		
		
		UtilHelper::dump($matches);
		
		die();
		
		for($i=0;$i<count($matches[2]);$i++)
		{
			$subject = $matches[3][$i];
			
			$pattern2 = '/<a.*?>(.*?)<\/a>/i';
			
			preg_match_all($pattern2, $subject, $matches2);
			
			$todo[$matches[2][$i]] = $matches2[1];
		}
		
		$result = '';
		
		foreach ($todo as $key => $item)
		{
			$result .= $key.":\r\n";
			foreach ($item as $value) {				
				$result .= trim($value)."\r\n";
			}
		}
		
//		$filename = './public/fangchan.txt';
		$filename = './public/tiaozao.txt';
		
		$fp = fopen($filename, 'w+');
		fwrite($fp, $result);
		fclose($fp);
		
		UtilHelper::dump($todo);
		

	}
	
	public function actionRewrite()
	{
//		$filename = 'http://baike.baidu.com/view/75284.htm';

		$filename = 'http://image.baidu.com/i?tn=baiduimage&ct=201326592&lm=-1&cl=2&fr=ala0&word=%C8%FD%D6%D8%C3%C5%20%B7%E2%C3%E6';
/*		
		$pattern = '/<h1.*>(.*?)<\/h1>/i';
*/
		$pattern = '/<a(.*?)>.*?<\/a>/';		
		$subject = file_get_contents($filename);
		$subject = iconv('GB2312', 'UTF-8', $subject);
		
//		echo $subject;
		
		preg_match_all($pattern, $subject, $matches);
		
		UtilHelper::dump($matches);
	}
	
	public function actionAllImage()
	{
		
		$filename = 'http://photo.itbulo.com/scenery/';
		
//		$pattern = '/<img\s+[^>]*\s*src\s*=\s*([\'\"]?)([^\'\">\s]*)\\1\s*[^>]*>/i';

		$pattern = '/<img.*src\s*=\s*[\"|\']?\s*([^>\"\'\s]*)/i';
		
		$subject = file_get_contents($filename);
		$subject = iconv('GB2312', 'UTF-8', $subject);
		
//		echo $subject;
		
		preg_match_all($pattern, $subject, $matches);
		
		UtilHelper::dump($matches);
	}
	
	//洗澡回来写小偷程序，采集文章
	public function getArticleList()
	{
			$url = "http://it.sohu.com/7/1002/17/column203661721_420.shtml";
		
		$result = array();
		
		$todo = Yii::app()->cache->get('articlelist');
		
		if ($todo === false)
		{
			for ($i=322; $i < 420; $i++){
				$con = file_get_contents("http://it.sohu.com/7/1002/17/column203661721.shtml");
				$preg="/<a href=\"(.*)\".*target=\"_blank\">(.*)<\/a>/";
				$preg="/<a href=\"(.*)\" target=\"_blank\">(.*)<\/a>/";
		
				
				$pattern = '/<a href=\'(.*?)\'.*>(.*?)<\/a><span>/';
				preg_match_all($pattern,$con,$arr);
				
				$result[] = array_combine($arr[2], $arr[1]);				
						
			}	
			
			$todo = array();
		
			foreach ($result as $item)
			{
				foreach ($item as $k=>$v)
				{
					$todo[] = array(
						'url'=>$v,
						'title'=>$k
					);
				}
			}
			
			Yii::app()->cache->set('articlelist', $todo);
				
		}

		foreach ($todo as $k=>$v)
		{
			$todo[$k]['content'] = $this->WenZhang($v['url']);
		}
		
		return $todo;
	}
		
	public function actionCaiJi()
	{

		$todo = $this->getArticleList();

			
		foreach ($todo as $item)
		{
			$userSql = $this->randomSql('{{user}}',1);
		
			$user = User::model()->findBySql($userSql);
			
			$cateSql = $this->randomSql('{{channel}}',1);
			
			$category = Channel::model()->findBySql($cateSql);

			if ($user && $category)
			{
				$model = new Advertisement();
				$model->uid = $user->id;
				$model->cid = $category->id;
				$model->title = iconv('GB2312', 'UTF-8', $item['title']);
				$model->content = iconv('GB2312', 'UTF-8', $item['content']);
				$model->start = time();
				$model->end = time();
				$model->address = Profile::model()->getUserTrueName($user->id);
				$model->phone = $user->profiles->phone;
				$model->tag = implode(',', UtilSearch::phpAnalysis($model->content, 5));
				
				
				$model->hasimg = UtilMatch::hasImage($model->content);
				$model->imginfo = UtilMatch::getAllImageInfo($model->content);

				UtilHelper::dump($model->attributes);
	
				
			}

			
			
		}	

//		UtilHelper::writeToFile(serialize($todo), 'a+');
		
		
		
//		UtilHelper::dump($todo);	

		
/**		foreach($arr[1] as $id=>$v){
			echo CHtml::link($arr[2][$id], array('caijiwenzhang','url'=>$v))."</br>";
		}
*/
	}
	
	//生成随机字符串
	function random_string($length, $max=FALSE)
	{
	  if (is_int($max) && $max > $length)
	  {
	    $length = mt_rand($length, $max);
	  }
	  $output = '';
	   
	  for ($i=0; $i<$length; $i++)
	  {
	    $which = mt_rand(0,2);
	     
	    if ($which === 0)
	    {
	      $output .= mt_rand(0,9);
	    }
	    elseif ($which === 1)
	    {
	      $output .= chr(mt_rand(65,90));
	    }
	    else
	    {
	      $output .= chr(mt_rand(97,122));
	    }
	  }
	  return $output;
	}
	
	public function randomSql($table,$size=1)
	{
		$sql = "
			SELECT * 
			FROM  `$table` AS t1
			JOIN (			
			SELECT ROUND( RAND( ) * ( 
			SELECT MAX( id ) 
			FROM  `$table` ) ) AS id
			) AS t2
			WHERE t1.id >= t2.id
			LIMIT $size
		";
		
		return $sql;
	}
	
	/**
	 *随机添加用户 
	 */
	public function actionAddUser()
	{
		for ($i = 0; $i < 100; $i++)
		{
			$string = $this->random_string(8);
			
			$model = new User();
			$model->username = strtolower($string);
			$model->password = strtolower($string);
			if ($model->save())
			{
				echo "OK";
				Yii::app()->authManager->assign('Visitor', $model->id);
				Yii::app()->authManager->assign('User', $model->id);
			}
			else{
				UtilHelper::writeToFile(CHtml::errorSummary($model));
			}			
		}

		
		$user = User::model()->findAll();
		
		foreach ($user as $data)
		{
			echo $data->username."<br />";
		}
	}
	
	public function actionAddInfo()
	{
		$userSql = $this->randomSql('{{user}}',1);
		
		$user = User::model()->findBySql($userSql);
		
		$cateSql = $this->randomSql('{{channel}}',1);
		
		$category = Channel::model()->findBySql($cateSql);
		
		
		
		UtilHelper::dump($category->attributes);
	}
	
	public function WenZhang($url)
	{
		$id = 'wenzhang'.urlencode($url);
		
		$todo = Yii::app()->cache->get($id);
		
		if ($todo === false)
		{
	//		$pattern = '/<div class=\"text clear\" id=\"contentText\">(.*)<\/div>\s*.*<div\s*.*>\s*/s';
			$pattern = "/<p>(.*)<\/p>/";
			
			$content = file_get_contents($url);
			preg_match_all($pattern, $content, $result);
			
			$i = 0;
			foreach ($result[0] as $k=>$v)
			{
				if (strlen($v) === 4443)
				{
					$i = $k;
				}				
			}
			
			
			for ($j = 0; $j <$i; $j++)
			{
				$todo .= "<p>".$result[0][$j].'</p>';
			}	

			Yii::app()->cache->set($id, $todo);
		}

		return $todo;
		
//		UtilHelper::dump($result);
	}
	
	/**
	 * 添加用户
	 * Enter description here ...
	 */
	public function actionUtilUser()
	{
		$form = new RegisterForm();
		
		$form->firstname = UtilUser::getFirstName();
		$form->lastname = UtilUser::getLastName();
		
		$form->username = UtilUser::getNamePinYin($form->firstname.$form->lastname);
		$form->password = $form->username;
		$form->repassword = $form->password;
		$form->email = UtilUser::getEmail($form->username);
		
		$time = time() - rand(365*24*60*60, 365*24*60*60*30);
		
		$form->birthyear = date('Y', $time);
		$form->birthmonth = date('m', $time);
		$form->birthday = date('d', $time);
		$form->gender = UtilUser::getGender();
		$form->agree = 1;		
		
		if ($form->register())
		{
			UtilHelper::dump($form->attributes);
			echo "OK";
		}
		
		echo date('Y/m/d', $time);

	}
	
	public function actionCreateRegion()
	{
		$todo = array();
		
		$str = "天津市：市辖区 和平区 河东区 河西区 南开区 河北区 红桥区 塘沽区 汉沽区 大港区 东丽区 西青区 津南区 北辰区 武清区 宝坻区 宁河县 静海县 蓟　县 ";
		$str = str_replace('　', '', $str);
		$dd = explode('：', $str);
		
		$todo['dd'] = $dd[0];
		$todo['tt'] = explode(' ',$dd[1]);
//		UtilHelper::dump($todo);
		
		
		$result = array();
		
		$file = file('./public/datas/region.txt');
		
		$i = 0;
		
		foreach ($file as $province)
		{
			$province = str_replace("\r\n", '', $province);
			
			$pos = strpos($province,': ');

			if ($pos === false)
			{
				$region1 = $province;
			}
			else 
			{
				
				$str = str_replace('　', '', $province);
				$mv = explode(': ', $str);		
				$county = explode(' ', $mv[1]);	
				$result[$region1][$mv[0]] = $county;
				
				
			}
		}
		
		$return = array();
		
		$id = 1;
		$pid = 0;
		
		foreach ($result as $key=>$item)
		{
			$return[] = array(
				'id'=>$id,
				'pid'=>$pid,
				'region'=>$key
			);
			
			$pid1 = $id;
			$id++;
			
			foreach ($item as $key2=>$item2)
			{
				$return[] = array(
					'id'=>$id,
					'pid'=>$pid1,
					'region'=>$key2
				);
				
				$pid2 = $id;
				$id++;
				
				foreach ($item2 as $item3)
				{
					if ($item3 !== '')
					{
						$return[] = array(
							'id'=>$id,
							'pid'=>$pid2,
							'region'=>$item3
						);
						$id++;						
					}

				}
			}
		}
		
		$fp = fopen('./public/region.txt', 'w+');
		
		//格式化记录到新文件
		foreach ($return as $todo)
		{
			$content = '|'.$todo['id'].'|'.$todo['region']."|1|".$todo['pid']."|0"."\r\n";
			fwrite($fp, $content);
			
			$region = new Region();
			$region->id = $todo['id'];
			$region->region = $todo['region'];
			$region->pid = $todo['pid'];
			$region->uid = 1;
			
			if (!$region->save())
			{
				UtilHelper::writeToFile(CHtml::errorSummary($model));
			}
		}
		
		fclose($fp);
		
		UtilHelper::dump($return);
	}
	

	
}


function check($str)
{
//	return str_replace(' ', '',str_replace('　', '',str_replace("\r", '',str_replace("\n", '', $str),$str),$str),$str);

	$str = str_replace(array("\r","\n","\s","　"," "), '', $str);
	return str_replace('•	', '-', $str);
}
