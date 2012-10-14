<?php

class AdminModule extends CWebModule
{
	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'admin.models.*',
			'admin.components.*',
		));
	}
	
	
	public function register($file)
	{
		$basepath = Yii::getPathOfAlias('application.modules.admin.assets');
		
		$url = Yii::app()->getAssetManager()->publish($basepath);
		
		$path = $url . '/'. $file;
		
		if (strpos($file, 'js') !== false)
			return Yii::app()->clientScript->registerScriptFile($path);
		elseif (strpos($file, 'css') !== false)
			return Yii::app()->clientScript->registerCssFile($path);
			
		return $path;
		
	}
	
	public function registerFiles($files)
	{
		if (is_array($files))
		{
			foreach ($files as $file)
				$this->register($file);
		}
		else 
			$this->register($files);
	}

	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
			// this method is called before any module controller action is performed
			// you may place customized code here
			return true;
		}
		else
			return false;
	}
}
