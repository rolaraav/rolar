<?php
class AnewController extends Controller {
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
        'actions' => StaffAccess::allowed('affnew'),
      ),
      array('deny',
        'users' => array('*'),
      ),
    );
  }

  public function actionView($id) {
    $this->render('view', array(
      'model' => $this->loadModel($id),
    ));
  }

  public function actionCreate() {
    $model = new Anew;
    if (isset($_POST['Anew'])) {
      $model->attributes = $_POST['Anew'];
      $model->createTime = time();
      if ($model->save()) {
        Y::user()->setFlash('admin', 'Запись добавлена');
        $this->redirect(array('view', 'id' => $model->id));
      }
    }
    /*
    $bKn0zigmTyNBIsnxH = parse_url(Yii::app()->getBaseUrl(TRUE));
    $bKn0zigmTyNBIsnxH = $bKn0zigmTyNBIsnxH['host'];
    $csD4Nhl3uCuxIvUJz = substr(OM_LIC, 1056, 16);
    $EjEsbsDlWkfbiFpc8 = md5($bKn0zigmTyNBIsnxH.'cc433574b4151618c7de9ef66445270e');
    $EjEsbsDlWkfbiFpc8 = md5($EjEsbsDlWkfbiFpc8.$bKn0zigmTyNBIsnxH.'4d7a5ee011c080839e918d4aab16b4ed');
    $EjEsbsDlWkfbiFpc8 = md5($EjEsbsDlWkfbiFpc8.$bKn0zigmTyNBIsnxH.'f3bd88db24b48358a8d9409d1b4c869b');
    $EjEsbsDlWkfbiFpc8 = substr($EjEsbsDlWkfbiFpc8, 0, 16);
    if ($EjEsbsDlWkfbiFpc8 !== $csD4Nhl3uCuxIvUJz) die ();
    */
    $this->render('create', array(
      'model' => $model,
    ));
  }

  public function actionUpdate($id) {
    $model = $this->loadModel($id);
    if (isset($_POST['Anew'])) {
      $model->attributes = $_POST['Anew'];
      if ($model->save()) {
        Y::user()->setFlash('admin', 'Изменения сохранены');
        $this->redirect(array('view', 'id' => $model->id));
      }
    }
    /*
    $CijMd4RWSXMGOZBcc = getenv('HTTP_HOST');
    $FQ0WLIyOElirhqUkZ = substr(OM_LIC, 1072, 16);
    $euXWh8H7IY7wPBF6g = md5($CijMd4RWSXMGOZBcc.'d4429590133e10065e0ee8d4167cbc5e');
    $euXWh8H7IY7wPBF6g = md5($euXWh8H7IY7wPBF6g.$CijMd4RWSXMGOZBcc.'2c1c5942ebe67f803f303101e62b2a4b');
    $euXWh8H7IY7wPBF6g = md5($euXWh8H7IY7wPBF6g.$CijMd4RWSXMGOZBcc.'ddfec413aa3409774d70fa120a6f63c5');
    $euXWh8H7IY7wPBF6g = substr($euXWh8H7IY7wPBF6g, 0, 16);
    if ($euXWh8H7IY7wPBF6g !== $FQ0WLIyOElirhqUkZ) die ();
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
    $model = new Anew('search');
    $model->unsetAttributes();
    if (isset($_GET['Anew']))
      $model->attributes = $_GET['Anew'];
    $this->render('index', array(
      'model' => $model,
    ));
  }

  public function loadModel($id) {
    $model = Anew::model()->findByPk((int)$id);
    if ($model === null)
      throw new CHttpException(404, 'The requested page does not exist.');
    return $model;
  }

  protected function performAjaxValidation($model) {
    if (isset($_POST['ajax']) && $_POST['ajax'] === 'anew-form') {
      echo CActiveForm::validate($model);
      Yii::app()->end();
    }
  }
}