<?php
class QuickSandWidget extends CWidget
{
	
	public $clientScript;
	
	public $baseUrl;
	
	//Load Queue widget CSS and jQueryy

	public $jsScripts = array('/jquery.quicksand.js' );
//	public $cssScript = 'css/main.css';

	public $script = '';




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
      
      Yii::app()->getClientScript()->registerCoreScript('jquery');

      foreach ($this->jsScripts as $script)
      {
      	$this->clientScript->registerScriptFile($this->baseUrl.$script);     	
      }
      
//      $this->clientScript->registerCssFile($this->baseUrl.$this->cssScript);
   }
   
   public function registerScript()
   {
   	
   		$jsscript = $this->script;
   		
   		$script = <<<SCRIPT
   		
		$jsscript;
				
SCRIPT;

		Yii::app()->clientScript->registerScript(__CLASS__,$script,CClientScript::POS_HEAD);
		
   }
   
	public function run()
	{
		$this->publishAssets();

		$this->registerClientScripts();
		
		$this->registerScript();	

	}

}

?>