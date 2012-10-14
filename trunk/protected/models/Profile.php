<?php

/**
 * This is the model class for table "{{profile}}".
 *
 * The followings are the available columns in table '{{profile}}':
 * @property integer $id
 * @property integer $uid
 * @property string $firstname
 * @property string $lastname
 * @property string $nickName
 * @property integer $avatar
 * @property integer $gender
 * @property integer $calendar
 * @property string $birth
 * @property string $birthyear
 * @property string $birthmonth
 * @property string $birthday
 * @property string $blood
 * @property integer $marry
 * @property string $email
 * @property string $phone
 * @property integer $qq
 * @property string $alipay
 * @property string $job
 * @property string $companyname
 * @property string $companyaddress
 * @property string $favoriteStar
 * @property string $favoriteFood
 * @property string $favoriteMusic
 * @property string $favoriteMovie
 * @property string $favoriteGames
 * @property string $favoriteSports
 * @property string $favoriteBooks
 * @property string $favoriteTourism
 * @property string $favoriteDigital
 * @property string $favoriteOther
 * @property string $primaryschool
 * @property string $middleschool
 * @property string $highschool
 * @property string $university
 * @property string $country
 * @property integer $province
 * @property integer $manicipal
 * @property integer $village
 * @property integer $county
 * @property integer $homeprovince
 * @property integer $homemanicipal
 * @property integer $homecounty
 * @property integer $homevillage
 * @property string $addressdetail
 * @property string $homeaddressdetail
 *
 * The followings are the available model relations:
 * @property User $user
 * @property File $avatar
 */
class Profile extends CActiveRecord
{
	
	const GENDER_MALE = 0;		//男
	const GENDER_FAMALE = 1;	//女
	const GENDER_SECRET = 2;	//保密
	
	const MARRY_YES = 0;		//已婚
	const MARRY_NO = 1;			//未婚
	const MARRY_SECRET = 2;		//保密
	
	const CALENDAR_LUNAR = 1;	//阴历
	const CALENDAR_SOLAR = 2;	//阳历
	
	const BLOOD_A = 1;	//A型血
	const BLOOD_B = 2;	//B型血
	const BLOOD_AB = 3; 	//AB型血
	const BLOOD_O = 4;	//O型血
	const BLOOD_SECRET = 5;	//保密
	
