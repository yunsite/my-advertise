<?php
class XbreadcrumbsWidget extends CWidget
{
	public $clientScript;
	
	public $baseUrl;
	public $Jscripts = array('xbreadcrumbs.js');
	public $Cssscript = 'xbreadcrumbs.css';
	
	public $id = '#xbreadcrumbs';
	public $options;	//'width': '75%','height': '75%','autoScale':false,


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
       $this->clientScript->registerScriptFile($this->baseUrl.'/'.$script,CClientScript::POS_END);     	
      }


      
      $this->clientScript->registerCssFile($this->baseUrl.'/'.$this->Cssscript);
   }
   
   public function registerScript()
   {
   		$script = <<<SCRIPT
   			
   		$("$this->id").xBreadcrumbs({{$this->options}})  ;
   		
SCRIPT;
		Yii::app()->getClientScript()->registerScript($this->id,$script,CClientScript::POS_READY);
   }
   
	public function run()
	{
		$this->publishAssets();
		$this->registerClientScripts();
		$this->registerScript();
//		$this->render('fancybox');	
	}

}
?>