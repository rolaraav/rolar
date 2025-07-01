<?php
class MainController extends Controller {

  public function actionIndex() {

    $this->layout = '//layouts/main';

    /*
    $F0vP8EqvGZGOzB7w8 = getenv('HTTP_HOST');
    $Ajqctdx1nkfJK44Tv = substr(OM_LIC, 304, 16);
    $b19PAFO6y0FJ5ecEA = md5($F0vP8EqvGZGOzB7w8.'27a3bc98738180a68571105692b5713b');
    $b19PAFO6y0FJ5ecEA = md5($b19PAFO6y0FJ5ecEA.$F0vP8EqvGZGOzB7w8.'111580c61a2e01a9c5ecd19be48fa8b3');
    $b19PAFO6y0FJ5ecEA = md5($b19PAFO6y0FJ5ecEA.$F0vP8EqvGZGOzB7w8.'3511e6b99bf763036ee0a174145c3223');
    $b19PAFO6y0FJ5ecEA = substr($b19PAFO6y0FJ5ecEA, 0, 16);
    if ($b19PAFO6y0FJ5ecEA !== $Ajqctdx1nkfJK44Tv) exit ();
    */

    $this->render('/main/index');

  }

  public function actionError() {
    if ($error = Yii::app()->errorHandler->error) {
      if (Yii::app()->request->isAjaxRequest)
        echo $error['message']; else $this->render('error', $error);
    }
  }

  public function actionTest() {
    echo '123';
  }

}