	/**
	 * Returns the static model of the specified AR class.
	 * @return Profile the static model class
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
		return '{{profile}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('uid', 'required'),
			array('uid, avatar, gender, calendar, marry, qq, province, manicipal, village, county, homeprovince, homemanicipal, homecounty, homevillage', 'numerical', 'integerOnly'=>true),
			array('firstname', 'length', 'max'=>20),
			array('lastname, nickName, birth, phone, country', 'length', 'max'=>50),
			array('birthyear', 'length', 'max'=>4),
			array('birthmonth, birthday', 'length', 'max'=>2),
			array('blood', 'length', 'max'=>10),
			array('email, alipay', 'length', 'max'=>100),
			array('job, companyaddress, favoriteStar, favoriteFood, favoriteMusic, favoriteMovie, favoriteGames, favoriteSports, favoriteBooks, favoriteTourism, favoriteDigital, favoriteOther', 'length', 'max'=>500),
			array('companyname, primaryschool, middleschool, highschool, university, addressdetail, homeaddressdetail', 'length', 'max'=>200),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, uid, firstname, lastname, nickName, avatar, gender, calendar, birth, birthyear, birthmonth, birthday, blood, marry, email, phone, qq, alipay, job, companyname, companyaddress, favoriteStar, favoriteFood, favoriteMusic, favoriteMovie, favoriteGames, favoriteSports, favoriteBooks, favoriteTourism, favoriteDigital, favoriteOther, primaryschool, middleschool, highschool, university, country, province, manicipal, village, county, homeprovince, homemanicipal, homecounty, homevillage, addressdetail, homeaddressdetail', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'user' => array(self::BELONGS_TO, 'User', 'uid'),
			'avatar' => array(self::BELONGS_TO, 'File', 'avatar'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'uid' => '用户ID',
			'firstname' => '姓',
			'lastname' => '名',
			'nickName' => '昵称',
			'gender' => '性别',
			'calendar' => '历法',
			'birth' => '生日',
			'birthyear' => 'Birthyear',
			'birthmonth' => 'Birthmonth',
			'birthday' => 'Birthday',
			'blood' => 'Blood',
			'marry' => '感情状况',
			'email' => '电子邮件',
			'phone' => '手机号码',
			'qq' => 'QQ号码',
			'alipay' => '支付宝',
			'job' => '工作',
			'companyname' => '公司名称',
			'companyaddress' => '公司地址',
			'favoriteStar' => '明星',
			'favoriteFood' => '美食',
			'favoriteMusic' => '音乐',
			'favoriteMovie' => '影视',
			'favoriteGames' => '游戏',
			'favoriteSports' => '运动',
			'favoriteBooks' => '书籍',
			'favoriteTourism' => '旅游',
			'favoriteDigital' => '数码',
			'favoriteOther' => '其他',
			'primaryschool' => '小学',
			'middleschool' => '中学',
			'highschool' => '高中',
			'university' => '大学',
			'address' => '地址',
			'country' => '国籍',
			'province' => '现居省份',
			'manicipal' => '现居市（州）',
			'village' => '现居乡镇',
			'county' => '现居县',
			'address'=>'现居地址',
			'addressdetail'=>'现居地详细地址',
			'homeaddress'=>'家乡',
			'homeprovince' => '出生省份',
			'homemanicipal' => '出生市（州）',
			'homecounty' => '出生县',
			'homevillage' => '出生乡镇',
			'homeaddressdetail'=>'家乡详细地址'
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
		$criteria->compare('uid',$this->uid);
		$criteria->compare('firstname',$this->firstname,true);
		$criteria->compare('lastname',$this->lastname,true);
		$criteria->compare('nickName',$this->nickName,true);
		$criteria->compare('avatar',$this->avatar);
		$criteria->compare('gender',$this->gender);
		$criteria->compare('calendar',$this->calendar);
		$criteria->compare('birth',$this->birth,true);
		$criteria->compare('birthyear',$this->birthyear,true);
		$criteria->compare('birthmonth',$this->birthmonth,true);
		$criteria->compare('birthday',$this->birthday,true);
		$criteria->compare('blood',$this->blood,true);
		$criteria->compare('marry',$this->marry);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('qq',$this->qq);
		$criteria->compare('alipay',$this->alipay,true);
		$criteria->compare('job',$this->job,true);
		$criteria->compare('companyname',$this->companyname,true);
		$criteria->compare('companyaddress',$this->companyaddress,true);
		$criteria->compare('favoriteStar',$this->favoriteStar,true);
		$criteria->compare('favoriteFood',$this->favoriteFood,true);
		$criteria->compare('favoriteMusic',$this->favoriteMusic,true);
		$criteria->compare('favoriteMovie',$this->favoriteMovie,true);
		$criteria->compare('favoriteGames',$this->favoriteGames,true);
		$criteria->compare('favoriteSports',$this->favoriteSports,true);
		$criteria->compare('favoriteBooks',$this->favoriteBooks,true);
		$criteria->compare('favoriteTourism',$this->favoriteTourism,true);
		$criteria->compare('favoriteDigital',$this->favoriteDigital,true);
		$criteria->compare('favoriteOther',$this->favoriteOther,true);
		$criteria->compare('primaryschool',$this->primaryschool,true);
		$criteria->compare('middleschool',$this->middleschool,true);
		$criteria->compare('highschool',$this->highschool,true);
		$criteria->compare('university',$this->university,true);
		$criteria->compare('country',$this->country,true);
		$criteria->compare('province',$this->province);
		$criteria->compare('manicipal',$this->manicipal);
		$criteria->compare('village',$this->village);
		$criteria->compare('county',$this->county);
		$criteria->compare('homeprovince',$this->homeprovince);
		$criteria->compare('homemanicipal',$this->homemanicipal);
		$criteria->compare('homecounty',$this->homecounty);
		$criteria->compare('homevillage',$this->homevillage);
		$criteria->compare('addressdetail',$this->addressdetail,true);
		$criteria->compare('homeaddressdetail',$this->homeaddressdetail,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	

	
	public function getProfileModel($id = null)
	{
		if (is_null($id))
			$id = Yii::app()->user->id;
		
		$model = User::model()->findByPk($id);
		
		return $model->profiles;
	}
    
    public function getEmail($id = null)
    {
        return self::getProfileModel()->email;
    }
	
	public function getGender($id)
	{
		switch ($id){
			case self::GENDER_MALE:
				return '男';
			case self::GENDER_FAMALE:
				return '女';
			case self::GENDER_SECRET:
				return '保密';
		}
	}
	
	
	public function generateGenderList()
	{
		return array(
			self::GENDER_MALE => self::getGender(self::GENDER_MALE),
			self::GENDER_FAMALE => self::getGender(self::GENDER_FAMALE),
			self::GENDER_SECRET => self::getGender(self::GENDER_SECRET)
		);
	}
	
	public function getBloodType($type)
	{
		switch ($type)
		{
			case self::BLOOD_A:
				return 'A型';
			case self::BLOOD_AB:
				return 'AB型';
			case self::BLOOD_B:
				return 'B型';
			case self::BLOOD_O:
				return 'O型';
		}
	}
	
	
	public function generateBloodList()
	{
		return array(
			self::BLOOD_A => self::getBloodType(self::BLOOD_A),
			self::BLOOD_AB => self::getBloodType(self::BLOOD_AB),
			self::BLOOD_B => self::getBloodType(self::BLOOD_B),
			self::BLOOD_O => self::getBloodType(self::BLOOD_O)
		);
	}

	
	public function getCalendarType($type)
	{
		switch ($type)
		{
			case self::CALENDAR_LUNAR:
				return '阴历';
			case self::CALENDAR_SOLAR:
				return '阳历';
		}
	}
	
	public function generateCalendar()
	{
		return array(
			self::CALENDAR_LUNAR=>self::getCalendarType(self::CALENDAR_LUNAR),
			self::CALENDAR_SOLAR=>self::getCalendarType(self::CALENDAR_SOLAR)
		);
	}
	
	public function generateYear()
	{
		return array_combine(range( date('Y',time()),1980, -1), array_map(array(self,addYear), range( date('Y',time()),1980, -1)));
	}
	
	public function addYear($year)
	{
		return $year.'年';
	}

	public function generateMonth()
	{
		return array_combine(range(1, 12), array_map(array(self,addMonth), range(1, 12)));
	}
	
	private function addMonth($month)
	{
		return $month.'月';
	}
	
	public function generateDay()
	{
		return array_combine(range(1, 31), array_map(array(self,addDay), range(1, 31)));
	}
	
	private function addDay($day)
	{
		return $day.'日';
	}
	
	/**
	 * 获取用户真实姓名
	 * @param unknown_type $id
	 */
	public function getUserTrueName($id)
	{
		$model = User::model()->findByPk($id);

		
		if ($model->profiles)
			return $model->profiles->firstname.$model->profiles->lastname;
		else 
			return $model->username;
	}
	
