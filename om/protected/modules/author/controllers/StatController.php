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

    $model = $this->loadModel(Y::user()->id);
    $goods = $model->goods;

    if (empty ($goods)) die ('Извините, но администратор Вам не назначил товаров - поэтому доступ невозможен');

    $startDate = mktime(0, 0, 0, 1, 1, date('Y') - 1);
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
        $stopDate = mktime(0, 0, 1, $t[1], $t[0], $t[2]);
      }
      if (!empty($_POST['thegood'])) {
        $thegood = $_POST['thegood'];
      }
    }

    if (($startDate < 1) or ($stopDate < 0)) die ('Неверный формат даты');

    $goodList = $this->_goodList($goods);

    //Получаем все счета для выбранного периода
    $gg = $goodList;

    if (!empty($thegood)) {
      if (!isset($gg[$thegood])) {
        die ('Данный товар не существует или не принадлежит Вам');
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

    $orders = Yii::app()->db->createCommand()->select('*')
      ->from('{{order}}')
      ->order('createDate ASC')
      ->where('createDate > '.$startDate.' AND createDate < '.$stopDate.' AND ('.$where.')', $args)->queryAll();

    $porders = Yii::app()->db->createCommand()->select('*')
      ->from('{{order}}')
      ->order('payDate ASC')
      ->where('payDate > '.$startDate.' AND payDate < '.$stopDate.' AND ('.$where.')', $args)->queryAll();

    if ($stopDate - $startDate < 2847600) {
      $statKind = 'day';
      $stat = Order::groupDays($porders, $startDate, $stopDate);
    }
    else {
      $statKind = 'month';
      $stat = Order::groupMonth($porders, $startDate, $stopDate);
    }

    $this->render('index', array(
      'model' => $model,
      'goods' => $goods,
      'gl' => $goodList,
      'startDate' => date('j.m.Y', $startDate),
      'stopDate' => date('j.m.Y', $stopDate),
      'thegood' => $thegood,
      'orders' => $orders,
      'porders' => $porders,
      'stat' => $stat,
      'statKind' => $statKind,
    ));
  }

  public function loadModel($id) {
    $model = Author::model()->findByPk($id);
    if ($model === null) {
      throw new CHttpException(404, 'Автора с таким ID не существует.');
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