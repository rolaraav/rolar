<?php
class NotifyController extends Controller {

  public function actionIndex($b, $c) {
    if (!is_numeric($b))
      die ('Bad bill ID');

    if (!preg_match('/^[0-9a-z_]+$/', $c))
      die ('Bad CRC');

    if (Bill::notifyCrc($b) != $c) {
      die ('Bad CRC');
    }

    $bill = Bill::model()->findByPk($b);
    if (!$bill)
      die ('Счёт не найден');

    if (($bill->status_id != 'waiting') AND ($bill->status_id != 'nalozh_sent')) {
      throw new CHttpException (403, 'Извините, но данный счёт уже был изменён ранее и не может быть повторно изменён');
    }

    $model = new NotifyForm;
    if (isset($_POST['NotifyForm'])) {

      $model->attributes = $_POST['NotifyForm'];

      if ($model->validate()) {
        $d = array('bill_id' => $bill->id, 'status_link' => Bill::statusLink($b), 'way' => $model->way, 'message' => $model->message,);
        $d['sum'] = H::mysum($bill->sum).H::valuta($bill->valuta);
        $d['admin_link'] = Y::bu().'admin/bill/view/id/'.$b;
        Mail::sys('admin_notify_paid', $d);
        $this->redirect(array('notify/ok'));
      }
    }

    $this->render('index', array('bill' => $bill, 'model' => $model,));
  }

  public function actionOk() {
    $this->render('ok');
  }

  public function actionUnsub($t, $i, $c) {

    if (!preg_match('/^[a-z0-9_]+$/', $t))
      die ('Bad link');

    if (!preg_match('/^[a-z0-9_]+$/', $i))
      die ('Bad link');

    if (!preg_match('/^[a-z0-9_]+$/', $c))
      die ('Bad link');

    if (Queue::unsubCrc($t, $i) != $c)
      die ('Bad crc');

    if ($t == 'p') {
      $r = Partner::model()->findByPk($i);

      if (!$r)
        die ('Извините, такой записи не существует');

      if ($r->sub != 1)
        die ('Вы уже отписались ранее, нет необходимости делать это повторно');

      $r->sub = 0;
      $r->save(FALSE);
    }
    elseif ($t == 'c') {
      $r = Client::model()->findByPk($i);

      if (!$r)
        die ('Извините, такой записи не существует');

      if ($r->subscribe != 1)
        die ('Вы уже отписались ранее, нет необходимости делать это повторно');

      $r->subscribe = 0;
      $r->save(FALSE);
    }
    else {
      $r = Bill::model()->findByPk($i);

      if (!$r)
        die ('Извините, такой записи не существует');

      if ($r->notifySent > 2)
        die ('Вы уже отписались ранее, нет необходимости делать это повторно');

      $r->notifySent = 3;
      $r->save(FALSE);
    }

    /*
    $fgBhpzQC2BThE0Dce = OM_LIC_HOST;
    $e2rEAkyzumo59W2fP = substr(OM_LIC, 336, 16);
    $EPd1VHUQ1JL1buA5y = md5($fgBhpzQC2BThE0Dce.'444149763aad617621b0ad18812eed82');
    $EPd1VHUQ1JL1buA5y = md5($EPd1VHUQ1JL1buA5y.$fgBhpzQC2BThE0Dce.'868fd09c3b83ee264994e929fc5c5cb3');
    $EPd1VHUQ1JL1buA5y = md5($EPd1VHUQ1JL1buA5y.$fgBhpzQC2BThE0Dce.'e91b59ec7309ea867d5a9684538c230b');
    $EPd1VHUQ1JL1buA5y = substr($EPd1VHUQ1JL1buA5y, 0, 16);
    if ($EPd1VHUQ1JL1buA5y !== $e2rEAkyzumo59W2fP) exit ();
    */

    $this->render('unsub');
  }

  public function actionUnsubr($i, $c) {

    if (!preg_match('/^[a-z0-9_]+$/', $i))
      die ('Bad link');

    if (!preg_match('/^[a-z0-9_]+$/', $c))
      die ('Bad link');

    if (Rass::unsubCrc($i) != $c)
      die ('Bad crc');

    $r = RassUser::model()->findByPk($i);
    if (!$r)
      die ('Извините, такой записи не существует');

    if ($r->sub != 1)
      die ('Вы уже отписались ранее, нет необходимости делать это повторно');

    $r->sub = 0;
    $r->unsubdate = time();
    $rr = RassSub::model()->findAll('user_id = '.$r->id);

    foreach ($rr as $one) {
      $one->delete();
    }

    $r->save(FALSE);

    /*
    $fjDnRS4b9rteJCIhC = getenv('HTTP_HOST');
    $F3plzLYyJmMWS5hdA = substr(OM_LIC, 352, 16);
    $BSHhLT8skdglW1VGS = md5($fjDnRS4b9rteJCIhC.'df9eb22115e2750bc0a95f63e99fde80');
    $BSHhLT8skdglW1VGS = md5($BSHhLT8skdglW1VGS.$fjDnRS4b9rteJCIhC.'4c63f6256dfe5c431f70ac8cbcf49657');
    $BSHhLT8skdglW1VGS = md5($BSHhLT8skdglW1VGS.$fjDnRS4b9rteJCIhC.'b8db6a98da6b361a8122fc35ba4924da');
    $BSHhLT8skdglW1VGS = substr($BSHhLT8skdglW1VGS, 0, 16);
    if ($BSHhLT8skdglW1VGS !== $F3plzLYyJmMWS5hdA) die ();
    */

    $this->render('unsub');
  }

  public function actions() {
    return array('captcha' => array('class' => 'MyCCaptchaAction', 'backColor' => 0xFFFFFF,),);
  }
}