<?php

class DefaultController extends Controller
{
	public $layout = 'application.modules.m.views.layouts.main';
	
	public function actionIndex()
	{
		$this->render('index');
	}
}