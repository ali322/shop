<?php
class OAuthLogin extends CAction{
    public function run(){
            $oauth = Yii::app()->oauth;
            $oauth->fetchOAuthToken();
            $requestToken = $oauth->getOAuthToken();
            $requestSecret = $oauth->getOAuthSecret();
            $callback=Yii::app()->getRequest()->getHostInfo().Yii::app()->getRequest()->getBaseUrl().$oauth->callback;
     
            $login_url=$oauth->authorizeURL."?oauth_consumer_key={$oauth->key}&oauth_token={$requestToken}&oauth_callback={$callback}";
            $this->controller->redirect($login_url);
    }
}
?>
