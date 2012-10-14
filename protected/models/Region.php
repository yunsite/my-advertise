<?php

/**
 * 广告栏管理办法
 * 
 * 一、下面为广告栏开启管理的处理办法：
 * （1）如果检验发现当前注册用户为所属省份的第一人，则开启相应省份广告栏
 * （2）若当前省份已经开启，则只为当前用户所在地区开启对应的广告栏
 * （3）每个用户只能最多只能开启一个一级广告栏和一个二级广告栏
 * 二、下面为对先行者的奖励办法：
 * （1）每天启一个新广告栏可加50分
 * 三、开启流程
 * 
 * 用户注册－比对用户信息及广告栏开启情况－进行奖励
 * 
 * 广告栏跳转：检验用户所选择地区是否已经开启广告栏->若未开启则跳转到对应错误页面

 * 四、特别处理
 * （1）要对用户当前所属地区信息进行严格管理，如用户需要修改，则需要提出申请
 * （2）为了防止用户随意修改所属地区信息获得奖励，所以如果用户已经获取了奖励，则不能再次获得
 * 
 * This is the model class for table "{{region}}".
 *
 * The followings are the available columns in table '{{region}}':
 * @property integer $id
 * @property string $region
 * @property integer $uid
 * @property integer $pid
 * @property integer $forerunner
 *
 * The followings are the available model relations:
 * @property College[] $colleges
 * @property User $user
 */
class Region extends CActiveRecord
{
	public $province;
	public $manicipal;
	public $county;
	public $village;
	
	public $areatype;
	
	const COUNTY = 1;
	const VILLAGE = 2;	
	
	/**
	 * Returns the static model of the specified AR class.
	 * @return Region the static model class
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
		return '{{region}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('region, uid, pid', 'required'),
			array('uid, pid, forerunner', 'numerical', 'integerOnly'=>true),
			array('region', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, region, uid, pid, forerunner', 'safe', 'on'=>'search'),
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
			'colleges' => array(self::HAS_MANY, 'College', 'province'),
			'user' => array(self::BELONGS_TO, 'User', 'uid'),
			'children' => array(self::HAS_MANY, 'Region', 'pid'),
			'parent' => array(self::BELONGS_TO, 'Region', 'id')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'region' => 'Region',
			'uid' => 'Uid',
			'pid' => 'Pid',
			'forerunner' => 'Forerunner',
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
		$criteria->compare('region',$this->region,true);
		$criteria->compare('uid',$this->uid);
		$criteria->compare('pid',$this->pid);
		$criteria->compare('forerunner',$this->forerunner);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function brand()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria = new CDbCriteria(array(
			'condition'=>'forerunner IS NOT NULL',
			'group'=>'forerunner',
			'order'=>'id DESC'
		));

		$criteria->compare('id',$this->id);
		$criteria->compare('region',$this->region,true);
		$criteria->compare('uid',$this->uid);
		$criteria->compare('pid',$this->pid);
//		$criteria->compare('forerunner',$this->forerunner);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	/**
	 * 根据IP地址获取当前所在地区
	 * Enter description here ...
	 */
	public function getAreaModel()
	{
		$queryIP = "182.128.".rand(10, 244).".21";
		
//		$queryIP = strval(rand(10, 244).'.'.rand(10, 244).'.'.rand(10, 244).'.'.rand(10, 244));

//		echo $queryIP;
		
//		$queryIP = UtilNet::getClientIp();
		$local = UtilNet::getIPLoc($queryIP);
			
//		UtilHelper::dump($local);

//		UtilHelper::writeToFile($local);
			
		$province = $local->province;
		$city = $local->city;
			
//		echo $province.$city;
			
		$provinceModel = Region::model()->getProvinceByName($province);
			
//		UtilHelper::dump($provinceModel);
			
		$cityModel = Region::model()->getManicipalByName($city, $provinceModel->id);
			
		if ($cityModel)
		{
			$model = $cityModel;
		}
		elseif ($provinceModel && !$cityModel)
		{
			$model = $provinceModel;
		}
		
		return $model;
	}
	
