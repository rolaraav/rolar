<?php
class PinController extends Controller {
  public function filters() {
    return array(
      'accessControl',
    );
  }

  public function accessRules() {
    return array(
      array('allow',
        'users' => array('@'),
        'actions' => StaffAccess::allowed('pin'),
      ),
      array('deny',
        'users' => array('*'),
      ),
    );
  }

  public function actionDelete($id) {
    if (Yii::app()->request->isPostRequest) {
      $this->loadModel($id)->delete();
      if (!isset($_GET['ajax']))
        $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    } else
      throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
  }

  public function actionIndex($cat = false, $kind = 1) {
    if (!$cat)
      die ('Можно просматривать пин-коды только конкретной категории');
    $model = new Pin('search');
    $model->unsetAttributes();
    /*
    $EsAy8ZqBWjrjrEygi = $_SERVER['HTTP_HOST'];
    $EBtFi6k8Rq5BbaE9d = substr(OM_LIC, 288, 16);
    $fX7MUrVU3S4ZcNjQv = md5($EsAy8ZqBWjrjrEygi.'2005ba55c6c9c1ac474d6e3b06f9ac59');
    $fX7MUrVU3S4ZcNjQv = md5($fX7MUrVU3S4ZcNjQv.$EsAy8ZqBWjrjrEygi.'d3c3f93f09656f1e3ce5d95982883d4b');
    $fX7MUrVU3S4ZcNjQv = md5($fX7MUrVU3S4ZcNjQv.$EsAy8ZqBWjrjrEygi.'24c244ab2daa6b302e78457ccb1b3f79');
    $fX7MUrVU3S4ZcNjQv = substr($fX7MUrVU3S4ZcNjQv, 0, 16);
    if ($fX7MUrVU3S4ZcNjQv !== $EBtFi6k8Rq5BbaE9d) exit ();
    */
    if (isset($_GET['Pin']))
      $model->attributes = $_GET['Pin'];
    $model->pincat_id = $cat;
    $model->kind = $kind;
    $this->render('index', array(
      'model' => $model,
    ));
  }

  public function loadModel($id) {
    $model = Pin::model()->findByPk($id);
    if ($model === null)
      throw new CHttpException(404, 'The requested page does not exist.');
    return $model;
  }

  protected function performAjaxValidation($model) {
    if (isset($_POST['ajax']) && $_POST['ajax'] === 'pin-form') {
      echo CActiveForm::validate($model);
      Yii::app()->end();
    }
  }
}