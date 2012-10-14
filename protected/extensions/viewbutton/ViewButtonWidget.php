<?php
/**
 * 此widget用于生成快捷导航
 * @author Administrator
 *
 */
class ViewButtonWidget extends CWidget
{
	public $url;	//link
	public $navID = 'navajax';		//div navigator id
	public $destinationID; //div
	public $autopaly = FALSE;
	
	public $pageCount = 1000;	//总页数
	
	public $baseUrl; 
	private $Cssscript='button.css';
	
	
	private $clientScript;
   /**
    * Publishes the assets
    */
   public function publishAssets()
   {
      $dir = dirname(__FILE__).DIRECTORY_SEPARATOR.'assets';
 
      $this->baseUrl = Yii::app()->getAssetManager()->publish($dir);
   }
   
   /**
    * Registers the external javascript files
    */
   public function registerClientScripts()
   {
      if ($this->baseUrl === '')
         throw new CException('Can not find the base folder');

      $this->clientScript = Yii::app()->getClientScript();
//
      $this->clientScript->registerCoreScript('jquery');
//      
//      foreach ($this->Jscripts as $script)
//      {
//       $this->clientScript->registerScriptFile($this->baseUrl.'/fancybox/'.$script,CClientScript::POS_END);     	
//      }


      
      $this->clientScript->registerCssFile($this->baseUrl.'/css/'.$this->Cssscript);
   }  

   
	public function run()
	{
		$this->publishAssets();
		$this->registerClientScripts();
		
		 $this->render('button',array(
		 	'url'=>$this->url,
		 	'navID'=>$this->navID,
		 	'destinationID'=>$this->destinationID,
		 	'pageCount'=>$this->pageCount
		 	
		 ));
	}
}