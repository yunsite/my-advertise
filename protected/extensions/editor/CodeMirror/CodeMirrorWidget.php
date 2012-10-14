<?php
class CodeMirrorWidget extends CWidget
{
	public $clientScript;
	
	public $baseUrl;
	public $Jscripts = array('lib/codemirror.js','mode/javascript/javascript.js');
	public $Cssscript = array('lib/codemirror.css', 'theme/ambiance.css');
	
	public $id = 'myCodeEditor';
    public $editor = 'editor';
    
    public $theme = 'ambiance';
    
	public $_options = array(

	);	//


   /**
    * Publishes the assets
    */
   public function publishAssets()
   {
      $dir = dirname(__FILE__).DIRECTORY_SEPARATOR.'assets';
 
      $this->baseUrl = Yii::app()->getAssetManager()->publish($dir);

   }
   
   public function setSyntax()
   {
        foreach($this->syntax as $syntax){
            $file = '.'.$this->baseUrl.'/mode/'.$syntax.'/'.$syntax.'.js';
            
            if(syntax && file_exists($file))
                $this->Jscripts[] = 'mode/'.$syntax.'/'.$syntax.'.js';            
        }
    

   }
   
   public function setTheme()
   {
        
        $file = '.'.$this->baseUrl.'/theme/'.$this->theme.'.css';
        
        if($this->theme != '' && file_exists($file))
            $this->Cssscript[] = 'theme/'.$this->theme.'.css';
   }
   
   /**
    * Registers the external javascript files
    */
   public function registerClientScripts()
   {
      if ($this->baseUrl === '')
         throw new CException('Can not find the base folder');

      $this->clientScript = Yii::app()->getClientScript();

 //     $this->clientScript->registerCoreScript('jquery');
      
      $this->setSyntax();
      
      foreach ($this->Jscripts as $script)
      {
       $this->clientScript->registerScriptFile($this->baseUrl.'/'.$script,CClientScript::POS_HEAD);     	
      }

      $this->setTheme();

      foreach($this->Cssscript as $css)
      {
        $this->clientScript->registerCssFile($this->baseUrl.'/'.$css);
      }
     
   }
   
   protected function setBaseOptions(){
       	$this->_options=array_merge(array(
//            value=>'js:function(){return 100;}',
            mode=>'javascript',
       		lineNumbers=>true	 
       	),$this->_options);
   
   }
   
   public function registerScript()
   {
        $script = 'var '. $this->editor. '= CodeMirror.fromTextArea(document.getElementById("'.$this->id.'"),'.CJavaScript::encode($this->_options).');';

   	
   	//	$script = 'var  '.$this->editor. ' = CodeMirror(document.getElementById("'.$this->id.'"),'. CJavaScript::encode($this->_options).')';

		Yii::app()->getClientScript()->registerScript('ext-editor-CodeMirrorWidget'.$this->id,$script,CClientScript::POS_HEAD);
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
//		$this->registerScript();
//		$this->render('fancybox');	
	}

}
?>