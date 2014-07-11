<?php
class DefaultController extends Controller
{
    public $layout='/layouts/grouponLayout';

    public function actions(){
        return array(
            'page'=>array(
                'class'=>'CViewAction',
            ),
        );
    }
	public function actionIndex()
	{
		$this->render('index');
	}

    public function actionView(){
        $this->render('view');
    }
}