<?php

class YandexkassaController extends Controller
{

    private $_ShopId = 'СЮДА_ПИШЕМ_SHOP_ID'; //Сюда в кавычках впишите ShopId
    private $_ShopPassword = 'СЮДА_ПИШЕМ_SHOP_PASSWORD'; //Сюда в кавычках впишите ShopPassword (пароль магазина)
    private $_Scid = 'СЮДА_ПИШЕМ_SCID'; //Сюда в кавычках впишите scid витрины


    //Поддержка закона 54-ФЗ
    // https://tech.yandex.ru/money/doc/payment-solution/payment-form/payment-form-receipt-docpage/

    /**
     * Система налогообложения
     * 1 — общая СН;
     * 2 — упрощенная СН (доходы);
     * 3 — упрощенная СН (доходы минус расходы);
     * 4 — единый налог на вмененный доход;    
     * 5 — единый сельскохозяйственный налог;
     * 6 — патентная СН.    
     */

    private $taxSystem = 2; 

    /**
     * Ставка НДС. Возможные значения — число от 1 до 6:
     * 
     * 1 — без НДС;
     * 2 — НДС по ставке 0%;      
     * 3 — НДС чека по ставке 10%;
     * 4 — НДС чека по ставке 18%;
     * 5 — НДС чека по расчетной ставке 10/110;
     * 6 — НДС чека по расчетной ставке 18/118.
     */

    private $tax = 1;

    private $autoSubmit = 1; //Автоматически отправлять форму с доп. странички ("Кнопка оплатить") - можно отключить и поставить 0 если что-то не так

    public function actionForm ()
    {

        header ("Content-type: text/html; charset=utf-8");
        if (!$_POST)
        {
            die ('Неизвестная ошибка, вернитесь обратно и нажмите, пожалуйста, ещё раз кнопку Продолжить оплату');            
        }
        
        if (!isset($_POST['bill_id']) || !isset($_POST['crc']))
        {
            die ('Неизвестная ошибка, вернитесь обратно и нажмите, пожалуйста, ещё раз кнопку Продолжить оплату');            
        } 
         
        
        $bill_id = (int) $_POST['bill_id'];
        $crc = trim($_POST['crc']);
        
        //Проверяем CRC
        $realcrc = trim(Bill::statusLink ($bill_id));
        
        //Для страховки http/https
        $realcrc = str_replace ('https://','',$realcrc);
        $realcrc = str_replace ('http://','',$realcrc);
        $crc = str_replace ('https://','',$crc);
        $crc = str_replace ('http://','',$crc);        
        
        if ($realcrc != $crc)
        {
            die ('Неизвестная ошибка контрольной суммы, вернитесь обратно и нажмите, пожалуйста, ещё раз кнопку Продолжить оплату');            
        }        
        
        //Ищем счёт
        $b = Bill::model()->findByPk ($bill_id);
        
        //Если не найден - ошибка
        if (!$b)
        {
            die ('Невозможно найти счёт. Вернитесь, пожалуйста, обратно или начните процесс заказа заново.');            
        }

        $ceny = Valuta::conv($b->sum, $b->valuta, $b->usdkurs, $b->eurkurs, $b->uahkurs);        

        $bu = Y::bu();

        $rur = number_format($ceny['rur'],  2, '.', '');       
        
        $json = array ();

        $json['customerContact'] = $b->email; //Контакты клиента - передаём e-mail
        $json['taxSystem'] = $this->taxSystem;

        $items = array ();

        $orders = $b->orders;

        $newsum = 0; //Новая сумма для передачи

        foreach ($orders as $order)
        {
            $item = array ();

            $item['quantity'] = 1; //По умолчанию одна позиция товара

            $ceny2 = Valuta::conv($order->cena, $order->valuta, $b->usdkurs, $b->eurkurs, $b->uahkurs);        
            $rur2 = number_format($ceny2['rur'],  2, '.', '');       

            $item['price'] = array ();
            $item['price']['amount'] = $rur2; //Цена за 1 товар такая же, т.к. всего 1 товар
            $item['tax'] = $this->tax; //НДС
            $item['text'] = $this->convertToUTF8 ($order->good->title);


            $newsum += $rur2;


            $items[] = $item;

        }

        $json['items'] = $items;


        $jsonStr = $this->jsonEncode ($json); //54-ФЗ данные

        echo '<form action="https://yoomoney.ru/eshop.xml" method="post" id="yandexkassa">
            <input name="shopId" value="'.$this->_ShopId.'" type="hidden"/>
            <input name="scid" value="'.$this->_Scid.'" type="hidden"/>
            <input name="sum" value="'.$newsum.'" type="hidden">
            <input name="customerNumber" value="'.$b->id.'" type="hidden"/>
            <input name="paymentType" value="" type="hidden"/>
            <input name="shopSuccessURL" value="'.$bu.'f/ok" type="hidden"/>
            <input name="shopFailURL" value="'.$bu.'f/fail" type="hidden"/>
            <input type="hidden" name="ym_merchant_receipt" value=\''.$jsonStr.'\'>
            <input type="submit" value="Перейти к оплате"/>
            </form>';

	if ($this->autoSubmit)
	{
		echo '<script>
            document.getElementById("yandexkassa").submit();
		</script>';
	}
        die ();
    }

    


