<?php

/**
 * This is the model class for table "{{adcomponent}}".
 *
 * The followings are the available columns in table '{{adcomponent}}':
 * @property integer $id
 * @property string $name
 * @property integer $type
 * @property string $code
 * @property string $style
 */
class Adcomponent extends CActiveRecord
{
	const COMPONENT_PAGE = 1;
	const CONPONENT_CONTENT = 2;
	
	/**
	 * Returns the static model of the specified AR class.
	 * @return Adcomponent the static model class
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
		return '{{adcomponent}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, type, code, style', 'required'),
			array('type', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>50),
			array('style', 'length', 'max'=>500),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, type, code, style', 'safe', 'on'=>'search'),
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
			'name' => 'Name',
			'type' => 'Type',
			'code' => 'Code',
			'style' => 'Style',
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
		$criteria->compare('code',$this->code,true);
		$criteria->compare('style',$this->style,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}