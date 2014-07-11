<?php 

/*
 * 用于腾讯社区开放平台的QQ登录，详情请查阅 http://connect.opensns.qq.com
 * 作者 Francis.TM
 * 修改 2011年5月14日
 * Blog http://blog.francistm.com
 *
 * ===================
 *
 * 1. 腾讯社区开放平台和腾讯微博开放平台的接口不同。后者使用标准的OAuth，而前者则
 * 不是，所以不能用标准的PECL库。
 *
 * 2. 社区开放平台其实并不是类似Discuz内置的使用QQ号登陆，而是使用QZone的账户
 * 来登录。
 *
 * ====================
 * 
 * 用法：
 *    1. 将文件放在 protected/components/ 下;
 *    2. 修改配置：
 *      return array(
 *        ....
 *        'components' => array(
 *            ....
 *            'oauth' => array(
 *                'key' => 'xxxx',
 *                'secret' => 'xxxxx',
 *                'callback' => '/site/callback',
 *                'class' => 'application.components.QQOAuth',
 *             ),
 *         ),
 *     );
 *
 *    3. 控制器动作中：
 *
 *     $oauth = Yii::app()->oauth;
 *     $oauth->fetchOAuthToken();
 *     $requestToken = $oauth->requestToken;
 *     $requestSecret = $oauth->requestSecret;
 *
 *     在回调动作中：
 *
 *     $token = $_GET['oauth_token'];
 *     $vericode = $_GET['oauth_vericode'];
 *     $oauth->fetchAccessToken($token, $vericode);
 *     $at = $oauth->accessToken;
 *     $as = $oauth->accessSecret;
 *     $userInfo = $oauth->fetchUserInfo($at, $as);
 *
 *     // $userInfo will be an array include nickname and avatar URL.
 *     // for detail, please check http://wiki.opensns.qq.com/wiki/%E3%80%90QQ%E7%99%BB%E5%BD%95%E3%80%91get_user_info
 *
 */
 

class QQOAuth extends CComponent
{
    public $key, $secret, $callback;

    protected $accessURL    = 'http://openapi.qzone.qq.com/oauth/qzoneoauth_access_token';
    protected $requestURL   = 'http://openapi.qzone.qq.com/oauth/qzoneoauth_request_token';
    protected $authorizeURL = 'http://openapi.qzone.qq.com/oauth/qzoneoauth_authorize';
    protected $userInfoURL  = 'http://openapi.qzone.qq.com/user/get_user_info';

    protected $oauth;

    public function __construct($key = null, $secret = null)
    {
        $this->key = $key;
        $this->secret = $secret;
        $this->callback = Yii::app()->createAbsoluteUrl($this->callback);
    }

    public function init()
    {
        return $this;
    }

    public function fetchOAuthToken()
    {
        $tokenInfo = $this->oauthRequest($this->requestURL);
        if(isset($tokenInfo['oauth_token'], $tokenInfo['oauth_token_secret'])) {
            $this->storageToken(array(
                'oauthToken' => $tokenInfo['oauth_token'],
                'oauthSecret' => $tokenInfo['oauth_token_secret'],
            ));

            return true;
        }

        return false;
    }

    public function fetchAccessToken($cbToken, $vericode)
    {
        $params = array(
            'oauth_vericode'     => $vericode,
            'oauth_consumer_key' => $this->key,
            'oauth_token'        => $this->getOAuthData('oauthToken'),
        );
        $oauthSecret = $this->getOAuthData('oauthSecret');
        $tokenInfo = $this->oauthRequest($this->accessURL, $params, $oauthSecret);

        if(isset($tokenInfo['oauth_token'], $tokenInfo['oauth_token_secret'])) {
            $this->storageToken(array(
                'openid' => $tokenInfo['openid'],
                'accessToken' => $tokenInfo['oauth_token'],
                'accessSecret' => $tokenInfo['oauth_token_secret'],
            ));

            return true;
        }

        return false;
    }

    public function fetchUserInfo($accessToken = null, $accessSecret = null)
    {
        if(empty($accessToken)) $accessToken = $this->getOAuthData('accessToken');
        if(empty($accessSecret)) $accessSecret = $this->getOAuthData('accessSecret');

        $openId = $this->getOAuthData('openid');
        $params = array(
            'openid'             => $openId,
            'oauth_token'        => $accessToken,
            'oauth_consumer_key' => $this->key,
        );

        $url = $this->buildRequestURL($this->userInfoURL, $params, $accessSecret);
        $jsonContent = trim(file_get_contents($url));

        return CJSON::decode($jsonContent);
    }

    public function getOpenId()
    {
        return $this->getOAuthData('openid');
    }

    public function getAuthorizeURL()
    {
        return $this->authorizeURL;
    }

    public function getOAuthToken()
    {
        return $this->getOAuthData('oauthToken');
    }

    public function getOAuthSecret()
    {
        return $this->getOAuthData('oauthSecret');
    }

    public function getAccessToken()
    {
        return $this->getOAuthData('accessToken');
    }

    public function getAccessSecret()
    {
        return $this->getOAuthData('accessSecret');
    }

    public function flushStorage()
    {
        return $this->storageToken(array(
            'openid' => null,
            'oauthToken' => null,
            'oauthSecret' => null,
            'accessToken' => null,
            'accessSecret' => null,
        ));
    }

    protected function buildRequestURL($url, $params = array(), $secret = '')
    {
        $params += array(
            'oauth_timestamp'        => time(),
            'oauth_version'          => '1.0',
            'oauth_consumer_key'     => $this->key,
            'oauth_signature_method' => 'HMAC-SHA1',
            'oauth_nonce'            => rand(1000, 9999),
        );

        $paramsToEncode = $params;
        ksort($paramsToEncode);

        $paramsToSign = 'GET&' . urlencode($url) . '&' . urlencode(http_build_query($paramsToEncode));
        $params['oauth_signature'] = base64_encode(hash_hmac('SHA1', $paramsToSign, $this->secret . '&' . $secret, true));

        return $url . '?' . http_build_query($params);
    }

    protected function oauthRequest($url, $params = array(), $secret = '')
    {
        $c = trim(file_get_contents($this->buildRequestURL($url, $params, $secret)));
        if(false == strpos($c, '&'))
            return false;

        parse_str($c, $params);

        return $params;
    }

    protected function getOAuthData($name)
    {
        $session = Yii::app()->session;

        if(isset($session[$name]))
            return $session[$name];

        return null;
    }

    protected function storageToken($name, $value = null)
    {
        $session = Yii::app()->session;

        if(is_array($name)) {
            foreach($name as $attr => $value) {
                $session[$attr] = $value;
            }

        }else {
            $session[$name] = $value;
        }

        return true;
    }
}