	/**
	 * 获取用户昵称
	 * @param unknown_type $id
	 */
	public function getUserNickName($id)
	{
		$model = User::model()->findByPk($id);
		
		if ($model->profiles)
			return $model->profiles->nickName;
		else 
			return $model->username;		
	}
    /**
     * 此方法可以访问User的所有属性
     * 例如<:{Profile.getUserGender|id:1}:>可以访问id对应用户的用户名
     **/ 
	public function getUserGender($id)
	{
		$model = User::model()->findByPk($id);
		
		if ($model->profiles)
			return $model->profiles->gender;
		else 
			return Profile::GENDER_SECRET;
	}
	
	public function getUserAddress($id, $separate = "&nbsp;&nbsp;")
	{
		$model = User::model()->findByPk($id);

		$result = '';
		
		if($model->profiles)
		{
//			if ($model->profiles->province)
//				$result .= Region::model()->getRegion($model->profiles->province).'&nbsp;&nbsp;';
//			if ($model->profiles->manicipal)
//				$result .= Region::model()->getRegion($model->profiles->manicipal).'&nbsp;&nbsp;';		
//			if ($model->profiles->county)
//				$result .= Region::model()->getRegion($model->profiles->county).'&nbsp;&nbsp;';
//			if ($model->profiles->village)
//				$result .= Region::model()->getRegion($model->profiles->village);	
			if ($model->profiles->addressdetail)
				$address = explode('-', $model->profiles->addressdetail);
			else 
			{
				$address = array(
					$model->profiles->province,
					$model->profiles->manicipal,
					$model->profiles->county,
					$model->profiles->village
				);
			}	
			
			$i = 1;
			foreach ($address as $region)
			{
				$result .= Region::model()->getRegion($region);
				
				if ($i < count($address)-1)
				{
					$result .= $separate;
				}
				
				$i++;
			}

			
		}
		else 
			$result .='地址不详';
		return $result;
	}
	
