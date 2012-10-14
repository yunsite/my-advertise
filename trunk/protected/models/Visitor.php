<?php

/**
 * This is the model class for table "{{visitor}}".
 *
 * The followings are the available columns in table '{{visitor}}':
 * @property integer $id
 * @property integer $aid
 * @property string $ip
 * @property integer $uid
 * @property integer $lasttime
 * @property integer $times
 * @property string $alltime
 * @property string $intervals
 * @property string $terminal
 * @property string $refer
 */
class Visitor extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Visitor the static model class
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
		return '{{visitor}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('aid, ip, lasttime, times, alltime, intervals, terminal', 'required'),
			array('aid, uid, lasttime, times', 'numerical', 'integerOnly'=>true),
			array('ip', 'length', 'max'=>30),
			array('terminal', 'length', 'max'=>500),
			array('refer', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, aid, ip, uid, lasttime, times, alltime, intervals, terminal, refer', 'safe', 'on'=>'search'),
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
			'ip' => 'Ip',
			'uid' => 'Uid',
			'lasttime' => 'Lasttime',
			'times' => 'Times',
			'alltime' => 'Alltime',
			'intervals' => 'Intervals',
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
		$criteria->compare('ip',$this->ip,true);
		$criteria->compare('uid',$this->uid);
		$criteria->compare('lasttime',$this->lasttime);
		$criteria->compare('times',$this->times);
		$criteria->compare('alltime',$this->alltime,true);
		$criteria->compare('intervals',$this->intervals,true);
		$criteria->compare('terminal',$this->terminal,true);
		$criteria->compare('refer',$this->refer,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
		/**
	 * 
	 * Get the visitor's head image
	 * @param int $ip
	 * @param array $htmlOptions
	 * @param int $gits
	 */
	public function getVisitorHead($ip, $htmlOptions = array(),$title = '', $gits = 50)
	{
				
// 		Yii::import('application.helpers.EGeoIP');
 
// 		$geoIp = new EGeoIP();
		 
// 		$geoIp->locate('182.128.111.224'); // use your IP
		 
// 		echo 'Information regarding IP: <b>'.$geoIp->ip.'</b><br/>';
// 		echo 'City: '.$geoIp->city.'<br>';
// 		echo 'Region: '.$geoIp->region.'<br>';
// 		echo 'Area Code: '.$geoIp->areaCode.'<br>';
// 		echo 'DMA: '.$geoIp->dma.'<br>';
// 		echo 'Country Code: '.$geoIp->countryCode.'<br>';
// 		echo 'Country Name: '.$geoIp->countryName.'<br>';
// 		echo 'Continent Code: '.$geoIp->continentCode.'<br>';

		Yii::import('application.components.visitors.QQWry');
		
		$id = ip2long($ip);
		
		$qqwry = new QQWry($ip);
		
		$id = abs(fmod($id, $gits));		
		
// 		UtilTools::dump($qqwry);

// 		echo $id;

// 		echo $qqwry->getDetailInfo();
		
		$str = CHtml::link(CHtml::image('/public/images/head/'.$id.'.jpg',$qqwry->getDetailInfo() , $htmlOptions),'#',array('title'=>'IP:'.$ip.',来自：'.$qqwry->getDetailInfo().','.$title));
		
// 		echo $str;
		return $str;
	}
	
	/**
	 * Add the visitor who have read this blog
	 * @param int $id
	 */
	public function addArticleVisitorInfo($id, $interval)
	{
		$ip = UtilNet::getClientIp();

// 		echo $ip;
		
		
		
//		$qq = new QQWry(long2ip($ip));
//		echo $qq->getDetailInfo();
		
		$visitorInfo = Visitor::model()->find('ip = :ip AND aid = :aid',array(
			':ip' => $ip,
			':aid' => $id
		));
		
// 		UtilHelper::dump($visitorInfo->attributes);
		
		
		if ($visitorInfo)
		{
			$visitorInfo->lasttime = time();
			$visitorInfo->times++;
			$visitorInfo->alltime .= '|'.time();
			$visitorInfo->intervals .= '|'.$interval;
			
			if (!Yii::app()->user->isGuest)
				$visitorInfo->uid = Yii::app()->user->id;
			
 			UtilHelper::writeToFile($visitorInfo->attributes);
		
//			Yii::app()->end();
			
			try {
				$visitorInfo->save();
				
			}catch (Exception $e){
				
		
				UtilHelper::dump($e);
				
			}
			
		}
		else 
		{
			$visitorInfo = new Visitor();
			$visitorInfo->aid = $id;
			$visitorInfo->ip = $ip;
			$visitorInfo->lasttime = time();
			$visitorInfo->times = 1;
			$visitorInfo->intervals = $interval;
			
			if (!Yii::app()->user->isGuest)
				$visitorInfo->uid = Yii::app()->user->id;
			
			$visitorInfo->alltime = time();
			$visitorInfo->refer = $_SERVER['HTTP_REFERER'];

			$visitorInfo->terminal = $_SERVER['HTTP_USER_AGENT'];
			
 			UtilHelper::writeToFile($visitorInfo->attributes);
//			Yii::app()->end();
			
			if ($visitorInfo->save()){
// 				echo "OK";
			}
			else 
			{
//				echo "Fail";
			}
			
			
		}
		
		
	}
	
	
	/**
	 * 
	 * Get the visitors who have read this blog
	 * @param int $id
	 */
	public function getArticleVisitors($id)
	{
		$model = self::model()->findAll(array(
					'condition'=>'aid = '.$id,
					'order' => 'lasttime DESC'
				));
		
		UtilHelper::dump($model);
		
		return $model;
	}
	
}