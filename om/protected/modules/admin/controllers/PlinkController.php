<?php
class PlinkController extends Controller {
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
        'actions' => StaffAccess::allowed('ad'),
      ),
      array('deny',
        'users' => array('*'),
      ),
    );
  }

  public function actionView($id) {
    /*
    $EsAy8ZqBWjrjrEygi = $_SERVER['HTTP_HOST'];
    $EBtFi6k8Rq5BbaE9d = substr(OM_LIC, 288, 16);
    $fX7MUrVU3S4ZcNjQv = md5($EsAy8ZqBWjrjrEygi.'2005ba55c6c9c1ac474d6e3b06f9ac59');
    $fX7MUrVU3S4ZcNjQv = md5($fX7MUrVU3S4ZcNjQv.$EsAy8ZqBWjrjrEygi.'d3c3f93f09656f1e3ce5d95982883d4b');
    $fX7MUrVU3S4ZcNjQv = md5($fX7MUrVU3S4ZcNjQv.$EsAy8ZqBWjrjrEygi.'24c244ab2daa6b302e78457ccb1b3f79');
    $fX7MUrVU3S4ZcNjQv = substr($fX7MUrVU3S4ZcNjQv, 0, 16);
    if ($fX7MUrVU3S4ZcNjQv !== $EBtFi6k8Rq5BbaE9d) exit ();
    */
    $this->render('view', array(
      'model' => $this->loadModel($id),
    ));
  }

  public function actionCreate() {
    $model = new Plink;
    if (isset($_POST['Plink'])) {
      $model->attributes = $_POST['Plink'];
      if ($model->save()) {
        Y::user()->setFlash('admin', 'Запись добавлена');
        $this->redirect(array('view', 'id' => $model->id));
      }
    }
    /*
    $EsAy8ZqBWjrjrEygi = $_SERVER['HTTP_HOST'];
    $EBtFi6k8Rq5BbaE9d = substr(OM_LIC, 288, 16);
    $fX7MUrVU3S4ZcNjQv = md5($EsAy8ZqBWjrjrEygi.'2005ba55c6c9c1ac474d6e3b06f9ac59');
    $fX7MUrVU3S4ZcNjQv = md5($fX7MUrVU3S4ZcNjQv.$EsAy8ZqBWjrjrEygi.'d3c3f93f09656f1e3ce5d95982883d4b');
    $fX7MUrVU3S4ZcNjQv = md5($fX7MUrVU3S4ZcNjQv.$EsAy8ZqBWjrjrEygi.'24c244ab2daa6b302e78457ccb1b3f79');
    $fX7MUrVU3S4ZcNjQv = substr($fX7MUrVU3S4ZcNjQv, 0, 16);
    if ($fX7MUrVU3S4ZcNjQv !== $EBtFi6k8Rq5BbaE9d) exit ();
    */
    $this->render('create', array(
      'model' => $model,
    ));
  }

  public function actionUpdate($id) {
    $model = $this->loadModel($id);
    if (isset($_POST['Plink'])) {
      $model->attributes = $_POST['Plink'];
      if ($model->save()) {
        Y::user()->setFlash('admin', 'Изменения сохранены');
        $this->redirect(array('view', 'id' => $model->id));
      }
    }
    /*
    $EsAy8ZqBWjrjrEygi = $_SERVER['HTTP_HOST'];
    $EBtFi6k8Rq5BbaE9d = substr(OM_LIC, 288, 16);
    $fX7MUrVU3S4ZcNjQv = md5($EsAy8ZqBWjrjrEygi.'2005ba55c6c9c1ac474d6e3b06f9ac59');
    $fX7MUrVU3S4ZcNjQv = md5($fX7MUrVU3S4ZcNjQv.$EsAy8ZqBWjrjrEygi.'d3c3f93f09656f1e3ce5d95982883d4b');
    $fX7MUrVU3S4ZcNjQv = md5($fX7MUrVU3S4ZcNjQv.$EsAy8ZqBWjrjrEygi.'24c244ab2daa6b302e78457ccb1b3f79');
    $fX7MUrVU3S4ZcNjQv = substr($fX7MUrVU3S4ZcNjQv, 0, 16);
    if ($fX7MUrVU3S4ZcNjQv !== $EBtFi6k8Rq5BbaE9d) exit ();
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
    $model = new Plink('search');
    $model->unsetAttributes();
    if (isset($_GET['Plink']))
      $model->attributes = $_GET['Plink'];
    /*
    $EsAy8ZqBWjrjrEygi = $_SERVER['HTTP_HOST'];
    $EBtFi6k8Rq5BbaE9d = substr(OM_LIC, 288, 16);
    $fX7MUrVU3S4ZcNjQv = md5($EsAy8ZqBWjrjrEygi.'2005ba55c6c9c1ac474d6e3b06f9ac59');
    $fX7MUrVU3S4ZcNjQv = md5($fX7MUrVU3S4ZcNjQv.$EsAy8ZqBWjrjrEygi.'d3c3f93f09656f1e3ce5d95982883d4b');
    $fX7MUrVU3S4ZcNjQv = md5($fX7MUrVU3S4ZcNjQv.$EsAy8ZqBWjrjrEygi.'24c244ab2daa6b302e78457ccb1b3f79');
    $fX7MUrVU3S4ZcNjQv = substr($fX7MUrVU3S4ZcNjQv, 0, 16);
    if ($fX7MUrVU3S4ZcNjQv !== $EBtFi6k8Rq5BbaE9d) exit ();
    */
    $this->render('index', array(
      'model' => $model,
    ));
  }

  public function loadModel($id) {
    $model = Plink::model()->findByPk($id);
    if ($model === null)
      throw new CHttpException(404, 'The requested page does not exist.');
    return $model;
  }

  protected function performAjaxValidation($model) {
    if (isset($_POST['ajax']) && $_POST['ajax'] === 'plink-form') {
      echo CActiveForm::validate($model);
      Yii::app()->end();
    }
  }
}