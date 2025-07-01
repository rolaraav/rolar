<?php
class NlController extends Controller {

  //Подтверждение наложенного платежа
  public function actionConfirm($b, $c) {

    //Проверяем по формату
    if (!is_numeric($b)) die ('Bad bill ID');

    if (!preg_match('/^[0-9a-z_]+$/', $c)) die ('Bad CRC');

    if (Bill::nalozh2Crc($b) != $c) {
      die ('Bad CRC');
    }

    //Получаем счёт
    $bill = Bill::model()->findByPk($b);

    if (!$bill) die ('Счёт не найден');

    if ($bill->status_id != 'nalozh') {
      throw new CHttpException (403, 'Извините, но данный счёт уже был изменён ранее и не может быть повторно изменён');
    }

    //Меняем статус заказа
    $bill->status_id = 'nalozh_confirmed';

    if (Settings::item('nalozhManual') == 1) {
      $bill->status_id = 'nalozh';
      if (Settings::item('nalozhEmail')) {
        $bill->comment = '[E-MAIL ПОДТВЕРЖДЁН '.date('j.m.Y H:i:s').'] '.$bill->comment;
      }
    }

    $bill->save(FALSE);

    /*
    $EoyNoDjiR7SRe4ePy = OM_LIC_HOST;
    $EbLkUhpVtjzkjw3EG = substr(OM_LIC, 320, 16);
    $fid6EdT8fUIxRjj1N = md5($EoyNoDjiR7SRe4ePy.'85b8de2d7a1cfd9a513bf1a1d31b702a');
    $fid6EdT8fUIxRjj1N = md5($fid6EdT8fUIxRjj1N.$EoyNoDjiR7SRe4ePy.'002f7c424973877577f098c88ac9ee64');
    $fid6EdT8fUIxRjj1N = md5($fid6EdT8fUIxRjj1N.$EoyNoDjiR7SRe4ePy.'19fc3787f8b39e2debdbaf058c3c351e');
    $fid6EdT8fUIxRjj1N = substr($fid6EdT8fUIxRjj1N, 0, 16);
    if ($fid6EdT8fUIxRjj1N !== $EbLkUhpVtjzkjw3EG) die ();
    */

    //Отправляем оповещение пользователю
    $dd = array('bill_id' => $bill->id, 'status_link' => Bill::statusLink($b),);

    if (Settings::item('nalozhManual') != 1) {
      if ($bill->curier) {
        Mail::letter('kurier_confirmed', $bill->email, $bill->uname, $dd);
      } else {
        Mail::letter('nalozh_confirmed', $bill->email, $bill->uname, $dd);
      }
    }

    //Оповещение администратору о заказе наложенным платежом
    $tocopy = array('email', 'amail', 'cupon', 'surname', 'uname', 'otchestvo', 'strana', 'gorod', 'region', 'address', 'postindex', 'phone', 'comment', 'ip');

    $d = array('bill_id' => $bill->id, 'status_link' => Bill::statusLink($b), 'kupon' => $bill->cupon,);

    foreach ($tocopy as $one) {
      $d[$one] = $bill->$one;
    }

    //Сумма
    $d['sum'] = H::mysum($bill->sum).H::valuta($bill->valuta);

    //Формируем список заказов:
    $ord = '';
    $orders = $bill->orders;
    foreach ($orders as $one) {
      $ord .= ' ['.$one->good->id.'] '.$one->good->title."\r\n";
    }
    $d['orders'] = $ord;

    $d['refid'] = $orders[0]->partner_id;

    //Ссылка на счёт в админке
    $d['admin_link'] = Y::bu().'admin/bill/view/id/'.$b;

    if (Settings::item('nalozhManual') != 1) {
      if ($bill->curier) {
        Mail::sys('admin_kurier_confirmed', $d);
      }
      else {
        //Собственно отправка
        Mail::sys('admin_nalozh_confirmed', $d);
      }
    }

    //Перееадресация в зависимости от того - включён ли кросселл
    //Берём первый товар
    $g = $bill->orders[0]->good;
    if ($g->csellOn) {
      $this->redirect(Y::bu().'nl/special/b/'.$b.'/c/'.Bill::crossCrc($b));
    }
    else {
      $this->redirect(Y::bu().'nl/confirmed/b/'.$b.'/c/'.Bill::nalozh3Crc($b));
    }
  }

