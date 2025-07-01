<?php
class CartorderController extends Controller {

  public function actionConfirm() {

    $cart = UsualCart::listGoods();

    if (empty ($cart)) {
      throw new CHttpException(404, 'Корзина пуста. Выберите товары для заказа');
    }

    $bill = Yii::app()->session['thecartorder'];

    /*
    $FaqizEZ13u8lHUSeM = getenv('HTTP_HOST');
    $DRykALIV2jdZqVARL = substr(OM_LIC, 128, 16);
    $FqI1ZJx4yhl9vQ5ed = md5($FaqizEZ13u8lHUSeM.'ef2f93fe4ecfe46678fb81c55337ce3c');
    $FqI1ZJx4yhl9vQ5ed = md5($FqI1ZJx4yhl9vQ5ed.$FaqizEZ13u8lHUSeM.'543bc09b01d87b0949d28aa87285afd1');
    $FqI1ZJx4yhl9vQ5ed = md5($FqI1ZJx4yhl9vQ5ed.$FaqizEZ13u8lHUSeM.'848261b1b6d7299e1f2411ab410a01e6');
    $FqI1ZJx4yhl9vQ5ed = substr($FqI1ZJx4yhl9vQ5ed, 0, 16);
    if ($FqI1ZJx4yhl9vQ5ed !== $DRykALIV2jdZqVARL) die ();
    */

    if (!$bill) {
      throw new CHttpException(403, 'Не заполнена форма оплаты');
    }
    $cart2 = self::_goodList($cart, $bill->cupon, $bill->email);
    $this->render('confirm', array('model' => $bill, 'goods' => $cart2,));
  }

  public function actionIndex() {

    if (Settings::item('usualCartOn') != 1) {
      throw new CHttpException (404, 'Извините, но корзина отключена');
    }

    $cart = UsualCart::listGoods();

    if (empty ($cart)) {
      throw new CHttpException(404, 'Корзина пуста. Выберите товары для заказа');
    }

    $model = new Bill;
    $model->unsetAttributes();
    $kind = UsualCart::checkKind();

    if ($kind == 'disk') {
      $model->disk = TRUE;
    }
    $model->kind = $kind;

    /*
    $AGKDvyN6beE02CcrF = $_SERVER['HTTP_HOST'];
    $d9YtrJkFhNRwnyesl = substr(OM_LIC, 144, 16);
    $EUgBKnjL1KPMSwWlB = md5($AGKDvyN6beE02CcrF.'b7d537a308fbfa78b38bcc88a664544e');
    $EUgBKnjL1KPMSwWlB = md5($EUgBKnjL1KPMSwWlB.$AGKDvyN6beE02CcrF.'44970af791d3203b1b8cce2b93052c97');
    $EUgBKnjL1KPMSwWlB = md5($EUgBKnjL1KPMSwWlB.$AGKDvyN6beE02CcrF.'d8c844fd22792cd26a9a6f26f988adf4');
    $EUgBKnjL1KPMSwWlB = substr($EUgBKnjL1KPMSwWlB, 0, 16);
    if ($EUgBKnjL1KPMSwWlB !== $d9YtrJkFhNRwnyesl) exit ();
    */

    if (isset($_POST['Bill'])) {
      $bbb = $_POST['Bill'];
      $ballow = array('email', 'uname', 'amail', 'cupon', 'surname', 'otchestvo', 'strana', 'gorod', 'region', 'street', 'comment', 'phone', 'postindex', 'address');
      foreach ($bbb as $bbkey => $one) {
        if (!in_array($bbkey, $ballow)) {
          unset ($bbb[$bbkey]);
        }
      }
      $model->attributes = $bbb;

      if ($model->validate()) {
        Yii::app()->session['thecartorder'] = $model;
        $this->redirect(array('confirm'));
      }
    }
    else {
      if (($kind == 'disk') && (Settings::item('phoneDisk') != 1)) {
        $model->phone = 'нет';
      }
      if (($kind != 'disk') && (Settings::item('phoneEbook') != 1)) {
        $model->phone = 'нет';
      }
    }
    $this->render('index', array('model' => $model, 'kind' => $kind,));
  }

