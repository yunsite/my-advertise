<?php

class SiteController extends Controller
{
	public $layout='//layouts/column2';
	
	public function __construct($id,$module)
	{
		parent::__construct($id,$module);
		
	}
	
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,

//				'transparent'=>true, //显示为透明，当关闭该选项时，才显示背景颜色
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		
		$criteria = Advertisement::model()->setFetchCondition(5);
		
		$latestInfo = Yii::app()->cache->get($this->getUrlId().'_latestInfo');
		
		if ($latestInfo === false)
		{
			$latestInfo = Advertisement::model()->findAll($criteria);

			Yii::app()->cache->set($this->getUrlId().'_latestInfo', $latestInfo, 3600, new CDbCacheDependency("SELECT MAX(id) FROM {{advertisement}}"));
		}
		
		$criteria->addColumnCondition(array('hasimg'=>1));
		$criteria->limit = 4;
		
		
		$newInfo = Yii::app()->cache->get($this->getUrlId().'_newInfo');
		
		if ($newInfo === false)
		{
			$newInfo = Advertisement::model()->findAll($criteria);

			Yii::app()->cache->set($this->getUrlId().'_newInfo', $newInfo, 3600, new CDbCacheDependency("SELECT MAX(id) FROM {{advertisement}}"));
		}		
//		$newInfo = Advertisement::model()->findAll($criteria);
		
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('index',array(
			'latestInfo'=>$latestInfo,
			'newInfo'=>$newInfo
		));
	}
	
	/**
	 * This is the action to visit the google map
	 */
	public function actionMap()
	{
		$this->render('map');
	}
	

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
	    if($error=Yii::app()->errorHandler->error)
	    {
	    	if(Yii::app()->request->isAjaxRequest)
	    		echo $error['message'];
	    	else
	        	$this->render('error', $error);
	    }
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$this->layout = '//layouts/site';
		
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				
				UtilHelper::writeToFile($model, 'a+');
				UtilMail::sendMail($model->email, $model->subject, $model->body);
				
//				$headers="From: {$model->email}\r\nReply-To: {$model->email}";
//				mail(Yii::app()->params['adminEmail'],$model->subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}
	
	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$this->layout = '//layouts/site';
		
		if (!Yii::app()->user->isGuest)
			$this->redirect($this->createUrl('/archiver/index', array('name'=>Yii::app()->user->name,'uid'=>Yii::app()->user->id)));
		
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
		
		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
			{	
				Yii::app()->session['loginIp'] = UtilNet::getClientIp();				
				if(isset($_GET['referer']))
				    $this->redirect($_GET['referer']);
                else
                    $this->redirect(array('/archiver/index','uid'=>Yii::app()->user->id,'name'=>Yii::app()->user->name));
			}
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}
	
	/**
	 * 检查登录状态
	 */
	public function actionCheckLoginState()
	{
		$username = $_GET['username'];	
		
		$string = 's:'.strlen($username).':"'.$username.'"';
		
		
		$criteria = new CDbCriteria();
		$criteria->addSearchCondition('data', $string);
		
		$model = Sessions::model()->find($criteria);
		
		
		
		if ($model)
		{
			$session = UtilSession::parseSession(Yii::app()->session->readSession($model->id));
			
			$ip = $session['loginIp'];
			
//			$ip = '125.68.51.203';		
			
			$region = UtilNet::getIPLoc($ip);		
			
			$result = array(
				'id'=>$model->id,
				'msg'=>"<b>检测到您的帐号当前已经在".$region->province.'.'.$region->city.'.'.$region->district."登录</b><br />是否要注销,重新登录"
			);
			
			echo json_encode($result);
		}
		else 
		{
			$result = array(
				'msg'=>'false'
			);
			
			echo json_encode($result);
		}
			
	}
	
	public function actionLoginAjax()
	{
		$this->layout = '//layouts/blank';
		
		if (!Yii::app()->user->isGuest)
			$this->redirect($this->createUrl('/archiver/index', array('name'=>Yii::app()->user->name,'uid'=>Yii::app()->user->id)));
		
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->request->getUrlReferrer());
		}
		// display the login form
		$this->render('loginajax',array('model'=>$model));		
	}
	
	public function actionRegister()
	{
		$this->layout = '//layouts/site';
	
		
	    $model=new RegisterForm;	    

	    // uncomment the following code to enable ajax-based validation
	   
	    if(isset($_POST['ajax']) && $_POST['ajax']==='register-form')
	    {
	        echo CActiveForm::validate($model);
	        Yii::app()->end();
	    }
	   
	
	    if(isset($_POST['RegisterForm']))
	    {
	        $model->attributes=$_POST['RegisterForm'];
	        
//	        UtilHelper::dump($model->attributes);
	        
	        
	        if($model->validate() && $model->register())
	        {
	        	Yii::app()->user->setFlash('register','你是本站的第'.User::model()->count().'位悦珂人');
				$this->refresh();
	            // form inputs are valid, do something here
//	            return;
	        }
	        else 
	        {
	        	UtilHelper::writeToFile(CHtml::errorSummary($model), 'a+');
	        }
	    }         
	    	
		$this->render('register',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
	
	/**
	 * 强制注销用户0mk
	 * Enter description here ...
	 */
	public function actionForceLogout($id)
	{
		if (Yii::app()->session->destroySession($id))
		{
			echo 'true';
		}	
		else
		{
			echo "false";
		}
	}
	
	public function actionChangeAcount()
	{
		Yii::app()->user->logout();
		
		$this->redirect(array('site/login'));
	}
	
	/**
	 * 此方法用于显示错误提示
	 * Enter description here ...
	 */
	public function actionMention()
	{
		$this->layout = '/layouts/main';
		
		$model = Region::model()->getUserArea();
		
		$link = Yii::app()->request->getUrlReferrer();
//		$link = $this->createUrl('/site/index',array('area'=>$model->short,'id'=>$model->id));
		
		$this->render('mention',array(
			'link'=>$link
		));
	}
	
	/**
	 * Test action
	 * 
	 * 
	 *      [username] => lianzhan
            [password] => lianzhan
            [repassword] => lianzhan
            [email] => lianzhan@163.com
            [firstname] => 连战
            [lastname] => 兄弟
            [birth] => 11/17/1964
            [gender] => 0
            [region] => 2492-2695-2701-
            [agree] => 1
            [verifyCode] => bbuupa
	 */
	public function actionTest()
	{
		$this->layout = '//layouts/main';
		
		$user = User::model()->find(array('order'=>'id DESC'));
		
//		UtilHelper::dump($user->profiles->attributes);
		
		$region = $user->profiles->province.'-'.$user->profiles->manicipal.'-'.$user->profiles->county.'-';
		
		Region::model()->addForerunner($user, $region);
		
		

	}
	
}


?>