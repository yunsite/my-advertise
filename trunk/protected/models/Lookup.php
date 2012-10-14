<?php

/**
 * This is the model class for table "{{lookup}}".
 *
 * The followings are the available columns in table '{{lookup}}':
 * @property integer $id
 * @property integer $uid
 * @property integer $type
 * @property string $name
 * @property string $ename
 * @property integer $weight
 * @property integer $cover
 * @property string $description
 *
 * The followings are the available model relations:
 * @property Channel[] $channels
 * @property File[] $files
 * @property User $user
 */
class Lookup extends CActiveRecord
{
	const CHANNEL_TYPE = 1;		//设置频道
	const SYSTEM_SETTING = 2;	//系统设置
	const USER_SETTING = 3;		//用户设置
	const USER_PIC_FOLDER = 4;	//用户图片集
	const USER_ADVERTISEMENT_PIC_FOLDER = 5;	//用户广告所用图片集
    const USER_ADTHEME_PIC_FOLDER = 6;  //用户主题图片集
	
	/**
	 * Returns the static model of the specified AR class.
	 * @return Lookup the static model class
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
		return '{{lookup}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('type, name, ename, weight, description', 'required'),
			array('uid, type, weight, cover', 'numerical', 'integerOnly'=>true),
			array('name, ename', 'length', 'max'=>30),
			array('description', 'length', 'max'=>500),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, uid, type, name, ename, weight, cover, description', 'safe', 'on'=>'search'),
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
			'channels' => array(self::HAS_MANY, 'Channel', 'type'),
			'files' => array(self::HAS_MANY, 'File', 'pid'),
			'user' => array(self::BELONGS_TO, 'User', 'uid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'uid' => 'Uid',
			'type' => 'Type',
			'name' => 'Name',
			'ename' => 'Ename',
			'weight' => 'Weight',
			'cover' => 'Cover',
			'description' => 'Description',
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
		$criteria->compare('type',$this->type);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('ename',$this->ename,true);
		$criteria->compare('weight',$this->weight);
		$criteria->compare('cover',$this->cover);
		$criteria->compare('description',$this->description,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function generateChannels()
	{
		$result = array();
		
		$model = self::model()->findAll(array(
			'condition'=>'type = :type',
			'order'=>'id DESC',
			'params'=>array(
				':type'=>self::CHANNEL_TYPE
			)
		));
		
		if ($model !== null)
		{
			foreach ($model as $channel)
			{
				$result[$channel->id] = $channel->name;
			}
		}
		
		return $result;
		
	}
	
	public function getLookUpItem($type)
	{
		switch ($type){
			case self::USER_PIC_FOLDER:
				return '用户图集包';
			case self::SYSTEM_SETTING:
				return '系统设置';
			case self::USER_SETTING:
				return '用户自定义';
            case self::USER_ADVERTISEMENT_PIC_FOLDER;
                return '文章图片';
            case self::USER_ADTHEME_PIC_FOLDER;
                return '主题图集';
		}
	}
	
	public function generateLookUpItemList()
	{
		return array(
			self::SYSTEM_SETTING => self::getLookUpItem(self::SYSTEM_SETTING),
			self::USER_SETTING => self::getLookUpItem(self::USER_SETTING),
			self::CHANNEL_TYPE => self::getLookUpItem(self::CHANNEL_TYPE),
            self::USER_ADVERTISEMENT_PIC_FOLDER=>self::getLookUpItem(self::USER_ADVERTISEMENT_PIC_FOLDER),
            self::USER_ADTHEME_PIC_FOLDER=>self::getLookUpItem(self::USER_ADTHEME_PIC_FOLDER)
		);
	}
	
	/**
	 * 获取用户默认的图片上传目录信息
	 * @param unknown_type $userID
	 */
	public function getUserDefaultAlbum($userID)
	{
//		$model = Lookup::model()->find(array(
//			'condition'=>'uid = :uid AND type = :type',
//			'params'=>array(
//				':uid'=>$userID,
//				':type'=>Lookup::USER_PIC_FOLDER
//			)
//		));
//		
//		if ($model == null)
//		{
//			$model = new Lookup();
//			$model->type = Lookup::USER_PIC_FOLDER;
//			$model->name = '默认图册';
//			$model->ename = Yii::app()->user->name.'_defaultAlbum';
//			$model->weight = 1;
//			$model->description = '我的默认图册';
//			
//			$model->save();
//		}

		$model = self::getUserAlbum($userID, '默认图册', Lookup::USER_PIC_FOLDER);
		
		return $model;
		
	}
	
	/**
	 * 获取用户广告内容中所上传图片信息
	 */
	public function getUserAdvertisementAlbum($userID)
	{
		$model = self::getUserAlbum($userID, '广告图集', Lookup::USER_ADVERTISEMENT_PIC_FOLDER);
		
		return $model;
	}
    
    /**
     * 获取用户制作的主题封面图片信息
     */
     public function getUserAdThemeAlbum($userID)
     {
        $model = self::getUserAlbum($userID, '主题封面',Lookup::USER_ADTHEME_PIC_FOLDER);
        return $model;
     }
	
	/**
	 * 获取用户图片上传目录信息
	 */
	private function getUserAlbum($userID, $name,$type)
	{
		$model = Lookup::model()->find(array(
			'condition'=>'uid = :uid AND type = :type',
			'params'=>array(
				':uid'=>$userID,
				':type'=>$type
			)
		));
		
		if ($model == null)
		{
			$model = new Lookup();
			$model->type = $type;
			$model->name = $name;
			$model->ename = Yii::app()->user->name.'_'.ucfirst(UtilHelper::words2PinYin($name)).'Album';
			$model->weight = 1;
			$model->description = $name.'相关图册';
			
			$model->save();
		}
		
		return $model;
		
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
			}
			return true;	
		}
		else
			return false;
	}
}