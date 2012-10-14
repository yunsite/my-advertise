<?php

/**
 * This is the model class for table "{{college}}".
 *
 * The followings are the available columns in table '{{college}}':
 * @property integer $id
 * @property string $name
 * @property integer $type
 * @property integer $province
 * @property string $homepage
 * @property integer $uid
 *
 * The followings are the available model relations:
 * @property User $u
 * @property Region $province0
 */
class College extends CActiveRecord
{
	
	const COLLEGE_TYPE_PUBEN = 0;	//普本
	const COLLEGE_TYPE_GAOZHI = 1;	//高职
	const COLLEGE_TYPE_DULI = 2;	//独立学院
	const COLLEGE_TYPE_FENXIAO = 3;	//分校
	const COLLEGE_TYPE_HIGHSCHOOL = 4;	//高中
	const COLLEGE_TYPE_PRIMARYSCHOOL = 5;	//小学
	const COLLEGE_TYPE_MIDDELSCHOOL = 6;	//初中
	
	/**
	 * Returns the static model of the specified AR class.
	 * @return College the static model class
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
		return '{{college}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, type, province', 'required'),
			array('type, province, uid', 'numerical', 'integerOnly'=>true),
			array('name, homepage', 'length', 'max'=>200),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, type, province, homepage, uid', 'safe', 'on'=>'search'),
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
			'u' => array(self::BELONGS_TO, 'User', 'uid'),
			'province0' => array(self::BELONGS_TO, 'Region', 'province'),
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
			'type' => 'Type',
			'province' => 'Province',
			'homepage' => 'Homepage',
			'uid' => 'Uid',
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
		$criteria->compare('type',$this->type);
		$criteria->compare('province',$this->province);
		$criteria->compare('homepage',$this->homepage,true);
		$criteria->compare('uid',$this->uid);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	
	/**
	 * @todo 根据学校类型及所属省份ID获取相关学校信息
	 * @param unknown_type $type
	 * @param unknown_type $pid
	 */
	public function getColleges($type,$pid)
	{
		$model = self::model()->findAll(array(
			'condition'=>'type = :type AND province = :province',
			'params'=>array(
				':type'=>$type,
				':province'=>$pid
			)
		));
		
		return $model;
	}
	
	public function generateCollegeLinks($type, $pid, $link='', $htmlOptions=array(), $addmore = true)
	{
		$links = '';
		
		$model = self::getColleges($type, $pid);
		
		foreach ($model as $item)
		{
			$htmlOptions['id'] = $item->id;
			$links .= CHtml::link($item->name, array($link,'id'=>$item->id), $htmlOptions);
		}
		
		UtilHelper::writeToFile($links);
		
		if ($addmore)
			$links .= '<br />如果这里没有你需要的学校，点这里'.CHtml::link('添加','javascript:void();',array('style'=>'border:none;','onclick'=>'addRegion();return false;') );
			
		return $links;
	}
	
	public function getCollege($id)
	{
		return self::model()->findByPk($id);
	}
	
	public function getCollegeName($id)
	{
		return self::getCollege($id)->name;
	}
	
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