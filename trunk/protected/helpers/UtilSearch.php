<?php
class UtilSearch
{
	public static function phpAnalysis($string, $size = 5, $do_fork = true, $do_unit = true, $do_prop = true, $do_multi = true, $pri_dict = true)
	{
		Yii::import('application.components.phpanalysis.*');
		
		header('Content-Type: text/html; charset=utf-8');

//	$str = <<<DOM
//九十年代初，刘德华演出多部黑社会江湖片，扮演身在黑社会却有情有义、英气未泯的人物，其形象深深影响当时的年轻人。其后刘德华开始改变形象，角色的类型多变，演出更有深度，演艺事业更上一层楼。电影的代表作包括《九一神雕侠侣》、《赌神》、《天若有情》、《龙在江湖》、《法外情》、《烈火战车》、《旺角卡门》、《雷洛传》、《阿虎》、《瘦身男女》、《赌侠》系列、《暗战》、《无间道》、《无间道三终极无间》、《大只佬》、《天下无贼》、《墨攻》、《投名状》、《门徒》等等。
//　　刘德华于1985年进军乐坛，第一张专辑是《只知道此刻爱你》，并获得很大回响。在1991年的偶像热潮下，刘德华与张学友、黎明、郭富城被传媒封为“四大天王”。1991年推出《爱不完》专辑，销售首日录音带销售共16万张，镭射唱片(CD)共72,000张。1993年1月，在香港红磡体育馆举办第一场个人演唱会。他曾六度夺得“十大劲歌金曲颁奖典礼”的“
//华仔(20张)
//最受欢迎男歌星”，亦九次夺得“亚太区最受欢迎香港男歌星”；其中刘德华于2004年度同时夺得“最受欢迎男歌星”和“亚太区最受欢迎香港男歌星”，是首位同时获得这两个大奖的男歌手。至2007年刘德华因为工作忙碌，以无法抽空出席TVB的颁奖典礼。刘德华曾于1998、1999、2001及2002年度夺“四台联颁音乐大奖--传媒大奖”，四度成为四大电子传媒音乐颁奖典礼大赢家。亦在90年代台湾演艺圈年度盛事十大偶像票选中连续6年打败当红的台湾四小天王、连续6度夺得冠军，其《忘情水》、《天意》等国语专辑在台湾取得近100万销量的好成绩。
//　　时至今日，帅气的刘德华仍然是影视歌坛的超级巨星，他对工作孜孜不倦，以49岁的年纪仍能成为演艺界当红偶像，可谓魅力无边
//DOM;

//		echo $this->createUrl('analysis');

		$str = isset($string)?$string:" ";

//		$str = isset($_POST['content'])?$_POST['content']:" ";
//		var_dump($_REQUEST);
//		die();
		
//		$do_fork = $do_unit = $do_prop = true;
//		$do_multi =  $pri_dict = false;
	
	    //初始化类
	    //PhpAnalysis::$loadInit = false;
	    $pa = new PhpAnalysis('utf-8', 'utf-8', $pri_dict);
	    
	    //载入词典
	    $pa->LoadDict();
	    
	    //执行分词
	    $pa->SetSource($str);
	    $pa->differMax = $do_multi;
	    $pa->unitWord = $do_unit;
	    
	    $pa->StartAnalysis( $do_fork );
	    
	    $result = $pa->GetFinallyResult(' ', $do_prop);
	     
	    $pa_foundWordStr = $pa->foundWordStr;
	    
	//    $result = $pa->GetFinallyIndex();
	
	    $result = explode(' ',$result);
	    
	    $pa = '';
	
	
	    $result = array_count_values($result);
	//    $result = str_replace('‘', '', $result);
		array_multisort($result,SORT_DESC,SORT_NUMERIC); 
//		echo "<pre>";
//		echo "<div style='float:left; width:200px;'>".var_dump($result)."</div>";
		$arr = array();
		
		foreach ($result as $k=>$v){
			if(!strpos($k,'/n')){
				unset($result[$k]);
			}else{
				$str = explode('/', $k);
				
				$arr[] = $str[0];
			}		
		}
//		echo "<div style='float:left; width:200px;'>".var_dump($result)."</div>";
//		
//		var_dump(array_slice($result, 0, 5));
//		echo "</pre>";
	
//		return $result;

		return array_slice($arr, 0, $size);
		
	}
}
?>