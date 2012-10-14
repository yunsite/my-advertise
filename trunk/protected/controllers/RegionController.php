<?php

class RegionController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/blank';

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
				'actions'=>array('index','view','regioninfo','regionhome'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','createregion','search'),
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
	 * 显示地区根目录
	 */
	public function actionRegionHome()
	{
		$model = Region::model()->findAll(array(
			'condition'=>'pid = :pid',
			'params'=>array(
				':pid'=>0
			)
		));

		$pinyin = new PinYin();

		foreach ($model as $item) {
			echo CHtml::link($item->region,array('/region/view','id'=>$item->id,'area'=>$pinyin->words2Short($item->region,1)),array('onclick'=>'uu.loadRegion($(this));return false;'));
		}
	}

	/**
	 * Displays a particular model.
	 * 如果查询没有子地区，则跳转到当前地区
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
	
		$model = $this->loadModel($id);
		
		UtilHelper::writeToFile($model->attributes);
		
		if($model->children == null)
		{
	
			
			//如果已有人开启了广告栏，则跳转到对应广告栏首页，否则就回到本地首页
			if ($model->forerunner)
			{
				// 设置cookie信息
				$cookies = new CHttpCookie('area', serialize($model->attributes));
				$cookies->expire = time() + 60*60*24*30;
				Yii::app()->request->cookies['area'] = $cookies;	

				$link = $this->createUrl('/site/index',array('area'=>Region::model()->getUserArea()->short,'id'=>$model->id));
			}
			else 
			{
				$link = $this->createUrl('/site/mention',array('region'=>$model->region));
			}
	
			
			
			echo 'fail_'.$link;

		}
		else 
		{
			$pinyin = new PinYin();
			
//			echo '<ul>';
			foreach ($model->children as $data)
			{
//				echo '<li>';
				echo CHtml::link($data->region, array('/region/view','id'=>$data->id,'area'=>$pinyin->words2Short($data->region,1)),array('onclick'=>'uu.loadRegion($(this));return false;'));
//				echo '</li>';
			}
//			echo '</ul>';	
		}		
	}
	
	public function actionInfo($id)
	{

		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));

	}
	
	public function actionRegionInfo($id)
	{
		echo Region::model()->generateRegionLinks($id, '/region/regioninfo',array('onclick'=>'eaddress($(this));return false;'),false);
	}
	
	public function actionCreateRegion()
	{
		if (Yii::app()->request->isPostRequest)
		{
			$model = new Region();
			
			$model->attributes = $_POST;
			$model->uid = Yii::app()->user->id;
			
			if ($model->save())
			{
				echo "ok";
			}
		}
		
		
		
		
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		
		$this->layout = '//layouts/blank';
		
		$model=new Region;
		

//		UtilHelper::dump($_REQUEST);

		// Uncomment the following line if AJAX validation is needed
//		$this->performAjaxValidation($model);

		if(isset($_POST['Region']))
		{
			$model->attributes=$_POST['Region'];
			
			if (isset($_POST['Region']['manicipal']) && !isset($_POST['Region']['county']))
				$model->pid = $_POST['Region']['manicipal'];
			elseif (isset($_POST['Region']['manicipal']) && isset($_POST['Region']['county']) && $_POST['Region']['areatype'] == Region::COUNTY)
				$model->pid = $_POST['Region']['manicipal'];
			elseif (isset($_POST['Region']['manicipal']) && isset($_POST['Region']['county']) && $_POST['Region']['areatype'] == Region::VILLAGE)
				$model->pid = $_POST['Region']['county'];
			
//			UtilHelper::dump($model->attributes);
//			
//			Yii::app()->end();

			if($model->save())
			{
				echo UtilHelper::formatRightAnswer('地区创建成功');
				die();
				
//				$this->redirect(array('view','id'=>$model->id));
			}
			else 
			{
				echo CHtml::errorSummary($model);
				die();
			}
//			if($model->save())
//				$this->redirect(array('info','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
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
		$this->performAjaxValidation($model);

		if(isset($_POST['Region']))
		{
			$model->attributes=$_POST['Region'];
			if($model->save())
				$this->redirect(array('info','id'=>$model->id));
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
		
		$dataProvider=new CActiveDataProvider('Region');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
		
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
	   
        $model=new Region('search');
        
        $criteria = new CDbCriteria(array(
            'condition'=>'',
            'order'=>'id DESC'
        ));
        
        $count = Region::model()->count($criteria);
        
        $pagination = new CPagination($count);
        $pagination->setPageSize(15);
        $pagination->applyLimit($criteria);
        
        $dataProvider = Region::model()->findAll($criteria);
        
        $this->render('admin', array(
            'model'=>$model,
            'dataProvider'=>$dataProvider,
            'pagination'=>$pagination
        ));             

	}
    
    public function actionSearch()
    {
		$model=new Region('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Region']))
			$model->attributes=$_GET['Region'];
        $criteria = $model->search()->getCriteria();   
         
        $count = Region::model()->count($criteria);
        
        $pagination = new CPagination($count);
        $pagination->setPageSize(15);
        $pagination->applyLimit($criteria);
        
        $dataProvider = Region::model()->findAll($criteria);           
    

		$this->render('search',array(
			'dataProvider'=>$dataProvider,
            'pagination'=>$pagination
		));        
    }

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Region::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='region-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function blankLayout()
	{
		$this->layout  = '//layouts/blank';
	}
}
