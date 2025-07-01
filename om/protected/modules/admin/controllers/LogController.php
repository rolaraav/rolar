<?php
class LogController extends Controller {
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
        'actions' => StaffAccess::allowed('log'),
      ),
      array('deny',
        'users' => array('*'),
      ),
    );
  }

  public function actionClear() {
    Yii::app()->db->createCommand()->truncateTable('{{log}}');
    Y::user()->setFlash('admin', Yii::t('admin', 'Журнал операций очищен'));
    $this->redirect(array('log/index'));
  }

  public function actionDelete($id) {
    $this->loadModel($id)->delete();
    if (!isset($_GET['ajax']))
      $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
  }

  public function actionIndex() {
    /*
    $DxWVMEI4IU1GMpDiE = parse_url(Y::bu());
    $DxWVMEI4IU1GMpDiE = $DxWVMEI4IU1GMpDiE['host'];
    $CWL5r6Y3hkqCeIUQw = substr(OM_LIC, 240, 16);
    $bZZyrxDCH0WzGZgFK = md5($DxWVMEI4IU1GMpDiE.'aaf1dfef3633646f29110ba1117c394d');
    $bZZyrxDCH0WzGZgFK = md5($bZZyrxDCH0WzGZgFK.$DxWVMEI4IU1GMpDiE.'bd8bda0b24a99774bc7bc9bc47c5df32');
    $bZZyrxDCH0WzGZgFK = md5($bZZyrxDCH0WzGZgFK.$DxWVMEI4IU1GMpDiE.'ef96fbdd5dbc207380233e5131745de1');
    $bZZyrxDCH0WzGZgFK = substr($bZZyrxDCH0WzGZgFK, 0, 16);
    if ($bZZyrxDCH0WzGZgFK !== $CWL5r6Y3hkqCeIUQw) die ();
    */
    $model = new Log('search');
    $model->unsetAttributes();
    if (isset($_GET['Log']))
      $model->attributes = $_GET['Log'];
    $this->render('admin', array(
      'model' => $model,
    ));
  }

  public function loadModel($id) {
    $model = Log::model()->findByPk($id);
    if ($model === null)
      throw new CHttpException(404, 'The requested page does not exist.');
    return $model;
  }

  protected function performAjaxValidation($model) {
    if (isset($_POST['ajax']) && $_POST['ajax'] === 'log-form') {
      echo CActiveForm::validate($model);
      Yii::app()->end();
    }
  }
}