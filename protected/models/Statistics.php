<?php

/**
 * This is the model class for table "{{statistics}}".
 *
 * The followings are the available columns in table '{{statistics}}':
 * @property integer $id
 * @property integer $aid
 * @property integer $uid
 * @property integer $ip
 * @property integer $starttime
 * @property integer $endtime
 * @property string $terminal
 * @property string $refer
 *
 * The followings are the available model relations:
 * @property User $user
 * @property Advertisement $advertisement
 */
class Statistics extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Statistics the static model class
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
		return '{{statistics}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('aid, ip, starttime, terminal', 'required'),
			array('aid, uid, ip, starttime, endtime', 'numerical', 'integerOnly'=>true),
			array('terminal, refer', 'length', 'max'=>250),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, aid, uid, ip, starttime, endtime, terminal, refer', 'safe', 'on'=>'search'),
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
			'advertisement' => array(self::BELONGS_TO, 'Advertisement', 'aid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'aid' => 'Aid',
			'uid' => 'Uid',
			'ip' => 'Ip',
			'starttime' => 'Starttime',
			'endtime' => 'Endtime',
			'terminal' => 'Terminal',
			'refer' => 'Refer',
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
		$criteria->compare('aid',$this->aid);
		$criteria->compare('uid',$this->uid);
		$criteria->compare('ip',$this->ip);
		$criteria->compare('starttime',$this->starttime);
		$criteria->compare('endtime',$this->endtime);
		$criteria->compare('terminal',$this->terminal,true);
		$criteria->compare('refer',$this->refer,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function getAllModels($criteria=array(),$sign='')
	{
		$cacheid = 'statistics_all_model_'.$sign;
		
		$model = Yii::app()->cache->get('statistics_all_model');
		
		if ($model === false)
		{
			$model = self::model()->findAll($criteria);
			
			Yii::app()->cache->set($cacheid, $model, 3600, new CDbCacheDependency("SELECT MAX(id) FROM {{statistics}}"));
		}
		
		return $model;
	}
	
	/**
	 * 获取访问者头像
	 * 策略：
	 * a:如是要用户则直接使用自己上传的头像
	 * b:如果是游客则根据IP地址使用系统提供的相应头像
	 * @param unknown_type $id
	 */
	public function getVisitorHeaders($id)
	{
		
	}
	
	
	
	/**
	 * 用户开始进入某页面，添加相关信息
	 * @param unknown_type $id
	 */
	public function visitStart($id, $refer)
	{
		try {
			$ip = ip2long(UtilNet::getClientIp());				
			
			$model = Statistics::model()->find(array(
				'condition'=>'ip = :ip AND aid = :aid AND refer = :refer AND UNIX_TIMESTAMP( )-starttime<:interval',
				'order' => 'id DESC',
				'params'=>array(
					':ip'=>$ip,
					':aid'=>$id,
					':refer'=>$refer,
					':interval'=>180
				)
			));			
			
			UtilHelper::writeToFile($model->attributes);
			
			if ($model)
			{
				$model->endtime = time();
				
//				UtilHelper::writeToFile(array_merge(array('提示'=>'更新'), $model->attributes), 'a+');
				
				if ($model->save())
				{
					echo $model->id;
				}
			}
			else 
			{
				$model = new Statistics();
				$model->aid = $id;
				$model->ip = $ip;
				$model->starttime = time();
				
				if (!Yii::app()->user->isGuest)
					$model->uid = Yii::app()->user->id;
					
				$model->terminal = $_SERVER['HTTP_USER_AGENT'];
				$model->refer = $refer;		
//				UtilHelper::writeToFile(array_merge(array('提示'=>'新加入数据'), $model->attributes), 'a+');

				if ($model->save())
				{
					echo $model->id;
				}
			}
				
			UtilHelper::writeToFile(CHtml::errorSummary($model), 'a+');
				

		}catch (Exception $e) {
			
			echo $e->getMessage();
		}
	}
	
	
	/**
	 * 用户结束访问某页面时，添加相关访问信息
	 * @param unknown_type $id
	 * @param unknown_type $interval
	 */
	public function visitEnd($id)
	{
		$model = Statistics::model()->findByPk($id);
		
		$model->endtime = time();
		
		if (!$model->save())
		{
			UtilHelper::writeToFile(CHtml::errorSummary($model), 'a+');
		}
		else 
		{
			echo "OKK";
		}		

	}	
	
	/**
	 * 统计数据优化：
	 * 由于在统计的时候会出现以下一系列的意外情况：
	 * a.刷新页面：这会导致在统计的时候重复统计
	 * b.用户关闭页面或浏览器DOWN掉之类情况：此时会导致统计不到关闭是的相关数据（endtime<关闭时间>）
	 * c.Google chrown和Safri不能捕捉到关闭浏览器和网页标签事件
	 * 优化主要从以下几个方面来做：
	 * a.对于刷新导致的重复数据进行合并
	 * b.忽略关闭页面等意外情况下的数据
	 * 
	 * 下面为需要处理的问题及相应初步的计算公式
	 * a.需要统计每个页面的浏览总次数：COUNT(Statistics.aid) - 
	 * b.需要统计每个页面的浏览时长：根据数据情况进行分组，选择相应组距
	 * c.需要统计每个页面的当前在线人数：Advertisement.online - 今日的Statistics.aid<time() - Statistics.startTime > 600>
	 * SQL: SELECT * FROM Statistics WHERE endtime IS NULL AND NOW()-endtime > 600 
	 *  
	 */
	public function optimizationStatistics()
	{
		
	}
	/**
	 * 根据id获取该文的浏览量，访问人数，当前在线人数
	 */
	
	/**
	 * 
	 */
	
	/**
	 * 看过某广告的所有人，除作者本人
	 * @param Advertisement $model
	 */
	public function historyViewStatistics($model)
	{
		$ids = array();
		foreach ($model->statistics as $data)
		{
			if ($data->uid && $data->uid != $model->uid)
				$ids[] = $data->uid;
		}
		//去除重复值
		$ids = array_unique($ids);

		echo $id.'---'.$model->uid;
		
		return $ids;
	}
	
	/**
	 * 当前在线人数
	 */
	public function onlineStatistics()
	{
		return Sessions::model()->count();
	}
	
	/**
	 * 当前某一页面在线人数统计
	 * 
	 */
	
	public function pageOnlineStatistics($id)
	{
		$result = array();
		
		$model = Statistics::model()->findAll(array(		
			'select'=>'uid, endtime',
			'condition'=>'aid = :aid AND endtime IS NULL AND UNIX_TIMESTAMP()-starttime < :time',
			'params'=>array(
				':aid'=>$id,
				':time' => 360
			)
		
		));
		foreach ($model as $data)
		{
			if (!in_array($data->uid, $result))
				$result[] = $data->uid;
			
			
		}
		return $result;
		
	}
	
	/**
	 * 某一页面在线时长统计
	 */
	public function pageOnlineLongStatistics($id)
	{
		
	}
	
	/**
	 * 某一页面的访问总次数
	 */
	public function pageStatistics($id) 
	{
		
	}
	
	public function agentStatistics()
	{
		$result = array();
		
		$model = Statistics::model()->findAll();
		
		foreach ($model as $data)
		{
			$agent = $data->terminal;
			
			$browser = new Browser();
			$browser->setUserAgent($agent);
			
			$browserinfo = str_replace(array(' ','.'), array('_','-'), $browser->getBrowser());
			$version =  str_replace(array(' ','.'), array('_','-'),$browser->getVersion());
			$platform = str_replace(array(' ','.'), array('_','-'),$browser->getPlatform());
//			$aolversion = str_replace(array(' ','.'), array('_','-'),$browser->getAolVersion());
			
			$result['Agent'][$browserinfo][$version] += 1;			
			$result['Platform'][$platform] += 1;			
	
			
		}		
		
		return $result;
	}
	
	public function getAllRegionInfo()
	{
		$result = array();
		
		$file = Yii::app()->params->visitIpPath;
		
		if (!file_exists($file))
		{
			$this->actionRewriteRegion();
		}		
		
		$ips = file($file);
		
		foreach ($ips as $ip)
		{
			$string =explode("\t", $ip);
			
			if ($string[0])			
			{
				$result['Country'][$string[0]] += 1;
			}	
			
			if ($string[0] == '中国')
			{
				$county = str_replace("\r\n", '', $string[2]);
				
				$result['Region'][$string[1]][$county] += 1;
			}

		}
		
		return $result;
	}
	
	public function getRegisterInfo()
	{
		$id = 'statistics_register_info';
		$register = Yii::app()->cache->get($id);
		
		if ($register === false)
		{
			$register = User::model()->findAll(array(
				'select'=>'created',
				'order'=>'created DESC'
			));
			
			Yii::app()->cache->set($id, $register, 3600, new CDbCacheDependency('SELECT MAX(id) FROM {{user}}'));
		}		
		
		return $register;
	}
	
	public function getSPaceInfo()
	{
		$id = 'statistics_space';
		$result = Yii::app()->cache->get($id);
		
		if ($result === false)
		{
			$directory = UtilHelper::getDirectorySize('./');		
			$all = $directory['size'];
			
			$directory = UtilHelper::getDirectorySize('./public/uploadfiles');		
			$uploadfiles = $directory['size'];
	
			$directory = UtilHelper::getDirectorySize('./public/uploads');
			$uploadimage = $directory['size'];
			
			$upload = $uploadfiles + $uploadimage;
			
			$system = $all - $upload;
			
			$free = Yii::app()->params->fullSpace - $all;
			
			$result = array(
				'all'=>$all,
				'upload'=>$upload,
				'system'=>$system,
				'free'=>$free
			);		

			Yii::app()->cache->set($id, $result, 36000, new CDirectoryCacheDependency('./public'));
		}
		
		return $result;
	}
}