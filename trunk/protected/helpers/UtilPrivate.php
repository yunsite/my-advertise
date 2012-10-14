<?php
/**
 * 此类用于提供一些用户个人信息
 * Enter description here ...
 * @author Administrator
 *
 */ 
class UtilPrivate {
	
	/*
	 * 根据用户地区自定义网站名称:比如“会东广告栏"
	 */	
	public static function siteName()
	{
		return Region::model()->getUserArea()->region.'广告牌';
	}
}
?>