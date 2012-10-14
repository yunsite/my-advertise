<?php
class visitorsWidget extends CWidget{
	public $baseUrl;
	
	public $queryID;
	
	public $options;	//transition:"none", width:"75%", height:"75%"

   /**
    * Publishes the assets
    */
   public function publishAssets()
   {
      $dir = dirname(__FILE__).DIRECTORY_SEPARATOR.'assets';
 
      $this->baseUrl = Yii::app()->getAssetManager()->publish($dir);
   }
   
  
   public function run()
   {
   		$this->publishAssets();
//   		$this->importQQWry();
   		
//   		$ip = '125.68.45.237';
//   		
//   		echo UtilTools::getClientIp().'lllll';
//   		
//   		$qq = new QQWry($ip);
//   		
//  		echo $ip.ip2long($ip).$qq->getDetailInfo().$this->queryID;
   		
   		$visitors = Visitors::model()->getArticleVisitors($this->queryID);
   		
//   		UtilTools::dump($visitors);
   		
   		$this->render('visitors',array(
   			'visitors' => $visitors
   		));
   }
}