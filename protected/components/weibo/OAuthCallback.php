<?php
class OAuthCallback extends CAction{
    public function run(){
        Yii::import('application.components.Weibo.lib.*');
        require_once 'config.php';
        $session=Yii::app()->session;
        $o = new WeiboOAuth( WB_AKEY , WB_SKEY , $session['keys']['oauth_token'] , $session['keys']['oauth_token_secret']  );
        $last_key = $o->getAccessToken(  $_REQUEST['oauth_verifier'] ) ;
        $session['last_key'] = $last_key;
        
        $c = new WeiboClient( WB_AKEY , WB_SKEY , $_SESSION['last_key']['oauth_token'] , $_SESSION['last_key']['oauth_token_secret']  );
//$ms  = $c->home_timeline(); // done
        $me = $c->verify_credentials();
        
   //     CVarDumper::dump($me);
        $user=$this->genOAUser($me, $me['id']);
            if($user){
                    $identity=new UserIdentity($user['username'],$user['password']);
                   if($identity->authenticate(true)){
                        $identity->username=$me['name'];
                        Yii::app()->user->login($identity,3600*24*30);
                        Yii::app()->user->setState('oauth_type',2);
                        Yii::app()->user->setState('oauth_avatar',$me['profile_image_url']);
                        User::model()->updateByPk(Yii::app()->user->id,array('lastvisit'=>time()));
                        $this->controller->redirect(Yii::app()->user->returnUrl);
                   }
	     }else{
                    $this->controller->redirect(Yii::app()->controller->module->returnUrl);
             }
    }
    
    /*绑定用户*/
    protected function genOAUser($userInfo,$openID){
            $command=Yii::app()->db->createCommand("select a.username,a.password from tbl_users a,tbl_oa_users b where a.id=b.user_id and b.weibo_openid ='{$openID}'");
            $user=$command->queryRow();
            if($user ==false){
                $user=new User();
                $user->username=$openID;
            
                $password='';
            
                for($i=0;$i<8;$i++)
                    $password.=chr(mt_rand(35,126));
            
                $user->password=UserModule::encrypting($password);
           //     $user->activkey=UserModule::encrypting(microtime().$user->password);
            //    $user->verifyPassword=UserModule::encrypting($user->password);
                $user->email=$openID.'@sina.cn';
                $user->createtime=time();
                $user->status=1;
                
                if($user->save()){
                    $oauser=new OaUsers;
                    $oauser->user_id=$user->id;
                    $oauser->weibo_openid=$openID;
                    $oauser->save();
                    
                    $profile=new Profile;
                    $profile->attributes=array();
                    $profile->user_id=$user->id;
                    $profile->save();
                  //  return $user;
                    return array('username'=>$user->username,'password'=>$user->password);
                }else{
                   header('content-type:text/html;charset=utf8');
                   CVarDumper::dump($user->getErrors());exit;
                    return false;
                }
            }else{
                    return $user;
                  //  return array('username'=>$user->username,'password'=>$user->password);
            }
        }
}
?>