	public function getUserHomeAddress($id)
	{
		$model = User::model()->findByPk($id);

		$result = '';
		
		if($model->profiles)
		{			
			$address = explode('-', $model->profiles->homeaddressdetail);
			
			foreach ($address as $region)
			{
				$result .= Region::model()->getRegion($region).'&nbsp;&nbsp;';
			}
		}
		else 
			$result .='地址不详';
		return $result;
	}
	
	public function generateTimeStamp($month,$day,$year)
	{
		return mktime(0,0,0,$month,$day,$year);
	}
	
	public function test($year,$month,$day)
	{
		return $year.'年'.$month.'月'.$day.'日';
	}
	
	public function getConstellation($month,$day)
	{
		$result = '';
		$constellation = array  (
			'白羊座'=>array(3,21,4,19),
			'金牛座'=>array(4,20,5,20),
			'双子座'=>array(5,21,6,21),
			'巨蟹座'=>array(6,22,7,22),
			'狮子座'=>array(7,23,8,22),
			'处女座'=>array(8,23,9,22),
			'天秤座'=>array(9,23,10,23),
			'天蝎座'=>array(10,24,11,22),
			'射手座'=>array(11,23,12,21),
			'摩蝎座'=>array(12,22,1,19),
			'水瓶座'=>array(1,20,2,18),
			'双鱼座'=>array(2,19,3,20)
		);
		
		foreach ($constellation as $key => $value)
		{
			$year = $endyear = date('Y',time());
			
			if ($value[0] > $value[2])
				$endyear = $year + 1;

			$timestamp = self::generateTimeStamp($month, $day, $endyear);	
			$start = self::generateTimeStamp($value[0], $value[1],$year);
			$end = self::generateTimeStamp($value[2], $value[3],$endyear);
			
//			echo date('Y-m-d',$start) .'-'. date('Y-m-d',$timestamp) .'-'.date('Y-m-d',$end).'<br />';
			
			if ($timestamp >= $start && $timestamp <= $end)
			{	
				$result = $key;
				break;			
			}
		}
		
		return $result;
	}
	
	public function generateUserAvatars($model, $size = 60, $path = 'avatar')
	{
		$origion = File::model()->generateFileName($model, $path, true);
		$src = File::model()->generateFileName($model, $path, true, 150);
		
		$des = File::model()->generateFileName($model, $path, true, $size);		
  
        
		if (!file_exists($des))
		{
			if (!is_dir(dirname($des)))
				UtilHelper::createFolder(dirname($des));
			
			if (file_exists($src))
			{
				$t = new ThumbHandler();
			    $t->setSrcImg($src);
			    $t->setCutType(1);//指明为手工裁切
//			    $t->setSrcCutPosition(100, 100);// 源图起点坐标
			    $t->setRectangleCut($size, $size);// 裁切尺寸
			    $t->setImgDisplayQuality(90);
			    $t->setDstImg($des);
			    $t->createImg(150,150);				
			}
			elseif (file_exists($origion)) 
			{
				$t = new ThumbHandler();
				$t->setSrcImg($origion);
				$t->setCutType(2);
				$t->setSrcCutPosition(0, 0);
				$t->setRectangleCut($size,$size);
				$t->setImgDisplayQuality(90);
				$t->setDstImg($des);
				
				$width = $t->getSrcImgWidth();
				$height = $t->getSrcImgHeight();
				
				if ($width >= $height)
					$t->createImg($height,$height);
				else 
					$t->createImg($width,$width);
				
			}
				

		}
		

	}
	
