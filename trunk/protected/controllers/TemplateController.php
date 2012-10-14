<?php

class TemplateController extends Controller
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
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','form','sorttype','template'),
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
	   $result = array();
       
	   $model = $this->loadModel($id);
       
       $result['html'] = $model->code;
       
       UtilHelper::writeToFile($model->code);
       
       $result['css'] = UtilLabel::getTemplateClass($model->code);
       
       UtilHelper::writeToFile($result,'a+');
       
       echo json_encode($result);      
       

	}
    
    public function actionTemplate($id)
    {
        $this->layout = '//layouts/blank';
        
        $model = Template::model()->findAll(array(
            'condition'=>'sorttype=:sorttype',
            'params'=>array(
                ':sorttype'=>$id
            )
        ));
        
        $this->render('template',array(
            'model'=>$model
        ));
        
    }

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
	   $this->layout = '//layouts/blank';
       
 		$model=new Template;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['Template']))
		{
			$model->attributes=$_POST['Template'];
            
            UtilHelper::writeToFile($_POST);
            
            UtilHelper::writeToFile($model->attributes, 'a+');
            
			if($model->save())
            {
 //               $this->redirect(array('view','id'=>$model->id));
 
                echo "OK";
                
                Yii::app()->end();
            }				
            else
             {
                UtilHelper::writeToFile(CHtml::errorSummary($model));
                
                echo CHtml::errorSummary($model);
                
                Yii::app()->end();
             }   
		}

		$this->render('create',array(
			'model'=>$model,
		));   
	}
    
    public function actionSortType($id)
    {
        $id = intval($id);       
        
        $this->render('sorttype',array(
            'data'=>Template::model()->getDataTemplate($id)
        ));
    }
    
    public function actionForm()
    {
        $this->layout = '//layouts/basic';
 		$model=new Template;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['Template']))
		{
			$model->attributes=$_POST['Template'];
            
            UtilHelper::writeToFile($_POST);
            
            UtilHelper::writeToFile($model->attributes, 'a+');
            
			if($model->save())
            {
 //               $this->redirect(array('view','id'=>$model->id));
 
                echo "OK";
                
                Yii::app()->end();
            }				
            else
             {
                UtilHelper::writeToFile(CHtml::errorSummary($model));
                
                echo CHtml::errorSummary($model);
                
                Yii::app()->end();
             }   
		}

		$this->render('form',array(
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
		// $this->performAjaxValidation($model);

		if(isset($_POST['Template']))
		{
			$model->attributes=$_POST['Template'];
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
	   $this->layout = '//layouts/basic';
       
		$dataProvider=new CActiveDataProvider('Template');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Template('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Template']))
			$model->attributes=$_GET['Template'];

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
		$model=Template::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='template-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
