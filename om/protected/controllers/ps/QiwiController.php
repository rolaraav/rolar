<?php

class QiwiController extends Controller
{
    //Данные киви
    private $_qid = "";
    private $_qpass = "";

    public function actionIndex ($b,$c)
    {
        //Проверяем по формату
        if (!is_numeric ($b)) die ('Bad bill ID');

        if (!preg_match ('/^[0-9a-z_]+$/',$c)) die ('Bad CRC');

        if (Bill::notifyCrc($b)!=$c) {
            die ('Bad CRC');
        }

        //Получаем счёт
        $bill = Bill::model()->findByPk ($b);

        if (!$bill) die ('Счёт не найден');

        if ($bill->status_id!='waiting') {
            throw new CHttpException (403,'Извините, но данный счёт уже поменял статус ранее и не может быть оплачен');
        }

        $tel = str_replace (' ','',trim ($_POST['tel']));
        $tel = str_replace ('-','',$tel);
        $tel = str_replace ('+','',$tel);

        if (!is_numeric($tel))
        {
            die ('<center><p align="center" style="font-family: Tahoma, Arial, Verdana, Sans-Serif"><h3 style="font-family: Tahoma, Arial, Verdana, Sans-Serif" align="center">Для продолжения оплаты -<br> введите номер Вашего счёта в QIWI<br> в формате +79991111111:</h3><br>
            <img src="'.Y::bu().'images/admin/pay/qiwi.jpg'.'" style="padding: 15px;"><br>
            <form action="" method="post">
            <input type="text" name="tel" value="+7">
            <br>&nbsp;<br>
            <input type="submit" value="Продолжить оплату">
            </form></p></center>');
        }
	$tel = '+'.$tel;



        $ceny = Valuta::conv($bill->sum, $bill->valuta, $bill->usdkurs, $bill->eurkurs, $bill->uahkurs);

        //Выставляем счёт киви
        $sum = ceil ($ceny['rur']*100)/100;
        $bill_id = $bill->id;

        $requestType = 'PUT';
        $url = 'https://w.qiwi.com/api/v2/prv/{prv_id}/bills/{bill_id}';

        $parameters = array(
            'user' => 'tel:'.$tel,
            'amount' => $sum,
            'ccy' => 'RUB',
            'comment' => 'Oplata scheta '.$bill_id,
            'pay_source' => 'qw',
            'lifetime' => date('c', time()+3600),
            'prv_name' => 'QIWI',
        );

        //Проверяем
        $this->_req ($requestType, $url, $bill_id, $parameters);

        //Если всё ок - редирект на оплату
        $url = 'https://w.qiwi.com/order/external/main.action?shop='.$this->_qid.'&transaction='.$bill_id;
        $url .= '&successUrl=' . Y::bu().'ps/qiwi/ok?b='.$bill_id;
        $url .= '&failUrl=' . Y::bu().'f/fail';

        $this->redirect ($url);

    }

    public function actionOk ()
    {
        if (isset ($_GET['b']))
        {
            $bill_id = $_GET['b']+0;
        } elseif (isset ($_GET['order'])) {
            $bill_id = $_GET['order']+0;
        }

        //Проверяем киви
        $requestType = 'GET';
        $url = 'https://w.qiwi.com/api/v2/prv/{prv_id}/bills/{bill_id}'; // Аналогично выше
        $parameters = array();

        $res = $this->_req ($requestType, $url, $bill_id, $parameters);

        //если всё ок - зачисляем
        if ($res->bill->status == 'paid')
        {
            Bill::payBill($bill_id, 'Qiwi', $res->bill->amount+0, 'rur', $res->bill->user);
        } else {
            $this->redirect (Y::bu().'f/wait');
            die ();
        }

        //- редирект на обычную страничку оплачено
        $this->redirect (Y::bu().'f/ok');
    }

    private function _req ($requestType, $url, $bill_id, $params = array ())
    {
        //Грузим данные магазина
        if (empty ($this->_qid))
        {
            $this->_qid = trim (Settings::item('payQiwiId'));
            $this->_qpass = trim (Settings::item('payQiwiPass'));
        }

        $loginPass = $this->_qpass; //Строка для авторизации

        $bill_id = (int) $bill_id; //Число

        //Url
        $url = str_replace ('{prv_id}',$this->_qid, $url);
        $url = str_replace ('{bill_id}',$bill_id, $url);

        $headers = array(
            "Accept: text/json",
            "Content-Type: application/x-www-form-urlencoded; charset=utf-8",
            "Authorization: Basic ".base64_encode($loginPass),
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        //curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        //curl_setopt($ch, CURLOPT_USERPWD, base64_encode($loginPass));

        if ($requestType != 'GET') {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $requestType);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
        }
        $httpResponse = curl_exec($ch);

        if (!$httpResponse) {
            // Описание ошибки, к примеру
            echo curl_error($ch).'('.curl_errno($ch).')';
            die ();
        }

        $httpResponseAr = json_decode($httpResponse);
        $res = $httpResponseAr->response;

        if (!is_object ($res)) die ('Unknown error');
        if ($res->result_code != 0)
        {
            $err = array (
                5 => 'Неверный формат параметров запроса',
                13 => 'Сервер занят, повторите запрос позже',
                150 => 'Ошибка авторизации',
                341 => 'Авторизация провалена',
                210 => 'Счет не найден',
                215 => 'Счет с таким bill_id уже существует (выпишите новый)',
                241 => 'Сумма слишком мала',
                242 => 'Сумма слишком велика',
                298 => 'Кошелек с таким номером не зарегистрирован',
                300 => 'Техническая ошибка',

            );

            die ('Error: '.$err[$res->result_code+0]);
        }
        return $res;

    }


}