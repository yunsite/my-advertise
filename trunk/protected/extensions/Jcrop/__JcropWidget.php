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
       $this->clientScript->registerScriptFile($this->baseUrl.'/js/'.$script,CClientScript::POS_END);     	
      }


      
      $this->clientScript->registerCssFile($this->baseUrl.'/css/'.$this->Cssscript);
   }
   
   public function registerScript()
   {
   		$path = $this->baseUrl;
   	
   		$script = <<<SCRIPT
         // Create variables (in this scope) to hold the API and image size
        var jcrop_api, boundx, boundy;   
              
        $(function(){
            startJcrop(); 
            
            
            
        });
   		

      
      
   
  
          
      function startJcrop(){
        

        $('#target').Jcrop({
            onChange: updatePreview,
            onSelect: updatePreview,
            aspectRatio: 1
          },function(){
            // Use the API to get the real image size
            var bounds = this.getBounds();
            boundx = bounds[0];
            boundy = bounds[1];
            
            alert(boundx);
            
            
            // Store the API in the jcrop_api variable
            jcrop_api = this;
          });
      } 
      
      


      function updatePreview(c)
      {
        if (parseInt(c.w) > 0)
        {
          var rx = 150 / c.w;
          var ry = 150 / c.h;
          
//          var boundy = $('#target').height();
//          
////          $('.jcrop-tracker').height(boundy+4+'px');
////          $('.jcrop-tracker').prev('div').height(boundy+'px');
//          
//          $('#newimgx').val('x:'+boundx+'y:'+boundy+'c.w:'+c.w+'c.h:'+c.h);
//
//			
//			
//			$('#newimgy').val(boundy);
         
		  $('#wh').val(rx);
		  
		  
          $('#preview').css({
            width: Math.round(rx * boundx) + 'px',
            height: Math.round(ry * boundy) + 'px',
            marginLeft: '-' + Math.round(rx * c.x) + 'px',
            marginTop: '-' + Math.round(ry * c.y) + 'px'
          });
        }
        
        showCoords(c);
      };
   		
	function showCoords(c)
	{
		$('#x').val(c.x);
		$('#y').val(c.y);
		$('#x2').val(c.x2);
		$('#y2').val(c.y2);
		$('#w').val(c.w);
		$('#h').val(c.h);
	};	

   		
SCRIPT;
		Yii::app()->getClientScript()->registerScript($this->id,$script,CClientScript::POS_END);
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