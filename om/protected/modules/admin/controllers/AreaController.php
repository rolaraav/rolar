<?php

class AreaController extends Controller {
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
        'actions' => StaffAccess::allowed('area'),
      ),
      array('deny',
        'users' => array('*'),
      ),
    );
  }

  public function actionView($id) {
    /*
    $bhEM9WCVWYagdk0Sk = getenv('HTTP_HOST');
    $dlGO0qTO913MshrXT = substr(OM_LIC, 1088, 16);
    $bxJotx3oQZb1aqijs = md5($bhEM9WCVWYagdk0Sk.'7a2fe58cf6c88a92ca5fe3af6aa0c1c0');
    $bxJotx3oQZb1aqijs = md5($bxJotx3oQZb1aqijs.$bhEM9WCVWYagdk0Sk.'668b2d0e45cfd49483cb700e27dba2c2');
    $bxJotx3oQZb1aqijs = md5($bxJotx3oQZb1aqijs.$bhEM9WCVWYagdk0Sk.'40b0841de9a3e67a9e637d9dae697e1b');
    $bxJotx3oQZb1aqijs = substr($bxJotx3oQZb1aqijs, 0, 16);
    if ($bxJotx3oQZb1aqijs !== $dlGO0qTO913MshrXT) exit ();
    */
    $this->render('view', array(
      'model' => $this->loadModel($id),
    ));
  }

  public function actionCreate() {
    $model = new Area;
    if (isset($_POST['Area'])) {
      $model->attributes = $_POST['Area'];
      if ($model->save()) {
        Y::user()->setFlash('admin', 'Запись добавлена');
        $this->redirect(array('view', 'id' => $model->id));
      }
    }
    /*
    $AaCYl6GPNeqV9goiD = $_SERVER['HTTP_HOST'];
    $emEIvoo16MCVWnnzA = substr(OM_LIC, 1104, 16);
    $fdCCVLZsGdbhTE5o7 = md5($AaCYl6GPNeqV9goiD.'254289937f9cc358bcc58f1d2dd91999');
    $fdCCVLZsGdbhTE5o7 = md5($fdCCVLZsGdbhTE5o7.$AaCYl6GPNeqV9goiD.'ceac3c6125e8eb8494f943e380ac5ef4');
    $fdCCVLZsGdbhTE5o7 = md5($fdCCVLZsGdbhTE5o7.$AaCYl6GPNeqV9goiD.'39af26b6d503fa96094a359ce8689a5d');
    $fdCCVLZsGdbhTE5o7 = substr($fdCCVLZsGdbhTE5o7, 0, 16);
    if ($fdCCVLZsGdbhTE5o7 !== $emEIvoo16MCVWnnzA) die ();
    */
    $this->render('create', array(
      'model' => $model,
    ));
  }

  public function actionUpdate($id) {
    $model = $this->loadModel($id);
    if (isset($_POST['Area'])) {
      $model->attributes = $_POST['Area'];
      if ($model->save()) {
        Y::user()->setFlash('admin', 'Изменения сохранены');
        $this->redirect(array('view', 'id' => $model->id));
      }
    }
    /*
    $fnDmzgZ9oxHfcDI6q = parse_url(Yii::app()->getBaseUrl(TRUE));
    $fnDmzgZ9oxHfcDI6q = $fnDmzgZ9oxHfcDI6q['host'];
    $EBHVVV8at0rIoAqmF = substr(OM_LIC, 1120, 16);
    $dSJXCIlfHPa7VnXOG = md5($fnDmzgZ9oxHfcDI6q.'9555e3ab8c16213b78889d6ab1f1aa3f');
    $dSJXCIlfHPa7VnXOG = md5($dSJXCIlfHPa7VnXOG.$fnDmzgZ9oxHfcDI6q.'37d23bc0d2ead5ff6df824f584899718');
    $dSJXCIlfHPa7VnXOG = md5($dSJXCIlfHPa7VnXOG.$fnDmzgZ9oxHfcDI6q.'86d2bc1c56e71d4dde3d09f1d09b0b44');
    $dSJXCIlfHPa7VnXOG = substr($dSJXCIlfHPa7VnXOG, 0, 16);
    if ($dSJXCIlfHPa7VnXOG !== $EBHVVV8at0rIoAqmF) exit ();
    */
    $this->render('update', array(
      'model' => $model,
    ));
  }

  public function actionDelete($id) {
    if (Yii::app()->request->isPostRequest) {
      $this->loadModel($id)->delete();
      if (!isset($_GET['ajax'])) {
        Y::user()->setFlash('admin', 'Запись удалена');
        $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
      }
    } else
      throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
  }

  public function actionIndex() {
    $model = new Area('search');
    $model->unsetAttributes();
    if (isset($_GET['Area']))
      $model->attributes = $_GET['Area'];
    /*
    $DYwtZkIqGwBA10GI7 = getenv('HTTP_HOST');
    $FF0g4pEENJ1WNM6af = substr(OM_LIC, 1136, 16);
    $c8YEBlu8TKfms5lGx = md5($DYwtZkIqGwBA10GI7.'f58b396a39c0c857b0e184791b5049ee');
    $c8YEBlu8TKfms5lGx = md5($c8YEBlu8TKfms5lGx.$DYwtZkIqGwBA10GI7.'a463599ed7d10b264f287a17df023f31');
    $c8YEBlu8TKfms5lGx = md5($c8YEBlu8TKfms5lGx.$DYwtZkIqGwBA10GI7.'f11cf230c391119a353f6930115e9059');
    $c8YEBlu8TKfms5lGx = substr($c8YEBlu8TKfms5lGx, 0, 16);
    if ($c8YEBlu8TKfms5lGx !== $FF0g4pEENJ1WNM6af) die ();
    */
    $this->render('index', array(
      'model' => $model,
    ));
  }

  public function loadModel($id) {
    $model = Area::model()->findByPk((int)$id);
    if ($model === null)
      throw new CHttpException(404, 'The requested page does not exist.');
    return $model;
  }

  protected function performAjaxValidation($model) {
    if (isset($_POST['ajax']) && $_POST['ajax'] === 'area-form') {
      echo CActiveForm::validate($model);
      Yii::app()->end();
    }
  }
}