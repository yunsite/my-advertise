<?php

/**
 * This is the model class for table "{{advertisement}}".
 *
 * The followings are the available columns in table '{{advertisement}}':
 * @property integer $id
 * @property integer $uid
 * @property integer $cid
 * @property integer $start
 * @property integer $end
 * @property integer $theme
 * @property string $title
 * @property string $content
 * @property integer $hasimg
 * @property string $imginfo
 * @property string $tag
 * @property string $address
 * @property string $phone
 * @property string $adusername
 * @property integer $pubdate
 * @property integer $moddate
 * @property integer $online
 *
 * The followings are the available model relations:
 * @property User $u
 * @property Adtheme $theme0
 * @property Channel $c
 * @property Statistics[] $statistics
 */
class Advertisement extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Advertisement the static model class
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
		return '{{advertisement}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cid, title, content', 'required'),
			array('uid, cid, start, end, theme, hasimg, pubdate, moddate, online', 'numerical', 'integerOnly'=>true),
			array('title, phone, adusername', 'length', 'max'=>50),
			array('tag', 'length', 'max'=>100),
			array('address', 'length', 'max'=>250),
			array('imginfo', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, uid, cid, start, end, theme, title, content, hasimg, imginfo, tag, address, phone, adusername, pubdate, moddate, online', 'safe', 'on'=>'search'),
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
			'theme' => array(self::BELONGS_TO, 'Adtheme', 'theme'),
			'channel' => array(self::BELONGS_TO, 'Channel', 'cid'),
			'statistics' => array(self::HAS_MANY, 'Statistics', 'aid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => '自动编号',
			'uid' => '用户编号',
			'cid' => '分类编号',
			'start' => '从',
			'end' => '到',
			'theme' => '模板主题',
			'title' => '广告标题',
			'content' => '广告内容',
			'tag' => '标签',
			'address' => '广告主详细地址',
			'phone' => '广告主电话',
			'adusername' => '广告主称呼',
			'pubdate' => '创建时间',
			'moddate' => '更新时间',
			'hasimg' => '是否含有图片',
			'imginfo' => '图片信息',
			'online' => '在线人数'
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
		
//		$criteria->with = 'user';

		$criteria->compare('id',$this->id);
		$criteria->compare('uid',$this->uid);
		$criteria->compare('cid',$this->cid);
		$criteria->compare('start',$this->start);
		$criteria->compare('end',$this->end);
		$criteria->compare('theme',$this->theme);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('hasimg',$this->hasimg);
		$criteria->compare('imginfo',$this->imginfo,true);
		$criteria->compare('tag',$this->tag,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('adusername',$this->adusername,true);
		$criteria->compare('pubdate',$this->pubdate);
		$criteria->compare('moddate',$this->moddate);
		$criteria->compare('online',$this->online);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	/**
	 * 设置系统显示广告的查询条件
	 * @param unknown_type $id
	 */	
	public function setFetchCondition($length = 5)
	{
		$criteria = new CDbCriteria(array(
				'limit'=>$length,
				'order'=>'id DESC'
		));	

		return $criteria;
	}
	
	
	public function getAdvertisementByKeywords($keyword)
	{
		$result = array();
		
		$criteria = self::setFetchCondition();
		$criteria->limit = -1;
		$criteria->addSearchCondition('title', $keyword);
		$criteria->addSearchCondition('content', $keyword,true, 'OR');

		
//		UtilHelper::writeToFile($criteria);
		
		$model = self::model()->findAll($criteria);
		
		foreach ($model as $item)
		{
			$result[] = $item->title;
		}
		
//		UtilHelper::writeToFile($result,'a+');
		
		return $result;
		
	}
	public function getAdvertisementModel($id)
	{
		$model = Yii::app()->cache->get('getAdvertisementModel_'.$id);
		
		if ($model === false)
		{
			$model = self::model()->findByPk($id);
			Yii::app()->cache->set('getAdvertisement_'.$id, $model);
		}
		
		return $model;
	}
	
	public function getValidateAdvertisement()
	{
		return self::model()->find(self::setFetchCondition());
	}
	
	/**
	 * 根据系统要求显示广告信息
	 * Enter description here ...
	 */	
	public function getValidateAdvertisements($length = 5)
	{

		$criteria = self::setFetchCondition($length);
		
		$data = self::model()->findAll($criteria);
		
		return $data;
	}
	
	//获取上一个项目
	public function getPreviewAdvertisementt($id)
	{
		$criteria = self::setFetchCondition(1);
		$criteria->select = 'id, title';
		$criteria->addCondition('id < :id');
		$criteria->params[':id'] = $id;		
		
//		UtilHelper::dump($criteria);
		
		$data = self::model()->find($criteria);
		
		return $data;
	}
	
	//获取下一个项目
	public function getNextAdvertisementt($id)
	{
		$criteria = self::setFetchCondition(1);
		$criteria->select = 'id, title';
		$criteria->addCondition('id > :id');
		$criteria->order = 'id ASC';
		$criteria->params[':id'] = $id;		
		$data = self::model()->find($criteria);
		return $data;
	}	
	public function getCachedInfo($criteria, $uniqueId)
	{
		$data = Yii::app()->cache->get($uniqueId);
		
		if ($data === false)
		{
			$data = Advertisement::model()->findAll($criteria);

			Yii::app()->cache->set($uniqueId, $latestInfo, 3600, new CDbCacheDependency("SELECT MAX(id) FROM {{advertisement}}"));
		}
		
		return $data;
	}
	
	public function getAdvertisements()
	{
		$result = array();
		
		$criteria = new CDbCriteria(array(
			'order' => 'id DESC',
			'limit' => 10

		));
		
		$result = self::model()->findAll($criteria);
		
		return $result;		
		
	}
	
	public function getAdvertisementExpired($time)
	{
		$result = '';	
		$remainDate = $time - time();	
		
		$oneday = 60*60*24;
		$onehour = 60*60;
		$oneminuts = 60;
		
		//天数
		$day = ceil($remainDate/$oneday);
		//剩余小时
		$remainHours = fmod($remainDate, $oneday);
		$hour = ceil($remainHours/$onehour);
		//剩余分钟
		$remainMinuts = fmod($remainDate, $onehour);
		$minuts = ceil($remainMinuts/$oneminuts);
		//剩余秒数
		$seconds = fmod($remainDate, $oneminuts);
		
		if ($remainDate > 0){
			$result = '还有'.$day.'天'.$hour.'小时'.$minuts.'分'.$seconds.'秒';
		}else {
			$result = '此信息已经过期';
		}
		
		return $result;
	}
	
	
	/**
	 * @todo 根据广告ID生成页面标题 
	 * @param unknown_type $id
	 */
	public function generatePageTitle($id, $isListPage = false)
	{
		$result = array();	
		
		//列表页面
		if ($isListPage)
		{
			$channel = Channel::model()->findParent($id);
			
			foreach ($channel as $item)
			{
				$result[$item['name']] = array('/info/list','id'=>$item['id'],'t'=>urlencode($item['name']));
			}	

			$result = array_reverse($result);
		}
		else //详细页面
		{
			$model = self::getAdvertisementModel($id);	
			
			$channel = Channel::model()->findParent($model->cid);
			
			foreach ($channel as $item)
			{
				$result[$item['name']] = array('/info/list','id'=>$item['id'],'t'=>urlencode($item['name']));
			}
			
			$result = array_reverse($result);
			
			$result[$model->title] = array('/info/view', 'id'=>$model->id, 't'=>urlencode($model->title));			
		}
		

				
//		$ad = array(
//			'id'=>$model->id,
//			'pid'=>$model->cid,
//			'name'=>$model->title
//		);
//		
//		array_unshift($result, $ad);
		
		return $result;	
		
	}
	
	//生成页面标题
	function PageTitleArray2String($id)
	{
		$result[] = Region::model()->getUserArea()->region.'广告栏';
		
		$arr = self::generatePageTitle($id);
		
		foreach ($arr as $key=>$val)
		{
			$result[]= $key;
		}
		
		$result = array_reverse($result);
		
		return implode('-', $result);
	 	
	}
	
	/**
	 * 根据内容是否含有图片
	 * 显示发布的广告信息
	 * Enter description here ...
	 * @param unknown_type $isImage
	 */
	public function getAdvertisementSize($isImage = true)
	{
		$criteria = new CDbCriteria(array(
		
		));
		if ($isImage)
			$criteria->addCondition('hasimg = 1');
		else 
			$criteria->addCondition('hasimg != 1');
		
		$num = Advertisement::model()->count($criteria);			
		
		return ceil($num/4);
	}
	
	/**
	 * 获取相关广告的第一张内容
	 * @param unknown_type $string
	 */
	public function getAdvertismentFolder($string)
	{
		$images = json_decode($string);
		
		return $images[0];
	}
	
	/**
	 * 以下为数据统计相关
	 */
	public function getAdvertisementArchiver()
	{
		$cacheid = 'advertisementArchiver';
		$temp = $result = array();
		
		$result = Yii::app()->cache->get($cacheid);
		
		if ($result === false)
		{
			$criteria = new CDbCriteria(array(
				'select'=>'pubdate',
				'order'=>'pubdate DESC'
			));
			
			$model = Advertisement::model()->findAll($criteria);
			
			foreach ($model as $data)
			{
				$temp[] = $data->pubdate;
			}
			
			if (is_array($temp))
			{
				foreach ($temp as $time)
				{
					$y = gmdate('Y', $time);
					$m = gmdate('n', $time);
					
					$result[$y][$m] += 1;
				}
			}	

			Yii::app()->cache->set($cacheid, $result, 3600, new CDbCacheDependency('SELECT MAX(id) FROM {{advertisement}}'));
		}
		
		return $result;

	}
	
	
	/**
	 * (non-PHPdoc)
	 * @see CActiveRecord::beforeSave()
	 */
	public function beforeSave()
	{
		if(parent::beforeSave())
		{
			if($this->isNewRecord)
			{
				$this->uid = Yii::app()->user->id;
				$this->pubdate = time();
				$this->moddate = time();
				$this->online = 0;
			}
			else 
			{
				$this->moddate = time();
			}
			return true;	
		}
		else
			return false;
	}
}