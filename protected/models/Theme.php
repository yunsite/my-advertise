<?php

/**
 * This is the model class for table "{{theme}}".
 *
 * The followings are the available columns in table '{{theme}}':
 * @property integer $id
 * @property string $name
 * @property integer $style
 * @property string $html
 * @property string $javascript
 * @property string $css
 * @property string $charge
 * @property integer $folder
 * @property integer $owner
 * @property integer $pubdate
 * @property integer $times
 *
 * The followings are the available model relations:
 * @property Advertisement[] $advertisements
 * @property File $themefolder
 * @property User $owner
 */
class Theme extends CActiveRecord
{
    
    const STYLE_FESTIVAL = 1;   //节日类型
    const STYLE_FRESH = 2;      //清新类型
    const STYLE_FASHION = 3;    //时尚
    const STYLE_CLASSIC = 4;    //古典
    const STYLE_NATURAL = 5;    //自然
    const STYLE_SIMPLE = 6;     //简约
	/**
	 * Returns the static model of the specified AR class.
	 * @return Theme the static model class
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
		return '{{theme}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, style, html, javascript, css, charge, folder', 'required'),
			array('style, folder, owner, pubdate, times', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>50),
			array('charge', 'length', 'max'=>5),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, style, html, javascript, css, charge, folder, owner, pubdate, times', 'safe', 'on'=>'search'),
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
			'advertisements' => array(self::HAS_MANY, 'Advertisement', 'theme'),
			'themefolder' => array(self::BELONGS_TO, 'File', 'folder'),
			'owner' => array(self::BELONGS_TO, 'User', 'owner'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'style' => 'Style',
			'html' => 'Html',
			'javascript' => 'Javascript',
			'css' => 'Css',
			'charge' => 'Charge',
			'folder' => 'Folder',
			'owner' => 'Owner',
			'pubdate' => 'Pubdate',
			'times' => 'Times',
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
		$criteria->compare('style',$this->style);
		$criteria->compare('html',$this->html,true);
		$criteria->compare('javascript',$this->javascript,true);
		$criteria->compare('css',$this->css,true);
		$criteria->compare('charge',$this->charge,true);
		$criteria->compare('folder',$this->folder);
		$criteria->compare('owner',$this->owner);
		$criteria->compare('pubdate',$this->pubdate);
		$criteria->compare('times',$this->times);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
    public function getStyleName($style)
    {
        switch($style){
            case self::STYLE_CLASSIC:
                return '古典';
                break;
            case self::STYLE_FASHION:
                return '时尚';
                break;
            case self::STYLE_FESTIVAL:
                return '节日';
                break;
            case self::STYLE_FRESH:
                return '清新';
                break;
            case self::STYLE_NATURAL:
                return '自然';
                break;
            case self::STYLE_SIMPLE:
                return '简约';
                break;
                
        }
    }
    
    public function generateStyleList()
    {
        return array(
            self::STYLE_CLASSIC=>self::getStyleName(self::STYLE_CLASSIC),
            self::STYLE_FASHION=>self::getStyleName(self::STYLE_FASHION),
            self::STYLE_FESTIVAL=>self::getStyleName(self::STYLE_FESTIVAL),
            self::STYLE_FRESH=>self::getStyleName(self::STYLE_FRESH),
            self::STYLE_NATURAL=>self::getStyleName(self::STYLE_NATURAL),
            self::STYLE_SIMPLE=>self::getStyleName(self::STYLE_SIMPLE)
        );
    }
    
    public function beforeSave()
    {
        if(parent::beforeSave())
		{
			if($this->isNewRecord)
			{
                $this->times = 0;
                $this->pubdate = time();
                $this->owner = Yii::app()->user->id;
			}
            
			return true;	
		}
		else
			return false;
	}        
    
}