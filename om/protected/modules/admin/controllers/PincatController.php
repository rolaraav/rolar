<?php
class PincatController extends Controller {
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
        'actions' => StaffAccess::allowed('pincat'),
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
    $model = new Pincat;
    if (isset($_POST['Pincat'])) {
      $model->attributes = $_POST['Pincat'];
      if ($model->save())
        $this->redirect(array('view', 'id' => $model->id));
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
    if (isset($_POST['Pincat'])) {
      $model->attributes = $_POST['Pincat'];
      if ($model->save())
        $this->redirect(array('view', 'id' => $model->id));
    }
    $this->render('update', array(
      'model' => $model,
    ));
  }

  public function actionDelete($id) {
    if (Yii::app()->request->isPostRequest) {
      $this->loadModel($id)->delete();
      if (!isset($_GET['ajax']))
        $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    } else
      throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
  }

  public function actionIndex() {
    $model = new Pincat('search');
    $model->unsetAttributes();
    if (isset($_GET['Pincat']))
      $model->attributes = $_GET['Pincat'];
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
    $model = Pincat::model()->findByPk($id);
    if ($model === null)
      throw new CHttpException(404, 'The requested page does not exist.');
    return $model;
  }

  protected function performAjaxValidation($model) {
    if (isset($_POST['ajax']) && $_POST['ajax'] === 'pincat-form') {
      echo CActiveForm::validate($model);
      Yii::app()->end();
    }
  }

  public function actionAddcodes($id) {
    if (empty ($_POST)) {
      die ('Не переданы коды');
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
    $codes = trim($_POST['tbody']);
    if (empty ($codes))
      die ('Не введены коды');
    $codes = str_replace("\r\n", "\n", $codes);
    $codes = str_replace("\r", "\n", $codes);
    $arr = explode("\n", $codes);
    $nn = 0;
    foreach ($arr as $one) {
      $one = trim($one);
      if (empty ($one))
        continue;
      $pp = Pin::model()->find(array(
        'condition' => 'pincat_id = :pincat_id AND code = :code',
        'params' => array(
          ':pincat_id' => $id + 0,
          ':code' => $one,
        ),
      ));
      if ($pp)
        continue;
      $pin = new Pin ();
      $pin->id = false;
      $pin->pincat_id = $id + 0;
      $pin->isNewRecord = true;
      $pin->added = time();
      $pin->used = 0;
      $pin->code = $one;
      $pin->save();
      $nn++;
    }
    Y::user()->setFlash('admin', 'Добавлено '.$nn.' кодов');
    $this->redirect(array('pin/index', 'cat' => $id));
  }
}