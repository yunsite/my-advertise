<?php

class DefaultController extends Controller
{
	public $layout='/layouts/main';
	
	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('index', 'info', 'case'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	

	
	public function actionIndex()
	{
				
		$this->render('index');
	}
	
	/**
	 * 显示信息配置信息
	 */
	public function actionInfo()
	{
		$this->render('info');
	}
	
	/**
	 * 测试用例
	 */
	public function actionCase()
	{
		$this->render('case');
	}
	
	public function actionLogin()
	{
		$this->layout='application.modules.admin.views.layouts.login';	
	}
}