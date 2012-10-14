<?php
class editareaWidget extends CWidget
{
	public $clientScript;
	
	public $baseUrl;
	public $Jscripts = array('edit_area/edit_area_full.js');
	public $Cssscript = '';
	
	public $id = 'editarea';
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
   
   /**
    * Registers the external javascript files
    */
   public function registerClientScripts()
   {
      if ($this->baseUrl === '')
         throw new CException('Can not find the base folder');

      $this->clientScript = Yii::app()->getClientScript();

//      $this->clientScript->registerCoreScript('jquery');
      
      foreach ($this->Jscripts as $script)
      {
       $this->clientScript->registerScriptFile($this->baseUrl.'/'.$script,CClientScript::POS_HEAD);     	
      }


      
 //     $this->clientScript->registerCssFile($this->baseUrl.'/'.$this->Cssscript);
   }
   
   protected function setBaseOptions(){
   	$this->_options=array_merge(array(
			'id' => $this->id, // id of the textarea to transform
   			start_highlight=> true,
   			font_size=> "8",
   			font_family=> "verdana, monospace",
   			allow_resize=> "y",
   			allow_toggle=> false,
   			language=> "fr",
   			syntax=> "css",
   			toolbar=> "new_document, save, load, |, charmap, |, search, go_to_line, |, undo, redo, |, select_font, |, change_smooth_selection, highlight, reset_highlight, |, help",
   			load_callback=> "my_load",
   			save_callback=> "my_save",
   			plugins=> "charmap",
   			charmap_default=> "arrows"		
   			 
   	),$this->_options);
   
   }
   
   public function registerScript()
   {
   	
   		$script = 'editAreaLoader.init('.CJavaScript::encode($this->_options).')';

		Yii::app()->getClientScript()->registerScript('ext-editor-editareaWidget',$script,CClientScript::POS_END);
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
//		$this->render('fancybox');	
	}

}
?>