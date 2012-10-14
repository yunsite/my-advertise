<?php

/**
 * This is the model class for table "{{template}}".
 *
 * The followings are the available columns in table '{{template}}':
 * @property integer $id
 * @property string $name
 * @property string $cname
 * @property string $code
 * @property integer $sorttype
 * @property integer $owner
 * @property integer $pubdate
 *
 * The followings are the available model relations:
 * @property Style[] $styles
 * @property User $owner0
 * @property Theme[] $themes
 * @property Theme[] $themes1
 */
class Template extends CActiveRecord
{ 
        
	const ADVERTISEMENT_TEMPLATE = 1;	//广告模板
    const CARD_TEMPLATE = 2;    //名片模板    
	const NOTE_TEMPLATE = 3; 		//广告摘要模板
    const EMAIL_TEMPLATE = 4;		//邮件模板
    
	/**
	 * Returns the static model of the specified AR class.
	 * @return Template the static model class
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
		return '{{template}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, cname, code, sorttype', 'required'),
			array('sorttype, owner, pubdate', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>50),
			array('cname', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, cname, code, sorttype, owner, pubdate', 'safe', 'on'=>'search'),
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
			'styles' => array(self::HAS_MANY, 'Style', 'template'),
			'owner0' => array(self::BELONGS_TO, 'User', 'owner'),
			'themes' => array(self::HAS_MANY, 'Theme', 'tid'),
			'themes1' => array(self::HAS_MANY, 'Theme', 'sid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => '模板名称',
            'cname' => '模板别名',
			'code' => '模板代码',
			'sorttype' => '模板分类',
			'owner' => '发布人',
			'pubdate' => '发布时间',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('cname',$this->cname,true);
		$criteria->compare('code',$this->code,true);
		$criteria->compare('sorttype',$this->sorttype);
		$criteria->compare('owner',$this->owner);
		$criteria->compare('pubdate',$this->pubdate);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
    /**
     * @param CActiveRecord $model
     **/ 
    public function getModelAttributes($model)
    {
        $result = array();
        $attributes = $model->attributeLabels();
        
 //       UtilHelper::dump($attributes);
        
        foreach($attributes as $key=>$value)
        {
            $result[$value] = get_class($model).'.findByPk.'.$key.'|pk=:id';
        }
        
        return $result;
    }
    
    /**
     * 设置广告数据模板
     **/
    private function getAdvertiseDataTemplate()
    {
        return array_merge(self::getModelAttributes(new Advertisement),array(
            '作者'=>'Advertisement.findByPk.user->username|pk=:id'
        ));
    }

    /**
     * 设置名片数据模板
     **/
    private function getCardDataTemplate()
    {
        return array_merge(self::getModelAttributes(new User),array(
            '真实姓名'=>'Profile.getUserTureName|id=:id',
            '用户妮称'=>'Profile.getUserNickName|id=:id',
            '电子邮件'=>'User.findByPk.profiles->email|pk=:id',
            '住址'=>'Profile.getUserAddress|id=:id'
        ));
    }    

    /**
     * 设置广告摘要数据模板
     **/
    private function getNoteDataTemplate()
    {
        return self::getAdvertiseDataTemplate();
    }   
    
    /**
     * 设置广告数据模板
     **/
    private function getEmailDataTemplate()
    {
        return self::getCardDataTemplate();
                
    } 
    
    /**
     * 根据类型，获取数据模板
     **/ 
    public function getDataTemplate($sorttype)
    {
        switch($sorttype)
        {
            case self::ADVERTISEMENT_TEMPLATE:
                return self::getAdvertiseDataTemplate();
                break;
            case self::EMAIL_TEMPLATE:
                return self::getEmailDataTemplate();
                break;
            case self::NOTE_TEMPLATE:
                return self::getNoteDataTemplate();
                break;
            case self::CARD_TEMPLATE:
                return self::getCardDataTemplate();
                break;
        }
        
    }
    
    public function generateTemplateData()
    {
        return Yii::app()->params['template'];
        
    }
    
    public function getSortTypeName($index)
    {
        switch($index)
        {
            case self::ADVERTISEMENT_TEMPLATE:
                return '广告模板';
                break;
            case self::CARD_TEMPLATE:
                return '名片模板';
                break;
            case self::NOTE_TEMPLATE:
                return '摘要模板';
                break;
            case self::EMAIL_TEMPLATE:
                return '邮件模板';
                break;
            
        }
    }
    
    public function generateSortTypeList()
    {
        return array(
            self::ADVERTISEMENT_TEMPLATE => self::getSortTypeName(self::ADVERTISEMENT_TEMPLATE),
            self::EMAIL_TEMPLATE => self::getSortTypeName(self::EMAIL_TEMPLATE),
            self::NOTE_TEMPLATE => self::getSortTypeName(self::NOTE_TEMPLATE),
            self::CARD_TEMPLATE => self::getSortTypeName(self::CARD_TEMPLATE)

        );
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

				$this->owner = Yii::app()->user->id;
				$this->pubdate = time();
	
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