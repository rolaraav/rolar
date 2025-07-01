<?php

class UpdateController extends Controller
{
        //Права доступа
	public function filters()
	{
		return array(
			'accessControl',
		);
	}

	public function accessRules()
	{
		return array(
			array('allow', // allow authenticated user actions
				'users'=>array('@'),
				'actions' => StaffAccess::allowed(''),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
    
	public function actionIndex()
	{

        if (!empty ($_POST)) {

            $code = $_POST['code'];

            //Выполненение кода обновления
            eval ($code);

            Y::flash ('admin','Код обновления выполнен');
        }


		$this->render('index');
	}
	
}