<?php
class NavigatorWidget extends CWidget
{
	public $controller = 'site';
	public $action = 'index';
	
	public function getView()
	{
		return $this->controller.'_'.$this->action;
	}
	
	public function run()
	{
		if ($this->getViewFile($this->getView()))
			$this->render($this->getView());
	}
}
?>