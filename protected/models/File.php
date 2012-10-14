<?php

/**
 * This is the model class for table "{{file}}".
 *
 * The followings are the available columns in table '{{file}}':
 * @property integer $id
 * @property integer $pid
 * @property integer $uid
 * @property integer $status
 * @property integer $hits
 * @property integer $iscomment
 * @property string $name
 * @property string $tag
 * @property integer $created
 * @property integer $size
 * @property string $ext
 * @property string $mime
 * @property string $remark
 *
 * The followings are the available model relations:
 * @property Lookup $p
 * @property User $u
 */
class File extends CActiveRecord
{
	//file allow comment or not
	const FILE_COMMENT_ALLOW = 1;
	const FILE_COMMENT_CANCEL = 0;
	
	//file status	
	const FILE_STATUS_RECYCLING = 0;	//放入回收站
	const FILE_STATUS_DRAFT = 1;	//草稿
	const FILE_STATUS_PUBLISHED = 2;	//发布
	const FILE_STATUS_ACHIVE = 3;	//文件存档
	
	//file isCover
	const FILE_COVER_ALLOW = 1;	//设为封面
	const FILE_COVER_CANCEL = 0;	//取消封面设置
	
	/**
	 * Returns the static model of the specified AR class.
	 * @return File the static model class
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
		return '{{file}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('pid,', 'required'),
			array('pid, uid, status, hits, iscomment, created, size', 'numerical', 'integerOnly'=>true),
			array('name, tag, ext', 'length', 'max'=>500),
			array('mime', 'length', 'max'=>200),
			array('remark', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, pid, uid, status, hits, iscomment, name, tag, created, size, ext, mime, remark', 'safe', 'on'=>'search'),
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
			'p' => array(self::BELONGS_TO, 'Lookup', 'pid'),	//查询文件所属分类
			'u' => array(self::BELONGS_TO, 'User', 'uid'),

			'lookups' => array(self::HAS_MANY, 'Lookup', 'cover'),
			'profiles' => array(self::HAS_MANY, 'Profile', 'avatar'),
			'tags' => array(self::HAS_MANY, 'Tag', 'ico'),
		
			'channel' => array(self::BELONGS_TO, 'Channel', 'cover'),
            
            'theme'=>array(self::HAS_ONE, 'Theme', 'folder')

		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'pid' => 'Pid',
			'uid' => 'Uid',
			'status' => 'Status',
			'hits' => 'Hits',
			'iscomment' => 'Iscomment',
			'name' => 'Name',
			'tag' => 'Tag',
			'created' => 'Created',
			'size' => 'Size',
			'ext' => 'Ext',
			'mime' => 'mime',
			'remark' => 'Remark',
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
		$criteria->compare('pid',$this->pid);
		$criteria->compare('uid',$this->uid);
		$criteria->compare('status',$this->status);
		$criteria->compare('hits',$this->hits);
		$criteria->compare('iscomment',$this->iscomment);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('tag',$this->tag,true);
		$criteria->compare('created',$this->created);
		$criteria->compare('size',$this->size);
		$criteria->compare('ext',$this->ext,true);
		$criteria->compare('mime',$this->mime,true);
		$criteria->compare('remark',$this->remark,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function getFileStatus($status)
	{
		switch ($status){
			case self::FILE_STATUS_ACHIVE:
				return Yii::t('common','ACHIVE');
				break;
			case self::FILE_STATUS_DRAFT:
				return Yii::t('common','DRAFT');
				break;
			case self::FILE_STATUS_PUBLISHED:
				return Yii::t('common','PUBLISHED');
				break;
			case self::FILE_STATUS_RECYCLING:
				return Yii::t('common','TRASH');
				break;
			default:
				return 'NULL';
				break;
		}
	}
	

	public function generateFileStatusDropdownListArray()
	{
		return array(
			self::FILE_STATUS_PUBLISHED=>self::getFileStatus(self::FILE_STATUS_PUBLISHED),
			self::FILE_STATUS_ACHIVE=>self::getFileStatus(self::FILE_STATUS_ACHIVE),
			self::FILE_STATUS_DRAFT=>self::getFileStatus(self::FILE_STATUS_DRAFT),
			self::FILE_STATUS_RECYCLING=>self::getFileStatus(self::FILE_STATUS_RECYCLING),
		);
	}
	
	public function getFileCommentStatus($status)
	{
		switch ($status){
			case self::FILE_COMMENT_ALLOW:
				return Yii::t('common','ALLOW');
				break;
			case self::FILE_COMMENT_CANCEL:
				return Yii::t('common','CANCEL');
				break;
		}
	}
	
	/**
	 * 
	 * 根据模型，获取文件路径
	 * @param unknown_type $model
	 * @param unknown_type $path
	 * @param unknown_type $isUploadPath
	 * @param unknown_type $width
	 */
	public function generateFileName($model, $path,  $isUploadPath = true, $width = null)
	{
		$result = '';
		
		if ($isUploadPath)
		{
			$result = '.';
		}
		
		$result .= Yii::app()->params->uploadPath[$path];        

		$result .= date('Y',$model->created).'/'.date('m',$model->created).'/'.date('d',$model->created).'/';
		
		$result .= md5($model->name).$model->created;
		
		if ($width)
			$result .= '_';
		
		$result .= $width.'.'.$model->ext;	

		if (!is_dir(dirname($result)))
			UtilHelper::createFolder(dirname($result));
		return $result;
	}
	
	
	/**
	 * 
	 * Enter description here ...
	 * @param unknown_type $model
	 * @param unknown_type $folder
	 * @param unknown_type $width
	 * @param unknown_type $alt
	 * @param unknown_type $htmlOptions
	 */
	public function getFileByModel($model, $folder,  $width = null, $alt = '', $htmlOptions = array())
	{
		$path = self::generateFileName($model, $folder, false, $width);

		if (!file_exists('.'.$path))		
		{
			Profile::model()->generateUserAvatars($model,$width,$folder);
					
		}

		
		if (file_exists('.'.$path))
			return CHtml::image($path, $alt, $htmlOptions);	
		else 
		{	
			File::model()->deleteByPk($model->id);
			
//			return CHtml::image(Yii::app()->params->defaultAvatarPath, $alt, $htmlOptions);
		}
		
	}
	

	
	public function getMimeType($ext, $uploadType)
	{
		$download = new UtilDownLoad();
		
		if ($download->getxlq_filetype($ext))
			return $download->getxlq_filetype($ext);
		else
			return $uploadType;
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
//				$this->created = time();				
				$this->uid = Yii::app()->user->id;
				$this->status = self::FILE_STATUS_ACHIVE;
				$this->hits = 0;
//				$this->iscomment = self::FILE_COMMENT_ALLOW;
			}
			else
			{
				
			}
			return true;	
		}
		else
			return false;
	}
}