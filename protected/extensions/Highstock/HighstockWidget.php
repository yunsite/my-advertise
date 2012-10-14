<?php
class HighstockWidget extends CWidget
{
	private  $_options = array();
	
	public $clientScript;	
	
	public $baseUrl;

	public $Jscripts = array('highstock.js','modules/exporting.js');

	public $Cssscript = '';
	
	public $id = 'chart';
	public $container = 'container';
	public $type = 'area';
    
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
      
      foreach ($this->Jscripts as $script)
      {
       $this->clientScript->registerScriptFile($this->baseUrl.'/js/'.$script,CClientScript::POS_HEAD);     	
      }


      
//      $this->clientScript->registerCssFile($this->baseUrl.'/'.$this->Cssscript);
   }
   
    protected function setBaseOptions(){
        $this->_options=array_merge(array(
			'chart'=>array(
        		'renderTo'=> $this->container,
                'type'=> $this->type
        	),
        	
        ),$this->_options);
        
    }
   
   public function registerScript()
   {
		
		Yii::app()->getClientScript()->registerScript(get_class($this),"$(function(){var {$this->id} = new Highcharts.StockChart(".CJavaScript::encode($this->_options).");});"
        ,CClientScript::POS_READY);
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