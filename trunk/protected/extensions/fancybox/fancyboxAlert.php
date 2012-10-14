<?php
class fancyboxAlert extends CWidget
{
	public $clientScript;
	
	public $baseUrl;
	public $Jscripts = array('jquery.fancybox-1.3.4.pack.js','jquery.mousewheel-3.0.4.pack.js');
	public $Cssscript = 'jquery.fancybox-1.3.4.css';
	
	public $id = 'facybox';
	public $options;	//'width': '75%','height': '75%','autoScale':false,
	
	public $title = '操作提示';
	public $content = '';
	



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

      $this->clientScript->registerCoreScript('jquery');
      
      foreach ($this->Jscripts as $script)
      {
       $this->clientScript->registerScriptFile($this->baseUrl.'/fancybox/'.$script,CClientScript::POS_HEAD);     	
      }


      
      $this->clientScript->registerCssFile($this->baseUrl.'/fancybox/'.$this->Cssscript);
   }
   
   public function registerScript()
   {
   		$script = <<<SCRIPT
   			

   		
   		 
   		
SCRIPT;
		Yii::app()->getClientScript()->registerScript('ext-box-fancyboxalert',$script,CClientScript::POS_READY);
   }
   
	public function run()
	{
		$this->publishAssets();
		$this->registerClientScripts();
		$this->registerScript();
		$this->render('alert');	
	}

}
?>