  public function actionConfirmed($b, $c) {

    //Проверяем по формату
    if (!is_numeric($b)) die ('Bad bill ID');

    if (!preg_match('/^[0-9a-z_]+$/', $c)) die ('Bad CRC');

    if (Bill::nalozh3Crc($b) != $c) {
      die ('Bad CRC');
    }

    $this->render('confirmed', array('slink' => Bill::statusLink($b),));
  }

  public function actionIndex($b, $c) {

    //Проверяем по формату
    if (!is_numeric($b)) die ('Bad bill ID');

    if (!preg_match('/^[0-9a-z_]+$/', $c)) die ('Bad CRC');

    if (Bill::nalozhCrc($b) != $c) {
      die ('Bad CRC');
    }

    //Готовим ссылку подтверждения
    $confirmLink = Y::bu().'nl/confirm/b/'.$b.'/c/'.Bill::nalozh2Crc($b);

    //Получаем счёт
    $bill = Bill::model()->findByPk($b);

    if (!$bill) die ('Счёт не найден');

    if ($bill->status_id != 'waiting') {
      throw new CHttpException (403, 'Извините, но данный счёт уже был изменён ранее, выпишите новый');
    }

    //Меняем статус на Ожидает подтверждения
    $bill->status_id = 'nalozh';

    if (isset ($_POST['kurier'])) {
      $bill->curier = 1;
    }
    $bill->save(FALSE);

    //Проверяем есть ли опция подтверждения наложенного платежа по e-mail
    if (!Settings::item('nalozhEmail')) {
      //Если нет - просто переходим по ссылке подтверждения
      $this->redirect($confirmLink);
    }

    //Иначе отправляем письмо подтверждения по e-mail
    $dd = array(
      'bill_id' => $bill->id,
      'sum' => H::mysum($bill->sum).H::valuta($bill->valuta),
      'status_link' => Bill::statusLink($b),
      'nalozh_link' => $confirmLink,
    );

    if ($bill->curier) {
      Mail::letter('kurier_confirm', $bill->email, $bill->uname, $dd);
    }
    else {
      Mail::letter('nalozh_confirm', $bill->email, $bill->uname, $dd);
    }

    $tocopy = array('email', 'amail', 'cupon', 'surname', 'uname', 'otchestvo', 'strana', 'gorod', 'region', 'address', 'postindex', 'phone', 'comment', 'ip');

    $d = array('bill_id' => $bill->id, 'status_link' => Bill::statusLink($b), 'kupon' => $bill->cupon,);

    foreach ($tocopy as $one) {
      $d[$one] = $bill->$one;
    }

    $d['sum'] = H::mysum($bill->sum).H::valuta($bill->valuta);
    $ord = '';
    $orders = $bill->orders;

    foreach ($orders as $one) {
      $ord .= ' ['.$one->good->id.'] '.$one->good->title."\r\n";
    }

    $d['orders'] = $ord;
    $d['refid'] = $orders[0]->partner_id;
    $d['admin_link'] = Y::bu().'admin/bill/view/id/'.$b;

    if ($bill->curier) {
      Mail::sys('admin_kurier_notconfirmed', $d);
    }
    else {
      Mail::sys('admin_nalozh_notconfirmed', $d);
    }

    //Показываем страничку с уведомлением
    $this->render('index');
  }

