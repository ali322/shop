<?php
class MyTabView extends CTabView{
    protected function renderHeader(){
        echo "<ul class=\"tabs\">\n";
		foreach($this->tabs as $id=>$tab)
		{
			$title=isset($tab['title'])?$tab['title']:'undefined';
			$active=$id===$this->activeTab?' class="active"' : '';
			$url=isset($tab['url'])?$tab['url']:"#{$id}";
			echo "<li ".$active."><a href=\"{$url}\"{$active}>{$title}</a></li>\n";
		}
		echo "</ul>\n";
    }

   public function registerClientScript(){
    $cs=Yii::app()->getClientScript();
    if(!$cs->isScriptRegistered('jquery'))
        $cs->registerCoreScript('jquery');
    $jsUrl=Yii::app()->assetManager->publish(Yii::getPathOfAlias('widget.goodsView.scripts'));
    $jsFile=$jsUrl.'/mytabview.js';
    if(!$cs->isScriptFileRegistered($jsFile))
        $cs->registerScriptFile($jsFile,CClientScript::POS_HEAD);
   // $cs->registerCoreScript('yiitab');
    $id=$this->getId();
    $cs->registerScript('Yii.CTabView#'.$id,"jQuery(\"#{$id}\").yiitab();");

    if($this->cssFile!==false)
        self::registerCssFile($this->cssFile);
    }
}
?>
