<?php
class chosenWidget extends CWidget
{
	public $clientScript;
	
	public $baseUrl;
	public $Jscripts = array('chosen/chosen.jquery.js');
	public $Cssscript = array('chosen/chosen.css',);
	
	public $selector = 'select';
    
    public $needCore = false;



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
      
      if($this->needCore)
          $this->clientScript->registerCoreScript('jquery');
      
      foreach ($this->Jscripts as $jsfile)
      {
       $this->clientScript->registerScriptFile($this->baseUrl.'/'.$jsfile,CClientScript::POS_HEAD);     	
      }
      foreach ($this->Cssscript as $cssfile)
      	$this->clientScript->registerCssFile($this->baseUrl.'/'.$cssfile);
   }
   
   public function registerScript()
   {		

            
   		$script = <<<SCRIPT
   			
   		$("select").chosen();
   		
SCRIPT;
		Yii::app()->getClientScript()->registerScript($this->id,$script,CClientScript::POS_READY);		
   }
   
  

   
	public function run()
	{
		
		$this->publishAssets();
		$this->registerClientScripts();
		$this->registerScript();

	}

}
?>