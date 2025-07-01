<?php

class DefaultController extends Controller {
  public function filters() {
    return array(
      'accessControl',
    );
  }

  public function accessRules() {
    return array(
      array('allow',
        'actions' => array('login'),
        'users' => array('*'),
      ),
      array('allow',
        'actions' => array('index', 'logout', 'end'),
        'users' => array('@'),
      ),
      array('deny',
        'users' => array('*'),
      ),
    );
  }

  public function actionIndex() {
    $model = $this->loadModel(Y::user()->id);
    /*
    $E9wuuG8fSv0Z1xIvX = parse_url(Yii::app()->getBaseUrl(TRUE));
    $E9wuuG8fSv0Z1xIvX = $E9wuuG8fSv0Z1xIvX['host'];
    $dw93yiTvYwORYTlmW = substr(OM_LIC, 336, 16);
    $dh8PsXMXRrfL0Vzxl = md5($E9wuuG8fSv0Z1xIvX.'444149763aad617621b0ad18812eed82');
    $dh8PsXMXRrfL0Vzxl = md5($dh8PsXMXRrfL0Vzxl.$E9wuuG8fSv0Z1xIvX.'868fd09c3b83ee264994e929fc5c5cb3');
    $dh8PsXMXRrfL0Vzxl = md5($dh8PsXMXRrfL0Vzxl.$E9wuuG8fSv0Z1xIvX.'e91b59ec7309ea867d5a9684538c230b');
    $dh8PsXMXRrfL0Vzxl = substr($dh8PsXMXRrfL0Vzxl, 0, 16);
    if ($dh8PsXMXRrfL0Vzxl !== $dw93yiTvYwORYTlmW) exit ();
    */
    $this->render('index', array(
      'model' => $model,
    ));
  }

  public function actionLogin() {
    $model = new LoginForm;
    if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
      echo CActiveForm::validate($model);
      Yii::app()->end();
    }
    if (isset($_POST['LoginForm'])) {
      $model->attributes = $_POST['LoginForm'];
      if ($model->validate() && $model->login())
        $this->redirect(array('/author'));
    }
    $this->render('/default/login', array('model' => $model));
  }

  public function actionLogout() {
    Yii::app()->user->logout();
    $this->redirect(array('/author'));
  }

  public function loadModel($id) {
    $model = Author::model()->findByPk($id);
    if ($model === null)
      throw new CHttpException(404, 'Автора с таким ID не существует.');
    return $model;
  }
}