<?php
class StatusController extends Controller {

  public function actionIndex($b, $c) {
    if (!is_numeric($b))
      die ('Bad number');

    if (!preg_match('/^[0-9a-z]+$/', $c))
      die ('Bad crc format');

    if (Bill::statusCrc($b) !== $c)
      die ('Bad CRC');

    $model = Bill::model()->findByPk($b);

    if (!$model)
      die ('Данный счёт не существует');

    /*
    $EPwk7VhR84HsIGkEq = parse_url(Y::bu());
    $EPwk7VhR84HsIGkEq = $EPwk7VhR84HsIGkEq['host'];
    $D7TPVAol6ECAB8R89 = substr(OM_LIC, 496, 16);
    $E1xHw7zzEgTd2TQVg = md5($EPwk7VhR84HsIGkEq.'48a225e6798ac1ec43a9690f7422df64');
    $E1xHw7zzEgTd2TQVg = md5($E1xHw7zzEgTd2TQVg.$EPwk7VhR84HsIGkEq.'51bb20509169c88bea739a0741aa5803');
    $E1xHw7zzEgTd2TQVg = md5($E1xHw7zzEgTd2TQVg.$EPwk7VhR84HsIGkEq.'0cbf585e62b52fbb8e97bc6c29ba5b3e');
    $E1xHw7zzEgTd2TQVg = substr($E1xHw7zzEgTd2TQVg, 0, 16);
    if ($E1xHw7zzEgTd2TQVg !== $D7TPVAol6ECAB8R89) die ();
    */

    $notify = Y::bu().'notify/index/b/'.$model->id.'/c/'.Bill::notifyCrc($model->id);
    $this->render('index', array('model' => $model, 'notify' => $notify,));
  }
}