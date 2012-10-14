<?php

/**
 * This is the model class for table "{{channel}}".
 *
 * The followings are the available columns in table '{{channel}}':
 * @property integer $id
 * @property string $name
 * @property integer $type
 * @property integer $weight
 * @property string $description
 * @property string $charge
 * @property integer $hasAD
 * @property integer $pid
 * @property integer $uid
 *
 * The followings are the available model relations:
 * @property Advertisement[] $advertisements
 * @property Lookup $type0
 * @property User $u
 */
class Channel extends CActiveRecord
{
	
	//四个基本频道
	const CHANNEL_MARKET = 1;	//交易
	const CHANNEL_FREIND = 2;	//交友
	const CHANNEL_JOB = 3;		//招聘
	const CHANNEL_SERVICE = 4;	//服务
    
    const CHANNEL_BLOG = 5; //博客服务
    const CHANNEL_MICROBLOG = 6;    //微博客服务
	
	/**
	 * Returns the static model of the specified AR class.
	 * @return Channel the static model class
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
			array('name, type, weight, description, charge', 'required'),
//			array('name','unique'),
			array('type, weight, pid, hasAD, uid', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>50),
			array('description', 'length', 'max'=>500),
			array('charge', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, type, weight, description, charge, hasAD, pid, uid', 'safe', 'on'=>'search'),
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
			'type0' => array(self::BELONGS_TO, 'Lookup', 'type'),
			'u' => array(self::BELONGS_TO, 'User', 'uid'),
			'cover' => array(self::HAS_ONE, 'File', 'cover'),
		
			'parent' => array(self::HAS_ONE, 'Channel', 'pid'),
			'child' => array(self::BELONGS_TO, 'Channel', 'id')
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
			'weight' => 'Weight',
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
		$criteria->compare('type',$this->type);
		$criteria->compare('weight',$this->weight);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('charge',$this->charge,true);
		$criteria->compare('pid',$this->pid);
		$criteria->compare('uid',$this->uid);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function getChannel($id)
	{
		switch ($id)
		{
			case self::CHANNEL_MARKET:
				return '交易';
			case self::CHANNEL_FREIND:
				return '交友';
			case self::CHANNEL_JOB:
				return '招聘';
			case self::CHANNEL_SERVICE:
				return '服务';
		}
	}
	
	public function generateChannelList()
	{
		return array(
			self::CHANNEL_MARKET=>self::getChannel(self::CHANNEL_MARKET),
			self::CHANNEL_FREIND=>self::getChannel(self::CHANNEL_FREIND),
			self::CHANNEL_JOB=>self::getChannel(self::CHANNEL_JOB),
			self::CHANNEL_SERVICE=>self::getChannel(self::CHANNEL_SERVICE)
		);
	}
	
	/**
	 * 根据ID获取父类频道模型
	 */
	public function findParent($id)
	{
		$model = self::getChannelModel($id);
		
		$result[] = array(
			'id' => $model->id,
			'pid'=> $model->pid,
			'name' => $model->name
		);

		
		while ($model->pid != 0)
		{			
			$model = self::getChannelModel($model->pid);
			
			$result[] = array(
				'id' => $model->id,
				'pid'=> $model->pid,
				'name' => $model->name
			);	
		}
		
		return $result;
	}
	
	/**
	 * 根据ID获取父类频道链
	 */
	public function parentString($id)
	{
		$str = '';
		
		$result = self::findParent($id);
		
		$result = array_reverse($result);
		
		foreach ($result as $item)
		{
			$str .= $item['name'].' ';
		}
		
		return $str;
		
	}
	/**
	 * 根据ID获取相关频道模型
	 * @param unknown_type $id
	 */
	public function getChannelModel($id)
	{
		return self::model()->findByPk($id);
	}
	
	public function getChannelName($id)
	{
		return self::getChannelModel($id)->name;
	}
	
	/**根据ID获取频道图标**/
	public function getChannelIco($id)
	{
		$model = self::getChannel($id);
		
		
		
		if ($model->cover)
		{
			$path = File::model()->generateFileName($model->cover, 'channels',false);
			
			echo $path;
			
			if (file_exists('.'.$path))
				return $path;
		}
		
		return Yii::app()->params->defaultChannelIco;
	}
	
