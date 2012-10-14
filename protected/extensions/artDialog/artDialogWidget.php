<?php
class artDialogWidget extends CWidget
{
	private  $_options = array();
	
	public $clientScript;
	
	public $baseUrl;
	public $Jscripts = array('source/artDialog.js');
	public $CssPath = 'skins/';
	public $theme = 'default';
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


      
      $this->clientScript->registerCssFile($this->baseUrl.'/'.$this->CssPath.$this->theme.'.css');
   }
   
    protected function setBaseOptions(){
        $this->_options=array_merge(array(

        ),$this->_options);        

    }
   
   public function registerScript()
   {
   		$path = $this->baseUrl;
   	
//   		$script = <<<SCRIPT
//   			
//		   $('#{$this->uploadifyID}').uploadify({
//		    'uploader'  : '{$path}/uploadify.swf',
////		    'script'    : '{$path}/uploadify.php',
//			'expressInstall':'{$path}/expressInstall.swf',
//			'script'	: '{$this->script}',
//		    'cancelImg' : '{$path}/cancel.png',
//		    'scriptData': {}
//		    'folder'    : '{$this->folder}',
//		    'auto'      : eval('{$this->auto}')
//		  });
//   		
//   		
//SCRIPT;
//		Yii::app()->getClientScript()->registerScript($this->id,$script,CClientScript::POS_READY);


   		Yii::app()->getClientScript()->registerScript(get_class($this),"art.dialog(".CJavaScript::encode($this->_options).");"
        ,CClientScript::POS_END);
   }
   
    /**
     * override defaults __get method to allow get options easier
     * 
     * @param mixed $name
     * @return mixed
     */
    function __get($name){
        try{
            return parent::__get($name);
        }catch(exception $e){
            if(isset($this->_options[$name]))
                return $this->_options[$name];
            throw $e;
        }
    }
    /**
     * override defaults __set method to allow set options easier
     * 
     * @param mixed $name
     * @param mixed $value
     * @return mixed
     */
    function __set($name,$value){
        try{
            return parent::__set($name,$value);
        }catch(exception $e){
            return $this->_options[$name]=$value;
        }
    }
   
	public function run()
	{
		$this->publishAssets();
		$this->registerClientScripts();
		$this->setBaseOptions();
		$this->registerScript();
//		$this->render('uploadify');	
	}

}
?>