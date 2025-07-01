<?php

class PaypalController extends Controller
{
    public function actionIndex ()
    {
        if (!Settings::item('payPaypalOn')) {
            die ('Error: способ отключен');
        }

        if (!$_POST) die ('Error'); //Пустые данные


        if (!isset ($_POST['verify_sign'])) {
            die ('Error: Не переданы параметры');
        }

        //Метод для хэшей
        $paykey = trim (Settings::item('payPaypalKey'));


        $sum = $_POST['mc_gross'] + 0;

        $bill_id = $_POST['item_number'] + 0; //Номер счёта

        if (isset ($_POST['test_ipn'])) {
            if (($_POST['test_ipn']) != 0) {
                die ('Error: тестовый режим запрещён');
            }
        }


        $way = 'PayPal';
        $type = 'rur'; //Рубли


        //Выполняем проверку
        $checked = false;

        if ($paykey != 'none')
        {

            //Рекомендуемый метод - fsockopen
            if ($paykey == 'fsockopen')
            {

                $checked = $this->_fsock ($bill_id, $sum);


            }

            //Ещё один метод проверки
            if ($paykey == 'file_get_contents')
            {
                $data = $_POST;
                $context = stream_context_create(array(
                    'http' => array(
                        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                        'method'  => 'POST',
                        'content' => http_build_query($data),
                    ),
                ));

                $content = file_get_contents('https://www.paypal.com/cgi-bin/webscr?cmd=_notify-validate', false, $context);

                $checked = strstr($content, 'VERIFIED');

            }

            if ($paykey == 'ipcheck')
            {
                if (preg_match('~^(?:.+[.])?paypal[.]com$~', gethostbyaddr($_SERVER['REMOTE_ADDR'])) > 0)
                {
                    // came from paypal.com (unless your server got r00ted)
                    $checked = true;
                }
            }


        } else {
            //Иначе без проверки
            $checked = true;
        }



        if ($checked) { //Проверка
            Bill::payBill($bill_id, $way, $sum, $type, $_POST['payer_email']);
        } else {
            die ('Error: Проверка подлинности не выполнена');
        }

    }

    //Уведомление о задержке платежа
    private function _pending_notify ($bill_id, $sum)
    {

        //Если успешно - отправляем письмо и редирект
        $d = array (
            'bill_id' => $bill_id,
            'status_link' => Bill::statusLink ($bill_id),
            'way' => 'Paypal',
            'message' => "Внимание! Это системное уведомление о необходимости проверить зачисление платежа PayPal по счёту №".$bill_id.",\r\n т.к. данный платёж передан на ручную обработку.\r\n После проверки отметьте в админ-панели счёт как оплаченный - вручную.",
        );

        //Сумма
        $d['sum'] = H::mysum($sum);

        //Ссылка на счёт в админке
        $d['admin_link'] = Y::bu().'admin/bill/view/id/'.$b;

        //Собственно отправка
        Mail::sys ('admin_notify_paid',$d);

    }

    private function _fsock ($bill_id, $sum)
    {

        $req = "cmd=_notify-validate";
        foreach($_POST as $key=>$val)
        {
            $req.= "&".$key."=".urlencode($val);
        }

        $header = "POST http://www.paypal.com/cgi-bin/webscr HTTP/1.0\r\n";
        $header .= "Content-Type: application/x-www-form-urlencoded\r\n";
        $header .= "Content-Length: " . strlen ($req) . "\r\n\r\n";
        $fp = fsockopen ("www.paypal.com", 80, $errno, $errstr, 30);

        if (!$fp)
        {
            echo "$errstr ($errno)";
            return false;
        }

        fputs ($fp, $header . $req);

        $res="";
        while (!feof($fp))
            $res .= fgets ($fp, 1024);
        fclose ($fp);

        if (strpos($res, "VERIFIED")===FALSE)
        {
            return false;
        }

        //payment VERIFIIED

        if ($_POST["payment_status"]!="Completed")
        {
            if ($_POST["payment_status"]=="Pending" )
            {
                //Уведомление
                $this->_pending_notify ($bill_id, $sum);
                return false;

            }

            return false;

        }

        return true; //Всё ок
    }

}