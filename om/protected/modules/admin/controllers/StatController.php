<?php
class StatController extends Controller {

  //Права доступа
  public function filters() {
    return array(
      'accessControl',
    );
  }

  public function accessRules() {
    return array(
      array('allow', // allow authenticated user actions
        'users' => array('@'),
        'actions' => StaffAccess::allowed('stat'),
      ),
      array('deny', // deny all users
        'users' => array('*'),
      ),
    );
  }

  public function actionIndex() {

    $goods = Good::model()->findAll(
      //'used = 1'
    );
    if (empty ($goods)) {
      throw new CHttpException(500, 'Просмотр статистики невозможен пока не будет создан хотя бы один товар');
      return true;
    }

    $startDate = time() - 2592000;
    $stopDate = time();
    $thegood = '';

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

    //{KG}
    /*
    $AKrcNaVOEe18OyQMN = $_SERVER['HTTP_HOST'];
    $cF7Jly0UE2rmlLMyd = substr(OM_LIC, 304, 16);
    $fWkIvqe9zcoMK7CKu = md5($AKrcNaVOEe18OyQMN.'27a3bc98738180a68571105692b5713b');
    $fWkIvqe9zcoMK7CKu = md5($fWkIvqe9zcoMK7CKu.$AKrcNaVOEe18OyQMN.'111580c61a2e01a9c5ecd19be48fa8b3');
    $fWkIvqe9zcoMK7CKu = md5($fWkIvqe9zcoMK7CKu.$AKrcNaVOEe18OyQMN.'3511e6b99bf763036ee0a174145c3223');
    $fWkIvqe9zcoMK7CKu = substr($fWkIvqe9zcoMK7CKu, 0, 16);
    if ($fWkIvqe9zcoMK7CKu !== $cF7Jly0UE2rmlLMyd) exit ();
    */

    //Получаем все счета для выбранного периода
    $gg = $goodList;

    if (!empty($thegood)) {
      if (!isset($gg[$thegood])) {
        die ('Данный товар неактивен');
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

    $query = "((createDate > $startDate AND createDate < $stopDate AND (status_id='waiting' OR status_id='cancelled' OR status_id='nalozh' OR status_id='nalozh_confirmed' OR status_id='nalozh_sent' OR status_id='nalozh_back'))";
    $query .= " OR (payDate > $startDate AND payDate < $stopDate AND (status_id='approved' OR status_id = 'processing' OR status_id='sent' OR status_id='nalozh_ok')))";

    if (!empty ($where)) {
      $orders = Order::model()->findAll($query.' AND ('.$where.')', $args);
    }
    else {
      $orders = Order::model()->findAll($query);
    }

    if (!empty ($where)) {
      $porders = Order::model()->findAll('payDate > '.$startDate.' AND payDate < '.$stopDate.' AND ('.$where.')'.
        ' AND (status_id = "approved" OR status_id="processing" OR status_id="sent" OR status_id="nalozh_ok")', $args);
    }
    else {
      $porders = Order::model()->findAll('payDate > '.$startDate.' AND payDate < '.$stopDate.' AND (status_id = "approved" OR status_id="processing" OR status_id="sent" OR status_id="nalozh_ok")');
    }

    $dwhere = $where;
    $dargs = $args;

    if (empty ($thegood)) {
      $dwhere = 'date > 0';
      $dargs = array();
    }

    $xstartdate = date('Ymd', $startDate);
    $xstopdate = date('Ymd', $stopDate);

    if (!empty ($dwhere)) {
      $clicks = S::model()->findAll('date >= '.$xstartdate.' AND date <= '.$xstopdate.' AND ('.$dwhere.')', $dargs);
    }
    else {
      $clicks = S::model()->findAll('date >= '.$xstartdate.' AND date <= '.$xstopdate, $dargs);
    }

    $clicks2 = array();

    $sbcheck = false;
    if (isset ($_POST['subacc'])) $sbcheck = true;

    if (!empty ($dwhere) && $sbcheck) {
      $clicks2 = S::model()->findAll('p_id = "obsys" AND date >= '.$xstartdate.' AND date <= '.$xstopdate.' AND ('.$dwhere.')', $dargs);
    }
    else {
      $clicks2 = S::model()->findAll('p_id = "obsys" AND date >= '.$xstartdate.' AND date <= '.$xstopdate, $dargs);
    }

    //echo '<pre>';
    //print_r ($clicks);
    //die ();
    //$clicks = Click::model()->findAll('date > '.$startDate.' AND date < '.$stopDate.' AND ('.$dwhere.')',$dargs);

    if ($stopDate - $startDate < 2847600) {
      $statKind = 'day';
      $stat = Order::groupDays($porders, $startDate, $stopDate);
      $cstat = Partner::cgroupDays($clicks, $startDate, $stopDate);
    }
    else {
      $statKind = 'month';
      $stat = Order::groupMonth($porders, $startDate, $stopDate);
      $cstat = Partner::cgroupMonth($clicks, $startDate, $stopDate);
    }

    //Группируем заказы для подсчёта количества
    $ts = array();
    $subs = array();

    foreach ($clicks2 as $one) {
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

    foreach ($goods as $one) {
      $ts[$one->id] = array(
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
        $totalstat['clicks'] += $one->clicks;

        if ($one->good_id == 'a') {
          $aclicks += $one->clicks;
        }
      }
    }

    foreach ($clicks2 as $one) {
      if (!empty ($one->sb)) {
        $ts2[$one->sb]['clicks'] += $one->clicks;
        $totalstat2['clicks'] += $one->clicks;
      }
    }

    //Считаем комиссионные за этот период
    $com1 = 0; //1-го уровня
    $com2 = 0; //2-го уровня

    //Теперь для заказов
    foreach ($orders as $one) {
      $ts[$one->good_id][$one->status_id]++;
      $totalstat[$one->status_id]++;

      if ($one->kanal != 'default' && isset ($ts2[$one->kanal])) {

        $ts2[$one->kanal][$one->status_id]++;
        $totalstat2[$one->status_id]++;

        if ($one->status_id == "approved" || $one->status_id == "processing" || $one->status_id == "sent" || $one->status_id == "nalozh_ok") {
          $vv = Valuta::conv($one->cena, $one->valuta);
          $ts2[$one->kanal]['dohod'] += $vv['rur'];
          $totalstat2['dohod'] += $vv['rur'];
        }
      }

      //Получаем выписку
      $aff = Affstats::model()->findByPk($one->id);

      if (!$aff) continue;
      $com1 += $aff->komis;
      $com2 += $aff->pkomis;
    }

    //Собственно выписка кликов
    $this->render('index', array(
      'goods' => $goods,
      'gl' => $goodList,
      'startDate' => date('j.m.Y', $startDate),
      'stopDate' => date('j.m.Y', $stopDate),
      'thegood' => $thegood,
      'orders' => $orders,
      'porders' => $porders,
      'stat' => $stat,
      'cstat' => $cstat,
      'statKind' => $statKind,
      'clicks' => $ts,
      'aclicks' => $aclicks,
      'tclicks' => $tclicks,
      'totalstat' => $totalstat,
      'totalstat2' => $totalstat2,
      'com1' => $com1,
      'com2' => $com2,
      'cmodel' => $cmodel,
      'sbcheck' => $sbcheck,
      'sub' => $ts2,
      'subs' => $subs,
    ));
  }

  public function loadModel($id) {
    $model = Partner::model()->findByPk($id);
    if ($model === null){
      throw new CHttpException(404, 'Партнёра с таким ID не существует.');
    }
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