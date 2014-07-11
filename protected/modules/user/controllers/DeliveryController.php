<?php
/**
 * Created by JetBrains PhpStorm.
 * User: alichen
 * Date: 12-8-5
 * Time: 上午11:12
 * To change this template use File | Settings | File Templates.
 */
class DeliveryController extends Controller{
    public $layout='//layouts/userLayout';

    public $defaultAction='create';

    public function actionSetDefault($id){
        $model=$this->loadModel($id);
        $model->is_default=$model->is_default==1?0:1;

        if($model->save())
            $this->redirect(array('create'));
    }

    public function actionCreate(){
        $model=new UserDelivery;

        $model->user_id=Yii::app()->user->id;
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['UserDelivery']))
        {
            $model->attributes=$_POST['UserDelivery'];
            if($model->save()){
                if(Yii::app()->request->isAjaxRequest){
                    $model->province_id=$model->province->province_name;
                    $model->city_id=$model->city->city_name;
                    $model->zone_id=$model->zone->zone_name;
                    echo CJSON::encode(CMap::mergeArray($model->attributes,array('status'=>1)));
                    Yii::app()->end();
                }
                $this->redirect('create');
            }else{
                if(Yii::app()->request->isAjaxRequest){
                    echo CJSON::encode(CMap::mergeArray(array('error'=>$model->getErrors()),array('status'=>0)));
                    Yii::app()->end();
                }
            }
        }
        if(Yii::app()->request->isAjaxRequest){
            echo $this->renderPartial('_form',array('model'=>$model),true);
        }else
        $this->render('index',array(
            'model'=>$model,
            'userDeliverys'=>$this->loadAllRows(),
        ));
    }

    public function actionUpdate($id){
        $model=$this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
       // $this->performAjaxValidation($model);

        if(isset($_POST['UserDelivery']))
        {
            $model->attributes=$_POST['UserDelivery'];
            if($model->save())
                $this->redirect(array('create'));
        }
        $this->render('index',array(
            'model'=>$model,
            'userDeliverys'=>$this->loadAllRows(),
        ));
    }
    public function actionDelete($id)
    {
        if($id)
        {
            // we only allow deletion via POST request
            $this->loadModel($id)->delete();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if(!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('create'));
        }
        else
            throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
    }

    public function loadAllRows(){
        $criteria=new CDbCriteria;
        $criteria->condition='user_id = :user_id';
        $criteria->params=array(':user_id'=>Yii::app()->user->id);

        $model=new UserDelivery;
        $userDeliverys=$model->findAll($criteria);
        return $userDeliverys;
    }

    public function loadModel($id)
    {
        $model=UserDelivery::model()->findByPk((int)$id);
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if(isset($_POST['ajax']) && $_POST['ajax']==='delivery-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}