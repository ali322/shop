<?php
class OAuthLogin extends CAction{
    public function run(){
        Yii::import('application.components.Weibo.lib.*');
        require_once 'config.php';
        $callback=Yii::app()->getRequest()->getHostInfo().Yii::app()->createUrl('user/login/weibocallback');
   //     CVarDumper::dump($callback);exit;
        $o = new WeiboOAuth( WB_AKEY , WB_SKEY  );

        $keys = $o->getRequestToken();
        $aurl = $o->getAuthorizeURL( $keys['oauth_token'] ,false ,$callback);
        
        $session=Yii::app()->session;
        $session['keys']=$keys;
        $this->controller->redirect($aurl);
    }
}
?>
