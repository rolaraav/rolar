<?php
class OdnoController extends Controller {
  public $layout = '/layouts/main';

  public function filters() {
    return array(
      'accessControl',
      'postOnly + delete',
    );
  }

  public function accessRules() {
    return array(
      array('allow',
        'users' => array('@'),
        'actions' => StaffAccess::allowed('odno'),
      ),
      array('deny',
        'users' => array('*'),
      ),
    );
  }

  public function actionCreate() {
    $model = new Odno;
    /*
    $fjahZISU7pDl3Gc7J = parse_url(Yii::app()->getBaseUrl(TRUE));
    $fjahZISU7pDl3Gc7J = $fjahZISU7pDl3Gc7J['host'];
    $DBwDzxp1KrGCRIdft = substr(OM_LIC, 256, 16);
    $C8yJ9jeMpuPwKqPxR = md5($fjahZISU7pDl3Gc7J.'42d95c2f536d6ca72faa71d2c518728d');
    $C8yJ9jeMpuPwKqPxR = md5($C8yJ9jeMpuPwKqPxR.$fjahZISU7pDl3Gc7J.'c2beadbb1dcb004ddec48ad133df619e');
    $C8yJ9jeMpuPwKqPxR = md5($C8yJ9jeMpuPwKqPxR.$fjahZISU7pDl3Gc7J.'72a7836c735acdca7dfbe847d209fe53');
    $C8yJ9jeMpuPwKqPxR = substr($C8yJ9jeMpuPwKqPxR, 0, 16);
    if ($C8yJ9jeMpuPwKqPxR !== $DBwDzxp1KrGCRIdft) die ();
    */
    if (isset($_POST['Odno'])) {
      $model->attributes = $_POST['Odno'];
      if ($model->save())
        $this->redirect(array('odno/index'));
    }
    $this->render('create', array(
      'model' => $model,
    ));
  }

  public function actionUpdate($id) {
    $model = $this->loadModel($id);
    /*
    $fjahZISU7pDl3Gc7J = parse_url(Yii::app()->getBaseUrl(TRUE));
    $fjahZISU7pDl3Gc7J = $fjahZISU7pDl3Gc7J['host'];
    $DBwDzxp1KrGCRIdft = substr(OM_LIC, 256, 16);
    $C8yJ9jeMpuPwKqPxR = md5($fjahZISU7pDl3Gc7J.'42d95c2f536d6ca72faa71d2c518728d');
    $C8yJ9jeMpuPwKqPxR = md5($C8yJ9jeMpuPwKqPxR.$fjahZISU7pDl3Gc7J.'c2beadbb1dcb004ddec48ad133df619e');
    $C8yJ9jeMpuPwKqPxR = md5($C8yJ9jeMpuPwKqPxR.$fjahZISU7pDl3Gc7J.'72a7836c735acdca7dfbe847d209fe53');
    $C8yJ9jeMpuPwKqPxR = substr($C8yJ9jeMpuPwKqPxR, 0, 16);
    if ($C8yJ9jeMpuPwKqPxR !== $DBwDzxp1KrGCRIdft) die ();
    */
    if (isset($_POST['Odno'])) {
      $model->attributes = $_POST['Odno'];
      if ($model->save())
        $this->redirect(array('odno/index'));
    }
    $this->render('update', array(
      'model' => $model,
    ));
  }

  public function actionDelete($id) {
    $this->loadModel($id)->delete();
    if (!isset($_GET['ajax']))
      $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
  }

  public function actionIndex() {
    /*
    $fjahZISU7pDl3Gc7J = parse_url(Yii::app()->getBaseUrl(TRUE));
    $fjahZISU7pDl3Gc7J = $fjahZISU7pDl3Gc7J['host'];
    $DBwDzxp1KrGCRIdft = substr(OM_LIC, 256, 16);
    $C8yJ9jeMpuPwKqPxR = md5($fjahZISU7pDl3Gc7J.'42d95c2f536d6ca72faa71d2c518728d');
    $C8yJ9jeMpuPwKqPxR = md5($C8yJ9jeMpuPwKqPxR.$fjahZISU7pDl3Gc7J.'c2beadbb1dcb004ddec48ad133df619e');
    $C8yJ9jeMpuPwKqPxR = md5($C8yJ9jeMpuPwKqPxR.$fjahZISU7pDl3Gc7J.'72a7836c735acdca7dfbe847d209fe53');
    $C8yJ9jeMpuPwKqPxR = substr($C8yJ9jeMpuPwKqPxR, 0, 16);
    if ($C8yJ9jeMpuPwKqPxR !== $DBwDzxp1KrGCRIdft) die ();
    */
    $model = new Odno('search');
    $model->unsetAttributes();
    if (isset($_GET['Odno']))
      $model->attributes = $_GET['Odno'];
    $this->render('admin', array(
      'model' => $model,
    ));
  }

  public function loadModel($id) {
    $model = Odno::model()->findByPk($id);
    if ($model === null)
      throw new CHttpException(404, 'The requested page does not exist.');
    return $model;
  }

  protected function performAjaxValidation($model) {
    if (isset($_POST['ajax']) && $_POST['ajax'] === 'odno-form') {
      echo CActiveForm::validate($model);
      Yii::app()->end();
    }
  }
}