	public function getZeroChannel($type)
	{
		$model = self::model()->findAll(array(
//				'pid' => 0,
				'condition' => 'type = :type AND pid = 0',
				'params' => array(
					':type'=>$type
				)
			)
		);
		
		return $model;
	}
	
	public function isNode($id)
	{
		$model = Channel::model()->find('pid = :pid',array(':pid'=>$id));
				
		return $model;

	}
	
	public function nodeType($id)
	{
		//当前模型
		$current = Channel::model()->findByPk($id);		
		//前一个
		$preview = Channel::model()->find(array(
			'condition'=>'pid = :pid AND id < :id',
			'params'=>array(
				':pid'=>$current->pid,
				':id'=>$id
			)
		));
		
		$next = Channel::model()->find(array(
			'condition'=>'pid = :pid AND id > :id',
			'params'=>array(
				':pid'=>$current->pid,
				':id'=>$id
			)
		));
		
		if ($preview && $next)
		{
			return 2;
		}elseif ($preview && !$next){
			return 3;
		}else{
			return 1;
		}
	}
	
	public function isLastNode($id)
	{
		$model = self::isNode($id);
		
		$next = Channel::model()->find(array(
			'condition'=>'pid = :pid AND id > :id',
			'params'=>array(
				':pid'=>$id,
				':id'=>$model->id
			)
		));
		
		return $next;
	}
	
	public function getChannels($pid, $type)
	{
		$model = self::model()->findAll(array(
			'condition'=>'pid = :pid AND type = :type',
			'order' => 'type ASC ,weight DESC',
			'params' => array(
				':pid' => $pid,
				':type' => $type
			)
		));
		
		return $model;
	}
	
	public function getChannelList($array,$pid=0,$y=0,&$tdata=array())
	{
		$t = 0;
		//然后递归的取出各个子分类，这里默认的$pid=0是因为数据库中的pid为0的表示是第一级分类
		foreach ($array as $value)
		{
			if($value['pid']==$pid){
				$n = $y + 1;
				$value['deep'] = $n;
				$value['no'] = $t++;
				if($n > 1)
				{
//					$nbsp = '|';
					for($i = 1; $i < $n; $i++)
					{
//						$nbsp .= "&nbsp;";
					}
					$value['name']=$nbsp.$value['name'];
				}
				$tdata[]=$value;
				$this->getChannelList($array,$value['id'],$n,$tdata);//这里递归调用，不明白递归的朋友，去找几个简单的递归例子熟悉下
			}
		}
		return $tdata;
	}
	
	/**
	 * 根据分类ID查寻所有分类
	 * 返回相应子分类ID
	 */
	public function getChildren($id, &$result=array())
	{
		
		//当前分类
		$channel = self::model()->findByPk($id); 
		//向数组中添加当前分类ID
//		$result[] = $channel->id;
		//查询子类ID
		
		$criteria = new CDbCriteria(array(
			'condition'=>'pid = :pid',
			'params'=>array(
				':pid'=>$channel->id
			) 
		));
		

		$model = self::model()->findAll($criteria);
		
		if($model) {
			foreach ($model as $item)
			{
				$result[] = $item;				
				self::getChildren($item->id, &$result);
			}			
		}
		
		return $result;

	}
	
	/**
	 * 
	 * @param unknown_type $id
	 */
	public function getChildrenArray($id)
	{
		$result = array();
		
		$model = self::getChildren($id);
		
		foreach ($model as $item)
		{
			$result[] = $item->attributes;
		}
		
		return $result;		
	}
	
	/**
	 * 根据分类ID查寻所有分类
	 * 返回相应子分类ID
	 */
	public function getChildrenIds($id)
	{
		$result = array();
		
		$model = self::getChildren($id);
		
		foreach ($model as $item)
		{
			$result[] = $item->id;
		}
		
		array_unshift($result, $id);
		
		return $result;

	}
	
	
	/**
	 * 
	 * Enter description here ...
	 * @param unknown_type $pid
	 * @param unknown_type $type
	 * @param unknown_type $url
	 * @param unknown_type $htmlOptions
	 * @param unknown_type $asList
	 * @param unknown_type $addMore
	 * @param unknown_type $separate
	 */	
	public function generateChannelLinks($pid,$type, $url = array(), $htmlOptions = array(), $asList = false, $addMore = ture, $separate = '&nbsp;&nbsp;')
	{
		$links = '';
		
		$model = self::getChannels($pid,$type);
		
//		UtilHelper::writeToFile($model);
		
		foreach ($model as $item)
		{
			$url['id'] = $item->id;
			$htmlOptions['id'] = $item->id;
			$img = CHtml::image(self::getChannelIco($item->id));
			$links .= CHtml::link($img.'<br />'.$item->name, $url, $htmlOptions);
		}
		
		if ($asList)	
		{
			
			$links = str_replace(array('<a','</a>'), array('<li><a','</a></li>'), $links);	
			
			$links = "<ul>".$links.'</ul>';		
		}

		if ($addMore)
			$links .= '<br />如果这里没有您需要的类别名称，请点击这里添加';
		
		return $links;
	}
	
