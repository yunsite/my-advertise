<?php
Yii::import('zii.widgets.CBreadcrumbs');

class jbreadcrumbsWidget extends CBreadcrumbs
{

	public $clientScript;
	
	public   $baseUrl;
	private  $Jscripts = array('jquery.jBreadCrumb.1.1.js');	//'jquery.easing.1.3.js','cufon-yui.js','ChunkFive_400.font.js',
	private  $Cssscript = 'BreadCrumb.css';
	
	public $id = 'breadCrumb0';


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

//      Yii::app()->clientScript->registerScriptFile('https://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js', CClientScript::POS_HEAD);
      
      foreach ($this->Jscripts as $script)
      {
       $this->clientScript->registerScriptFile($this->baseUrl.'/js/'.$script,CClientScript::POS_END);     	
      }


      
      $this->clientScript->registerCssFile($this->baseUrl.'/Styles/'.$this->Cssscript);
   }
   
   public function registerScript()
   {
   		$script = <<<SCRIPT
   			
  		var container	= $('#$this->id');
		container.jBreadCrumb();
   		
SCRIPT;
		Yii::app()->getClientScript()->registerScript('jbreadcrumbswidget',$script,CClientScript::POS_READY);
   }
   
   
	public function run()
	{
		$this->publishAssets();
		$this->registerClientScripts();
		$this->registerScript();
		
  		if(empty($this->links))
			return;
		
		$this->render('breadcrumbs');	
	}


}
?>