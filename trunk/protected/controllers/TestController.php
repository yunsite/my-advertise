<?php
class TestController extends CController
{
	public $layout = '//layouts/main';
	
	
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
				'actions'=>array('index','view','online','demo','tabsliding','zip','icos'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
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
	
	public function actionIndex()
	{
	   
       $this->layout = '//layouts/basic';     
     
       
        $this->render('index');
	}
	
	public function actionIcos()
	{
		$this->render('icos');
	}
	
	public function actionTabSliding()
	{		
		$this->render('tabsliding');
	}
	
	
	public function actionDemo()
	{
		$headers = get_headers('http://www.liangshan-online.com/public/uploadfiles/86991333899060.gif', 1);
		
		UtilHelper::dump($headers);
		
		UtilHelper::dump(date('Y-m-d H:i:s',strtotime($headers['Last-Modified'])));
		
		$this->render('demo');
	}
	
	public function actionZip()
	{
		Yii::import('application.helpers.vendors.zip.clsTbsZip');
		
		$zip = new clsTbsZip();
		
		/**create**/
		
//		$zip->CreateNew();
//		
//		$zip->FileAdd('sub/test2.txt', './public/test2.txt',TBSZIP_FILE);
//		
//		$zip->Flush(TBSZIP_FILE, './public/zip/test.zip');
		
		$zipfile = './public/zip/test.zip';
		$tmpfile = './public/zip/tmp.zip';
		
		$zip->Open($zipfile);
		
//		echo $zip->FileExists('test2.txt');

		if (!$zip->FileExists('test.txt')){
			$zip->FileAdd('test.txt', './public/test.txt', TBSZIP_FILE);
		}

			
		if (!$zip->FileExists('pclzip-2-8.zip')){
			$zip->FileAdd('pclzip-2-8.zip', './public/zip/pclzip-2-8.zip',TBSZIP_FILE);
		}
		
		

//		$zip->FileAdd('hello.jpg', './public/uploadfiles/82671333902992.jpg', TBSZIP_FILE);
		
		echo $zip->FileRead('pclzip-2-8.zip');

//		$zip->Flush(TBSZIP_DOWNLOAD, 'download.zip');

//		echo $zip->FileRead('test.txt');

//		foreach ($zip->CdFileLst as $file)
//		{
//			UtilHelper::dump($zip->FileRead($file['v_name']));
//		}

		


		
		$zip->Flush(TBSZIP_FILE, $tmpfile);
		
//		$zip->Flush(TBSZIP_DOWNLOAD, 'download.zip', 'application/zip');
		
		$zip->close();
		
//		if (file_exists($zipfile)){
//			unlink($zipfile);
//			
//			copy($tmpfile, $zipfile);
//			
//			unlink($tmpfile);
//		}
		
	}
}