	/**
	 * 获取用户最后一次访问的广告栏相关信息
	 * 
	 * 备注：
	 * （1）此处所设置的cookie['area']与RegionControll::actionView所共用，
	 * RegionController::actionView()记录用户最后一次更换查看广告栏信息，并记入cookie['area']中
	 * （2）此处存在一个问题：如果用当前访问用户没有注册且该用户所在地广告栏没有开通，此时显示全网更新数据
	 */
	public function getUserArea()
	{
		$pinyin = new PinYin();		
		
		$cookie =  Yii::app()->request->getCookies();	

		//获取当前地区
		$model = self::getAreaModel();
		
		$data = serialize($model->attributes);
		
		if (!isset($cookie['area']))
		{		
		
//			$model = Region::model()->findByPk(418);
			
			// 设置cookie信息
			$cookies = new CHttpCookie('area', $data);
			$cookies->expire = time() + 60*60*24*30;
			Yii::app()->request->cookies['area'] = $cookies;

		}
	
		$info = unserialize($cookie['area']->value);
		
//		UtilHelper::writeToFile($info);
	
		try {
//			$info['region'] = mb_substr($info['region'], 0, 2, 'utf-8');
			$info['region'] = UtilHelper::strSlice($info['region'], 0, 2, 'utf-8', false);
			
			$info['short'] = $pinyin->words2Short($info['region']);
		
			if (!$info['short'])
				$info['short'] = $pinyin->words2Short('悦珂');			
			
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	
		return json_decode(json_encode($info));
		
		
	}
	
	/**
	 * 根据用户获取广告栏名称
	 * Region $id
	 * 
	 * @注：如果第三级地名为“市辖区”，则获取上级市名称
	 */
	public function getAreaName($id)
	{
		$result = '';		
		
		$region = Region::model()->getRegionModel($id);

		
		if ($region->region == '市辖区')
		{
			$result = Region::model()->getRegion($region->pid);
		}
		else 
		{
			$result = $region->region;
		}	
	
		return $result;
		
	}
	
	/**
	 * User $user
	 * 获取广告牌简称,即只取地区名的前两个字作为地区广告牌名称
	 */	
	public function getAreaBrandName($id)
	{
		$region = self::model()->getAreaName($id);
		
		return UtilHelper::strSlice($region, 0, 2, 'utf-8', false);	
		
	}
	
	/**
	 * 
	 */
	public function getAreaBrandNameByUser($id)
	{
		$user = User::model()->findByPk($id);
		
		return self::model()->getAreaBrandName($user->profiles->county);
	}
	
	/**
	 * 获取广告简写
	 * @param unknown_type $id
	 */
	public function getAreaBrandShortName($id)
	{
		$pinyin = new PinYin();
		
		return $pinyin->words2Short(self::getAreaBrandName($id));		
	}
	
	
	
	public function getInputRegionType($type)
	{
		switch ($type){
			case self::COUNTY:
				return '县级地区';
			case self::VILLAGE;
				return '乡（镇)级地区';
		}
		
	}
	
	public function generateRegionType()
	{
		return array(
			self::COUNTY => self::getInputRegionType(self::COUNTY),
			self::VILLAGE => self::getInputRegionType(self::VILLAGE)
		);
	}
	
	public function generateProvince($id)
	{
		$result = array();
		
		$region = Region::model()->findAll(array(
			'condition'=>'pid = '.$id
		));
		
		foreach ($region as $data)
		{
			$result[$data->id] = $data->region;
		}
		
		return $result;
	}
	
	public function generateRegionLinks($id, $link=null,$htmlOptions=array(),$addMore=true)
	{
		$links = '';
		
		$result = array();
		
		$result = self::generateProvince($id);
		
		foreach ($result as $key=>$value)
		{
			$htmlOptions['id'] = $key;
			$links .= CHtml::link($value,array($link,'id'=>$key), $htmlOptions);
		}
		
//		UtilHelper::writeToFile($links);
		if ($addMore)
			$links .= '<br />如果这里没有你需要的地址，点这里'.CHtml::link('添加','javascript:void();',array('style'=>'border:none;','onclick'=>'addRegion();return false;') );
			
		return $links;
		
		
	}
	
	public function getRegionModel($id)
	{
		return self::model()->findByPk($id);
	}
	
	public function getRegion($id)
	{
		return self::getRegionModel($id)->region;
	}
	
	/**
	 *根据名称获取省份Model
	 * @param unknown_type $name
	 */
	public function getProvinceByName($name)
	{
		$criteria = new CDbCriteria(array(
			'condition'=>'pid = 0'
		));
		
		$criteria->addSearchCondition('region', $name);
		
		return self::model()->find($criteria);
		
	}
	
	/**
	 * 根据名称来获取市级Model
	 */
	public function getManicipalByName($name, $pid)
	{
		$criteria = new CDbCriteria(array(
			'condition'=>'pid = 22',
//			'params'=>array(
//				':pid'=>$pid
//			)
		));
		
		$criteria->addSearchCondition('region', $name);
		
		return self::model()->find($criteria);		
	}
	
	/**
	 * 检验当前id对应地区是否已经
	 * @param unknown_type $id
	 */
	public function getRegionForerunnerId($id)
	{
		$model = self::getRegion($id);
		
		return $model->forerunner;
	}
	
	/**
	 * 检验用户是否为注册地区的先行者
	 * 
	 * 
	 * @param User $user
	 */
	public function checkForerunner($user)
	{
		
	}
	
	/**
	 * 开启当前注册人所在地广告栏
	 */
	public function addForerunner($user,$region)
	{
		$regions = explode('-', $region);
		
		foreach ($regions as $area)
		{
			$area = intval($area);
			
			$model = Region::model()->find(array(
				'condition'=>'id = :id AND forerunner IS NULL',
				'params'=>array(
					':id'=>$area
				)
			));
			
//			UtilHelper::dump($model->attributes);
			

			
			if ($model)
			{
				$model->forerunner = $user->id;
				
				if (!$model->save())
					UtilHelper::writeToFile(CHtml::errorSummary($model));
			}
		}
	}
}