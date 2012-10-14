<?php

/**
 * This is the model class for table "{{style}}".
 *
 * The followings are the available columns in table '{{style}}':
 * @property integer $id
 * @property string $name
 * @property string $code
 * @property integer $template
 * @property integer $owner
 * @property integer $pubdate
 *
 * The followings are the available model relations:
 * @property Template $template0
 * @property User $owner0
 */
class Style extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Style the static model class
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
		return '{{style}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, code, template, owner, pubdate', 'required'),
			array('template, owner, pubdate', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, code, template, owner, pubdate', 'safe', 'on'=>'search'),
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
			'template0' => array(self::BELONGS_TO, 'Template', 'template'),
			'owner0' => array(self::BELONGS_TO, 'User', 'owner'),
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
			'code' => 'Code',
			'template' => 'Template',
			'owner' => 'Owner',
			'pubdate' => 'Pubdate',
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
		$criteria->compare('code',$this->code,true);
		$criteria->compare('template',$this->template);
		$criteria->compare('owner',$this->owner);
		$criteria->compare('pubdate',$this->pubdate);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}