    //Оповещение от платёжной системы Yandex
    public function actionIndex ()
    {
        if (!$_POST) die ('Error'); //Пустые данные


        if (!isset ($_POST['action'])) {
            die ('Error: Не переданы параметры');
        }

        //Получаем ид магазина
        $shop_id = $this->_ShopId;        

        //Получаем номер счёта
        $order_id = $_POST['customerNumber'];
        
        $bill_id = intval ($order_id); //Тот же номер счёта, но как число - для зачисления оплаты

        //Внутренний номер инвойса
        $invoice_id = $_POST['invoiceId'];

        //Дата в специальном формате
        $performedDatetime = date ('c');        


        //Код для случая - проверка платежа ДО оплаты, всегда возвращаем успешно
        if ($_POST['action'] == 'checkOrder')
        {


        	print '<?xml version="1.0" encoding="UTF-8"?> 
            <checkOrderResponse performedDatetime="'.$performedDatetime.'" code="0" invoiceId="'.$invoice_id.'"	shopId="'.$shop_id.'"/>';

            die ();


            //Другой код - AVISO URL - проверка статуса платежа и зачисление

        } elseif ($_POST['action'] == 'paymentAviso') {

            $str =	$_POST['action'].';'.$_POST['orderSumAmount'].';'.
                    $_POST['orderSumCurrencyPaycash'].';'.$_POST['orderSumBankPaycash'].';'.
                    $shop_id . ';' . $invoice_id.';'.
                    $_POST['customerNumber'].';'.$this->_ShopPassword;

            $md5 = strtoupper(md5($str));
                        

            if($md5 == $_POST['md5']) { //Проверка хэша

                $sum = floatval ($_POST['orderSumAmount']); //Сумма по факту для зачисления
                $way = 'ЮMoney';
                $type = 'rur'; //Валюта - рубли

                Bill::payBill($bill_id, $way, $sum, $type, 'ЮKassa'); //Yandex.Kassa

                //Ответ в браузер
	            print '<?xml version="1.0" encoding="UTF-8"?>
                <paymentAvisoResponse performedDatetime="'.$performedDatetime.'" code="0" invoiceId="'.$invoice_id.'" shopId="'.$shop_id.'"/>';

                die ();

            } else {
                die ('Error: Неверная контрольная сумма');
            }


        } else {
            die ('Error: bad action');
        }


    }

    public function actionOk ()
    {
        $this->redirect (Y::bu().'f/ok/w/yandexkassa');
    }

    public function actionFail ()
    {
        $this->redirect (Y::bu().'f/fail/w/yandexkassa');
    }

    public function actionTest ()
    {
        die ('Test OK');
    }

    private function convertToUTF8($str) {
        $enc = mb_detect_encoding($str);

        if ($enc && $enc != 'UTF-8') {
            return iconv($enc, 'UTF-8', $str);
        } else {
            return $str;
        }
    }

    private function jsonEncode ($json)
    {
        $encoded = json_encode($json);
        $unescaped = preg_replace_callback('/\\\\u(\w{4})/', function ($matches) {
            return html_entity_decode('&#x' . $matches[1] . ';', ENT_COMPAT, 'UTF-8');
        }, $encoded);        

        return $unescaped;
    }

}
