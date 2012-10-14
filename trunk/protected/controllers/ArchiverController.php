<?php

class ArchiverController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/archiver';
	
	function init(){
		if(isset($_POST['SESSION_ID'])){
			$session=Yii::app()->getSession();
			$session->close();
			$session->sessionID = $_POST['SESSION_ID'];
			$session->open();
		}
	}

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
				'actions'=>array('index','view','list','blog','hlist','profile','time','test2','test','todotest','basic','analysis','card','message','eaddress',),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','ctemplate','cconponent','release','erelease',
							'releasetemplate','trelease','test','updateprofile','myAds','ebasic',
							'favorite','ehomeaddress','updatefavorite','efavorite','private',
							'eprivate','authentication','eauthentication','eauthsecond','eprimary',
							'emiddelschool','ehighschool','euniversity','ejob','eauththird','avatar',
							'upload','checkupload','uploadavatar','avatarcrop','generateavatar',
							'setavatar','eauthfinish'
				),
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
	
	public function actionMessage()
	{		
		$this->layout = '//layouts/blank';
		
		$model = Advertisement::model()->getValidateAdvertisement();
		
		$this->render('message',array(
			'model'=>$model
		));
	}
    
    public function actionList()
    {
        $this->layout = '//layouts/blog';
        
        $this->render('list');


    }
    
    //隐藏显示
    public function actionHlist()
    {
        $this->layout = '//layouts/blank';
        
        $criteria = Advertisement::model()->setFetchCondition();
        
        $count = Advertisement::model()->count($criteria);
        
        $pagination = new CPagination($count);
        $pagination->setPageSize(15);
        $pagination->applyLimit($criteria);
        
        $dataProvider = Advertisement::model()->findAll($criteria);
        
        $this->render('hlist', array(
            'model'=>$model,
            'dataProvider'=>$dataProvider,
            'pagination'=>$pagination
        )); 
    }
    
    public function actionBlog($id)
    {
        $this->layout = '//layouts/blog';
        
		$model = Advertisement::model()->findByPk($id);
        
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
        
		
		$this->render('blog',array(
			'model'=>$model,
            'comment'=>$comment,
		));
    }
	
	public function actionToDoTest()
	{
	    //上传配置
	    $config = array(
	        "uploadPath"=>Yii::app()->params['uploadPath']['advertisement'], //"public/uploadfiles/",                          //保存路径
	        "fileType"=>array(".gif",".png",".jpg",".jpeg",".bmp"),   //文件允许格式
	        "fileSize"=>1000                                          //文件大小限制，单位KB
	    );
	    
	    //文件上传状态,当成功时返回SUCCESS，其余值将直接返回对应字符窜并显示在图片预览框，同时可以在前端页面通过回调函数获取对应字符窜
	    $state = "SUCCESS";
	
	    $title = htmlspecialchars($_POST['pictitle'], ENT_QUOTES);
	    $path  = $config['uploadPath'];
	    if(!file_exists($path)){
	        mkdir("$path", 0777);
	    }
	    //格式验证
	    $current_type = strtolower(strrchr($_FILES["picdata"]["name"], '.'));
	    if(!in_array($current_type, $config['fileType'])){
	        $state = "不支持的图片类型！";
	    }
	    //大小验证
	    $file_size = 1024 * $config['fileSize'];
	    if( $_FILES["picdata"]["size"] > $file_size ){
	        $state = "图片大小超出限制！";
	    }
	    //保存图片
	    if($state == "SUCCESS"){
	        $tmp_file=$_FILES["picdata"]["name"];
	        $file = $path.rand(1,10000).time().strrchr($tmp_file,'.');
	        
	        $info = pathinfo($_FILES['picdata']['name']);
	        
	        $model = new File();
			$model->pid = Lookup::model()->getUserAdvertisementAlbum(Yii::app()->user->id)->id;
			$model->size = $_FILES['picdata']['size'];
			$model->ext = strtolower($info['extension']);
			$model->name = $info['filename'];
			$model->created = time();
			$model->mime = File::model()->getMimeType($model->ext, $_FILES['picdata']['type']);
			
			UtilHelper::writeToFile($_FILES, './public/testd.txt','w+');
			UtilHelper::writeToFile(pathinfo($_FILES['picdata']['name']), './public/testd.txt','a+');
			
			UtilHelper::writeToFile($model->attributes);
						
			$file = File::model()->generateFileName($model, 'advertisement', true);
	        
	        UtilHelper::writeToFile($file, './public/testd.txt','a+');
	        
	        if($model->save())
	        {
	        	$result = move_uploaded_file($_FILES["picdata"]["tmp_name"],$file);
	        	if(!$result){
		            $state = "图片保存失败！";
		        }
	        }
	        else 
	        {
	        	$state = "数据保存失败！";
	        }
	        

	    }
	    //向浏览器返回数据json数据
	    $file= str_replace(array('../','./'),'',$file);  //为方便理解，替换掉所有类似../和./等相对路径标识
	    
	    $str = "{'url':'".$file."','title':'".$title."','state':'".$state."'}";
   
	    echo $str;
    
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
	
	public function actionCard()
	{
		$this->layout = '//layouts/blank';
		
		
		$model = User::model()->findByPk($_GET['id']);
		
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		
		$this->render('card',array(
			'model'=>$model
		));
	}
	
	public function actionTest()
	{
		$this->layout = "//layouts/basic";
		$this->render('test');
	}
	
	/**
	 * @todo 更新个人爱好相关信息
	 */
	public function actionUpdateFavorite()
	{
		$result = array();
	
		$id = Yii::app()->user->id;
		
		$model = self::loadProfileModel($id);	

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Profile']))
		{

			foreach ($_POST['Profile'] as $key=>$item)
			{
				if(strpos($item, '？') > 0)
				{
//					echo $key.'->'.strpos($item, '？');
					unset($_POST['Profile'][$key]);
					
					continue;
				}

				$new = explode(',', $_POST['Profile'][$key]);
				$old = explode(',', self::loadProfileModel($id)->$key);

//				
				$result[$key] = array(
					'type'=>Tag::model()->getTagTypeByCname($key),
					'add'=>array_diff($new, $old),
					'minus'=>array_diff($old, $new)
				);
				
			}
			
			Tag::model()->saveTag($result);
			
//			UtilHelper::dump($result);
			
//			if ($_POST['Profile']['favoriteStar'] == '')
//				unset($_POST['Profile']['favoriteStar']);
			
			$model->attributes=$_POST['Profile'];
			
//			UtilHelper::dump(Profile::model()->getProfileModel()->attributes);
//			UtilHelper::dump($_POST);
//			UtilHelper::dump($model->attributes);
//			die();
			
//			if($model->save())
//				$this->redirect(array('view','id'=>$model->id));
			if($model->save())
			{
				echo UtilHelper::formatRightAnswer('个人信息修改成功');
				die();
				
//				$this->redirect(array('view','id'=>$model->id));
			}
			else 
			{
				echo CHtml::errorSummary($model);
				die();
			}
		}		
	}
	
	
	public function actionUpdateProfile()
	{
		$id = Yii::app()->user->id;
		
		$model = self::loadProfileModel($id);	


		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Profile']))
		{
	
			$model->attributes=$_POST['Profile'];
			
			$address = explode('-',$model->addressdetail);

			$model->province = $address[0];
			$model->manicipal = $address[1];
			$model->county = $address[2];
			$model->village = $address[3];

			
			
			$homeaddress = explode('-', $model->homeaddressdetail);

			
			$model->homecounty = $homeaddress[0];
			$model->homemanicipal = $homeaddress[1];
			$model->homecounty = $homeaddress[2];
			$model->homevillage = $homeaddress[3];

			
			$birth = strtotime($_POST['Profile']['birth']);
			
			$model->birthday = date('d',$birth);
			$model->birthmonth = date('m',$birth);
			$model->birthyear = date('Y',$birth);
			
			
//			UtilHelper::dump(Profile::model()->getProfileModel()->attributes);
//			UtilHelper::dump($model->attributes);
			
			UtilHelper::writeToFile(array_merge($_POST,$model->attributes));
			
//			die();
			
//			if($model->save())
//				$this->redirect(array('view','id'=>$model->id));
			if($model->save())
			{
				echo UtilHelper::formatRightAnswer('个人信息修改成功');
				die();
				
//				$this->redirect(array('view','id'=>$model->id));
			}
			else 
			{
				echo CHtml::errorSummary($model);
				die();
			}
		}
	}


	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Profile;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Profile']))
		{
			$model->attributes=$_POST['Profile'];
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
	public function actionProfile()
	{
		$this->layout = '//layouts/profile';
		
		$id = isset($_GET['uid'])?$_GET['uid']:Yii::app()->user->id;
		$model = self::loadProfileModel($id);	


		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Profile']))
		{
			$model->attributes=$_POST['Profile'];
//			if($model->save())
//				$this->redirect(array('view','id'=>$model->id));
			if($model->save())
			{
				echo UtilHelper::formatRightAnswer('个人信息修改成功');
				die();
				
//				$this->redirect(array('view','id'=>$model->id));
			}
			else 
			{
				echo CHtml::errorSummary($model);
				die();
			}
		}

		$this->render('view',array(
			'model'=>$model,
		));
	}
	
	/**
	 * 此方法用于显示用户个人的基本资料
	 */
	public function actionBasic()
	{
		$this->layout = '//layouts/blank';
		
		$uid = isset($_GET['id'])?$_GET['uid']:Yii::app()->user->id;
			

		$model = self::loadProfileModel($uid);
		
		$this->render('basic',array(
			'model'=>$model,
		));
	}
	
	/**
	 * 此方法用于修改用户个人的基本资料
	 */
	public function actionEbasic()
	{
		$this->layout = '//layouts/blank';
		
		$model = self::loadProfileModel(Yii::app()->user->id);
		
		$this->performAjaxValidation($model);
		
		$this->render('ebasic',array(
			'model'=>$model
		));
		
		
	}
	/**
	 * 此方法用于显示用户的个人爱好相关资料
	 */
	public function actionFavorite()
	{
		$this->layout = '//layouts/blank';		
		
		$model = self::loadProfileModel(Yii::app()->user->id);
		
		$this->render('favorite',array(
			'model'=>$model,
		));
	}
	
	/**
	 * 此方法用于修改用户个人的基本资料
	 */
	public function actionEfavorite()
	{
		$this->layout = '//layouts/blank';
		
		$model = self::loadProfileModel(Yii::app()->user->id);
		
		$this->performAjaxValidation($model);
		
		$this->render('efavorite',array(
			'model'=>$model
		));
		
		
	}
	
	/**
	 * 此方法用于修改用户个人的基本资料
	 */
	public function actionEaddress()
	{
		$this->layout = '//layouts/blank';
		
		$model = self::loadProfileModel(Yii::app()->user->id);
		
		$this->performAjaxValidation($model);
		
		$this->render('eaddress',array(
			'model'=>$model
		));
		
		
	}
	/**
	 * 此方法用于修改用户个人的基本资料
	 */
	public function actionEhomeAddress()
	{
		$this->layout = '//layouts/blank';
		
		$model = self::loadProfileModel(Yii::app()->user->id);
		
		$this->performAjaxValidation($model);
		
		$this->render('ehomeaddress',array(
			'model'=>$model
		));
		
		
	}	
	
	/**
	 * 此方法用于修改用户个人的基本资料
	 */
	public function actionEprimary()
	{
		$this->layout = '//layouts/blank';
		
		$model = self::loadProfileModel(Yii::app()->user->id);
		
		$this->performAjaxValidation($model);
		
		$this->render('eprimary',array(
			'model'=>$model
		));
		
		
	}	
		
	/**
	 * 此方法用于修改用户个人的基本资料
	 */
	public function actionEmiddelschool()
	{
		$this->renderTemplate('emiddleschool');		
	}	
	
	/**
	 * 此方法用于修改用户个人的基本资料
	 */
	public function actionEhighSchool()
	{
		$this->renderTemplate('ehighschool');	
		
	}
	
	/**
	 * 此方法用于修改用户个人的基本资料
	 */
	public function actionEuniversity()
	{
		$this->renderTemplate('euniversity');	
		
	}
	
	public function actionEjob()
	{
		$this->renderTemplate('ejob');
	}
	
	/**
	 * 此方法用于显示用户个的私人资料
	 */
	public function actionPrivate()
	{
		$this->layout = '//layouts/blank';
		
		$model = self::loadProfileModel(Yii::app()->user->id);
		
		$this->render('private',array(
			'model'=>$model,
		));
	}
	/**
	 * 此方法用于修改用户个人的私人资料
	 */
	public function actionEprivate()
	{
		$this->layout = '//layouts/blank';
		
		$model = self::loadProfileModel(Yii::app()->user->id);
		
		$this->performAjaxValidation($model);
		
		$this->render('eprivate',array(
			'model'=>$model
		));
		
		
	}	
	
	/**
	 * 此方法用于修改用户的实名认证资料
	 */
	public function actionAuthentication()
	{
		$this->layout = '//layouts/blank';
		
		$model = self::loadProfileModel(Yii::app()->user->id);
		
		$this->render('authentication',array(
			'model'=>$model,
		));
	}
	/**
	 * 此方法用于修改用户个人的私人资料
	 */
	public function actionEauthentication()
	{
		$this->layout = '//layouts/blank';
		
		$model = self::loadProfileModel(Yii::app()->user->id);
		
		$this->performAjaxValidation($model);
		
		$this->render('eauthentication',array(
			'model'=>$model
		));
		
		
	}	
	
	public function actionEauthsecond()
	{
		$this->layout = '//layouts/blank';		
		
		$model = self::loadProfileModel(Yii::app()->user->id);
		
		$this->performAjaxValidation($model);
		
		$this->render('eauthsecond',array(
			'model'=>$model
		));	
	}
	
	public function actionEauththird()
	{
		$this->layout = '//layouts/blank';		
		
		$model = self::loadProfileModel(Yii::app()->user->id);
		
		$this->performAjaxValidation($model);
		
		$this->render('eauththird',array(
			'model'=>$model
		));		
	}	
	
	public function actionEauthFinish()
	{
	   $i = $all = 0;
       
		$this->layout = '//layouts/blank';
        
        $profile = Profile::model()->findByPk(Yii::app()->user->id);
        
        foreach($profile as $key=>$value){
            if($value == NULL) $i++;
           
            $all++;
        }
		$percent = ($i/$all)*100;
        

        
		$this->render('eauthfinish',array(
            'percent'=>$percent
        ));
		
	}
	
	
	public function actionUpload()
	{

		if(isset($_POST['PHPSESSID']))
        {
	        Yii::app()->session->close();
	        Yii::app()->session->sessionID = $_POST['PHPSESSID'];
	        Yii::app()->session->open();
        }
        
        if(Yii::app()->user->isGuest) throw new CHttpException(403,'bad');
        
		if (!empty($_FILES)) {
			
//			$_FILES['Filedata'] = array_map('strtolower', $_FILES['Filedata']);
			
//			UtilHelper::dump($_FILES);
			
			$tempFile = $_FILES['Filedata']['tmp_name'];
			$targetPath = $_SERVER['DOCUMENT_ROOT'] . $_REQUEST['folder'] .'/';
			$targetFile =  str_replace('//','/',$targetPath) . $_FILES['Filedata']['name'];
			
			$fileTypes  = str_replace('*.','',$_REQUEST['fileext']);
			$fileTypes  = str_replace(';','|',$fileTypes);
			$typesArray = split('\|',$fileTypes);
			$fileParts  = pathinfo($_FILES['Filedata']['name']);
			
			$fileParts = array_map(strtolower, $fileParts);	
			
			
			$model = new File();
			$model->pid = $_POST['pid']; ///Lookup::model()->getUserDefaultAlbum(Yii::app()->user->id)->id;
			$model->size = $_FILES['Filedata']['size'];
			$model->ext = strtolower($fileParts['extension']);
			$model->name = $fileParts['filename'];
			$model->created = time();
			$model->mime = File::model()->getMimeType($model->ext, $_FILES['Filedata']['type']);
			
						
			$path = File::model()->generateFileName($model, $_POST['targetFolder']);
			
			
			
			if ($model->save())
			{
				
				$id = $model->id;		

				
//				 if (in_array(strtolower($fileParts['extension']),$typesArray)) {
					// Uncomment the following line if you want to make the directory if it doesn't exist
					// mkdir(str_replace('//','/',$targetPath), 0755, true);
					
					move_uploaded_file($tempFile,$targetFile);
					
					@copy($targetFile,$path);
					@unlink($targetFile);				
	
					
					
					$response = array(
						'path'=>File::model()->generateFileName($model, $_POST['targetFolder'],false),
						'id'=>$model->id
					);
					
					echo json_encode($response);
//					echo $response['id'];//.'#_#'.$cookie['upload']->value.'#_#'.json_encode($model->attributes);
//					echo str_replace($_SERVER['DOCUMENT_ROOT'],'',$targetFile);
//				 } 
//				 else 
//				 {
//				 	echo 'Invalid file type.';
//				}
			}
		}       

	}
	
	public function actionCheckUpload()
	{
		$fileArray = array();
		foreach ($_POST as $key => $value) {
			if ($key != 'folder') {
				if (file_exists($_SERVER['DOCUMENT_ROOT'] . $_POST['folder'] . '/' . $value)) {
					$fileArray[$key] = $value;
				}
			}
		}
		echo json_encode($fileArray);
	}
	
	public function actionUploadAvatar()
	{
		$this->layout = '//layouts/blank';
		
		$this->render('uploadavatar');
	}

	
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
		    
		    
		    $profile = Profile::model()->find(array(
		    	'condition' => 'uid = :uid',
		    	'params' => array(
		    		':uid'=>Yii::app()->user->id
		    	)
		    ));  
		    
		    if ($profile)
		    {			    	
		    	$profile->avatar = $model->id;
		    	$profile->save();
		    }
		    else 
		    {
		    	UtilHelper::commonWord();
		    }
		    
		    
//		    $data = UtilHelper::Test($profile->attributes);

		    
		    $src = File::model()->generateFileName($model, 'avatar');
		    
			$desinfo =	array(
				'path'=>File::model()->generateFileName($model, 'avatar', true, 150),
				'width'=>150,
				'height'=>150				
			);			
			
			$x = $_POST['x'];
			$y = $_POST['y'];
			$w = $_POST['w'];
			$h = $_POST['h'];
			
			$t = new UtilThumbHandle($src);
				
			$width = $t->getSrcImgWidth();
				
			$scale = $width/500;
				
			$x = round($scale*$x);
			$y = round($scale*$y);
			$w = round($scale*$w);
			$h = round($scale*$h);
				
			$t->createImg($desinfo, $x, $y, $w, $h);	

			$des_60 = File::model()->generateFileName($model, 'avatar', true, 60);
			$des_30 = File::model()->generateFileName($model, 'avatar', true, 30);
			
			if (file_exists($des_30)) unlink($des_30);
			if (file_exists($des_60)) unlink($des_60);
			
	 		die();		    
		}
		else 
		{
			UtilHelper::commonWord();
		}
	}
	
	
	/**
	 * 为当前用户修改头像
	 * @param unknown_type $id
	 */
	public function actionsetAvatar($id)
	{
		$model = $this->loadProfileModel(Yii::app()->user->id);
		
		$model->avatar = $id;
		
		$model->save();
	}
	
	public function actionGenerateAvatar()
	{
		
		echo Profile::model()->getUserAvatarPath(Yii::app()->user->id,30);
		echo Profile::model()->getUserAvatarPath(Yii::app()->user->id,60);
		
//		echo Profile::model()->getUserAvatar(Yii::app()->user->id,array(),60);
//		echo Profile::model()->getUserAvatar(Yii::app()->user->id,array(),30);
	}
	
	public function actionTest3()
	{
//		echo Profile::model()->getUserAvatar(Yii::app()->user->id, array(),200);
		
		$src = './public/20bfaca64c6da0436293e020e62c6d5e1327747695.png';
		$temp = './public/test_temp.jpg';
		$des = './public/test_des.jpg';
		
			$desinfo = array(
					'path'=>$des,
					'width'=>150,
					'height'=>150				
				);	
		
				$t = new UtilThumbHandle($src);
				
				$width = $t->getSrcImgWidth();
				
				$scale = $width/500;
				$x = 200;
				$y = 5;
				$w = 285;
				$h = 285;				
				$x = round($scale*$x);
				$y = round($scale*$y);
				$w = round($scale*$w);
				$h = round($scale*$h);
				
				$t->createImg($desinfo, $x, $y, $w, $h);
		
//		$targ_w = $targ_h = 150;
//		$jpeg_quality = 90;
//		
//		$x = 200;
//		$y = 5;
//		$w = 285;
//		$h = 285;
//			
////	$src = 'public/uploads/1z2977e09zwss.jpg';
//		$img_r = imagecreatefromjpeg($src);
//		
//		$width = imagesx($img_r);
//		
//		$scale = $width/500;
//		
//		$x = round($scale*$x);
//		$y = round($scale*$y);
//		$w = round($scale*$w);
//		$h = round($scale*$h);
//		
//		
//		
//		$dst_r = ImageCreateTrueColor( $targ_w, $targ_h );
//		imagecopyresampled($dst_r,$img_r,0,0,$x,$y,$targ_w,$targ_h,$w,$h);
//			
//			
//		header('Content-type: image/jpeg');
//		imagejpeg($dst_r,null,$jpeg_quality);
//	
//		exit;
		
//		$t = new ThumbHandler();
//	    $t->setSrcImg($src);
//	    $t->setCutType(1);//指明为手工裁切
//	    $t->setSrcCutPosition(0, 0);// 源图起点坐标
//	    $t->setRectangleCut(500, 200);// 裁切尺寸
//	    $t->setDstImg($temp);
//	    $t->createImg(500);
	    
		$width = 500;
		
	    $t = new ThumbHandler();
		$t->setSrcImg($src);	

		$x = 93;
		$y = 119;
		
		$w = 252;
		$h = 252;
		
		$width = $t->getSrcImgWidth();
		
		$scale = $width/500;
		
		$x = round($scale*$x);
		$y = round($scale*$y);
		$w = round($scale*$w);
		$h = round($scale*$h);
		
//		$t->setCutType(1);//指明为手工裁切
//		$t->setDstImg($temp);
//		
//		$w = $t->getSrcImgWidth();
//		$h = $t->getSrcImgHeight();
//		
//		//宽度缩放比例
//		$num = ($width/$w)*100;
//		
//		$t->createImg($num);
//		
//		$t->setSrcImg($temp);
		$t->setCutType(2);
		$t->setDstImg($des);
		$t->setImgDisplayQuality(90);
		
		$t->setSrcCutPosition($x,$y);
		$t->setRectangleCut(150, 150);
		
//		echo $t->_getImgType($src);
		$t->createImg($w,$h);
//		
////		unlink($temp);
		

		
	}
	
	public function actionTest2(){
		
		$content = file_get_contents('http://ctc.qzs.qq.com/qzone/mall/app/vip_reward/swf/play.swf');
		
		file_put_contents('./public/play.swf', $content);


	}
	
	/**
	 * 此方法用于发布广告信息
	 */
	public function actionERelease($id)
	{
		$this->layout = '//layouts/column1';
				
		$model = $this->loadAdvertisementModel($id);

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['Advertisement']))
		{
			$model->attributes=$_POST['Advertisement'];
			
			$model->start = strtotime($model->start);
			$model->end = strtotime($model->end);
			
			$model->hasimg = UtilMatch::hasImage($model->content);
			$model->imginfo = UtilMatch::getAllImageInfo($model->content);
			
//			UtilHelper::dump(UtilMatch::hasImage($model->content));
//			UtilHelper::dump(UtilMatch::getAllImageInfo($model->content));
//			
//			UtilHelper::dump($model->attributes);
			
//			die();
			
			$return = array();
			
			if($model->save())
			{
				
				$return = array(
					'status'=>'ok',
					'data'=>CHtml::link('继续添加广告', array('/archiver/release','uid'=>$model->uid)).CHtml::link('/查看刚发布的广告', array('/info/view','uid'=>$model->uid,'id'=>$model->id))
				);				
	
			}
			else 
			{	$return = array(
					'status'=>'false',
					'data' => CHtml::errorSummary($model)
				);
			}
			
			echo json_encode($return);				
			
			die();
		}

		$this->render('erelease',array(
			'model'=>$model,
		));
	}
	
	/**
	 * 此方法用于发布广告信息
	 */
	public function actionRelease()
	{
		$this->layout = '//layouts/column1';
				
		$model=new Advertisement;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['Advertisement']))
		{
			$model->attributes=$_POST['Advertisement'];
			
			$model->start = strtotime($model->start);
			$model->end = strtotime($model->end);
			
			$model->hasimg = UtilMatch::hasImage($model->content);
			$model->imginfo = UtilMatch::getAllImageInfo($model->content);
			
//			UtilHelper::dump(UtilMatch::hasImage($model->content));
//			UtilHelper::dump(UtilMatch::getAllImageInfo($model->content));
//			
			UtilHelper::writeToFile($model->attributes);
//			
//			die();
			
			$return = array();
			
			if($model->save())
			{
				
				$return = array(
					'status'=>'ok',
					'data'=>CHtml::link('继续添加广告', array('/archiver/release','uid'=>$model->uid)).CHtml::link('/查看刚发布的广告', array('/info/view','uid'=>$model->uid,'id'=>$model->id))
				);				
	
			}
			else 
			{	$return = array(
					'status'=>'false',
					'data' => CHtml::errorSummary($model)
				);
			}
			
			UtilHelper::writeToFile($return, 'a+');
			
			echo json_encode($return);				
			
			die();
		}

		$this->render('release',array(
			'model'=>$model,
		));
	}
    
    public function actionTRelease()
    {
        $this->layout = '//layouts/column1';
        
        $theme = Theme::model()->findAll();
        
        $this->render('trelease',array(
            'themes'=>$theme
        ));
    }
	
	/**
	 * 此方法用于发布模板广告
	 */
	public function actionReleaseTemplate()
	{
		$this->layout = '//layouts/column1';
		
		$this->render('releasetemplate');
	}
	
	/**
	 * 此方法用于创建模板
	 */
	public function actionCTemplate()
	{
		$this->layout = '//layouts/column1';
		
		$this->render('ctemplate');
		
	}
	
	/**
	 * 此方法用于创建组件
	 */
	public function actionCConponent()
	{
		$this->layout = '//layouts/column1';
		
		$this->render('cconponent');
		
	}	

	/**
	 * Deletes a particular model.
	 * If deleti
	 * on is successful, the browser will be redirected to the 'admin' page.
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
	
    //分词，然后返回分词结果
	public function actionAnalysis()
	{
		
//		$this->layout = '//layouts/blank';

//	$content = <<<DOM
//九十年代初，刘德华演出多部黑社会江湖片，扮演身在黑社会却有情有义、英气未泯的人物，其形象深深影响当时的年轻人。其后刘德华开始改变形象，角色的类型多变，演出更有深度，演艺事业更上一层楼。电影的代表作包括《九一神雕侠侣》、《赌神》、《天若有情》、《龙在江湖》、《法外情》、《烈火战车》、《旺角卡门》、《雷洛传》、《阿虎》、《瘦身男女》、《赌侠》系列、《暗战》、《无间道》、《无间道三终极无间》、《大只佬》、《天下无贼》、《墨攻》、《投名状》、《门徒》等等。
//　　刘德华于1985年进军乐坛，第一张专辑是《只知道此刻爱你》，并获得很大回响。在1991年的偶像热潮下，刘德华与张学友、黎明、郭富城被传媒封为“四大天王”。1991年推出《爱不完》专辑，销售首日录音带销售共16万张，镭射唱片(CD)共72,000张。1993年1月，在香港红磡体育馆举办第一场个人演唱会。他曾六度夺得“十大劲歌金曲颁奖典礼”的“
//华仔(20张)
//最受欢迎男歌星”，亦九次夺得“亚太区最受欢迎香港男歌星”；其中刘德华于2004年度同时夺得“最受欢迎男歌星”和“亚太区最受欢迎香港男歌星”，是首位同时获得这两个大奖的男歌手。至2007年刘德华因为工作忙碌，以无法抽空出席TVB的颁奖典礼。刘德华曾于1998、1999、2001及2002年度夺“四台联颁音乐大奖--传媒大奖”，四度成为四大电子传媒音乐颁奖典礼大赢家。亦在90年代台湾演艺圈年度盛事十大偶像票选中连续6年打败当红的台湾四小天王、连续6度夺得冠军，其《忘情水》、《天意》等国语专辑在台湾取得近100万销量的好成绩。
//　　时至今日，帅气的刘德华仍然是影视歌坛的超级巨星，他对工作孜孜不倦，以49岁的年纪仍能成为演艺界当红偶像，可谓魅力无边
//DOM;

	
//		$str = file_get_contents('http://ythzjk.iteye.com/blog/325738');

		$content = $_POST['content'];
		$size = $_POST['size'];


		echo json_encode(UtilSearch::phpAnalysis($content, $size));

		
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$this->layout = '//layouts/blog';
		
		$criteria = new CDbCriteria(array(
			'condition'=>'uid = :uid',
			'order' => 'id DESC',
			'params' => array(
				':uid'=>isset($_GET['uid'])?$_GET['uid']:Yii::app()->user->id
			)
		));
		
		$total = Advertisement::model()->count($criteria);
		
		$pages = new CPagination($total);
		$pages->pageSize = 10;
		$pages->applyLimit($criteria);	
		
		
		$model = Advertisement::model()->findAll($criteria);
		
//		$dataProvider=new CActiveDataProvider('Advertisement',array(
//			'criteria' => $criteria
//		));
		$this->render('index',array(
//			'dataProvider'=>$dataProvider,
			'pages'=>$pages,
			'model'=>$model
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Profile('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Profile']))
			$model->attributes=$_GET['Profile'];

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
		$model=Profile::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	
	/**
	 * 根据id返回Profile模型
	 * @param unknown_type $id
	 */
	public function loadProfileModel($id)
	{
		$model = Profile::model()->find(array(
			'condition'=>'uid = :uid',
			'params'=>array(
				':uid'=>$id
			)
		));
		
		if ($model === null)
		{
			$model = new Profile();
			$model->uid = Yii::app()->user->id;
			$model->save();
		}
		
		return $model;
	}
	
	/**
	 * 根据id返回Advertisement模型
	 * @param unknown_type $template
	 */
	public function loadAdvertisementModel($id)
	{
		$model=Advertisement::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;		
	}
	
	
	private function renderTemplate($template)
	{
		$this->layout = '//layouts/blank';		
		
		$model = self::loadProfileModel(Yii::app()->user->id);
		
		$this->performAjaxValidation($model);
		
		$this->render($template, array(
			'model'=>$model
		));	
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='profile-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}