	/**
	 * 根据用户ID获取用户头像路径
	 * @param unknown_type $id
	 * @param unknown_type $size
	 */
	public function getUserAvatarPath($id, $size = 60)
	{
		
		$path = '';
		
		$model = User::model()->findByPk($id);
		
		if ($model->profiles)
		{
			
			if ($model->profiles->birthyear)
				$path = UtilHelper::getZodiacPath($model->profiles->birthyear);		
					
			if ($model->profiles->avatar)
			{
				$data = File::model()->findByPk($model->profiles->avatar);
				
				$originPath = File::model()->generateFileName($data, 'avatar',true,null);			
				
				
				if (file_exists($originPath))
				{
					$avatarPath = File::model()->generateFileName($data, 'avatar',false,$size);
					
					if (!file_exists('.'.$avatarPath))
					{
						self::generateUserAvatars($data,$size);
					}
					
					$path = $avatarPath;
				}				

			}					
			
		}
		else 
			$path = Yii::app()->params->defaultAvatarPath;
			
		
		return $path;
	}
	
	//根据用户获取用户头像
	public function getUserAvatar($id, $htmlOptions = array(),$size =60, $alt = '')
	{
		$path = self::getUserAvatarPath($id,$size);
		if ($size)
			$htmlOptions['style'] = 'width:'.$size.'px';
		
		return CHtml::image($path, $alt, $htmlOptions);
	}
	
	public function getUserConstellation($id)
	{
		$result = '';
		
		$model = User::model()->findByPk($id);
		
		if ($model->profiles)
		{
			$month = $model->profiles->birthmonth;
			$day = $model->profiles->birthday;	
			
			
			if ($month !== null && $day !== null)
			{

				$result = self::getConstellation($month,$day);
			}
			
		}
		else 
			$result = '星座不详';
		
		return $result;
	}
	
	public function getMarryStateList()
	{
		return array(
			self::MARRY_YES => self::getMarrySate(self::MARRY_YES),
			self::MARRY_NO => self::getMarrySate(self::MARRY_NO),
			self::MARRY_SECRET => self::getMarrySate(self::MARRY_SECRET)
		);
	}
	
	public function getMarrySate($type)
	{
		switch ($type)
		{
			case self::MARRY_NO:
				return '目前未婚';
			case self::MARRY_YES:
				return '目前已婚';
			case self::MARRY_SECRET:
				return '感情状态不详'; 
		}
	}

	public function getUserMarryState($id)
	{
		$result = '';
		
		$model = User::model()->findByPk($id);
		
		if ($model->profiles && $model->profiles->marry !== null) {
			$result = self::getMarrySate($model->profiles->marry);
		}
		else 
		{
			$result = self::getMarrySate(self::MARRY_SECRET);
		}
		
		return $result;
	}	
	
	/**
	 * 获取用户的小学学校信息
	 * @param unknown_type $uid
	 */
	public function getUserPrimary($uid = null)
	{
		$model = self::getProfileModel($uid);
		
		return College::model()->getCollege($model->profiles->primaryschool);
	}
	
	
	/**
	 * 获取用户的中学信息
	 * @param unknown_type $uid
	 */
	public function getUserMiddelScholl($uid = null)
	{
		$model = self::getProfileModel($uid);
		
		return College::model()->getCollege($model->profiles->middleschool);
	}
	
	/**
	 * 获取用户的高中学校信息
	 * @param unknown_type $uid
	 */
	public function getUserHighSchool($uid = null)
	{
		$model = self::getProfileModel($uid);
		
		
		return College::model()->getCollege($model->profiles->highschool);
	}
	
	/**
	 * 获取用户的大学学校信息
	 * @param unknown_type $uid
	 */
	public function getUserUniversity($uid = null)
	{
		$model = self::getProfileModel($uid);
		
		return College::model()->getCollege($model->profiles->university);
	}
	
}