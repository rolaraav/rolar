<?php
class BlackController extends Controller {
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
        'actions' => StaffAccess::allowed('black'),
      ),
      array('deny',
        'users' => array('*'),
      ),
    );
  }

  public function actionView($id) {
    /*
    $cwRQVZeW0bFQaHsDh = parse_url(Y::bu());
    $cwRQVZeW0bFQaHsDh = $cwRQVZeW0bFQaHsDh['host'];
    $DiaVql5byga1cIqSB = substr(OM_LIC, 800, 16);
    $cHbEAThmG116Luz40 = md5($cwRQVZeW0bFQaHsDh.'958948ecfb3e56597f477cd0fb724dad');
    $cHbEAThmG116Luz40 = md5($cHbEAThmG116Luz40.$cwRQVZeW0bFQaHsDh.'5ad65dfedbda3aca231ce9fae742c383');
    $cHbEAThmG116Luz40 = md5($cHbEAThmG116Luz40.$cwRQVZeW0bFQaHsDh.'cdb573e2bcb3a66a591949c581dfa827');
    $cHbEAThmG116Luz40 = substr($cHbEAThmG116Luz40, 0, 16);
    if ($cHbEAThmG116Luz40 !== $DiaVql5byga1cIqSB) exit ();
    */
    $this->render('view', array(
      'model' => $this->loadModel($id),
    ));
  }

  public function actionCreate() {
    $model = new Black;
    /*
    $e1ylPZu0Aq0goFEeN = OM_LIC_HOST;
    $BZI8i0MMoN9ErcNJZ = substr(OM_LIC, 816, 16);
    $cDNMuxJ2ySPmT5k7L = md5($e1ylPZu0Aq0goFEeN.'743193c4590b9f373148769f9bcf9795');
    $cDNMuxJ2ySPmT5k7L = md5($cDNMuxJ2ySPmT5k7L.$e1ylPZu0Aq0goFEeN.'be9ef56adb5f70448eb3e69b9118efde');
    $cDNMuxJ2ySPmT5k7L = md5($cDNMuxJ2ySPmT5k7L.$e1ylPZu0Aq0goFEeN.'1efd007d76914a65d2e4281bb00446ef');
    $cDNMuxJ2ySPmT5k7L = substr($cDNMuxJ2ySPmT5k7L, 0, 16);
    if ($cDNMuxJ2ySPmT5k7L !== $BZI8i0MMoN9ErcNJZ) die ();
    */
    if (isset($_POST['Black'])) {
      $model->attributes = $_POST['Black'];
      $model->createDate = time();
      if ($model->validate()) {
        $model->address = $model->address.' '.$model->gorod.' '.$model->strana;
        if ($model->save(FALSE)) {
          Y::user()->setFlash('admin', 'Запись добавлена');
          $this->redirect(array('view', 'id' => $model->id));
        }
      }
    }
    $this->render('create', array(
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
    $model = new Black('search');
    $model->unsetAttributes();
    /*
    $eBvkDxwzrWiIUCucQ = parse_url(Y::bu());
    $eBvkDxwzrWiIUCucQ = $eBvkDxwzrWiIUCucQ['host'];
    $cH87EgaQ2k4Q4F3Qq = substr(OM_LIC, 832, 16);
    $Cmd6VLzVSD8f3HWUf = md5($eBvkDxwzrWiIUCucQ.'8ee5ebd5bc3549df51bcb726dae13087');
    $Cmd6VLzVSD8f3HWUf = md5($Cmd6VLzVSD8f3HWUf.$eBvkDxwzrWiIUCucQ.'243bc82ab74cbfbc66dea439da2e1e25');
    $Cmd6VLzVSD8f3HWUf = md5($Cmd6VLzVSD8f3HWUf.$eBvkDxwzrWiIUCucQ.'d50a871a39d02fa1459fa61305e67c00');
    $Cmd6VLzVSD8f3HWUf = substr($Cmd6VLzVSD8f3HWUf, 0, 16);
    if ($Cmd6VLzVSD8f3HWUf !== $cH87EgaQ2k4Q4F3Qq) exit ();
    */
    if (isset($_GET['Black']))
      $model->attributes = $_GET['Black'];
    $this->render('index', array(
      'model' => $model,
    ));
  }

  public function loadModel($id) {
    $model = Black::model()->findByPk((int)$id);
    if ($model === null)
      throw new CHttpException(404, 'The requested page does not exist.');
    return $model;
  }

  protected function performAjaxValidation($model) {
    if (isset($_POST['ajax']) && $_POST['ajax'] === 'black-form') {
      echo CActiveForm::validate($model);
      Yii::app()->end();
    }
  }
}