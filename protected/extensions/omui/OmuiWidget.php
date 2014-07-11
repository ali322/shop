<?php
/*
 * omui 初始类(插件模式)
 */
class OmuiWidget extends CInputWidget{
    /*风格*/
	public $theme='';

	/*clientScript变量*/
	protected $cs;
		
    /*框架资源路径*/
    protected $baseUrl;
        
    /*扩展资源路径*/
    protected $plusUrl;

    /*是否使用压缩过的js*/
    private $minified=false;
        
	public function init(){
                $this->cs=Yii::app()->getClientScript();
                $this->baseUrl=Yii::app()->assetManager->publish(Yii::getPathOfAlias('ext.omui.lib'));
           //     $this->plusUrl=Yii::app()->assetManager->publish(Yii::getPathOfAlias('ext.omui.plus'));
		$this->loadBaseScripts();
	}
        
        /*
         * 插件模式注册函数
         */
        protected  function loadPlugin($pluginName){
            if($this->minified)
                $this->loadSpecifiedScripts($pluginName,$this->baseUrl.'/js/ui/mini/om-');
            else
                $this->loadSpecifiedScripts($pluginName,$this->baseUrl.'/js/ui/om-');
        }
    /*
     * 注册基本的脚本文件
     * */
        private function loadBaseScripts(){
                $themeUrl=$this->baseUrl.'/css';
                /*
                 * 集成模式下取消注释
                $jsUrl=$this->baseUrl.'/js';
                $jsFile=$jsUrl."/operamasks-ui.min.js";
                */
                
                /*插件模式*/
                $jsUrl=$this->baseUrl.'/js/ui';
                $jsFile=$this->minified?$jsUrl."/mini/om-core.js":$jsUrl."/om-core.js";
                
                $basicCss=$themeUrl.'/default/om-default.css';
                
                /*注册omui默认样式文件*/
                if(!$this->cs->isCssFileRegistered($basicCss))
                        $this->cs->registerCssFile($basicCss);
                
                /*注册omui风格样式文件*/
                if($this->theme !=''){
                    $mainCss=$themeUrl.'/'.$this->theme.'/om-default.css';
                    if(!$this->cs->isCssFileRegistered($mainCss))
                            $this->cs->registerCssFile($mainCss);
                }

                
                /*注册jquery核心文件*/
		if(!$this->cs->isScriptRegistered('jquery'))
			$this->cs->registerCoreScript('jquery');
                
                /*注册omui核心文件*/
		if(!$this->cs->isScriptFileRegistered($jsFile))
		      $this->cs->registerScriptFile($jsFile,CClientScript::POS_HEAD);
	}
        
        private function loadSpecifiedScripts($scriptName,$scriptPath){
            if(is_array($scriptName)){
               foreach($scriptName as $v){
                   $pluginJsFile=$scriptPath.$v.'.js';
                   if(!$this->cs->isScriptFileRegistered($pluginJsFile))
                       $this->cs->registerScriptFile($pluginJsFile,CClientScript::POS_BEGIN);
               }
            }else{
                $pluginJsFile=$scriptPath.$scriptName.'.js';
                if(!$this->cs->isScriptFileRegistered($pluginJsFile))
                       $this->cs->registerScriptFile($pluginJsFile,CClientScript::POS_BEGIN);
            }
        }
}
?>
