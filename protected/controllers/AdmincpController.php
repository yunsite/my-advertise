<?php

class AdmincpController extends Controller
{
	public $layout='//layouts/blank';
	
	public function actionIndex()
	{
		$this->layout='//layouts/admincp';
		
		$today = strtotime(date('y-m-d'));
		
		$criteria = new CDbCriteria(array(
			'condition'=>'moddate > :moddate',
			'order'=>'moddate DESC',
			'params'=>array(
				':moddate'=> $today
			)
		));
		
		$advertisement = new CActiveDataProvider('Advertisement',array(
		    'criteria'=>$criteria,
			'pagination'=>array(
				'pageSize'=>5
			)
		));
		
		$usercriteria = new CDbCriteria(array(
			'condition'=>'created > :createtime',
			'order'=>'created DESC',
			'params'=>array(
				':createtime'=>$today
			)
		));
		

		
		$user = new CActiveDataProvider('User',array(
		    'criteria'=>$usercriteria,
			'pagination'=>array(
				'pageSize'=>15
			)
		));
	
		$this->render('index',array(
			'advertisement'=>$advertisement,
			'user'=>$user
		));
	}
	
	

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
	
	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('index', 'region','member','channel','advertise','brand',
							'lookup','message','email','update','sysinfo','theme','statistics',
                            'lab','adminuser','admininfo','adminregion','adminjob','admintags',
                            'admincollege'
						),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
    
    public function actionLab()
    {        
        $this->render('lab');
    }
	
    public function actionStatistics()
    {
        $this->render('statistics');
    }
	/**
	 * 给特定的用户发送订阅邮件
	 */
	public function actionEmail()
	{
		$this->render('email');
	}
	
	/**
	 * 显示今日更新内容
	 */
	public function actionUpdate()
	{
		$criteria = new CDbCriteria(array(
			'condition'=>'moddate > :moddate',
			'order'=>'moddate DESC',
			'params'=>array(
				':moddate'=>strtotime(date('y-m-d'))
			)
		));
		
		$dataProvider=new CActiveDataProvider('Advertisement',array(
		    'criteria'=>$criteria
		));
		
		$this->render('update', array(
			'advertisement'=>$dataProvider
		));
	}
	
	public function actionMessage()
	{
		
		$this->render('message');
	}
	
	public function actionRegion()
	{
		$model=new Region('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Region']))
			$model->attributes=$_GET['Region'];

		$this->render('region',array(
			'model'=>$model,
		));

	}
	
	
	public function actionMember()
	{
		$model=new User('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['User']))
			$model->attributes=$_GET['User'];

		$this->render('member',array(
			'model'=>$model,
		));
	}
	
	/**
	 * Manages all models.
	 */
	public function actionChannel()
	{
		
		$model=new Channel('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Channel']))
			$model->attributes=$_GET['Channel'];

		$this->render('channel',array(
			'model'=>$model,
		));
	}
	
	/**
	 * 广告栏开启情况统计
	 */
	public function actionBrand()
	{
		$this->layout = '//layouts/blank';
		
		$model=new Region('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Region']))
			$model->attributes=$_GET['Region'];

		$criteria = new CDbCriteria(array(
			'condition'=>'forerunner IS NOT NULL',
			'group'=>'forerunner',
			'order'=>'id DESC'
		));
		
		$dataProvider=new CActiveDataProvider('Region',array(
		    'criteria'=>$criteria
		));
		
		$this->render('brand',array(
			'sort'=>$dataProvider,
			'model'=>$model,
		));
	}
	
	/**
	 * 站点所有的广告信息
	 */
	public function actionAdvertise()
	{
		$criteria = new CDbCriteria(array(
			'condition'=>'',
			'order'=>'id DESC'
		));
		
		$dataProvider=new CActiveDataProvider('Advertisement',array(
		    'criteria'=>$criteria
		));
		
		$this->render('advertise',array(
			'dataProvider'=>$dataProvider
		));
	}
	
	public function actionSysinfo()
	{
		$this->render('sysinfo');
	}
	
	public function actionLookUp()
	{
		$model=new Lookup('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Lookup']))
			$model->attributes=$_GET['Lookup'];

		$this->render('lookup',array(
			'model'=>$model,
		));
	}
	
	public function actionTheme()
	{
		$this->render('theme');
	}
    
    public function actionAdminUser()
    {

    }
    
    public function actionAdminUserSearch()
    {
        
    }
    
    public function actionAdminUserCard($id)
    {
        $model = User::model()->findByPk($id);
        
        $this->render('adminusercard',array(
            'model'=>$model
        ));
    }
    
    public function actionAdminInfo()
    {
        
    }
    
    public function actionAdminTags()
    {
        
    }
    
    public function actionAdminCollege()
    {
        
    }
    
    public function actionAdminJob()
    {
        
    }
    
    public function actionAdminRegion()
    {
        
    }
	
	public function actionLogin()
	{
		
		$this->layout = '//layouts/blank';
		
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
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

}