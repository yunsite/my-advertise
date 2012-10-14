<?php
class Poshytip extends CWidget
{
	public $clientScript;
	
	public $baseUrl;
	public $Jscripts = array('jquery.poshytip.js');
    public $Cssscript = array();
//	public $Cssscript = array(
//								'tip-yellow/tip-yellow.css',
//								'tip-violet/tip-violet.css',
//								'tip-darkgray/tip-darkgray.css',
//								'tip-skyblue/tip-skyblue.css',
//								'tip-yellowsimple/tip-yellowsimple.css',
//								'tip-twitter/tip-twitter.css',
//								'tip-green/tip-green.css'
//							);
	
	public $selector = ':input ';
	public $options = array(
							'className',
							'showOn',
							'alignTo',
							'alignX',
							'alignY',
							'offsetX'
	);
	public $init;
	public $tooltips = array(
							'className'=>'tip-yellowsimple',
							'showOn'=>'focus',
							'alignTo'=>'target',
							'alignX'=>'left',
							'alignY'=>'center',
							'offsetX'=>5	
	);

    public $needCore = false;

   /**
    * Publishes the assets
    */
   public function publishAssets()
   {
      $dir = dirname(__FILE__).DIRECTORY_SEPARATOR.'src';
 
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
      
      $this->loadCss();
      foreach ($this->Cssscript as $cssfile)
      	$this->clientScript->registerCssFile($this->baseUrl.'/'.$cssfile);
   }
   
   public function loadCss()
   {
        if($this->tooltips['className'])
        {
            $this->Cssscript[] = $this->tooltips['className'].'/'.$this->tooltips['className'].'.css';
        }
   }
   
   public function registerScript()
   {		
   		if(isset($this->selector)) {
            $options = (empty($this->init)) ? '{}' : $this->init;
			$options = json_encode($options);
            $script = "$('".$this->selector."').tooltip(".$options.");";
            
//            echo '<script type="text/javascrit" language="javascript">';
//            echo '$(function(){';
//            echo $script;
//            echo '});';
//            echo '</script>';    
   		}
   		
//   		$this->clientScript->registerScript('poshytip',$script);
		
   }
   
   private function initTooltip()
   {
   		$initialize = array();
   		if (is_array($this->tooltips))
   		{
   			foreach ($this->tooltips as $option => $value)
   			{
   				if (in_array($option, $this->options))
   					$initialize[$option] = $value;
   			}
   		}
   		
   		$this->init = json_encode($initialize);
   }
   

   
	public function run()
	{
		
		$this->publishAssets();
		$this->registerClientScripts();
		$this->initTooltip();
		$this->registerScript();
		$this->render('tip');	
	}

}
?>