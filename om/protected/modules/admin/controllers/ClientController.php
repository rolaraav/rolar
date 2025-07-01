<?php
class ClientController extends Controller {
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
        'actions' => StaffAccess::allowed('client'),
      ),
      array('deny',
        'users' => array('*'),
      ),
    );
  }

  public function actionView($id) {
    /*
    $DVhRZLWk45apDnG5O = parse_url(Y::bu());
    $DVhRZLWk45apDnG5O = $DVhRZLWk45apDnG5O['host'];
    $CtUQS6uoedc06ph97 = substr(OM_LIC, 864, 16);
    $bAQRoc5hF1zecKqMR = md5($DVhRZLWk45apDnG5O.'df46b08da8fc34caed6d6eecb1e38a12');
    $bAQRoc5hF1zecKqMR = md5($bAQRoc5hF1zecKqMR.$DVhRZLWk45apDnG5O.'495488e75b04d276badcab28373cc265');
    $bAQRoc5hF1zecKqMR = md5($bAQRoc5hF1zecKqMR.$DVhRZLWk45apDnG5O.'a7fae4e54a2ca67f5f53e3a3c1f387dd');
    $bAQRoc5hF1zecKqMR = substr($bAQRoc5hF1zecKqMR, 0, 16);
    if ($bAQRoc5hF1zecKqMR !== $CtUQS6uoedc06ph97) die ();
    */
    $this->render('view', array(
      'model' => $this->loadModel($id),
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
    /*
    $DVhRZLWk45apDnG5O = parse_url(Y::bu());
    $DVhRZLWk45apDnG5O = $DVhRZLWk45apDnG5O['host'];
    $CtUQS6uoedc06ph97 = substr(OM_LIC, 864, 16);
    $bAQRoc5hF1zecKqMR = md5($DVhRZLWk45apDnG5O.'df46b08da8fc34caed6d6eecb1e38a12');
    $bAQRoc5hF1zecKqMR = md5($bAQRoc5hF1zecKqMR.$DVhRZLWk45apDnG5O.'495488e75b04d276badcab28373cc265');
    $bAQRoc5hF1zecKqMR = md5($bAQRoc5hF1zecKqMR.$DVhRZLWk45apDnG5O.'a7fae4e54a2ca67f5f53e3a3c1f387dd');
    $bAQRoc5hF1zecKqMR = substr($bAQRoc5hF1zecKqMR, 0, 16);
    if ($bAQRoc5hF1zecKqMR !== $CtUQS6uoedc06ph97) die ();
    */
    $model = new Client('search');
    $model->unsetAttributes();
    if (isset($_GET['Client']))
      $model->attributes = $_GET['Client'];
    $this->render('index', array(
      'model' => $model,
    ));
  }

  public function loadModel($id) {
    $model = Client::model()->findByPk((int)$id);
    if ($model === null)
      throw new CHttpException(404, 'The requested page does not exist.');
    return $model;
  }

  protected function performAjaxValidation($model) {
    if (isset($_POST['ajax']) && $_POST['ajax'] === 'client-form') {
      echo CActiveForm::validate($model);
      Yii::app()->end();
    }
  }

  public function actionImport() {
    /*
    $DVhRZLWk45apDnG5O = parse_url(Y::bu());
    $DVhRZLWk45apDnG5O = $DVhRZLWk45apDnG5O['host'];
    $CtUQS6uoedc06ph97 = substr(OM_LIC, 864, 16);
    $bAQRoc5hF1zecKqMR = md5($DVhRZLWk45apDnG5O.'df46b08da8fc34caed6d6eecb1e38a12');
    $bAQRoc5hF1zecKqMR = md5($bAQRoc5hF1zecKqMR.$DVhRZLWk45apDnG5O.'495488e75b04d276badcab28373cc265');
    $bAQRoc5hF1zecKqMR = md5($bAQRoc5hF1zecKqMR.$DVhRZLWk45apDnG5O.'a7fae4e54a2ca67f5f53e3a3c1f387dd');
    $bAQRoc5hF1zecKqMR = substr($bAQRoc5hF1zecKqMR, 0, 16);
    if ($bAQRoc5hF1zecKqMR !== $CtUQS6uoedc06ph97) die ();
    */
    if (!empty ($_POST)) {
      if (empty ($_POST['list'])) die ('Не заполнен список клиентов');
      $good = $_POST['good'];
      $ls = trim($_POST['list']);
      $f = trim($_POST['format']);
      $raz = H::cut_str('}', '{', $f);
      $em = FALSE;
      if (strpos($f, '{email}') < 2) {
        $em = TRUE;
      }
      $ll = explode("\n", $ls);
      $c = new Client;
      $cc = 0;
      foreach ($ll as $one) {
        $one = trim($one);
        $one = explode($raz, $one);
        $c->isNewRecord = TRUE;
        $c->id = FALSE;
        if ($em) {
          $c->email = trim($one[0]);
          $c->uname = trim($one[1]);
        } else {
          $c->uname = trim($one[0]);
          $c->email = trim($one[1]);
        }
        if (strpos($c->email, '@') === FALSE) {
          echo '<h2 align="center">Что-то неверно с форматом, т.к. система не нашла знак @ в одном из адресов - "'.$c->email.'"';
          break;
        }
        $c->subscribe = 1;
        $c->good_id = $good;
        $c->date = time();
        $c->save(FALSE);
        $cc++;
      }
      Y::user()->setFlash('admin', 'Клиенты внесены в базу. Записей добавлено: '.$cc.'.');
    }
    /*
    $DVhRZLWk45apDnG5O = parse_url(Y::bu());
    $DVhRZLWk45apDnG5O = $DVhRZLWk45apDnG5O['host'];
    $CtUQS6uoedc06ph97 = substr(OM_LIC, 864, 16);
    $bAQRoc5hF1zecKqMR = md5($DVhRZLWk45apDnG5O.'df46b08da8fc34caed6d6eecb1e38a12');
    $bAQRoc5hF1zecKqMR = md5($bAQRoc5hF1zecKqMR.$DVhRZLWk45apDnG5O.'495488e75b04d276badcab28373cc265');
    $bAQRoc5hF1zecKqMR = md5($bAQRoc5hF1zecKqMR.$DVhRZLWk45apDnG5O.'a7fae4e54a2ca67f5f53e3a3c1f387dd');
    $bAQRoc5hF1zecKqMR = substr($bAQRoc5hF1zecKqMR, 0, 16);
    if ($bAQRoc5hF1zecKqMR !== $CtUQS6uoedc06ph97) die ();
    */
    $this->render('import');
  }

  public function actionExport() {
    $data = '';
    $dc = 0;
    if (!empty ($_POST)) {
      $g = $_POST['good'];
      $f = $_POST['format'];
      $cl = Client::model()->findAll(array(
        'condition' => 'good_id = :good_id',
        'params' => array(
          ':good_id' => $g,
        )
      ));
      $f = str_replace('{good_id}', $g, $f);
      foreach ($cl as $one) {
        $s = $f;
        $s = str_replace('{uname}', $one->uname, $s);
        $s = str_replace('{email}', $one->email, $s);
        $s = str_replace('{amail}', $one->amail, $s);
        $s = str_replace('{date}', date('j.m.Y', $one->date), $s);
        $s = str_replace('{subscribe}', $one->subscribe, $s);
        $data .= $s."\r\n";
        $dc++;
      }
      if (empty ($data)) {
        $data = 'Для данного товара клиенты не найдены';
      } else {
        $data = trim($data);
      }
    }
    /*
    $DVhRZLWk45apDnG5O = parse_url(Y::bu());
    $DVhRZLWk45apDnG5O = $DVhRZLWk45apDnG5O['host'];
    $CtUQS6uoedc06ph97 = substr(OM_LIC, 864, 16);
    $bAQRoc5hF1zecKqMR = md5($DVhRZLWk45apDnG5O.'df46b08da8fc34caed6d6eecb1e38a12');
    $bAQRoc5hF1zecKqMR = md5($bAQRoc5hF1zecKqMR.$DVhRZLWk45apDnG5O.'495488e75b04d276badcab28373cc265');
    $bAQRoc5hF1zecKqMR = md5($bAQRoc5hF1zecKqMR.$DVhRZLWk45apDnG5O.'a7fae4e54a2ca67f5f53e3a3c1f387dd');
    $bAQRoc5hF1zecKqMR = substr($bAQRoc5hF1zecKqMR, 0, 16);
    if ($bAQRoc5hF1zecKqMR !== $CtUQS6uoedc06ph97) die ();
    */
    $this->render('export', array('data' => $data, 'dc' => $dc));
  }
}