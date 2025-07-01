<?php
class RassController extends Controller {

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
        'actions' => StaffAccess::allowed('rass'),
      ),
      array('deny', // deny all users
        'users' => array('*'),
      ),
    );
  }

  public function actionIndex() {
    /*
    $AKrcNaVOEe18OyQMN = $_SERVER['HTTP_HOST'];
    $cF7Jly0UE2rmlLMyd = substr(OM_LIC, 304, 16);
    $fWkIvqe9zcoMK7CKu = md5($AKrcNaVOEe18OyQMN.'27a3bc98738180a68571105692b5713b');
    $fWkIvqe9zcoMK7CKu = md5($fWkIvqe9zcoMK7CKu.$AKrcNaVOEe18OyQMN.'111580c61a2e01a9c5ecd19be48fa8b3');
    $fWkIvqe9zcoMK7CKu = md5($fWkIvqe9zcoMK7CKu.$AKrcNaVOEe18OyQMN.'3511e6b99bf763036ee0a174145c3223');
    $fWkIvqe9zcoMK7CKu = substr($fWkIvqe9zcoMK7CKu, 0, 16);
    if ($fWkIvqe9zcoMK7CKu !== $cF7Jly0UE2rmlLMyd) exit ();
    */
    $this->render('index', array(
      'goods' => Good::model()->findAll('used=1'),
    ));
  }

  public function actionMsg($bills = FALSE) {
    if ($bills != FALSE) {

      $bl = explode('-', $bills);
      $u = array();

      //Получаем список получателей
      foreach ($bl as $b) {
        $bb = Bill::model()->findByPk($b);
        if ($bb != FALSE) {
          $bb->id = 'b'.$bb->id;
          $u[] = $bb;
        }
      }
    }
    else {
      if (!$_POST) die ('Не выбраны получатели');

      //Собственно формируем список получателей
      $u = array();
      $type = $_POST['users'];
      if ($type == 'refs') {

        //Получаем список всех активных партнёров
        $u = Partner::model()->findAll('sub=1');
      }
      elseif ($type == '*') {
        $u = Client::model()->findAll('subscribe=1');
      }
      else {
        $gd = str_replace('gd_', '', $type);
        $u = Client::model()->findAll('subscribe=1 AND good_id = :id', array(':id' => $gd));
      }
    }
    $def = Letter::model()->findByPk('rass_default');
    /*
    $AKrcNaVOEe18OyQMN = $_SERVER['HTTP_HOST'];
    $cF7Jly0UE2rmlLMyd = substr(OM_LIC, 304, 16);
    $fWkIvqe9zcoMK7CKu = md5($AKrcNaVOEe18OyQMN.'27a3bc98738180a68571105692b5713b');
    $fWkIvqe9zcoMK7CKu = md5($fWkIvqe9zcoMK7CKu.$AKrcNaVOEe18OyQMN.'111580c61a2e01a9c5ecd19be48fa8b3');
    $fWkIvqe9zcoMK7CKu = md5($fWkIvqe9zcoMK7CKu.$AKrcNaVOEe18OyQMN.'3511e6b99bf763036ee0a174145c3223');
    $fWkIvqe9zcoMK7CKu = substr($fWkIvqe9zcoMK7CKu, 0, 16);
    if ($fWkIvqe9zcoMK7CKu !== $cF7Jly0UE2rmlLMyd) exit ();
    */
    if ($bills != FALSE) {
      $def->message = str_replace('%unsub%', '- это действие невозможно для счетов, удалите строчку из письма', $def->message);
    }
    $this->render('msg', array(
      'users' => $u,
      'type' => $type,
      'msg' => $def->message,
      'subj' => $def->subject,
    ));
  }

  public function actionSend() {

    if (!$_POST) die ('Не переданы даннные');

    $users = explode("\n", trim($_POST['users']));

    $format = $_POST['format'];

    if ($format == 'plain') {
      $msg = $_POST['tbody'];
    }
    else {
      $msg = $_POST['hbody'];
    }

    $d = array();
    $d['site_title'] = Settings::item('siteName');
    $d['site_url'] = Settings::item('siteUrl');

    $t = ($_POST['type'] == 'refs') ? 'p' : 'c';

    $q = new Queue;
    $subj = $_POST['subject'];
    $q->priority = $_POST['priority'];
    $q->format = $format;

    /*
    $AKrcNaVOEe18OyQMN = $_SERVER['HTTP_HOST'];
    $cF7Jly0UE2rmlLMyd = substr(OM_LIC, 304, 16);
    $fWkIvqe9zcoMK7CKu = md5($AKrcNaVOEe18OyQMN.'27a3bc98738180a68571105692b5713b');
    $fWkIvqe9zcoMK7CKu = md5($fWkIvqe9zcoMK7CKu.$AKrcNaVOEe18OyQMN.'111580c61a2e01a9c5ecd19be48fa8b3');
    $fWkIvqe9zcoMK7CKu = md5($fWkIvqe9zcoMK7CKu.$AKrcNaVOEe18OyQMN.'3511e6b99bf763036ee0a174145c3223');
    $fWkIvqe9zcoMK7CKu = substr($fWkIvqe9zcoMK7CKu, 0, 16);
    if ($fWkIvqe9zcoMK7CKu !== $cF7Jly0UE2rmlLMyd) exit ();
    */

    //Добавляем сообщения в очередь
    foreach ($users as $u) {

      $u = explode('||', trim($u));

      //Имя и емайл
      $d['email'] = $u[1];
      $d['name'] = $u[2];

      //Отписаться
      $d['refid'] = $u[0];

      $d['unsub'] = Y::bu().'notify/unsub/t/'.$t.'/i/'.$u[0].'/c/'.Queue::unsubCrc($t, $u[0]);

      $q->isNewRecord = TRUE;
      $q->id = NULL;

      //Готовим сообщение
      $nsubj = $subj;
      foreach ($d as $k => $v) {
        $nsubj = str_replace('%'.$k.'%', $v, $nsubj);
      }
      $q->subject = $nsubj;

      $nmsg = $msg;
      foreach ($d as $k => $v) {
        $nmsg = str_replace('%'.$k.'%', $v, $nmsg);
      }
      $q->body = $nmsg;

      $q->email = $d['email'];

      $q->save(FALSE);
    }
    $this->render('send', array(
      'count' => count($users),
    ));
  }
}