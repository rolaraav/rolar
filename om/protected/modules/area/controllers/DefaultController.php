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
        'actions' => array('index', 'logout', 'prolong', 'end'),
        'users' => array('@'),
      ),
      array('deny',
        'users' => array('*'),
      ),
    );
  }

  public function actionIndex() {
    if (Y::user()->payTill < time()) {
      $this->redirect(array('end'));
    }
    $sections = $models = AreaSection::model()->findAll(array(
      'order' => 'position',
      'condition' => 'area_id=:id',
      'params' => array(':id' => Y::user()->areaId),
    ));
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
      'sections' => $sections,
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
        $this->redirect(array('/area'));
    }
    $this->render('/default/login', array('model' => $model));
  }

  public function actionLogout() {
    Yii::app()->user->logout();
    $this->redirect(array('/area'));
  }

  public function actionEnd() {
    $this->render('noaccess');
  }

  public function actionProlong() {
    if (empty ($_POST))
      die ('Не заполнена форма');
    $pid = $_POST['paylist_id'];
    if (!is_numeric($pid))
      die ('Неверный номер');
    $pl = AreaPaylist::model()->findByPk($pid);
    if (!$pl)
      die ('Извините, но такой срок не найден');
    if ($pl->area_id != Yii::app()->user->areaId)
      die ('Данный срок не относится к этой закрытой зоне');
    Bill::areaBill($pl->area_id, Yii::app()->user->id, $pl->srok, $pl->price);
  }
}