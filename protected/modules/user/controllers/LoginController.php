<?php

class LoginController extends Controller
{
	public $defaultAction = 'login';
    public $layout='//layouts/simpleLayout';

        public function actions(){
            return array(
              'sharelogin'=>'application.components.tencent.OAuthLogin',
              'callback'=>'application.components.tencent.OAuthCallback',
              'weibologin'=>'application.components.weibo.OAuthLogin',
              'weibocallback'=>'application.components.weibo.OAuthCallback',
            );
        }
	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		if (Yii::app()->user->isGuest) {
			$model=new UserLogin;
			// collect user input data
			if(isset($_POST['UserLogin']))
			{
				$model->attributes=$_POST['UserLogin'];
				// validate user input and redirect to previous page if valid
				if($model->validate()) {
					$this->lastViset();
					if (strpos(Yii::app()->user->returnUrl,'/index.php')!==false)
						$this->redirect(Yii::app()->controller->module->returnUrl);
					else
						$this->redirect(Yii::app()->user->returnUrl);
				}
			}
			// display the login form
			$this->render('/user/login',array('model'=>$model));
		} else
			$this->redirect(Yii::app()->controller->module->returnUrl);
	}

    public function actionMinLogin(){
        $this->layout='//layouts/basicLayout';
        if (Yii::app()->user->isGuest) {
            $model=new UserLogin;
            // collect user input data
            if(isset($_POST['UserLogin']))
            {
                $model->attributes=$_POST['UserLogin'];
                // validate user input and redirect to previous page if valid
                if($model->validate()) {
                    $this->lastViset();
                    $this->render('/user/minlogin',array('authorized'=>true));
                }
            }
            // display the login form
            $this->render('/user/minlogin',array('model'=>$model));
        } else{
            $this->render('/user/minlogin',array('authorized'=>true));
        }
           // $this->redirect(Yii::app()->controller->module->returnUrl);
    }

	private function lastViset() {
		$lastVisit = User::model()->notsafe()->findByPk(Yii::app()->user->id);
		$lastVisit->lastvisit = time();
		$lastVisit->save();
	}

}
