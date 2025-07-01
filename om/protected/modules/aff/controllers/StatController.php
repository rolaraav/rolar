<?php
class StatController extends Controller {

  public function filters() {
    return array(
      'accessControl', // perform access control for CRUD operations
    );
  }

  public function accessRules() {
    return array(
      array('allow',
        'actions' => array('index'),
        'users' => array('@'),
      ),
      array('deny',  // deny all users
        'users' => array('*'),
      ),
    );
  }

  public function actionIndex() {
    $refid = Y::user()->id;
    $model = $this->loadModel($refid);
    $goods = Good::model()->findAll(
      'used = 1 AND affOn = 1 AND affShow=1'
    );

    $goods2 = Good::model()->findAll();
    $startDate = mktime(0, 0, 1, 1, 1, date('Y'));
    $stopDate = time();
    $thegood = '';

    /*
    $E9wuuG8fSv0Z1xIvX = parse_url(Yii::app()->getBaseUrl(TRUE));
    $E9wuuG8fSv0Z1xIvX = $E9wuuG8fSv0Z1xIvX['host'];
    $dw93yiTvYwORYTlmW = substr(OM_LIC, 336, 16);
    $dh8PsXMXRrfL0Vzxl = md5($E9wuuG8fSv0Z1xIvX.'444149763aad617621b0ad18812eed82');
    $dh8PsXMXRrfL0Vzxl = md5($dh8PsXMXRrfL0Vzxl.$E9wuuG8fSv0Z1xIvX.'868fd09c3b83ee264994e929fc5c5cb3');
    $dh8PsXMXRrfL0Vzxl = md5($dh8PsXMXRrfL0Vzxl.$E9wuuG8fSv0Z1xIvX.'e91b59ec7309ea867d5a9684538c230b');
    $dh8PsXMXRrfL0Vzxl = substr($dh8PsXMXRrfL0Vzxl, 0, 16);
    if ($dh8PsXMXRrfL0Vzxl !== $dw93yiTvYwORYTlmW) exit ();
    */

    if ($_POST) {
      if (!empty ($_POST['startDate'])) {
        $t = explode('.', $_POST['startDate']);
        $startDate = mktime(0, 0, 1, $t[1], $t[0], $t[2]);
      }

      if (!empty ($_POST['stopDate'])) {
        $t = explode('.', $_POST['stopDate']);
        $stopDate = mktime(23, 59, 59, $t[1], $t[0], $t[2]);
      }

      if (!empty($_POST['thegood'])) {
        $thegood = $_POST['thegood'];
      }
    }

    if (($startDate < 1) or ($stopDate < 0)) die ('Неверный формат даты');

    $goodList = $this->_goodList($goods);
    $goodList2 = $this->_goodList($goods2);

    //Получаем все счета для выбранного периода
    $gg = $goodList2;
    if (!empty($thegood)) {
      if (!isset($gg[$thegood])) {
        die ('Данный товар не принимает участие в партнёрской программе или скрыт');
      }
      $gg = array('thegood' => $gg[$thegood]);
    }

    $where = 'good_id=:id1';
    $args = array(':id1' => $thegood);

    if (empty ($thegood)) {

      $where = '';
      $args = array();

      $nn = 1;
      foreach ($gg as $key => $one) {
        if ($nn > 1) {
          $where .= ' OR ';
        }

        $where .= 'good_id=:id'.$nn;
        $args[':id'.$nn] = $key;
        $nn++;
      }
    }

    $args[':pid'] = $refid;

    $query = "((createDate > $startDate AND createDate < $stopDate AND (status_id='waiting' OR status_id='cancelled' OR status_id='nalozh' OR status_id='nalozh_confirmed' OR status_id='nalozh_sent' OR status_id='nalozh_back'))";
    $query .= " OR (payDate > $startDate AND payDate < $stopDate AND (status_id='approved' OR status_id = 'processing' OR status_id='sent' OR status_id='nalozh_ok')))";

    if (!empty ($where)) {
      $orders = Order::model()->findAll($query.' AND partner_id = :pid AND ('.$where.')', $args);
      $opaid = Affstats::model()->findAll('partner_id = :pid AND date > '.$startDate.' AND date < '.$stopDate.' AND ('.$where.')', $args);
    }
    else {
      $orders = Order::model()->findAll($query.' AND partner_id = :pid', $args);
      $opaid = Affstats::model()->findAll('partner_id = :pid AND date > '.$startDate.' AND date < '.$stopDate, $args);
    }

    $porders = Order::model()->findAll('partner_id = :pid AND payDate > '.$startDate.' AND payDate < '.$stopDate.' AND ('.$where.')', $args);
    $dwhere = $where;
    $dargs = $args;

    if (empty ($thegood)) {
      $dwhere = 'date > 0';
      $dargs = array();
      $dargs[':pid'] = $refid;
    }

    $xstartdate = date('Ymd', $startDate);
    $xstopdate = date('Ymd', $stopDate);

    if (!empty ($dwhere)) {
      $clicks = S::model()->findAll('p_id = :pid AND date >= '.$xstartdate.' AND date <= '.$xstopdate.' AND ('.$dwhere.')', $dargs);
    }
    else {
      $clicks = S::model()->findAll('p_id = :pid AND date >= '.$xstartdate.' AND date <= '.$xstopdate, $dargs);
    }
    if ($stopDate - $startDate < 2847600) {
      $statKind = 'day';
      $stat = Order::pgroupDays($porders, $startDate, $stopDate);
      $cstat = Partner::cgroupDays($clicks, $startDate, $stopDate);
    }
    else {
      $statKind = 'month';
      $stat = Order::pgroupMonth($porders, $startDate, $stopDate);
      $cstat = Partner::cgroupMonth($clicks, $startDate, $stopDate);
    }

    //Группируем заказы для подсчёта количества
    $ts = array();
    foreach ($goods as $one) {

      $ts[$one->id] = array(
        'conv' => 0,
        'clicks' => 0,
        'waiting' => 0,
        'approved' => 0,
        'processing' => 0,
        'sent' => 0,
        'nalozh' => 0,
        'nalozh_ok' => 0,
        'nalozh_confirmed' => 0,
        'nalozh_sent' => 0,
        'nalozh_back' => 0,
        'cancelled' => 0,
      );
    }

    $ts2 = array();
    $subs = array();

    foreach ($clicks as $one) {
      $subs[] = $one->sb;
      $ts2[$one->sb] = array(
        'clicks' => 0,
        'conv' => 0,
        'waiting' => 0,
        'approved' => 0,
        'processing' => 0,
        'sent' => 0,
        'nalozh' => 0,
        'nalozh_ok' => 0,
        'nalozh_confirmed' => 0,
        'nalozh_sent' => 0,
        'nalozh_back' => 0,
        'cancelled' => 0,
      );
    }

    $subs = array_unique($subs);
    sort($subs);
    $totalstat = array(
      'clicks' => 0,
      'waiting' => 0,
      'approved' => 0,
      'processing' => 0,
      'sent' => 0,
      'nalozh' => 0,
      'nalozh_ok' => 0,
      'nalozh_confirmed' => 0,
      'nalozh_sent' => 0,
      'nalozh_back' => 0,
      'cancelled' => 0,
    );

    $totalstat2 = array(
      'clicks' => 0,
      'conv' => 0,
      'waiting' => 0,
      'approved' => 0,
      'processing' => 0,
      'sent' => 0,
      'nalozh' => 0,
      'nalozh_ok' => 0,
      'nalozh_confirmed' => 0,
      'nalozh_sent' => 0,
      'nalozh_back' => 0,
      'cancelled' => 0,
      'dohod' => 0,
    );

    $tclicks = 0; //Всего кликов
    $aclicks = 0; //Кликов для приведения в партнёрку

    //Формируем статистику кликов
    foreach ($clicks as $one) {
      $tclicks += $one->clicks;
      if (!empty ($one->good_id)) {
        $ts[$one->good_id]['clicks'] += $one->clicks;
        $ts2[$one->sb]['clicks'] += $one->clicks;
        if ($one->good_id != 'a') {
          $totalstat['clicks'] += $one->clicks;
        }
        $totalstat2['clicks'] += $one->clicks;
      }
      if ($one->good_id == 'a') {
        $aclicks += $one->clicks;
      }
    }

    //Теперь для заказов
    foreach ($orders as $one) {
      $ts[$one->good_id][$one->status_id]++;
      $ts2[$one->kanal][$one->status_id]++;
      $ts2[$one->kanal]['conv']++;
      $totalstat[$one->status_id]++;
      $totalstat2[$one->status_id]++;
      $totalstat2['conv']++;
    }

    foreach ($opaid as $one) {
      $ts2[$one->kanal]['dohod'] += $one->komis;
      $totalstat2['dohod'] += $one->komis;
    }

    $sbcheck = false;

    if (isset ($_POST['subacc']))
      $sbcheck = true;

    $this->render('index', array(
      'model' => $model,
      'goods' => $goods,
      'gl' => $goodList,
      'startDate' => date('j.m.Y', $startDate),
      'stopDate' => date('j.m.Y', $stopDate),
      'thegood' => $thegood,
      'orders' => $orders,
      'opaid' => $opaid,
      'porders' => $porders,
      'stat' => $stat,
      'cstat' => $cstat,
      'statKind' => $statKind,
      'clicks' => $ts,
      'aclicks' => $aclicks,
      'tclicks' => $tclicks,
      'totalstat' => $totalstat,
      'totalstat2' => $totalstat2,
      'cmodel' => $cmodel,
      'sbcheck' => $sbcheck,
      'sub' => $ts2,
      'subs' => $subs,
    ));
  }

  public function loadModel($id) {
    $model = Partner::model()->findByPk($id);
    if ($model === null)
      throw new CHttpException(404, 'Партнёра с таким ID не существует.');
    return $model;
  }

  public function _goodList($goods) {
    $gl = array();
    foreach ($goods as $one) {
      $gl[$one->id] = $one->title;
    }
    return $gl;
  }
}