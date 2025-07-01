<?php
class InstallController extends Controller
{
	public function actionIndex()
	{
            //Проверяем была ли установка
            if (in_array('om_settings',Yii::app()->db->schema->tableNames)) {
                die ('Система Order Master 2 уже установлена');
            }
            
            if (!empty ($_POST)) {
                
                //проверяем секреный ключ
//		die (Y::param('secretKey'));	
                if (md5($_POST['secret'])!=Y::param('secretKey')) {
                    die ('Секретный ключ не соответствует записанному в config/main.php');
                }
                
                //Иначе делаем установку
                $_POST['file'] = 'install.sql';
                //Y::dump ($_POST);
                $email = $_POST['email'];
                $uname = $_POST['email'];
                
                $dbBackup=Yii::createComponent('application.extensions.dbBackupRestore.EdbBackupRestore');
                $dbBackup->backupPath="./protected/_backup/";                
                
                $dbBackup->restore();
                //$dbBackup->run();


                
                //Обновляем парочку записей для админа
                //Обновляем автора и оператора
                $a = Author::model()->findByPk ('1');
                
                if ($a!=FALSE) {
                    $a->email = $email;
                    $a->uname = $uname;
                    $a->password = H::random_string ('alnum',20);
                    $a->save (FALSE);
                }
                
                //Оператор
                $s = Staff::model ()->findByPk (1);
                
                if ($s!=FALSE) {
                    $s->email = $email;
                    $s->firstName = $uname;                    
                    $s->password = md5('pass'.'adminpassword'.Y::param('secretKey'));
                    $s->_logging = TRUE;
                    $s->save (FALSE,array('email','uname','password'));
                }

                //Новые системы платёжные
                //$np = new NwaysPatch ();
                //$np->actionPatch (false);
                
                // перенаправление
                echo '<script language="javascript">
                    window.location = \''.Y::bu().'install/ok'.'\';
                </script>';
                //$this->redirect (array('ok'));
                
            }
            
            $this->render('index');
                
	}

	public function actionOk()
	{
		$this->render('ok');
	}

}