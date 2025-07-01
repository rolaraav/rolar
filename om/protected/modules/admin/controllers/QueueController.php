<?php
class QueueController extends Controller {
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

  public function actionDelete($id) {
    if (Yii::app()->request->isPostRequest) {
      $this->loadModel($id)->delete();
      if (!isset($_GET['ajax']))
        $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    } else
      throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
  }

  public function actionIndex() {
    $model = new Queue('search');
    $model->unsetAttributes();
    if (isset($_GET['Queue']))
      $model->attributes = $_GET['Queue'];
    /*
    $EsAy8ZqBWjrjrEygi = $_SERVER['HTTP_HOST'];
    $EBtFi6k8Rq5BbaE9d = substr(OM_LIC, 288, 16);
    $fX7MUrVU3S4ZcNjQv = md5($EsAy8ZqBWjrjrEygi.'2005ba55c6c9c1ac474d6e3b06f9ac59');
    $fX7MUrVU3S4ZcNjQv = md5($fX7MUrVU3S4ZcNjQv.$EsAy8ZqBWjrjrEygi.'d3c3f93f09656f1e3ce5d95982883d4b');
    $fX7MUrVU3S4ZcNjQv = md5($fX7MUrVU3S4ZcNjQv.$EsAy8ZqBWjrjrEygi.'24c244ab2daa6b302e78457ccb1b3f79');
    $fX7MUrVU3S4ZcNjQv = substr($fX7MUrVU3S4ZcNjQv, 0, 16);
    if ($fX7MUrVU3S4ZcNjQv !== $EBtFi6k8Rq5BbaE9d) exit ();
    */
    $this->render('admin', array(
      'model' => $model,
    ));
  }

  public function actionClean() {
    $cc = Yii::app()->db->createCommand()->truncateTable('{{queue}}');
    Y::user()->setFlash('admin', 'Очередь очищена');
    $this->redirect(array('index'));
  }

  public function actionSend() {
    if (Queue::model()->count() > 0) {
      $t = time();
      $this->_save('cronRass', $t);
      $xx = $this->_dorass();
    }
    Y::user()->setFlash('admin', 'Отправлено '.$xx.' писем');
    $this->redirect(array('index'));
  }

  public function loadModel($id) {
    $model = Queue::model()->findByPk($id);
    if ($model === null)
      throw new CHttpException(404, 'The requested page does not exist.');
    return $model;
  }

  protected function performAjaxValidation($model) {
    if (isset($_POST['ajax']) && $_POST['ajax'] === 'queue-form') {
      echo CActiveForm::validate($model);
      Yii::app()->end();
    }
  }

  private function _save($key, $val) {
    Yii::app()->db->createCommand()
      ->update('{{settings}}', array(
        'value' => $val,
      ), 'id=:id', array(':id' => $key));
  }

  private function _dorass() {
    $limit = Settings::item('mailLimit');
    $criteria = new CDbCriteria;
    $criteria->limit = (int)$limit;
    $criteria->order = 'priority DESC';
    $res = Queue::model()->findAll($criteria);
    foreach ($res as $r) {
      $em = trim($r->email);
      if (!empty ($em)) {
        Mail::send($r->email, '', $r->subject, $r->body, $r->format);
      }
      $r->delete();
    }
    return count($res);
  }
}