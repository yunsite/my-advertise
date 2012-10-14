<?php
class PreNextWidget extends CWidget
{
	
	public $view = 'prenext';
    public $linkview = 'view';
	public $id;
	public $length = 10;
	
	public function getData()
	{
		$result = array();
		
		$result['preview'] = Advertisement::model()->getPreviewAdvertisementt($this->id);
		$result['next'] = Advertisement::model()->getNextAdvertisementt($this->id);
		
		return $result;
	}

	
	public function run()
	{
		$this->render($this->view,$this->getData());
	}
}