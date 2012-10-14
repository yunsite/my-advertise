<?php

/**
 * 
 */
class Ueditor extends CInputWidget 
{
	
	/******* widget private vars *******/
	private $baseUrl			= null;
	private $jsFiles			= array(
									'/editor_config.js',
									'/editor_all_min.js',
								);
	private $cssFiles			= array(
									'/themes/default/ueditor.css',
								);							
								
	public $getId = 'editor';
	
	public $toolbars = null;
	
	public $UEDITOR_HOME_URL = "../";
	public $imagePath = null;
	public $initialContent = null;  //初始化编辑器的内容
    public $autoClearinitialContent = null;                       //是否自动清除编辑器初始内容
    public $iframeCssUrl = null;        //要引入css的url
    public $removeFormatTags = null;    //清除格式删除的标签 'b,big,code,del,dfn,em,font,i,ins,kbd,q,samp,small,span,strike,strong,sub,sup,tt,u,var'
    public $removeFormatAttributes = null;        //清除格式删除的属性 'class,style,lang,width,height,align,hspace,valign'
    public $enterTag = null;                                      //编辑器回车标签。p或br
    public $maxUndoCount = null;                                   //最多可以回退的次数
    public $maxInputCount = null;                                  //当输入的字符数超过该值时，保存一次现场
    public $selectedTdClass = null;                   //设定选中td的样式名称 'selectTdClass'
    public $pasteplain = null;                                      //是否纯文本粘贴。false为不使用纯文本粘贴，true为使用纯文本粘贴
    public $textarea = null;                            //提交表单时，服务器获取编辑器提交内容的所用的参数，多实例时请给每个实例赋予不同的名字 'editorValue'
    public $focus = null;                                       //初始化时，是否让编辑器获得焦点true或false
    public $indentValue = null;                                 //初始化时，首行缩进距离 '2em'
    public $pageBreakTag = null;             //分页符 _baidu_page_break_tag_
    public $minFrameHeight= null;                                 //最小高度
    public $autoHeightEnabled=null;                             //是否自动长高
    public $autoFloatEnabled= null;                              //是否保持toolbar的位置不动
    public $elementPathEnabled = null;                           //是否启用elementPath
    public $wordCount=null;                                      //是否开启字数统计
    public $maximumWords=null;                                  //允许的最大字符数
    public $tabSize = null;                                           //tab的宽度
    public $tabNode = null;                                      //tab时的单一字符
    public $emotionPath= null;
	
	
								
	/**
	* Initialize the widget
	*/
	public function init()
	{
		//Publish assets
		$this->publishAssets();
		$this->registerClientScripts();
		parent::init();
	}
	
	/**
	* Publishes the assets
	*/
	public function publishAssets()
	{
		$dir = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'ueditor_1_1_7';
		$this->baseUrl = Yii::app()->getAssetManager()->publish($dir);
	}
	
	/**
	* Registers the external javascript files
	*/
	public function registerClientScripts()
	{
		
		if ($this->baseUrl === '')
			throw new CException(Yii::t('Ueditor', 'baseUrl must be set. This is done automatically by calling publishAssets()'));
		
		//Register the main script files
		$cs = Yii::app()->getClientScript();
		foreach($this->jsFiles as $jsFile) {
			$ueditorJsFile = $this->baseUrl . $jsFile;
			$cs->registerScriptFile($ueditorJsFile, CClientScript::POS_HEAD);
		}
		
		// add the css
		foreach($this->cssFiles as $cssFile) {
			$ueditorCssFile = $this->baseUrl . $cssFile;
			$cs->registerCssFile($ueditorCssFile);
		}
		//Register the widget-specific script on ready
		 $js = $this->generateOnloadJavascript();
		$cs->registerScript('ueditor'.$this->getId(), $js, CClientScript::POS_END);
	}
	
	protected function generateOnloadJavascript()
	{
		$js = "var editor = new baidu.editor.ui.Editor({";
		$js .= "UEDITOR_HOME_URL:'".$this->baseUrl.$this->UEDITOR_HOME_URL."',";	
		if($this->initialContent){
			$js .= "initialContent:'$this->initialContent',";
		}
		if($this->imagePath){
			$js .= "imagePath:'$this->imagePath',";
		}
		if($this->iframeCssUrl){
			$js .= "iframeCssUrl:'$this->iframeCssUrl',";
		}
		if($this->removeFormatTags){
			$js .= "removeFormatTags:'$this->removeFormatTags',";
		}
		if($this->removeFormatAttributes){
			$js .= "removeFormatAttributes:'$this->removeFormatAttributes',";
		}
		if($this->enterTag){
			$js .= "enterTag:'$this->enterTag',";
		}
		if($this->maxUndoCount){
			$js .= "maxUndoCount:'$this->maxUndoCount',";
		}
		if($this->maxInputCount){
			$js .= "maxInputCount:'$this->maxInputCount',";
		}
		if($this->selectedTdClass){
			$js .= "selectedTdClass:'$this->selectedTdClass',";
		}
		if($this->pasteplain){
			$js .= "pasteplain:'$this->pasteplain',";
		}
		if($this->textarea){
			$js .= "textarea:'$this->textarea',";
		}
		if($this->focus){
			$js .= "focus:'$this->focus',";
		}
		if($this->indentValue){
			$js .= "indentValue:'$this->indentValue',";
		}
		if($this->pageBreakTag){
			$js .= "pageBreakTag:'$this->pageBreakTag',";
		}
		if($this->minFrameHeight){
			$js .= "minFrameHeight:'$this->minFrameHeight',";
		}
		if($this->autoHeightEnabled){
			$js .= "autoHeightEnabled:'$this->autoHeightEnabled',";
		}
		if($this->autoFloatEnabled){
			$js .= "autoFloatEnabled:'$this->autoFloatEnabled',";
		}
		if($this->elementPathEnabled){
			$js .= "elementPathEnabled:'$this->elementPathEnabled',";
		}
		if($this->wordCount){
			$js .= "wordCount:'$this->wordCount',";
		}if($this->maximumWords){
			$js .= "maximumWords:'$this->maximumWords',";
		}if($this->tabSize){
			$js .= "tabSize:'$this->tabSize',";
		}
		if($this->tabNode){
			$js .= "tabNode:'$this->tabNode',";
		}
		if($this->emotionPath){
			$js .= "emotionPath:'$this->emotionPath',";
		}
		if($this->toolbars){
			$js .= "toolbars:[
	                    [$this->toolbars]
	                ],";	
		}
		$js .= "});";
        $js .= "editor.render('$this->getId');";
			  
		return $js;
	}

	/**
	* Run the widget
	*/
	public function run()
	{
			
		parent::run();
	}
}
