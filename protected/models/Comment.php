<?php

/**
 * This is the model class for table "{{comment}}".
 *
 * The followings are the available columns in table '{{comment}}':
 * @property integer $id
 * @property integer $aid
 * @property string $author
 * @property string $email
 * @property string $url
 * @property string $ip
 * @property string $pubdate
 * @property string $content
 * @property integer $approved
 * @property string $agent
 * @property integer $uid
 */
class Comment extends CActiveRecord
{
 
    const APPROVED_PUBLISHED = 1;
    const APPROVED_LOCK = 0;
   
	/**
	 * Returns the static model of the specified AR class.
	 * @return Comment the static model class
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
		return '{{comment}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('content,', 'required'),
			array('aid, approved, uid', 'numerical', 'integerOnly'=>true),
			array('author, email, ip', 'length', 'max'=>32),
			array('content,url,agent', 'length', 'max'=>256),
            array('email','email'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, aid, author, email, url, ip, pubdate, content, approved, agent, uid', 'safe', 'on'=>'search'),
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
			'aid' => '文章ID',
			'author' => '昵称',
			'email' => '邮箱',
			'url' => '评论地址',
			'ip' => 'IP地址',
			'pubdate' => '回复时间',
			'content' => '回复内容',
			'approved' => '是否批准',
			'agent' => '浏览',
			'uid' => '用户ID',
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
		$criteria->compare('author',$this->author,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('ip',$this->ip,true);
		$criteria->compare('pubdate',$this->pubdate,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('approved',$this->approved);
		$criteria->compare('agent',$this->agent,true);
		$criteria->compare('uid',$this->uid);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
    public function getComments($criteria)
    {
        
        
        $total = self::model()->count($criteria);

        $pagination = new CPagination($total);
        $pagination->setPageSize(5);
        $pagination->applyLimit($criteria);        

        $model = self::model()->findAll($criteria);
        
        return array(
            'model'=>$model,
            'pagination'=>$pagination
        );
    }
    
    /***
     *获取已经核审通过的评论
     */
    public function getApprovedCommentsByAid($aid)
    {
        $criteria = new CDbCriteria(array(
            'condition'=>'aid = :aid AND approved = :approved',
            'order'=>'pubdate DESC',
            'params'=>array(
                ':aid'=>$aid,
                ':approved'=>self::APPROVED_PUBLISHED
            )
        ));
        
        return self::getComments($criteria);
        
        
    }
    
    public function beforeSave()
    {
		if(parent::beforeSave())
		{
			if($this->isNewRecord)
			{
				$this->pubdate = time();
				$this->approved = self::APPROVED_PUBLISHED;
				$this->agent = CHttpRequest::getUserAgent();
				$this->uid = Yii::app()->user->id;
				$this->ip = CHttpRequest::getUserHostAddress();
                $this->author = Yii::app()->user->name;
                $this->url = Yii::app()->request->getRequestUri();
                $this->email = Profile::model()->getEmail();
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