<?php

class CollectController extends Controller
{
    public $layout='//layouts/userLayout';

    public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}
        
        public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','create','delete'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
        
	public function actionIndex()
	{
        //        $criteria=new CDbCriteria;
        //        $user=User::model()->findByPk(Yii::app()->user->id);
        $criteria=new CDbCriteria;
        $criteria->condition='user_id = :userId';
        $criteria->params=array(':userId'=>Yii::app()->user->id);
        $collects=UserCollection::model()->findAll($criteria);
        $goodIds=array();
        foreach($collects as $collect){
            $goodIds[]=$collect->good_id;
        }
        $_criteria=new CDbCriteria;
        $_criteria->addInCondition('good_id',$goodIds);
        $goods=Goods::model()->findAll($_criteria);
		$this->render('index',array('goods'=>$goods));
	}

        public function actionCreate($id){
                $conn=Yii::app()->db;
                $user_id=Yii::app()->user->id;
                $trans=$conn->beginTransaction();
                try{
                $command=$conn->createCommand('insert into ol_user_collection(user_id,good_id) values(:user_id,:good_id)');
                $command->bindParam(':user_id',$user_id,PDO::PARAM_INT);
                $command->bindParam(':good_id',$id,PDO::PARAM_INT);
                $command->execute();
                $trans->commit();
                $this->redirect(array('index'));
                }catch(Exception $e){
                    $trans->rollback();
                    throw new CHttpException(404,'The requested page does not exist.');
                }
        }
        
        public function actionDelete($id){
                $conn=Yii::app()->db;
                $user_id=Yii::app()->user->id;
                $trans=$conn->beginTransaction();
                try{
                    $command=$conn->createCommand('delete from ol_user_collection where good_id=:good_id and user_id=:user_id');
                    $command->bindParam(':user_id',$user_id);
                    $command->bindParam(':good_id',$id);
                    $command->execute();
                    $trans->commit();
                    $this->redirect(array('index'));
                }catch(Exception $e){
                    $trans->rollback();
                    throw new CHttpException(404,'The requested page does not exist.');
                }
        }
	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}