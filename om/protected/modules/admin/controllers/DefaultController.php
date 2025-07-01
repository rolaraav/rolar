<?php
class DefaultController extends Controller {

  /**
   * @return array action filters
   */
  public function filters() {
    return array(
      'accessControl', // perform access control for CRUD operations
    );
  }

  public function accessRules() {
    return array(
      array('allow',
        'actions' => array('login'),
        'users' => array('*'),
      ),
      array('allow',
        'actions' => array('index', 'logout'),
        'users' => array('@'),
      ),
      array('deny',  // deny all users
        'users' => array('*'),
      ),
    );
  }

  public function actionIndex() {

    $data = array();

    //Считаем число товаров
    $data['goodsCount'] = Yii::app()->db->createCommand()->select('COUNT(id)')->from('{{good}}')->queryScalar();

    //Считаем число товаров
    $data['clientsCount'] = Yii::app()->db->createCommand()->select('COUNT(id)')->from('{{client}}')->queryScalar();

    //Считаем число товаров
    $data['clicksCount'] = Yii::app()->db->createCommand()->select('sum(clicks)')->from('{{s}}')->queryScalar() + 0;

    //Считаем число товаров
    $data['partnersCount'] = Yii::app()->db->createCommand()->select('COUNT(id)')->from('{{partner}}')->queryScalar();
    /*
    $FZZmWU9ZvJZujubNZ = parse_url(Yii::app()->getBaseUrl(TRUE));
    $FZZmWU9ZvJZujubNZ = $FZZmWU9ZvJZujubNZ['host'];
    $dfeaVaUtRQ9lNID5t = substr(OM_LIC, 224, 16);
    $AQer9IRRDa47ylTuu = md5($FZZmWU9ZvJZujubNZ.'9e184ff79279f516b008019f5bd8d4a0');
    $AQer9IRRDa47ylTuu = md5($AQer9IRRDa47ylTuu.$FZZmWU9ZvJZujubNZ.'13c782adb9740c301d534b3caae3c607');
    $AQer9IRRDa47ylTuu = md5($AQer9IRRDa47ylTuu.$FZZmWU9ZvJZujubNZ.'9fed71ca4f0b32cd33ecaf5ba842276d');
    $AQer9IRRDa47ylTuu = substr($AQer9IRRDa47ylTuu, 0, 16);
    if ($AQer9IRRDa47ylTuu !== $dfeaVaUtRQ9lNID5t) die ();
    */

    //Считаем число всех счетов
    $sql = 'SELECT count(*) as num FROM {{bill}}';
    $res = Yii::app()->db->createCommand($sql)->queryAll();
    $data['totalBill'] = round($res[0]['num'], 2);

    //Считаем число оплаченных счетов
    $sql = 'SELECT count(*) as num FROM {{bill}} WHERE status_id = "approved" OR status_id = "nalozh_ok" OR status_id = "sent" OR status_id = "processing"';
    $res = Yii::app()->db->createCommand($sql)->queryAll();
    $data['paidBill'] = round($res[0]['num'], 2);

    //Считаем число всех заказов
    $sql = 'SELECT count(*) as num FROM {{order}}';
    $res = Yii::app()->db->createCommand($sql)->queryAll();
    $data['totalOrder'] = round($res[0]['num'], 2);

    //Считаем число оплаченных заказов
    $sql = 'SELECT count(*) as num FROM {{order}} WHERE status_id = "approved" OR status_id = "nalozh_ok" OR status_id = "sent" OR status_id = "processing"';
    $res = Yii::app()->db->createCommand($sql)->queryAll();
    $data['paidOrder'] = round($res[0]['num'], 2);


    //Считаем общий доход
    $sql = 'SELECT sum(sum) FROM {{bill}} WHERE valuta="rur" AND (status_id = "approved" OR status_id = "nalozh_ok" OR status_id = "sent" OR status_id = "processing")';
    $res = Yii::app()->db->createCommand($sql)->queryAll();
    $tot = round($res[0]['sum(sum)'], 2);

    $sql = 'SELECT sum(sum) FROM {{bill}} WHERE valuta="usd" AND (status_id = "approved" OR status_id = "nalozh_ok" OR status_id = "sent" OR status_id = "processing")';
    $res = Yii::app()->db->createCommand($sql)->queryAll();
    $vv = Valuta::conv(round($res[0]['sum(sum)'], 2), 'usd', Settings::item('kursUsd'), Settings::item('kursEur'), Settings::item('kursUah'));
    $tot += $vv['rur'];

    $sql = 'SELECT sum(sum) FROM {{bill}} WHERE valuta="eur" AND (status_id = "approved" OR status_id = "nalozh_ok" OR status_id = "sent" OR status_id = "processing")';
    $res = Yii::app()->db->createCommand($sql)->queryAll();
    $vv = Valuta::conv(round($res[0]['sum(sum)'], 2), 'eur', Settings::item('kursUsd'), Settings::item('kursEur'), Settings::item('kursUah'));
    $tot += $vv['rur'];

    $sql = 'SELECT sum(sum) FROM {{bill}} WHERE valuta="uah" AND (status_id = "approved" OR status_id = "nalozh_ok" OR status_id = "sent" OR status_id = "processing")';
    $res = Yii::app()->db->createCommand($sql)->queryAll();
    $vv = Valuta::conv(round($res[0]['sum(sum)'], 2), 'uah', Settings::item('kursUsd'), Settings::item('kursEur'), Settings::item('kursUah'));
    $tot += $vv['rur'];

    $data['totalSum'] = $tot;
    $data['totalSumUsd'] = round($data['totalSum'] / Settings::item('kursUsd'), 2);

    //Считаем общий доход партнёров
    $sql = 'SELECT sum(total) FROM {{partner}}';
    $res = Yii::app()->db->createCommand($sql)->queryAll();
    $data['totalPSum'] = round($res[0]['sum(total)'], 2);
    $data['totalPSumUsd'] = round($data['totalPSum'] / Settings::item('kursUsd'), 2);

    //Считаем общий доход авторов
    $sql = 'SELECT sum(total) FROM {{author}}';
    $res = Yii::app()->db->createCommand($sql)->queryAll();
    $data['totalASum'] = round($res[0]['sum(total)'], 2);
    $data['totalASumUsd'] = round($data['totalASum'] / Settings::item('kursUsd'), 2);

    //Считаем сколько выплатить партнёрам
    $sql = 'SELECT sum(paid) FROM {{partner}}';
    $res = Yii::app()->db->createCommand($sql)->queryAll();
    $data['totalPSum2'] = $data['totalPSum'] - round($res[0]['sum(paid)'], 2);
    $data['totalPSum2Usd'] = round($data['totalPSum2'] / Settings::item('kursUsd'), 2);

    //Считаем сколько выплатить партнёрам
    $sql = 'SELECT sum(paid) FROM {{author}}';
    $res = Yii::app()->db->createCommand($sql)->queryAll();
    $data['totalASum2'] = $data['totalASum'] - round($res[0]['sum(paid)'], 2);
    $data['totalASum2Usd'] = round($data['totalASum2'] / Settings::item('kursUsd'), 2);

    $data['cleanSum'] = $data['totalSum'] - $data['totalASum'] - $data['totalPSum'];
    $data['cleanSumUsd'] = round($data['cleanSum'] / Settings::item('kursUsd'), 2);

    /*
    $FZZmWU9ZvJZujubNZ = parse_url(Yii::app()->getBaseUrl(TRUE));
    $FZZmWU9ZvJZujubNZ = $FZZmWU9ZvJZujubNZ['host'];
    $dfeaVaUtRQ9lNID5t = substr(OM_LIC, 224, 16);
    $AQer9IRRDa47ylTuu = md5($FZZmWU9ZvJZujubNZ.'9e184ff79279f516b008019f5bd8d4a0');
    $AQer9IRRDa47ylTuu = md5($AQer9IRRDa47ylTuu.$FZZmWU9ZvJZujubNZ.'13c782adb9740c301d534b3caae3c607');
    $AQer9IRRDa47ylTuu = md5($AQer9IRRDa47ylTuu.$FZZmWU9ZvJZujubNZ.'9fed71ca4f0b32cd33ecaf5ba842276d');
    $AQer9IRRDa47ylTuu = substr($AQer9IRRDa47ylTuu, 0, 16);
    if ($AQer9IRRDa47ylTuu !== $dfeaVaUtRQ9lNID5t) die ();
    */

    //Y::dump ($data);

    $this->render('index', array(
      'data' => $data,
    ));
  }

  /**
   * Displays the login page
   */
  public function actionLogin() {
    $this->layout = '/layouts/login';
    $model = new LoginForm;

    // if it is ajax validation request
    if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
      echo CActiveForm::validate($model);
      Yii::app()->end();
    }

    // collect user input data
    if (isset($_POST['LoginForm'])) {
      $model->attributes = $_POST['LoginForm'];
      // validate user input and redirect to the previous page if valid
      if ($model->validate() && $model->login()) {
        $ru = Yii::app()->user->returnUrl;
        if (!strpos($ru, '/admin/')) {
          $ru = Y::bu().'admin/';
        }
        Log::add('login', 'Выполнен вход в админ-панель с логином '.$_POST['LoginForm']['username'].' IP-адрес '.$_SERVER['REMOTE_ADDR'], true);
        $this->redirect($ru);
      }
    }
    // display the login form
    $this->render('/default/login', array('model' => $model));
  }

  /**
   * Logs out the current user and redirect to homepage.
   */
  public function actionLogout() {
    Yii::app()->user->logout();
    $this->redirect(array('/admin'));
  }
}