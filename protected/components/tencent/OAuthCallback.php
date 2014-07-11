<?php
class OAuthCallback extends CAction{
    public function run(){
        $oauth = Yii::app()->oauth;
            $token = $_GET['oauth_token'];
            $vericode = $_GET['oauth_vericode'];
            $oauth->fetchAccessToken($token, $vericode);
            $at = $oauth->accessToken;
            $as = $oauth->accessSecret;
            $userInfo = $oauth->fetchUserInfo($at, $as);
    //        CVarDumper::dump($userInfo);exit;        
            $user=$this->genOAUser($userInfo, $oauth->getOpenId());
            if($user){
                    $identity=new UserIdentity($user['username'],$user['password']);
                   if($identity->authenticate(true,array('nickname'=>$userInfo['nickname']))){
                        $identity->username=$userInfo['nickname'];
                        Yii::app()->user->login($identity,3600*24*30);
                        Yii::app()->user->setState('oauth_type',1);
                        Yii::app()->user->setState('oauth_avatar',$userInfo['figureurl_2']);
                        User::model()->updateByPk(Yii::app()->user->id,array('lastvisit'=>time()));
                        $this->controller->redirect(Yii::app()->user->returnUrl);
                   }
	     }else{
                    $this->controller->redirect(Yii::app()->controller->module->returnUrl);
             }
    }
    
    /*绑定用户*/
    protected function genOAUser($userInfo,$openID){
            $command=Yii::app()->db->createCommand("select a.username,a.password from tbl_users a,tbl_oa_users b where a.id=b.user_id and b.qq_openid ='{$openID}'");
            $user=$command->queryRow();
            if($user ==false){
                $user=new User();
                $user->username=$openID;
            
                $password='';
            
                for($i=0;$i<8;$i++)
                    $password.=chr(mt_rand(35,126));
            
                $user->password=UserModule::encrypting($password);
                $user->email=$openID.'@qq.com';
                $user->createtime=time();
                $user->status=1;
                
                if($user->save()){
                    $oauser=new OaUsers;
                    $oauser->user_id=$user->id;
                    $oauser->qq_openid=$openID;
                    $oauser->save();
                    
                    $profile=new Profile;
                    $profile->attributes=array();
                    $profile->user_id=$user->id;
                    $profile->save();
                  //  return $user;
                    return array('username'=>$user->username,'password'=>$user->password);
                }else{
               //     header('content-type:text/html;charset=utf8');
               //    CVarDumper::dump($user->getErrors());exit;
                    return false;
                }
            }else{
                    return $user;
                  //  return array('username'=>$user->username,'password'=>$user->password);
            }
        }
}
?>
