
<?php
class syntaxhighlighterWidget extends CWidget
{
	public $clientScript;
	
	public $baseUrl;
	
	//Load Queue widget CSS and jQueryy

	public $Jscripts = array('shCore.js');
	public $Cssscript = 'shCore.css';
	
	public $lang = 'AppleScript,AS3,Bash,ColdFusion,Cpp,CSharp,Css,Delphi,Diff,Erlang,Groovy,Java,JScript,Perl,Php,PowerShell,Python,Ruby,Sass,Scala,Sql,Vb,Xml';
//	public $lang = "Php,Css,JScript,Java";
	/**settings*/
	
	public $theme = "Default";	//Django,Emacs,FadeToGrey,Midnight,RDark



   /**
    * Publishes the assets
    */
   public function publishAssets()
   {
      $dir = dirname(__FILE__).DIRECTORY_SEPARATOR.'assets';
 
      $this->baseUrl = Yii::app()->getAssetManager()->publish($dir);
   }
   
   public function generateScriptName()
   {
   		$names = explode(',', $this->lang);
   		
   		$langs = array();
   		
   		foreach ($names as $name)
   		{
   			$langs[] = 'shBrush'.$name.'.js';
   		}
   		
   		$this->Jscripts = array_merge($this->Jscripts,$langs);
   }
   
   /**
    * Registers the external javascript files
    */
   public function registerClientScripts()
   {
      if ($this->baseUrl === '')
         throw new CException('Can not find the base folder');

      $this->clientScript = Yii::app()->getClientScript();
      
//      Yii::app()->getClientScript()->registerCoreScript('jquery');

      
      foreach ($this->Jscripts as $script)
      {
       $this->clientScript->registerScriptFile($this->baseUrl.'/scripts/'.$script);     	
      }


//      $this->clientScript->registerCssFile($this->jqueryUi);
      
      $this->clientScript->registerCssFile($this->baseUrl.'/styles/'.$this->Cssscript);
      $this->clientScript->registerCssFile($this->baseUrl.'/styles/shTheme'.$this->theme.'.css');
   }
   
   public function registerScript()
   {
   		$script = <<<SCRIPT
   		
	SyntaxHighlighter.config.bloggerMode = true;
	SyntaxHighlighter.all();
			
SCRIPT;
		Yii::app()->clientScript->registerScript(__CLASS__,$script,CClientScript::POS_END);
   }
   
	public function run()
	{
		$this->publishAssets();
		
		$this->generateScriptName();
		$this->registerClientScripts();
		$this->registerScript();	

//		$this->render('syntax');

	}

}
?>