  public function actionUp($n) {

    if (!is_numeric($n)) die ('Bad number');

    $b = Yii::app()->session['crossB'];

    if (!$b) die ('Извините, но Ваша сессия уже окончена - поэтому добавление более невозможно');

    $g = Yii::app()->session['crossG'];

    $g = Good::model()->findByPk($g);

    $crc = Yii::app()->session['crossC'];

    if (Bill::crossCrc($b) != $crc) die ('Ошибка контрольной суммы');

    if (($n == 1) && ($g->csellOn == 1)) {
      $g2 = $g->csellGood;
      Bill::cross($g2, $b, $g->id);
    }

    if (($n == 2) && (!empty ($g->csell2))) {
      $g2 = $g->csell2g;
      Bill::cross($g2, $b, $g->id);
    }

    if (($n == 3) && (!empty ($g->csell3))) {
      $g2 = $g->csell3g;
      Bill::cross($g2, $b, $g->id);
    }

    $ok = FALSE;

    $url = '/';

    if ($n == 1) {
      if (empty($g->csell2)) {
        $ok = TRUE;
      }
      else {
        $url = $g->csell2;
      }
    }
    if ($n == 2) {
      if (empty($g->csell3)) {
        $ok = TRUE;
      }
      else {
        $url = $g->csell3;
      }
    }
    if ($n == 3) {
      $ok = TRUE;
    }
    if ($ok) {
      Yii::app()->session['crossB'] = FALSE;
      Yii::app()->session['crossC'] = FALSE;
      Yii::app()->session['crossG'] = FALSE;
      if (!empty ($g->csellOk)) {
        $this->redirect($g->csellOk);
      }
      else {
        $this->render('ok', array('slink' => Bill::statusLink($b->id),), FALSE, 'order_cross_ok/'.($g->id));
      }
    }
    else {
      $this->redirect($url);
    }
  }

  //После того, как подтвердили кросселл
  public function actionOk($b, $g, $c) {

    if (!is_numeric($b)) die ('Bad bill ID');

    if (!preg_match('/^[0-9a-z_]+$/', $g)) die ('Bad good id');

    if (!preg_match('/^[0-9a-z_]+$/', $c)) die ('Bad CRC');

    //Проверяем CRC
    if (Bill::cross2Crc($b, $g) != $c) {
      die ('Bad CRC');
    }

    $gg = Good::model()->findByPk($g);
    $g2 = $gg->csellGood;

    Bill::cross($g2, $b, $gg->id);
    Yii::app()->session['crossB'] = FALSE;
    Yii::app()->session['crossC'] = FALSE;
    Yii::app()->session['crossG'] = FALSE;

    $this->render('ok', array('slink' => Bill::statusLink($b),), FALSE, 'order_cross_ok/'.$g);
  }

  //Кросселл
  public function actionSpecial($b, $c) {

    if (!is_numeric($b)) die ('Bad bill ID');

    if (!preg_match('/^[0-9a-z_]+$/', $c))  die ('Bad CRC');

    if (Bill::crossCrc($b) != $c) {
      die ('Bad CRC');
    }

    //Получаем счёт
    $bill = Bill::model()->findByPk($b);

    if (!$bill) die ('Счёт не найден');

    //Берём первый товар
    $g = $bill->orders[0]->good;

    if (!$g->csellOn) die ('Функция отключена для данного товара');

    $ctext = $g->csellText;
    Yii::app()->session['crossB'] = $b;
    Yii::app()->session['crossC'] = Bill::crossCrc($b);
    Yii::app()->session['crossG'] = $g->id;

    $curl = trim($ctext);

    if (substr($curl, 0, 7) == 'http://') {
      $this->redirect($curl);
    }
    else {
      $this->render('special', array('okurl' => Y::bu().'nl/ok/b/'.$b.'/g/'.$g->id.'/c/'.Bill::cross2crc($b, $g->id), 'cross' => $g->csellText,), FALSE, 'order_cross/'.$g->id);
    }
  }
}