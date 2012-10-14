<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column1';
	
	private $urlId;
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
	
	public function __construct($id,$module)
	{
		parent::__construct($id,$module);
				
		$cookie = Yii::app()->getRequest()->getCookies();
		
		if (!Yii::app()->user->isGuest)  
		{
			if (!isset($cookie['online']))
			{
				// 设置cookie信息
				$cookies = new CHttpCookie('online', Yii::app()->user->name);
				$cookies->expire = time() + 60*60*24*1;
				Yii::app()->request->cookies['online'] = $cookies;					
			}
		
		}
		else 
		{
			if (isset($cookie['online']))
				unset($cookie['online']);
		}

		
	}
	
	
	public function beforeAction($action)
	{
		//获取当前URI
		$urlId = $this->getUrlId();		
		
		$auth = Yii::app()->authManager;
		
		if (!$auth->getAuthItem($urlId))
			$auth->createOperation($urlId);
		
		
		if (!Yii::app()->user->isGuest)
		{
			if (!$auth->checkAccess($urlId,Yii::app()->user->id))
			{
				throw new CHttpException(403,'你无权访问该页.');
			} 

			
		}
		
		return true;
	}
	
	/**
	 * 设置URLID
	 * @param unknown_type $string
	 */
	public function setUrlId($string)
	{
		$this->urlId = $string;
	}
	
	/**
	 * 获取URLID
	 */
	public function getUrlId()
	{	
		if ($this->urlId == null)
			$this->setUrlId(ucfirst($this->module->id).ucfirst($this->id).ucfirst($this->action->id));			
	
		return $this->urlId;
	}
	

}