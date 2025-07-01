<?php

class RezervController extends Controller
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

            $dbBackup=Yii::createComponent('application.extensions.dbBackupRestore.EdbBackupRestore');
            $dbBackup->backupPath="./protected/_backup/";
            if($_POST)
            {
                    switch($_GET['act'])
                    {
                            case "dboption": { $dbBackup->dboption($_POST['whattodo'],$_POST['tables']); $this->redirect(Yii::app()->request->getUrlReferrer()); break; }
                            case "backup"  : { $dbBackup->backup(); break; }
                            case "restore" : { $dbBackup->restore(); break; }
                            default        : { $this->redirect(Yii::app()->request->getUrlReferrer()); break; }
                    }
            }
            else
            {
                    $r=$dbBackup->run();
                    $this->render('index',array('content'=>$r,'backupPath' => $dbBackup->backupPath));
            }
	}

}