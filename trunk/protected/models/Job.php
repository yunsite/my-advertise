<?php

/**
 * This is the model class for table "{{job}}".
 *
 * The followings are the available columns in table '{{job}}':
 * @property integer $id
 * @property integer $pid
 * @property integer $uid
 * @property string $name
 *
 * The followings are the available model relations:
 * @property User $u
 */
class Job extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Job the static model class
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
		return '{{job}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('pid, uid, name', 'required'),
			array('pid, uid', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>200),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, pid, uid, name', 'safe', 'on'=>'search'),
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
			'name' => 'Name',
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
		$criteria->compare('name',$this->name,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	/**
	 * @todo 根据学校类型及所属省份ID获取相关学校信息
	 * @param unknown_type $type
	 * @param unknown_type $pid
	 */
	public function getJobs($pid)
	{
		$model = self::model()->findAll(array(
			'condition'=>'pid = :pid',
			'params'=>array(
				':pid'=>$pid
			)
		));
		
		return $model;
	}
	public function generateJobLinks($pid, $link='', $htmlOptions=array(), $addmore = true)
	{
		$links = '';
		
		$model = self::getJobs($pid);
		
		foreach ($model as $item)
		{
			$htmlOptions['id'] = $item->id;
			$links .= CHtml::link($item->name, array($link,'id'=>$item->id), $htmlOptions);
		}
		
		UtilHelper::writeToFile($links);
		
		if ($addmore)
			$links .= '<br />如果这里没有您所从事的工作，点这里'.CHtml::link('添加','javascript:void();',array('style'=>'border:none;','onclick'=>'addRegion();return false;') );
			
		return $links;
	}
	
	public function getJob($id)
	{
		return self::model()->findByPk($id);
	}
	
	public function getJobName($id)
	{
		return self::getJob($id)->name;
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