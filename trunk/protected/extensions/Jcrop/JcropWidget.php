<?php
class JcropWidget extends CWidget
{
	public $clientScript;
	
	public $baseUrl;
	public $Jscripts = array('jquery.Jcrop.js');
	public $Cssscript = 'jquery.Jcrop.css';
	
	public $uploadifyID = 'file_upload';
	
	public $label = '开始上传';
	
	public $auto = false;
	
	public $options;	//'width': '75%','height': '75%','autoScale':false,
    
    public $tar_width = 500;
    public $pre_width = 150;


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
       $this->clientScript->registerScriptFile($this->baseUrl.'/js/'.$script,CClientScript::POS_HEAD);     	
      }


      
      $this->clientScript->registerCssFile($this->baseUrl.'/css/'.$this->Cssscript);
   }
   
   public function registerScript()
   {
   		$path = $this->baseUrl;
        
        $head = <<<HEAD
        
            jQuery('#target').Jcrop({
                onChange: updatePreview,
                onSelect: updatePreview,
                aspectRatio: 1
            });
        
     
function getImageInfo() {
    var img = $("#target");

    var image = new Image();

    image.src = img.attr("src");

    return image;
}

/**
 * coords是剪切时的图片参数
 * coords.w : 剪切宽度
 * coords.h : 剪切高度
 */
function updatePreview(coords) {
    if (parseInt(coords.w) > 0) {
        
        var rx = {$this->pre_width} / coords.w;
        var ry = {$this->pre_width} / coords.h;

        var image = getImageInfo();

        width = {$this->tar_width};

        var rn = width / image.width;

        height = Math.round(rn * image.height);

        jQuery('#preview').css({
            width: Math.round(rx * width) + 'px',
            height: Math.round(ry * height) + 'px',
            marginLeft: '-' + Math.round(rx * coords.x) + 'px',
            marginTop: '-' + Math.round(ry * coords.y) + 'px'
        });
    }

    showCoords(coords);
}

// Our simple event handler, called from onChange and onSelect
// event handlers, as per the Jcrop invocation above
function showCoords(c) {
    jQuery('#x').val(c.x);
    jQuery('#y').val(c.y);
    jQuery('#x2').val(c.x2);
    jQuery('#y2').val(c.y2);
    jQuery('#w').val(c.w);
    jQuery('#h').val(c.h);
};        
        
HEAD;
   	
   		$script = <<<SCRIPT
        


   		
SCRIPT;
//		Yii::app()->getClientScript()->registerScript($this->id.'head',$head,CClientScript::POS_END);
        Yii::app()->getClientScript()->registerScript($this->id.'ready',$head,CClientScript::POS_READY);
   }
   
	public function run()
	{
		$this->publishAssets();
		$this->registerClientScripts();
		$this->registerScript();
//		$this->render('jcrop');	
	}

}
?>