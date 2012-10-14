<?php
class hoverCardWidget extends CWidget
{
	
	public $clientScript;
	
	public $baseUrl;
	public $Jscripts = array('js/hoverCard.js');
	public $Cssscript = array('css/main.css');
	
	public $selector = ".bind_hover_card";
	
	private $_options = array(
	
	);
	
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
   		if(isset($this->selector)) {
            $options = (empty($this->_options)) ? '{}' : $this->_options;
			$options = CJavaScript::encode($options);
            
            $script = '$("'.$this->selector.'").hoverCard('.$options.')';    
   		}
   		
   		$this->clientScript->registerScript('hoverCard',$script);
		
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
		$this->registerScript();

	}

}
?>