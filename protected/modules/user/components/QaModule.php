<?php

class QaModule extends CWebModule
{
        private $_assetsUrl;
        
	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application
                $this->initScript();
		// import the module-level models and components
		$this->setImport(array(
			'qa.models.*',
			'qa.components.*',
		));
	}

	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
                    $controller->layout='application.modules.shop.views.layouts.webshop_main';
			// this method is called before any module controller action is performed
			// you may place customized code here
			return true;
		}
		else
			return false;
	}
        
        public static function t($str='',$params=array(),$dic='qa') {
		return Yii::t("QaModule.".$dic, $str, $params);
	}
        
        	/**
	 * @param $place
	 * @return boolean 
	 */
	public static function doCaptcha($place = '') {
		if(!extension_loaded('gd'))
			return false;
		if (in_array($place, Yii::app()->getModule('user')->captcha))
			return Yii::app()->getModule('user')->captcha[$place];
		return false;
	}
        
        protected function initScript(){
            $cssPath=dirname(__FILE__).DIRECTORY_SEPARATOR.'assets'.DIRECTORY_SEPARATOR.'qa.css';
            $cssFile=Yii::app()->getAssetManager()->publish($cssPath);
        //    CVarDumper::dump($cssPath);exit;
            Yii::app()->clientScript->registerCssFile($cssFile);
        }
        
        public function getAssetsUrl()
        {
          if($this->_assetsUrl===null)
                $this->_assetsUrl=Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('application.modules.shop.assets'));
          return $this->_assetsUrl;
        }

        public function setAssetsUrl($value)
        {
          $this->_assetsUrl=$value;
        }
}
