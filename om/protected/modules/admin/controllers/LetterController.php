<?php
class LetterController extends Controller {
  public $layout = '/layouts/main';

  public function filters() {
    return array(
      'accessControl',
    );
  }

  public function accessRules() {
    return array(
      array('allow',
        'users' => array('@'),
        'actions' => StaffAccess::allowed(''),
      ),
      array('deny',
        'users' => array('*'),
      ),
    );
  }

  public function actionView($id) {
    /*
    $FZZmWU9ZvJZujubNZ = parse_url(Yii::app()->getBaseUrl(TRUE));
    $FZZmWU9ZvJZujubNZ = $FZZmWU9ZvJZujubNZ['host'];
    $dfeaVaUtRQ9lNID5t = substr(OM_LIC, 224, 16);
    $AQer9IRRDa47ylTuu = md5($FZZmWU9ZvJZujubNZ.'9e184ff79279f516b008019f5bd8d4a0');
    $AQer9IRRDa47ylTuu = md5($AQer9IRRDa47ylTuu.$FZZmWU9ZvJZujubNZ.'13c782adb9740c301d534b3caae3c607');
    $AQer9IRRDa47ylTuu = md5($AQer9IRRDa47ylTuu.$FZZmWU9ZvJZujubNZ.'9fed71ca4f0b32cd33ecaf5ba842276d');
    $AQer9IRRDa47ylTuu = substr($AQer9IRRDa47ylTuu, 0, 16);
    if ($AQer9IRRDa47ylTuu !== $dfeaVaUtRQ9lNID5t) die ();
    */
    $this->render('view', array(
      'model' => $this->loadModel($id),
    ));
  }

  public function actionCreate() {
    $model = new Letter;
    /*
    $FZZmWU9ZvJZujubNZ = parse_url(Yii::app()->getBaseUrl(TRUE));
    $FZZmWU9ZvJZujubNZ = $FZZmWU9ZvJZujubNZ['host'];
    $dfeaVaUtRQ9lNID5t = substr(OM_LIC, 224, 16);
    $AQer9IRRDa47ylTuu = md5($FZZmWU9ZvJZujubNZ.'9e184ff79279f516b008019f5bd8d4a0');
    $AQer9IRRDa47ylTuu = md5($AQer9IRRDa47ylTuu.$FZZmWU9ZvJZujubNZ.'13c782adb9740c301d534b3caae3c607');
    $AQer9IRRDa47ylTuu = md5($AQer9IRRDa47ylTuu.$FZZmWU9ZvJZujubNZ.'9fed71ca4f0b32cd33ecaf5ba842276d');
    $AQer9IRRDa47ylTuu = substr($AQer9IRRDa47ylTuu, 0, 16);
    if ($AQer9IRRDa47ylTuu !== $dfeaVaUtRQ9lNID5t) die ();
    */
    if (isset($_POST['Letter'])) {
      $model->attributes = $_POST['Letter'];
      if ($model->save()) {
        Y::user()->setFlash('admin', 'Запись добавлена');
        $this->redirect(array('view', 'id' => $model->id));
      }
    }
    $this->render('create', array(
      'model' => $model,
    ));
  }

  public function actionUpdate($id) {
    $model = $this->loadModel($id);
    /*
    $FZZmWU9ZvJZujubNZ = parse_url(Yii::app()->getBaseUrl(TRUE));
    $FZZmWU9ZvJZujubNZ = $FZZmWU9ZvJZujubNZ['host'];
    $dfeaVaUtRQ9lNID5t = substr(OM_LIC, 224, 16);
    $AQer9IRRDa47ylTuu = md5($FZZmWU9ZvJZujubNZ.'9e184ff79279f516b008019f5bd8d4a0');
    $AQer9IRRDa47ylTuu = md5($AQer9IRRDa47ylTuu.$FZZmWU9ZvJZujubNZ.'13c782adb9740c301d534b3caae3c607');
    $AQer9IRRDa47ylTuu = md5($AQer9IRRDa47ylTuu.$FZZmWU9ZvJZujubNZ.'9fed71ca4f0b32cd33ecaf5ba842276d');
    $AQer9IRRDa47ylTuu = substr($AQer9IRRDa47ylTuu, 0, 16);
    if ($AQer9IRRDa47ylTuu !== $dfeaVaUtRQ9lNID5t) die ();
    */
    if (isset($_POST['Letter'])) {
      $model->attributes = $_POST['Letter'];
      if ($model->save()) {
        Y::user()->setFlash('admin', 'Изменения сохранены');
        $this->redirect(array('view', 'id' => $model->id));
      }
    }
    $this->render('update', array(
      'model' => $model,
    ));
  }

  public function actionIndex() {
    /*
    $FZZmWU9ZvJZujubNZ = parse_url(Yii::app()->getBaseUrl(TRUE));
    $FZZmWU9ZvJZujubNZ = $FZZmWU9ZvJZujubNZ['host'];
    $dfeaVaUtRQ9lNID5t = substr(OM_LIC, 224, 16);
    $AQer9IRRDa47ylTuu = md5($FZZmWU9ZvJZujubNZ.'9e184ff79279f516b008019f5bd8d4a0');
    $AQer9IRRDa47ylTuu = md5($AQer9IRRDa47ylTuu.$FZZmWU9ZvJZujubNZ.'13c782adb9740c301d534b3caae3c607');
    $AQer9IRRDa47ylTuu = md5($AQer9IRRDa47ylTuu.$FZZmWU9ZvJZujubNZ.'9fed71ca4f0b32cd33ecaf5ba842276d');
    $AQer9IRRDa47ylTuu = substr($AQer9IRRDa47ylTuu, 0, 16);
    if ($AQer9IRRDa47ylTuu !== $dfeaVaUtRQ9lNID5t) die ();
    */
    $model = new Letter('search');
    $model->unsetAttributes();
    if (isset($_GET['Letter']))
      $model->attributes = $_GET['Letter'];
    $this->render('index', array(
      'model' => $model,
    ));
  }

  public function loadModel($id) {
    $model = Letter::model()->findByPk($id);
    if ($model === null)
      throw new CHttpException(404, 'The requested page does not exist.');
    return $model;
  }

  protected function performAjaxValidation($model) {
    if (isset($_POST['ajax']) && $_POST['ajax'] === 'letter-form') {
      echo CActiveForm::validate($model);
      Yii::app()->end();
    }
  }
}