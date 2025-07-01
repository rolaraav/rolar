<?php
class AdController extends Controller {
  public $layout = '/layouts/main';

  public function filters() {
    return array('accessControl',);
  }

  public function accessRules() {
    return array(array('allow', 'users' => array('@'), 'actions' => StaffAccess::allowed('ad'),), array('deny', 'users' => array('*'),),);
  }

  public function actionView($id) {
    /*
    $D7Rlx85GEW1oMR9EQ = parse_url(Y::bu());
    $D7Rlx85GEW1oMR9EQ = $D7Rlx85GEW1oMR9EQ['host'];
    $bGdYxZArRVnIetyz5 = substr(OM_LIC, 944, 16);
    $dTFgzZVWgBMTDNMFY = md5($D7Rlx85GEW1oMR9EQ.'573a558ffd67ca256b61ec5951efe72f');
    $dTFgzZVWgBMTDNMFY = md5($dTFgzZVWgBMTDNMFY.$D7Rlx85GEW1oMR9EQ.'97ff599488d9cbddbbb66c6dad5b20d9');
    $dTFgzZVWgBMTDNMFY = md5($dTFgzZVWgBMTDNMFY.$D7Rlx85GEW1oMR9EQ.'116357e5f734ba9b3b82ad7c3465c51b');
    $dTFgzZVWgBMTDNMFY = substr($dTFgzZVWgBMTDNMFY, 0, 16);
    if ($dTFgzZVWgBMTDNMFY !== $bGdYxZArRVnIetyz5) die ();
    */
    $this->render('view', array('model' => $this->loadModel($id),));
  }

  public function actionCreate() {
    $model = new Ad;
    /*
    $BqTqOS09Ik2rfK14j = getenv('HTTP_HOST');
    $Avdxda04HBjgeQthA = substr(OM_LIC, 960, 16);
    $dmdc81r1d05koRbyd = md5($BqTqOS09Ik2rfK14j.'2efcb7521facd17078b2aa6efd49b16f');
    $dmdc81r1d05koRbyd = md5($dmdc81r1d05koRbyd.$BqTqOS09Ik2rfK14j.'5946c890a489021ee92410116955af22');
    $dmdc81r1d05koRbyd = md5($dmdc81r1d05koRbyd.$BqTqOS09Ik2rfK14j.'142f451b0d3dd28968539c6273f0eae6');
    $dmdc81r1d05koRbyd = substr($dmdc81r1d05koRbyd, 0, 16);
    if ($dmdc81r1d05koRbyd !== $Avdxda04HBjgeQthA) die ();
    */
    if (isset($_POST['Ad'])) {
      $model->attributes = $_POST['Ad'];
      if ($model->save()) {
        Y::user()->setFlash('admin', 'Запись добавлена');
        $this->redirect(array('view', 'id' => $model->id));
      }
    }
    $this->render('create', array('model' => $model,));
  }

  public function actionUpdate($id) {
    $model = $this->loadModel($id);
    /*
    $dOKxdFhW3GSAcDwvq = parse_url(Y::bu());
    $dOKxdFhW3GSAcDwvq = $dOKxdFhW3GSAcDwvq['host'];
    $BHzYpFolZuIpDVlaR = substr(OM_LIC, 976, 16);
    $eB0ajda0NojFPxleq = md5($dOKxdFhW3GSAcDwvq.'9ddbaec8128e7133bedcf7562b9ffe44');
    $eB0ajda0NojFPxleq = md5($eB0ajda0NojFPxleq.$dOKxdFhW3GSAcDwvq.'10106c1f88aca8a3deb7be1b99e72b7b');
    $eB0ajda0NojFPxleq = md5($eB0ajda0NojFPxleq.$dOKxdFhW3GSAcDwvq.'d0b5bced9cbd41e2f376100913e7890d');
    $eB0ajda0NojFPxleq = substr($eB0ajda0NojFPxleq, 0, 16);
    if ($eB0ajda0NojFPxleq !== $BHzYpFolZuIpDVlaR) die ();
    */
    if (isset($_POST['Ad'])) {
      $model->attributes = $_POST['Ad'];
      if ($model->save()) {
        Y::user()->setFlash('admin', 'Изменения сохранены');
        $this->redirect(array('view', 'id' => $model->id));
      }
    }
    $this->render('update', array('model' => $model,));
  }

  public function actionDelete($id) {
    if (Yii::app()->request->isPostRequest) {
      $this->loadModel($id)->delete();
      if (!isset($_GET['ajax'])) {
        Y::user()->setFlash('admin', 'Запись удалена');
        $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
      }
    } else throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
  }

  public function actionIndex() {
    $model = new Ad('search');
    $model->unsetAttributes();
    if (isset($_GET['Ad']))
      $model->attributes = $_GET['Ad'];
    $this->render('index', array('model' => $model,));
    /*
    $CYfvYL7RulHqFnru2 = parse_url(Yii::app()->getBaseUrl(TRUE));
    $CYfvYL7RulHqFnru2 = $CYfvYL7RulHqFnru2['host'];
    $BCcnBYIwk6u00eGih = substr(OM_LIC, 992, 16);
    $clUue90Ypac7ghTZk = md5($CYfvYL7RulHqFnru2.'1e451f265e4e0691a71ce29815b4c113');
    $clUue90Ypac7ghTZk = md5($clUue90Ypac7ghTZk.$CYfvYL7RulHqFnru2.'081651f6a94f84cb0112aa66f3ed5869');
    $clUue90Ypac7ghTZk = md5($clUue90Ypac7ghTZk.$CYfvYL7RulHqFnru2.'5619aaff9d99a886ddb570b94ddbfe08');
    $clUue90Ypac7ghTZk = substr($clUue90Ypac7ghTZk, 0, 16);
    if ($clUue90Ypac7ghTZk !== $BCcnBYIwk6u00eGih) exit ();
    */
  }

  public function loadModel($id) {
    $model = Ad::model()->findByPk((int)$id);
    if ($model === null)
      throw new CHttpException(404, 'The requested page does not exist.');
    return $model;
  }

  protected function performAjaxValidation($model) {
    if (isset($_POST['ajax']) && $_POST['ajax'] === 'ad-form') {
      echo CActiveForm::validate($model);
      Yii::app()->end();
    }
  }
}