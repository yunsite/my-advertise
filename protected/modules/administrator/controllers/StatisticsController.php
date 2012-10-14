<?php

class StatisticsController extends Controller
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
				'actions'=>array('create','update','online','onlinedata','agent','platform','rewriteregion','region','regioncountry','regionprovince','register','space',),
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
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}


	//当前在线人数统计
	public function actionOnlineData()
	{
		echo Statistics::model()->onlineStatistics();
	}
	
	public function actionOnline()
	{
		$this->render('online');
	}
	
	/**
	 * 统计浏览器使用情况
	 * 
	 * 注：此处使用的数据重复性太大，在实际应用时要考虑去除重复数据
	 */	
	public function actionAgent()
	{
		$this->layout = '//layouts/blank';
		
		$data = Statistics::model()->agentStatistics();
		
//		UtilHelper::dump($data);

		$count = Statistics::model()->count();
		
		$agent = array();
		
		foreach ($data['Agent'] as $key=>$value)
		{
			$agent[]=array($key, (array_sum($value)/$count)*100);
		}
		
		
//		UtilHelper::dump($agent);
		
		$this->render('agent',array(
			'agent'=>$agent
		));
	}
	
	/**Platform**/
	public function actionPlatform()
	{
		$this->layout = '//layouts/blank';
		
		$data = Statistics::model()->agentStatistics();
		
		$count = Statistics::model()->count();
		
		$platform = array();
		
		foreach ($data['Platform'] as $key=>$value)
		{
			$platform[]=array($key, ($value/$count)*100);
		}
		
		$this->render('platform',array(
			'platform'=>$platform
		));		
	}
	
	/**
	 * 重写获取统计用户所在地区数据
	 * 
	 * 注：由于使用网络数据库，而获取相关数据花费时间太长，所以先把每次访问时的数据写入一个单独的文件，使用本地文件读取相关数据
	 */
	public function actionRewriteRegion()
	{
		set_time_limit(0);
		ignore_user_abort(true);
				
		$file = Yii::app()->params->visitIpPath;
		
		$fp = fopen($file, 'w+');
		
		$model = Comments::model()->findAll();
				
		foreach ($model as $data)
		{
			$local = UtilNet::getIPLoc($data->comment_author_IP);
			
			fwrite($fp, $local->country."\t".$local->province."\t".$local->city."\r\n");
				
//			UtilHelper::dump($local);
//			$province = $local->province;
///			$city = $local->city;
				
//			echo $province.$city;			
		}
		
		fclose($fp);
		

			
//		$provinceModel = Region::model()->getProvinceByName($province);
			
//		UtilHelper::dump($provinceModel);
			
//		$cityModel = Region::model()->getManicipalByName($city, $provinceModel->id);
	}
	
	/**
	 * 统计访问者所在国家
	 * Enter description here ...
	 */
	public function actionRegionCountry()
	{

		$result = Statistics::model()->getAllRegionInfo();
		
		foreach ($result['Country'] as $key=>$value)
		{
			$pie[] = array(
				'name'=>$key,
				'y'=>($value/Comments::model()->count())*100
			);
			
		}
		
		$this->render('regioncountry',array(
			'pie'=>$pie,
			'columns'=>$result['Country']
		));			
		
	}
	
	/**
	 * 统计访问者所在中国省份
	 * 
	 */
	public function actionRegionProvince()
	{

		$result = Statistics::model()->getAllRegionInfo();
		
		$i = 0;
		foreach ($result['Region'] as $key=>$value)
		{
			$province[$key] = array_sum($value);
			
			$data[] = array(
				'y'=>array_sum($value),
				'drilldown'=>array(
					'color'=>'js:colors['.$i.']',
					'name'=>$key,
					'categories'=>array_keys($value),
					'data'=>array_values($value)
				)
			);
			
			$i++;
			
		}
		
		
		$this->render('regionprovince',array(
			'categories'=>CJavaScript::encode(array_keys($province)),
			'data'=>CJavaScript::encode($data)
		));		
	
	}
	
	public function actionRegister()
	{
		$result = array();
		
		$model = Statistics::model()->getRegisterInfo();
		
		foreach ($model as $data)
		{
			$year = date('Y', $data->created);
			
			if (!$result[$year])
				$result[$year] = array_fill(0, 12, 0);				
			
			$month = date('n', $data->created) - 1;
			
			$result[$year][$month] += 1;
		}
		
		$i = 0;
		foreach ($result as $key=>$value)
		{
			$return[$i]['name'] = strval($key);
			$return[$i]['data'] = $value;
			$i++;
		}
		
		$this->render('register', array(
			'data'=>$return
		));
	}

	public function actionSpace()
	{
		$data = array();

		$result = Statistics::model()->getSPaceInfo();
		
		$all = Yii::app()->params->fullSpace;
		
		$data= array(
			array('System',($result['system']/$all)*100),
			array('Upload',($result['upload']/$all)*100),
			array('Free',($result['free']/$all)*100)
		);
		
		$column = array(
			array('System',$result['system']),
			array('Upload',$result['upload']),
			array('Free',$result['free'])		
		);
		
		$this->render('space',array(
			'data'=>$data,
			'column'=>$column
		));
		

	}
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Statistics;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Statistics']))
		{
			$model->attributes=$_POST['Statistics'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
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
		// $this->performAjaxValidation($model);

		if(isset($_POST['Statistics']))
		{
			$model->attributes=$_POST['Statistics'];
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
		$dataProvider=new CActiveDataProvider('Statistics');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Statistics('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Statistics']))
			$model->attributes=$_GET['Statistics'];

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
		$model=Statistics::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='statistics-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
