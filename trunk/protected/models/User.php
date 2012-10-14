<?php

/**
 * This is the model class for table "{{user}}".
 *
 * The followings are the available columns in table '{{user}}':
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $salt
 * @property integer $role
 * @property integer $created
 * @property integer $lastlogin
 *
 * The followings are the available model relations:
 * @property Advertisement[] $advertisements
 * @property Profile[] $profiles
 */
class User extends CActiveRecord
{
	const ROLE_SUPER = 0;		//超级用户
	const ROLE_ADMIN = 1;		//系统管理员
	const ROLE_NORMAL = 2;		//一般用户
	const ROLE_VIP = 3;			//对于某些收费项目只有VIP用户才能使用，一般用户不能
	
	/**
	 * Note:
	 * AUTH_NOTACTIVETED	注册并取得修改个人信息的权限,发送激活邮件
	 * AUTH_ACTIVETED	邮件激活用户并取得文章管理权限,等待发表第一篇文章
	 * AUTH_USER	发表文章成为真正的用户并取得文章分享/收藏等权限
	 * AUTH_REALNAMEAUTHENTICATION	通过实名认证,取得网上支付权限
	 * AUTH_DEVELOPER	取得开发插件/模板等权限
	 * AUTH_VIP		升级为VIP用户,可以享受打折优惠
	 * AUTH_ADMINISTRATOR	取得区域管理权限
	 */
	const AUTH_NOTACTIVETED = 'Not Activeted';
	const AUTH_ACTIVETED = 'Activeted';
	const AUTH_REALNAMEAUTHENTICATION = 'Real-name Authentication';
	const AUTH_USER = 'User';
	const AUTH_VIP = 'Vip';
	const AUTH_ADMINISTRATOR = 'Administrator';
	const AUTH_DEVELOPER = 'Developer';
	const AUTH_TESTER = 'Tester';
	/**
	 * Returns the static model of the specified AR class.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{user}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, password', 'required'),
			array('role, created, lastlogin', 'numerical', 'integerOnly'=>true),
			array('username, salt', 'length', 'max'=>50),
			array('username','unique'),
			array('password','checkPassword'),
			array('password', 'length', 'max'=>128),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, username, password, salt, role, created, lastlogin', 'safe', 'on'=>'search'),
		);
	}
	
	public function checkPassword()
	{
		if (!$this->hasErrors())
		{
			if (strpos($this->username, $this->password)){
				$this->addError('password', '用户密码不能含有与用户名相同的字符');
			}			
		}

	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'advertisements' => array(self::HAS_MANY, 'Advertisement', 'uid'),
			'profiles' => array(self::HAS_ONE, 'Profile', 'uid'),
			'region'  => array(self::HAS_MANY, 'Region', 'uid'),
			'runner' => array(self::BELONGS_TO, 'Region', 'forerunner')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'username' => '用户名',
			'password' => '密码',
			'salt' => '随机字符',
			'role' => '角色',
			'created' => '注册时间',
			'lastlogin' => '最后一次登录时间',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('salt',$this->salt,true);
		$criteria->compare('role',$this->role);
		$criteria->compare('created',$this->created);
		$criteria->compare('lastlogin',$this->lastlogin);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
    
	
	public function getRoleName($id)
	{
		switch ($id){
			case self::ROLE_ADMIN:
				return '管理员';
			case self::ROLE_NORMAL:
				return '一般用户';
			case self::ROLE_SUPER:
				return '超级用户';
			case self::ROLE_VIP:
				return 'VIP用户';
		}
	}
	
	public function generateRoleList()
	{
		return array(
			self::ROLE_NORMAL => self::getRoleName(self::ROLE_NORMAL),
			self::ROLE_VIP => self::getRoleName(self::ROLE_VIP),			
			self::ROLE_ADMIN => self::getRoleName(self::ROLE_ADMIN),
			self::ROLE_SUPER => self::getRoleName(self::ROLE_SUPER)
		);
	}
    

	public function validatePassword($password)
	{
		return $this->hashPassword($password,$this->salt) === $this->password;
	}
	
	public function hashPassword($password,$salt){
		return md5($salt.$password);
	}
	
	public function generateSalt()
	{
		$salt = md5($this->username.$this->created);
		$salt = substr($salt, 5, 5);
		return $salt;
	}
	
	public function beforeSave()
	{
		if(parent::beforeSave())
		{
			if($this->isNewRecord)
			{
				$this->created = time();
				$this->lastlogin = $this->created;
				$this->salt = $this->generateSalt();
				$this->password = $this->hashPassword($this->password, $this->salt);
				$this->role = self::ROLE_NORMAL;
			}
			else
			{
				$this->lastlogin = time();	
			}
			return true;	
		}
		else
			return false;
	}
}