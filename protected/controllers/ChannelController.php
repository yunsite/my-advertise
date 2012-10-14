<?php

class ChannelController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/channel';

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
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','channel','getparents'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','batchcreate','update','channelinfo'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->layout = '//layouts/blank';
		
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}
	
	public function actionChannelInfo()
	{
		$pid = $_GET['id'];
		$type = $_GET['type'];
		if (isset($pid) && isset($type))		
			echo Channel::model()->generateChannelLinks($pid,$type, array('/channel/channelinfo','type'=>$type), array('onclick'=>'chooseChannel($(this));return false;','class'=>'button'));
	}

	public function actionChannel()
	{
		
		$this->layout = '//layouts/blank';
		
		$type = isset($_GET['id'])?$_GET['id']:Channel::CHANNEL_MARKET;
		
		$criteria = new CDbCriteria(array(
			'condition'=>'type = :type',
			'params' => array(
				':type' => $type
			)
		));
		
		$total = Channel::model()->count($criteria);
		
		$pages = new CPagination($total);
		$pages->pageSize = 27;
		$pages->applyLimit($criteria);	
		
		
		$model = Channel::model()->findAll($criteria);
		
		$this->render('channel',array(
			'model'=>$model,
			'pages'=>$pages
		));
				
	}
	
	public function actionGetParents()
	{
		$result = array();
		$result[0] = '无';
		
		$type = $_GET['type'];
		
		if (isset($type))
		{
			$channel = Channel::model()->findAll(array(
				'condition'=>'type = :type',
				'params'=>array(
					':type'=>$type
				)
			));
			
			foreach ($channel as $item)
			{
				$result[$item->id] = $item->name;
			}
			
		}
		
		UtilHelper::dump($result);
	}
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		
		
		$this->layout = '//layouts/blank';
		
		$model=new Channel;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['Channel']))
		{
			$model->attributes=$_POST['Channel'];
			if($model->save())
			{
				echo UtilHelper::formatRightAnswer('频道创建成功');
				die();
				
//				$this->redirect(array('view','id'=>$model->id));
			}
			else 
			{
				echo CHtml::errorSummary($model);
				die();
			}
				
			
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	public function actionBatchCreate()
	{
		$this->layout = '//layouts/blank';
		
		$this->render('batch');
	}
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Channel']))
		{
			$model->attributes=$_POST['Channel'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$this->layout = '//layouts/column1';
		
		$type = isset($_GET['id'])?$_GET['id']:Channel::CHANNEL_MARKET;
		
		$criteria = new CDbCriteria(array(
			'condition'=>'type = :type',
			'params' => array(
				':type' => $type
			)
		));
		
		$total = Channel::model()->count($criteria);
		
		$pages = new CPagination($total);
		$pages->pageSize = 27;
		$pages->applyLimit($criteria);	
		
		
		$model = Channel::model()->findAll($criteria);
		
		$this->render('index',array(
			'model'=>$model,
			'pages'=>$pages
		));
		
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		
		$this->layout = '//layouts/blank';
		
		$model=new Channel('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Channel']))
			$model->attributes=$_GET['Channel'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Channel::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='channel-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
