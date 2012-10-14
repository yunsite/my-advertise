<?php
class EAdvertisement extends Advertisement
{
	/**
	 * 根据系统要求显示广告信息
	 * Enter description here ...
	 */	
	public function getValidateAdvertisements($criteria, $uniqueId)
	{

		$data = Yii::app()->cache->get($uniqueId);
		
		if ($data === false)		
		{
			$data = self::model()->findAll($criteria);
			Yii::app()->cache->set($uniqueId, $data, 3600, new CDbCacheDependency("SELECT MAX(id) FROM {{advertisement}}"));
		}	
		
		return $data;
	}
}