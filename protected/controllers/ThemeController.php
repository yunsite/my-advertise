<?php

class ThemeController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/clumn1';

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
				'actions'=>array('create','update','form','preview','templatedata','getscreenshot','uploadImage','avatar','getremoteimage'),
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
        $this->layout = '//layouts/column1';
       
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}
	
	public function actionTemplateData($id)
	{
        $id = intval($id);       
        
        $this->render('templatedata',array(
            'data'=>Template::model()->getDataTemplate($id)
        ));		
	}
    
    public function actionPreview()
    {
        $this->layout = '//layouts/basic';
        
        $this->render('preview');
    }
    
    public function actionGetScreenShot()
    {
        $this->layout = '//layouts/blank';
        
        $this->render('getscreenshot');
    }

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
	   $this->layout = '//layouts/column1';

 		$model=new Theme;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['Theme']))
		{
			$model->attributes=$_POST['Theme'];
            
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
              
    	$this->render('create',array('model'=>$model));
	}
    
    //剪切主题样式图片
	public function actionAvatar()
	{
	
		if (Yii::app()->request->isPostRequest)
		{	

			if (!intval($_POST['modelID']))
			{
				echo "请先上传或选择要剪切的头像图片";
				die();
			}	
		    	
		    $model = File::model()->findByPk($_POST['modelID']);
		    
    
//		    $data = UtilHelper::Test($profile->attributes);

		    
		    $src = File::model()->generateFileName($model, 'adtheme');
		    
			$desinfo =	array(
				'path'=>File::model()->generateFileName($model, 'adtheme', true, 120),
				'width'=>120,
				'height'=>120				
			);			
			
			$x = $_POST['x'];
			$y = $_POST['y'];
			$w = $_POST['w'];
			$h = $_POST['h'];
			
			$t = new UtilThumbHandle($src);
				
			$width = $t->getSrcImgWidth();
				
			$scale = $width/650;
				
			$x = round($scale*$x);
			$y = round($scale*$y);
			$w = round($scale*$w);
			$h = round($scale*$h);
				
			$t->createImg($desinfo, $x, $y, $w, $h);	

			$des_120 = File::model()->generateFileName($model, 'adtheme', false, 120);

            echo $des_120;
			
	 		die();		    
		}
		else 
		{
			UtilHelper::commonWord();
		}
	}    

    
    public function actionForm()
    {
        $this->layout = '//layouts/basic';
        
 		$model=new Theme;

		// Uncomment the following line if AJAX validation is needed
	    $this->performAjaxValidation($model);

		if(isset($_POST['Theme']))
		{
			$model->attributes=$_POST['Theme'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('form',array(
			'model'=>$model,
		));       
    }
    
    /**
     * 上传主题图片
     */
     public function actionUploadImage()
     {
        $this->layout = '//layouts/blank';
        
        $this->render('uploadimage');
     }
     
     public function actionGetRemoteImage()
     {
        $url = isset($_POST['url'])?$_POST['url']:die('图片地址不正确~');
        
        $info = UtilHelper::resourceLocalize($url);
        
//        UtilHelper::dump($info);
        
        $model = new File();
        $model->name = $info['filename'];
        $model->ext = $info['extension'];
        $model->created = time();
        $model->size = $info['size'];
        $model->pid = Lookup::model()->getUserAdThemeAlbum(Yii::app()->user->id)->id;
        $model->mime = File::model()->getMimeType($model->ext,$info['mime']);
        
        $src = './public/favorite/'.$model->name.'.'.$model->ext;
        $target = File::model()->generateFileName($model,'adtheme',true);
        
//        UtilHelper::dump($model->attributes); 

        if($model->save())
        {
            UtilFile::moveFile($src,$target);
            
            $result = array(
                'id'=>$model->id,
                'path'=>File::model()->generateFileName($model,'adtheme',false)
            );
            
            echo json_encode($result);
        }
     }

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
	    $this->layout = '//layouts/column1';
       
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Theme']))
		{
			$model->attributes=$_POST['Theme'];
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
	   $this->layout = '//layouts/blog';
       
		$dataProvider=new CActiveDataProvider('Theme');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Theme('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Theme']))
			$model->attributes=$_GET['Theme'];

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
		$model=Theme::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='theme-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