  public function actionComplete() {

    $cart = UsualCart::listGoods();

    if (empty ($cart)) {
      throw new CHttpException(404, 'Корзина пуста. Выберите товары для заказа');
    }

    $bill = Yii::app()->session['thecartorder'];

    if (!$bill) {
      throw new CHttpException(403, 'Не заполнена форма оплаты');
    }

    $cart2 = self::_goodList($cart, $bill->cupon);
    $bill->id = NULL;
    $bill->isNewRecord = TRUE;
    $bill->createDate = time();
    $bill->payDate = 0;
    $bill->status_id = Bill::BILL_WAITING;
    $bill->ip = Yii::app()->request->userHostAddress;
    $bill->way = '';
    $bill->kind = UsualCart::checkKind();
    $bill->orderCount = count($cart2);
    $bill->postNumber = '';
    $bill->usdkurs = Settings::item('kursUsd');
    $bill->eurkurs = Settings::item('kursEur');
    $bill->uahkurs = Settings::item('kursUah');
    $bill->valuta = 'rur';
    $total = 0;

    foreach ($cart2 as $one) {
      $total += $one->rurcena;
    }

    $bill->sum = $total;

    if (!$bill->save()) {
      throw new CHttpException(403, 'Произошла неизвестная ошибка при формировании счёта. Пожалуйста, выпишите новый.');
    }

    $ord = new Order;

    /*
    $fIlITq39qdRdYpwll = getenv('HTTP_HOST');
    $dc9tguDUOBtJpEgZ3 = substr(OM_LIC, 176, 16);
    $BZl3zK1bB72OQblW1 = md5($fIlITq39qdRdYpwll.'1f3fbef9b90fba8742a621b80f634159');
    $BZl3zK1bB72OQblW1 = md5($BZl3zK1bB72OQblW1.$fIlITq39qdRdYpwll.'5c26bd0d598fad1affe92571bd8f6cfc');
    $BZl3zK1bB72OQblW1 = md5($BZl3zK1bB72OQblW1.$fIlITq39qdRdYpwll.'2b12488236747211f1f548139b90b4b8');
    $BZl3zK1bB72OQblW1 = substr($BZl3zK1bB72OQblW1, 0, 16);
    if ($BZl3zK1bB72OQblW1 !== $dc9tguDUOBtJpEgZ3) exit ();
    */

    foreach ($cart2 as $good) {
      $ord->id = NULL;
      $ord->isNewRecord = TRUE;
      $ord->bill_id = $bill->id;
      $ord->good_id = $good->id;
      $ord->createDate = $bill->createDate;
      $ord->cena = $good->newprice;
      $ord->valuta = $good->currency;
      if (!$ord->save()) {
        throw new CHttpException(403, 'Произошла неизвестная ошибка при формировании заказа. Пожалуйста, сделайте новый заказ');
      }
    }

    Yii::app()->session['thecartorder'] = FALSE;

    UsualCart::emptyCart();

    $data = array('bill_id' => $bill->id, 'sum' => H::mysum($bill->sum).H::valuta($bill->valuta), 'status_link' => Y::bu().'status/index/b/'.$bill->id.'/c/'.Bill::statusCrc($bill->id),);

    Mail::letter('bill_new', $bill->email, $bill->uname, $data);

    $this->redirect(array('bill/index', 'bill_id' => $bill->id, 'hash' => Bill::hashBill($bill->id)));

  }

  private static function _goodList($cart, $kupon, $email = false) {

    $nc = array();

    foreach ($cart as $good) {

      $gd = Good::model()->findByPk($good['id']);

      if (!$gd) {
        throw new CHttpException(404, 'К сожалению, один из товаров, помещённых в корзину, не существует. Сформируйте Корзину заново.');
      }

      if (!empty ($kupon)) {
        if (Cupon::valid($kupon, $email) != '') {
          $gd->newprice = Cupon::goodCena($kupon, $gd);
        }
      }
      else {
        $gd->newprice = $gd->price;
      }

      $rurcena = (Valuta::conv($gd->newprice, $gd->currency));
      $gd->rurcena = $rurcena['rur'];
      $nc[] = $gd;

    }
    return $nc;
  }
}