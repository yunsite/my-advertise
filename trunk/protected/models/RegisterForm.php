<?php
class RegisterForm extends CFormModel
{
	
	//User Model
	public $username;
	public $password;
	public $repassword;
	
	//Profile Model
	public $email;
	public $firstname;
	public $lastname;
	public $birth;
	public $gender;
	public $region;
	
	
	public $agree;	
	public $verifyCode;



	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// username and password are required
			array('username, password, repassword, email, firstname, lastname, gender, birth, region, agree', 'required'),
			// rememberMe needs to be a boolean
			array('username', 'unique', 'className'=>'User'),
			array('email', 'unique', 'className'=>'Profile'),
			array('firstname, lastname', 'checkUsername'),
			array('username', 'length', 'min'=>5, 'max'=>20),
			array('password', 'length', 'min'=>5, 'max'=>20),
			array('password', 'checkPassword'),
			array('email', 'email'),
//			array('birth','date'),
			array('agree', 'boolean'),
			array('verifyCode' , 'captcha' , 'allowEmpty' => !CCaptcha::checkRequirements()),
			// password needs to be authenticated
			array('repassword', 'compare', 'compareAttribute'=>'password'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'firstname'=> '姓',
			'lastname'=> '名',
			'username' => '用户名',
			'password' => '用户密码',
			'repassword' => '确认密码',
			'verifyCode' => '输入验证码',
			'email' => '电子邮箱',
			'gender' => '性别',
			'birth' => '出生日期',
			'region'=>'现居地',
			'agree'=>'同意悦珂谷的'.CHtml::link('使用协议',Yii::app()->createUrl('/site/term')).'及'.CHtml::link('服务规则',Yii::app()->createUrl('/site/service')),
		);
	}
	
	public function checkPassword()
	{
		if (!$this->hasErrors())
		{
			if (strpos($this->password, $this->username))
				$this->addError('password', '密码不能含有与用户名相同的文字');
		}
	}
	
	public function checkRepassword()
	{
		if (!$this->hasErrors())
		{
			if ($this->password != $this->repassword)
				$this->addError('repassword', '两次密码输入不一致!');
		}
	}
	
	public function checkUsername()
	{
		if (!$this->hasErrors())
		{
			if (!UtilValidator::isChinese($this->firstname)) {
				$this->addError('firstname', '用户的姓必须是中文');
			}elseif (!UtilValidator::isChinese($this->lastname))
				$this->addError('lastname', '用户的名字必须是中文');
		}
	}


	
	public function register()
	{		
		if (!$this->hasErrors())
		{
			if (!$this->agree)
				$this->addError('agree', '不好意思，只有同意我们的使用协议书才能使用本站提供的信息');		
			else
			{
				$model = new User();
				
				$model->username = $this->username;
				$model->password = $this->password;
				
				
				if ($model->save())
				{
					//生日解析
					$birth = strtotime($this->birth);
					$year = date('Y',$birth);
					$month = date('n',$birth);
					$day = date('d', $birth);
					///现居地解析
					$address = explode('-', $this->region);
					
					$profile = new Profile();
					$profile->firstname = $this->firstname;
					$profile->lastname = $this->lastname;
					$profile->email = $this->email;
					$profile->gender = $this->gender;
					$profile->birthday = intval($day);
					$profile->birthmonth = intval($month);
					$profile->birthyear = intval($year);
					$profile->country = 1;
					$profile->province = $address[0];
					$profile->manicipal = $address[1];
					$profile->county = $address[2];
					$profile->village = $address[3];
					$profile->uid = $model->id;
					if ($profile->save())
					{
						Yii::app()->authManager->assign(User::AUTH_NOTACTIVETED, $model->id);
						
						//开启当地广告栏
						Region::model()->addForerunner($model, $this->region);
						
						return true;
					}
					else 
					{
						User::model()->deleteByPk($model->id);
					}
					return false;
				}
				else
				{
					return false;
				}				
			}
		}
		

	}


	/**
	 * Logs in the user using the given username and password in the model.
	 * @return boolean whether login is successful
	 */
	public function login()
	{
		if($this->_identity===null)
		{
			$this->_identity=new UserIdentity($this->username,$this->password);
			$this->_identity->authenticate();
		}
		if($this->_identity->errorCode===UserIdentity::ERROR_NONE)
		{
			$duration=$this->rememberMe ? 3600*24*30 : 0; // 30 days
			Yii::app()->user->login($this->_identity,$duration);
			return true;
		}
		else
			return false;
	}
}