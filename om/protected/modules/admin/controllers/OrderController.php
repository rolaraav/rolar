<?php
class OrderController extends Controller {
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
        'actions' => StaffAccess::allowed('order'),
      ),
      array('deny',
        'users' => array('*'),
      ),
    );
  }

  public function actionView($id) {
    $this->render('view', array(
      'model' => $this->loadModel($id),
    ));
  }

  public function actionIndex() {
    $model = new Order('search');
    $model->unsetAttributes();
    if (isset($_GET['Order']))
      $model->attributes = $_GET['Order'];
    /*
    $fjahZISU7pDl3Gc7J = parse_url(Yii::app()->getBaseUrl(TRUE));
    $fjahZISU7pDl3Gc7J = $fjahZISU7pDl3Gc7J['host'];
    $DBwDzxp1KrGCRIdft = substr(OM_LIC, 256, 16);
    $C8yJ9jeMpuPwKqPxR = md5($fjahZISU7pDl3Gc7J.'42d95c2f536d6ca72faa71d2c518728d');
    $C8yJ9jeMpuPwKqPxR = md5($C8yJ9jeMpuPwKqPxR.$fjahZISU7pDl3Gc7J.'c2beadbb1dcb004ddec48ad133df619e');
    $C8yJ9jeMpuPwKqPxR = md5($C8yJ9jeMpuPwKqPxR.$fjahZISU7pDl3Gc7J.'72a7836c735acdca7dfbe847d209fe53');
    $C8yJ9jeMpuPwKqPxR = substr($C8yJ9jeMpuPwKqPxR, 0, 16);
    if ($C8yJ9jeMpuPwKqPxR !== $DBwDzxp1KrGCRIdft) die ();
    */
    if (!empty($_POST)) {
      $st = $_POST['operation'];
      if ($st == 'excel') {
        $orders = $_POST['orders'];
        $this->myexcel($orders);
        return TRUE;
      }
    }
    $this->render('index', array(
      'model' => $model,
    ));
  }

  public function loadModel($id) {
    $model = Order::model()->findByPk((int)$id);
    if ($model === null)
      throw new CHttpException(404, 'The requested page does not exist.');
    $cn = StaffAccess::allowed('country');
    if (!empty ($cn)) {
      if ($cn[0] != 'none') {
        if (!in_array($model->country, $cn)) {
          die ('Вам не разрешено работать с данным счётом');
        }
      }
    }
    return $model;
  }

  protected function performAjaxValidation($model) {
    if (isset($_POST['ajax']) && $_POST['ajax'] === 'order-form') {
      echo CActiveForm::validate($model);
      Yii::app()->end();
    }
  }

  private function myexcel($orders) {
    $bs = array();
    $efields = array('ID заказа', 'ФИО', 'Страна', 'Область', 'Город', 'Адрес', 'Индекс',
      'E-mail', 'Способ оплаты', 'Сумма оплаты', 'Партнер', 'Дата оплаты (заказа)', 'Телефон', 'Товар', 'ID счёта', 'Статус', 'Примечание');
    $bs = array();
    foreach ($orders as $b) {
      $bs[] = Order::model()->findByPk($b);
    }
    $t = array();
    foreach ($bs as $or) {
      $b = Bill::model()->findByPk($or->bill_id);
      $a = array(
        $or->id,
        $b->surname.' '.$b->uname.' '.$b->otchestvo,
        $b->strana,
        $b->region,
        $b->gorod,
        $b->address,
        $b->postindex,
        $b->email,
        $b->way,
        $b->sum.' '.strtoupper($b->valuta),
        $b->orders[0]->partner_id,
        H::date(($b->payDate > 0) ? $b->payDate : $b->createDate),
        $b->phone,
        $or->good_id,
        $b->id,
        Lookup::item('Status', $b->status_id),
        $b->comment,
      );
      $t[] = $a;
    }
    $fn = 'orders_'.date('Y_m_j_H_i').'.xls';
    Bill::excel($efields, $t, $fn);
  }
}