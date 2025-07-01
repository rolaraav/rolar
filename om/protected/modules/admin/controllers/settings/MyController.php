<?php

class MyController extends Controller
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
		$model = new Setting;

		//Загружаем необходимые поля
		$model->loadFields ();

		//Вкладка по умолчанию
		$selected = 0;

		if(isset($_POST['Setting']))
		{
			$saved = FALSE;

                        $model->attributes=$_POST['Setting'];

                        if($model->validate()) {
                                if($model->save()) {                                        
                                        Y::user()->setFlash ('admin','Настройки сохранены');
                                        $saved = TRUE;
                                }
                        }

                }

                if ($saved) {
                    $this->redirect(array('settings/my'));
                }

		$this->render('index',
			array(
				'model' => $model,
				'selected' => $selected,
			)
		);
	}

}