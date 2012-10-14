<?php

class InfoController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/profile';
    

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			array('COutputCache + view', 'cacheID'=>'advertisement_view','duration'=>120, 'varyByParam'=>array('id'))
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
				'actions'=>array('index', 'view', 'infolist', 'infoimg', 'list', 'infoimgpage', 
								'channel', 'test', 'search', 'updateonlineinfo', 'visitstart',
								'visitend', 'rss', 'xview'
							),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','statistics','adminsearch'),
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
	    $this->layout = '//layouts/infoad';	
		
		$model = $this->loadModel($id);
        
        $comment = new Comment;
		
		try 
		{		

			$model->online++;
			$model->save();		
			
		}
		catch (Exception $e ) 
		{
			echo $e->getFile().$e->getLine().$e->getMessage();	

		}      
        
		
		$this->render('viewad',array(
			'model'=>$model,
            'comment'=>$comment,
		));
	}
	
    /**
     * 此方法用于ajax Pop层显示
     */
	public function actionXview($id)
	{	
			
		$this->layout = '//layouts/basic';
		
		$model = $this->loadModel($id);
		
		try 
		{		

			$model->online++;
			$model->save();		
			
		}
		catch (Exception $e ) 
		{
			echo $e->getFile().$e->getLine().$e->getMessage();	

		}
		
		$this->render('xview',array(
			'model'=>$model
		));
	}
	
	public function actionStatistics()
	{
		$this->layout = '//layouts/blank';
		
		$this->render('statistics');
	}
	
	public function actionRss()
	{
		Yii::app()->clientScript->registerLinkTag(
			'alternate',
			'application/rss+xml',
			$this->createUrl('info/6')
		);
		
		require_once 'Zend/Feed.php';
		require_once 'Zend/Feed/Atom.php';
		
		$model = Yii::app()->cache->get($this->getUrlId());
		
		if ($model === false) {
			
			$criteria = Advertisement::model()->setFetchCondition(20);
			
			$model = Advertisement::model()->findAll($criteria);
			
			Yii::app()->cache->set($this->getUrlId(), $model, 36000, new CDbCacheDependency("SELECT MAX(id) FROM {{advertisement}}"));
		}
		
		
		$entries = array();
		
		foreach ($model as $post)
		{
			$entries[] = array(
				'title'=>$post->title,
				'link'=>$this->createUrl('info/view', array('id'=>$post->id)),
				'description'=>UtilHelper::strSlice($post->content, 0 , 1000),
				'lastUpdate'=>$post->create
			);
		}
		
		$feed = Zend_Feed::importArray(array(
			'title'=>'悦珂广告栏',
			'link'	=> $this->createUrl(''),
			'charset'=>'UTF-8',
			'entries'	=> $entries
		));
		
		$feed->send();
		
	}
	
	/**
	 * 访问开始时异步提交相关访问数据
	 * Enter description here ...
	 */
	public function actionVisitStart()
	{
		
		$id = $_GET['id'];
		$refer = $_GET['refer'];
		Statistics::model()->VisitStart($id, $refer);
	}
	
	/**
	 * 访问结束时更新相关数据
	 * Enter description here ...
	 */
	public function actionVisitEnd()
	{
		UtilHelper::writeToFile($_GET);
		
		$id = $_GET['id'];
		$aid = $_GET['aid'];
		
		$model = $this->loadModel($aid);
		
		try 
		{		

			$model->online--;
			
			if($model->save())
			{
				echo "YES";
			}		
			else 
			{
				UtilHelper::writeToFile(CHtml::errorSummary($model), 'a+');
			}
			
		}
		catch (Exception $e ) 
		{
			echo $e->getFile().$e->getLine().$e->getMessage();	
		}		

		Statistics::model()->VisitEnd($id);
	}
	


	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Advertisement;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Advertisement']))
		{
			$model->attributes=$_POST['Advertisement'];
			
			$model->start = strtotime($model->start);
			$model->end = strtotime($model->end);
			
		
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
			else 
				UtilHelper::writeToFile(CHtml::errorSummary($model),'./public/test2.txt');
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

		if(isset($_POST['Advertisement']))
		{
			$model->attributes=$_POST['Advertisement'];
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
		
		$this->layout = '//layouts/infolist';
	
		$page = isset($_GET['page'])?$_GET['page']:0;
		
		$criteria = new CDbCriteria(array(
//			'condition'=>'uid = :uid',
			'order' => 'id DESC',

		));
		
//		if (isset($_GET['id']))
//			$criteria->addCondition('type = '.$type);
		
		$total = Channel::model()->count($criteria);
		
		$pages = new CPagination($total);
		$pages->pageSize = 10;
		$pages->applyLimit($criteria);	
		
		
		$model = Yii::app()->cache->get($this->getUrlId().'_'.$page);
		if ($model === false)
		{
			$model = Advertisement::model()->findAll($criteria);
			Yii::app()->cache->set($this->getUrlId().'_'.$page, $model, 3600, new CDbCacheDependency('SELECT MAX(id) FROM {{advertisement}}'));
		}
		
		
		$this->render('index',array(
			'model'=>$model,
			'pages'=>$pages
		));

	}
	
	public function actionSearch($keyword)
	{
	
		$this->layout = '//layouts/column1';
		

//		$keyword = urldecode($keyword);
		
//		echo urlencode($keyword);
			
		$criteria = Advertisement::model()->setFetchCondition();
		
		$criteria->addSearchCondition('title', $keyword, true, 'OR');
		$criteria->addSearchCondition('content', $keyword, true, 'OR');
		
		$total = Advertisement::model()->count($criteria);
		
		$pages = new CPagination($total);
		$pages->pageSize = 10;
		$pages->applyLimit($criteria);			
		
		$model = Advertisement::model()->findAll($criteria);

//		UtilHelper::dump($model);
		
		$this->render('search',array(
			'model'=>$model,
			'pages'=>$pages
		));			

	}
	
	/**
	 * 根据分类ID显示当前分类及子分类的所有相关信息
	 */
	public function actionList($id)
	{
	
		$this->layout = '//layouts/infolist';
		
		$page = isset($_GET['page'])?$_GET['page']:0;
		
		$ids = Channel::model()->getChildrenIds($id);
		
		$criteria = Advertisement::model()->setFetchCondition();
		
		$criteria->addInCondition('cid', $ids);
		
		$total = Advertisement::model()->count($criteria);
		
		$pages = new CPagination($total);
		$pages->pageSize = 10;
		$pages->applyLimit($criteria);			
		
		$model = Yii::app()->cache->get($this->getUrlId().'_'.$id.'_'.$page);
		if ($model === false)
		{
			$model = Advertisement::model()->findAll($criteria);
			Yii::app()->cache->set($this->getUrlId().'_'.$id.'_'.$page, $model, 3600, new CDbCacheDependency('SELECT MAX(id) FROM {{advertisement}}'));
		}
		
		$this->render('list',array(
			'model'=>$model,
			'pages'=>$pages
		));			
		
	}
	
	
	/**
	 * 显示当前未过期的文字信息
	 */
	public function actionInfoList()
	{
		$this->layout = '//layouts/blank';
		
		$page = isset($_GET['page'])?$_GET['page']:0;
		$offset = $page * 5;
		
		$criteria = Advertisement::model()->setFetchCondition(5);
		$criteria->offset= $offset;
		$criteria->limit = 5;
		
		$latestInfo = Yii::app()->cache->get($this->getUrlId().'_'.$offset);
				
		if ($latestInfo === false)
		{
			$latestInfo = Advertisement::model()->findAll($criteria);
			Yii::app()->cache->set($this->getUrlId().'_'.$offset, $latestInfo);
		}
		
		
		$this->render('infolist',array(
			'model'=>$latestInfo
		));
	}
	
	
	/**
	 * 显示当前未过期的图片信息
	 */
	public function actionInfoImg()
	{
		
		$this->layout = '//layouts/blank';
		
		$page = isset($_GET['page'])?$_GET['page']:1;
		$offset = ($page-1) * 4;
			
		$newInfo = Advertisement::model()->findAll(array(
			'condition'=>'hasimg = :hasimg',
			'order'=>'id DESC',
			'limit' => 4,
			'offset' => $offset,
			'params' => array(
				':hasimg'=>1
			)
		));
		
		$this->render('infoimg', array(
			'model'=>$newInfo
		));
	}
	
	public function actionChannel()
	{
		$client = new SoapClient($this->createUrl('/service/quote'));
		echo $client->getPrice('GOOGLE');
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$this->layout = '//layouts/blank';
		
        $model=new Advertisement('search');
        
        $criteria = new CDbCriteria(array(
            'condition'=>'',
            'order'=>'id DESC'
        ));
        
        $count = Advertisement::model()->count($criteria);
        
        $pagination = new CPagination($count);
        $pagination->setPageSize(15);
        $pagination->applyLimit($criteria);
        
        $dataProvider = Advertisement::model()->findAll($criteria);
        
        $this->render('admin', array(
            'model'=>$model,
            'dataProvider'=>$dataProvider,
            'pagination'=>$pagination
        ));   
	}
    
    public function actionAdminSearch()
    {
        $this->layout = '//layouts/blank';
        
		$model=new Advertisement('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Advertisement']))
			$model->attributes=$_GET['Advertisement'];
            
        $criteria = $model->search()->getCriteria();   
        $criteria->order = 'id DESC';
         
        $count = Advertisement::model()->count($criteria);
        
        $pagination = new CPagination($count);
        $pagination->setPageSize(15);
        $pagination->applyLimit($criteria);
        
        $dataProvider = Advertisement::model()->findAll($criteria);           
    

		$this->render('adminsearch',array(
			'dataProvider'=>$dataProvider,
            'pagination'=>$pagination
		));        
    }
    
    
	
	public function actionTest($id)
	{

		$content = readfile('http://www.highcharts.com/samples/data/jsonp.php?filename=large-dataset.json&callback=?');
		
		UtilHelper::dump(json_decode($content));
		
	}
	
	public function actionTest2()
	{
		require 'Zend/Search/Lucene.php';
		require 'Zend/Search/Lucene/Analysis/TokenFilter/StopWords.php';
		Yii::import('application.helpers.search.*');
		
		$str = "OK";
		
		
		
		$analyzer = new Phpbean_Lucene_Analyzer();
		
		$keywords = strtolower($str);
		

		
		$stopWords= array("a","an","at","the","and","or","is","am");
        $stopWordsFilter= new Zend_Search_Lucene_Analysis_TokenFilter_StopWords($stopWords);
        $analyzer= new Phpbean_Lucene_Analyzer();
        $cnStopWords= array("的");
        $analyzer->setCnStopWords($cnStopWords);
        $analyzer->addFilter($stopWordsFilter);
        $value="this is  a test二元分词是中文分词最简单的一种算法，就是把一个句子中相邻的两个字当作一个...就是读取数据库，然后分词建立二进制格式的索引保存在文件中";
        $analyzer->setInput($value,"utf-8");
        
        $position     =0;
        $tokenCounter=0;
         while (($token=$analyzer->nextToken()) !==null) {
            $tokenCounter++;
            $tokens[] =$token->getTermText();
            
            
            
            
         }         
         
        UtilHelper::dump($tokens);
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Advertisement::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='advertisement-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
