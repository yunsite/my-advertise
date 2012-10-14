<?php
class sidebarWidget extends CWidget
{
	public $view;
	
	public function viewSelect()
	{
		if (!isset($this->view))
		{
			if ($this->controller->id == 'archiver' && $this->controller->action->id == 'index')
				$this->view = 'main';
			elseif ($this->controller->id == 'archiver' && $this->controller->action->id == 'profile')
				$this->view = 'profile';			
		}		
	}
	
	public function getData()
	{
		$view = $this->view;
		
		$data = array();
		
		
		switch ($view)
		{
			case $view == 'adlist':
				$data = Advertisement::model()->getAdvertisements();
				break;
			case $view == 'channel':
				foreach (Channel::model()->generateChannelList() as $channel => $v){
					$data[] = Channel::model()->getChannels(0, $channel);
				}
				break;
			case $view == 'message':
				$data = Advertisement::model()->getValidateAdvertisements(4);
				break;
			case $view == 'register':
				$data = User::model()->findAll(array(
					'order'=>'lastlogin DESC',
					'limit'=>10
				));
				break;
            case $view == 'adrelated':
                $_model = Advertisement::model()->getAdvertisementModel($_GET['id']);
                $data = Advertisement::model()->findAll(array(
                    'condition'=>'cid = :cid',
                    'order'=>'id DESC',
                    'limit'=>10,
                    'params'=>array(
                        ':cid'=>$_model->cid
                    )
                ));
                unset($_model);
                break;
            case $view = 'infolist':
                $_model = Advertisement::model()->getAdvertisementModel($_GET['id']);
                $data = Advertisement::model()->findAll(array(
                    'condition'=>'uid = :uid',
                    'order'=>'id DESC',
                    'limit'=>10,
                    'params'=>array(
                        ':uid'=>$_model->uid
                    )
                ));
                unset($_model);
                break;
				
		}
		
		return $data;
	}
	
	public function run()
	{	
		$this->viewSelect();
		$this->render($this->view,array(
			'model' => self::getData()
		));
	}
}
?>