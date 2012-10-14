<?php

/**
 * This is the model class for table "{{channel}}".
 *
 * The followings are the available columns in table '{{channel}}':
 * @property integer $id
 * @property string $name
 * @property integer $weight
 * @property integer $type
 * @property integer $cover
 * @property string $description
 * @property string $charge
 * @property integer $hasAD
 * @property integer $pid
 * @property integer $uid
 *
 * The followings are the available model relations:
 * @property Advertisement[] $advertisements
 * @property File $cover0
 * @property User $u
 */
class Channels extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Channels the static model class
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
		return '{{channel}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, weight, type, description, charge, hasAD, pid, uid', 'required'),
			array('weight, type, cover, hasAD, pid, uid', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>50),
			array('description', 'length', 'max'=>500),
			array('charge', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, weight, type, cover, description, charge, hasAD, pid, uid', 'safe', 'on'=>'search'),
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
			'advertisements' => array(self::HAS_MANY, 'Advertisement', 'cid'),
			'cover0' => array(self::BELONGS_TO, 'File', 'cover'),
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
			'name' => 'Name',
			'weight' => 'Weight',
			'type' => 'Type',
			'cover' => 'Cover',
			'description' => 'Description',
			'charge' => 'Charge',
			'hasAD' => 'Has Ad',
			'pid' => 'Pid',
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
		$criteria->compare('weight',$this->weight);
		$criteria->compare('type',$this->type);
		$criteria->compare('cover',$this->cover);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('charge',$this->charge,true);
		$criteria->compare('hasAD',$this->hasAD);
		$criteria->compare('pid',$this->pid);
		$criteria->compare('uid',$this->uid);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}