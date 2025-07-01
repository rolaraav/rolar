<?php



//Интеграция с Единой Кассой (W1)
class WalletController extends Controller
{

    //Оповещение от платёжной системы w1
    public function actionIndex ()
    {

        if (!Settings::item('payW1On')) {
            die ('Error: способ отключен');
        }

        if (!$_POST) die ('Error'); //Пустые данные

        //Ключ для хэшей
        $skey = trim (Settings::item('payW1Key'));

        // Функция, которая возвращает результат в Единую кассу



        // Проверка наличия необходимых параметров в POST-запросе

        if (!isset($_POST["WMI_SIGNATURE"]))
            $this->print_answer("Retry", "Отсутствует параметр WMI_SIGNATURE");

        if (!isset($_POST["WMI_PAYMENT_NO"]))
            $this->print_answer("Retry", "Отсутствует параметр WMI_PAYMENT_NO");

        if (!isset($_POST["WMI_ORDER_STATE"]))
            $this->print_answer("Retry", "Отсутствует параметр WMI_ORDER_STATE");

        // Извлечение всех параметров POST-запроса, кроме WMI_SIGNATURE

        foreach($_POST as $name => $value)
        {
            if ($name !== "WMI_SIGNATURE") $params[$name] = $value;
        }

        // Сортировка массива по именам ключей в порядке возрастания
        // и формирование сообщения, путем объединения значений формы

        uksort($params, "strcasecmp"); $values = "";

        foreach($params as $name => $value)
        {
            //Конвертация из текущей кодировки (UTF-8)
            //необходима только если кодировка магазина отлична от Windows-1251
            $value = $this->conv($value);
            $values .= $value;
        }

        // Формирование подписи для сравнения ее с параметром WMI_SIGNATURE

        $signature = base64_encode(pack("H*", md5($values . $skey)));

        $sum = $_POST['WMI_PAYMENT_AMOUNT']+0;
        $bill_id = $_POST['WMI_PAYMENT_NO']+0;

        $type = 'rur'; //Валюта
        $way = 'W1 Единая касса';

        //Сравнение полученной подписи с подписью W1

        if ($signature == $_POST["WMI_SIGNATURE"])
        {
            if (strtoupper($_POST["WMI_ORDER_STATE"]) == "ACCEPTED")
            {
                // TODO: Пометить заказ, как «Оплаченный» в системе учета магазина
                Bill::payBill($bill_id, $way, $sum, $type, $_POST['WMI_TO_USER_ID']);

                $this->print_answer("Ok", "Заказ #" . $_POST["WMI_PAYMENT_NO"] . " оплачен!");
            }
            else
            {
                // Случилось что-то странное, пришло неизвестное состояние заказа

                $this->log ("Единая касса (W1), ошибка в счёте #".$_POST["WMI_PAYMENT_NO"]." - неверное состояние, сформированая подпись - ".$signature);
                $this->print_answer("Retry", "Неверное состояние ". $_POST["WMI_ORDER_STATE"]);
            }
        }
        else
        {
            // Подпись не совпадает, возможно вы поменяли настройки интернет-магазина

            $this->log ("Единая касса (W1), ошибка в счёте #".$_POST["WMI_PAYMENT_NO"]." - неверная подпись, сформированая - ".$signature);
            $this->print_answer("Retry", "Неверная подпись " . $_POST["WMI_SIGNATURE"]);            
        }


    }

    public function actionOk ()
    {
        $this->redirect (Y::bu().'f/ok/w/walletone');
    }

    public function actionFail ()
    {
        $this->redirect (Y::bu().'f/fail/w/walletone');
    }

    private function print_answer($result, $description)
    {
        header ("Content-type: text/html; charset=Windows-1251");
        print "WMI_RESULT=" . strtoupper($result) . "&";
        print "WMI_DESCRIPTION=" .urlencode($this->conv ($description));
        exit();
    }
    
    //Конвертер кодировки
    private function conv ($str)
    {
        if (function_exists ('mb_convert_encoding')) {
            $str = mb_convert_encoding ($str, 'Windows-1251','utf8');
        } elseif (function_exists ('iconv')) {
            $str = iconv("utf-8", "Windows-1251", $value);
        }
        
        return $str;
    }
    
    private function conv2 ($str)
    {
        if (function_exists ('mb_convert_encoding')) {
            $str = mb_convert_encoding ($str, 'utf8','Windows-1251');
        } elseif (function_exists ('iconv')) {
            $str = iconv("Windows-1251", "utf-8", $value);
        }
        
        return $str;
    }    
    
    //Лог в случае ошибки
    private function log ($descr)
    {
        $data = $descr."\r\n
        ============================
          Данные POST:
        ============================";
        
        foreach ($_POST as $key=>$one)
        {
            $data .= "\r\n".$key . ' = '.$this->conv2($one);
        }
        $data .= "\r\n" . '=======================';
        
        Log::add ('newpay', $data);
    }

}