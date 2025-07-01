<?php

class YandexController extends Controller
{

    //Оповещение от платёжной системы Yandex
    public function actionIndex ()
    {

        if (!Settings::item('payYandexOn')) {
            die ('Error: способ отключен');
        }

        if (!$_POST) die ('Error'); //Пустые данные


        if (!isset ($_POST['sha1_hash'])) {
            die ('Error: Не переданы параметры');
        }

        //Ключ для хэшей
        $yakey = trim (Settings::item('payYandexKey'));

        //Точно ли это платёж с ob ?
        $label = $_POST['label'];
        if (strpos($label, 'Oplata_scheta_') === false) {
            die ('Not OM2 payment');
        }

        $sum = $_POST['amount'] + 0;
        if (isset ($_POST['withdraw_amount'])) {
            $sum2 = $_POST['withdraw_amount'] + 0;
            if ($sum2 > $sum) $sum = $sum2;
        }

        $bill_id = str_replace('Oplata_scheta_', '', trim($label)) + 0; //Номер счёта

        if (isset ($_POST['test_notification'])) {
            if (($_POST['test_notification']) != 0) {
                die ('Error: тестовый режим запрещён');
            }
        }


        $way = 'ЮMoney';
        $type = 'rur'; //Рубли


        $hash = $_POST['notification_type'] . '&' . $_POST['operation_id'] . '&' . $_POST['amount'] . '&643&'
                     .  $_POST['datetime'] . '&' . $_POST['sender'] . '&false&' . $yakey . '&' . $label;

        $hash = sha1 ($hash);

        if ($_POST['sha1_hash'] == $hash) { //Проверка хэша
            Bill::payBill($bill_id, $way, $sum, $type, $_POST['sender']);
        } else {
            die ('Error: Неверная контрольная сумма');
        }

    }

    public function actionOk ()
    {
        $this->redirect (Y::bu().'f/ok/w/yandex');
    }

    public function actionFail ()
    {
        $this->redirect (Y::bu().'f/fail/w/yandex');
    }


}