	public function generateChannels()
	{
		$result = array();
		
		$model = self::model()->findAll(array(
			'order'=>'type ASC ,weight ASC'
		));
		
		
		
		if ($model !== null)
		{
			foreach ($model as $channel)
			{
				$result[$channel->type0->name][$channel->id] = $channel->name;
			}
		}
		
//		$result = array(
//			'教育'=>array('语言','数理'),
//			'招聘'=>array('销售','文员'),
//		);
		
		return $result;
	}
	public function showCategories($id, $limit = 5, $showPop=false,$className="category-item")
	{
		$result = Yii::app()->cache->get('showcategory_'.$id);
		
		if ($result === false)
		{
			$categories = Channel::model()->getZeroChannel($id);
			
			foreach ($categories as $category)
			{			
				$result .= self::categoryItem($category, $limit, $showPop, $className);
			}	

			Yii::app()->cache->set('showcategory_'.$id, $result);
		}	

		
		echo $result;
	}
	
	/**
	 * 显示分类
	 * @param unknown_type $model
	 */
	public function categoryItem($model, $limit=5, $showPop=false, $className="category-item", &$result='') {

		
		$id = $model->id;

		$result .= "<div class=\"{$className}\">";
		
		$result .= "<h4>".$model->name."</h4>";
		
		if ($showPop)
			$result .= "<span class=\"{$className}-pop\">{$model->description}</span>";
		
		$item = Channel::model()->getChildrenArray($id);

		$item = Channel::model()->getChannelList($item, $id);

		foreach($item as $child)
		{
			
			if ($limit)
			{
				if ($child['deep'] == 2 && $child['no'] < $limit || $child['deep'] == 1)
				{
					$id = $child['id'];
					$nodeType = Channel::model()->nodeType($id);
			
					$result .= self::categoryItemChildren($child, $nodeType);					
				}				
			}
			else 
			{
				$id = $child['id'];
				$nodeType = Channel::model()->nodeType($id);
			
				$result .= self::categoryItemChildren($child, $nodeType);					
			}


		}
		
		$result .= "</ul>";		
		$result .= "</div>";

		return $result;
	}

	/**
	 * 按要求格式化输出每一分类节点
	 * @param unknown_type $item
	 * @param unknown_type $nodeType
	 */
	public function categoryItemChildren($item, $nodeType) {

		$result = '';
		
		$link = CHtml::link($item['name'], array('/info/list','id'=>$item['id']));
//		$link .= "&nbsp;&nbsp;&nbsp;&nbsp;";
			
		//只显示到第二层
			
		if ($item['deep'] == 1 && $nodeType == 1)	
			$result .= "<ul><li><h4>".$link."</h4>";
		elseif ($item['deep'] == 1 && $nodeType == 2)
			$result .= "<li><h4>".$link."</h4>";
		elseif ($item['deep'] == 1 && $nodeType == 3)
			$result .= "<li><h4>".$link."</h4>";
		elseif ($item['deep'] == 2 && $nodeType == 1) {
			$result .= "<span>".$link;
		}elseif ($item['deep'] == 2 && $nodeType == 2) 
			$result .= $link;
		elseif ($item['deep'] == 2 && $nodeType == 3)
			$result .= $link."</span></li>";	

		return $result;

	}
	
	public function beforeSave()
	{
		if(parent::beforeSave())
		{
			if($this->isNewRecord)
			{
				$this->uid = Yii::app()->user->id;
				$this->hasAD = false;
//				$this->pid = 0;	//频道尚未启用无限分级
			}
			return true;	
		}
		else
			return false;
	}
}