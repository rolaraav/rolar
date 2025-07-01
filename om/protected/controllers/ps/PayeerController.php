<?php

/**
 * Модуль Payeer для Order Master 2 - http://payeer.com/
 * Поместить необходимо в папку om2/protected/controllers/ps/PayeerController.php
 * 
 * Разработка: www.ordermaster.ru
 * 
 * Используемые URL-для настройки - есть на скриншоте - https://image.prntscr.com/image/4pztm-o2RM_BCL8tK_RipA.png
 * 
 * URL успешной оплаты: http://вашдомен.ру/om2/ps/payeer/success
 * 
 * URL неуспешной оплаты: http://вашдомен.ру/om2/ps/payeer/fail
 * 
 * URL обработчика: http://вашдомен.ру/om2/ps/payeer/status
 *  
 **/

class PayeerController extends Controller
{
    /**
     * Здесь нужно указать ID мерчанта (магазина) из раздела Настройки мерчанта - поставьте вместо 111
     **/
    public $shopId = '111';
    
    
    /**
     * Сюда нужно вписать секретный ключ Payeer - поставьте вместо здесь_сам_ключ
     */
    public $secretKey = 'здесь_сам_ключ';
    
    
    /**
     * Желаемая валюта. По умолчанию - RUB (рубли)
     * Ещё можно указать либо USD, либо EUR
     */
     public $valuta = 'RUB';
     
     /**
      * Это значение определяет способ оплаты по умолчанию
      * Можно оставить равным 0 - и пользователь будет сам выбирать
      * Можно вписать значение - к примеру 2609 для Payeer-кошелька и дрю.
      * Сами значения можно посмотреть в разделе "Платёжные методы" - примерно так - https://prnt.sc/fl5ya8
      * Если неважно - не меняйте это значение
      * 
      **/
    public $defaultMethod = '0';
    
    /**
     * Если задано предыдущее значение - то можно задать валюту способа по умолчанию, аналогично - RUB, USD или EUR
     * Не будет использоваться, если в $defaultMethod - стоит значение 0
     **/
    public $defaultMethodValuta = 'RUB';
    
    
    /**
     * Ниже этого блока ничего менять не следует - там находится основной код
     */       
    
    public function actionIndex ()
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
        
        //Формируем необходимые данные и контрольные суммы
        $fdata = array ();
        
        
        //Ид магазина
        $fdata['m_shop'] = Settings::item('payPayeerId'); // $this->shopId;
        
        //Номер счёта
        $fdata['m_orderid'] = $b->id;
        
        $ceny = Valuta::conv($b->sum, $b->valuta, $b->usdkurs, $b->eurkurs, $b->uahkurs);        
        
        //Сумма и валюта
        $fdata['m_amount'] = number_format($ceny[strtolower(str_replace ('RUB','RUR',$this->valuta))],  2, '.', '');
        $fdata['m_curr'] = strtoupper ($this->valuta);        
        
        if ($this->defaultMethod)
        {
            $fdata['form[ps]'] = $this->defaultMethod;
            $fdata['form[curr['.$this->defaultMethod.']]'] = $this->defaultMethodValuta; //Валюта для выбранного способа по умолчанию
        } 
        
        $fdata['m_desc'] = base64_encode ('Oplata scheta #'.$b->id); //Здесь описание платежа - может быть изменено
        
        $arHash = array (        
                $fdata['m_shop'],
                $fdata['m_orderid'],
                $fdata['m_amount'],
                $fdata['m_curr'],
                $fdata['m_desc'],
        );
        
        $arHash[] = Settings::item('payPayeerKey'); // $this->secretKey; //Добавляем секретный ключ
        
        $fdata['m_sign'] = strtoupper(hash('sha256',implode(":",$arHash))); //Контрольная подпись        
        
        //Вывод формы платежа с авторедиректом
        $out = '<form method="post" action="https://payeer.com/merchant/" id="payeerform">' . "\r\n";
        
        foreach ($fdata as $key=>$value)
        {
            $out .= '<input type="hidden" name="'.$key.'" value="'.$value.'">' . "\r\n";
        }
        
        $out .= '<form>';
        
        $out .= '<script type="text/javascript">
            document.getElementById("payeerform").submit();
        </script>
        ';
        
        echo $out;              
                
    }
    
    public function actionStatus ()
    {
        if (!$_POST) die ('Error');
        
        if (isset($_POST['m_operation_id']) &&   isset($_POST['m_sign'])) {
            
            $m_key = Settings::item('payPayeerKey'); // $this->secretKey;
            
            // Формируем   массив для   генерации подписи
            
            $arHash = array(
                $_POST['m_operation_id'],
                $_POST['m_operation_ps'],
                $_POST['m_operation_date'],
                $_POST['m_operation_pay_date'],
                $_POST['m_shop'],
                $_POST['m_orderid'],
                $_POST['m_amount'],
                $_POST['m_curr'],
                $_POST['m_desc'],
                $_POST['m_status']
            );
    
            // Добавляем в   массив секретный ключ
            $arHash[] = $m_key;
      
            // Формируем   подпись
            $sign_hash = strtoupper(hash('sha256',implode(':', $arHash)));
            
            //   Если   подписи совпадают  и   статус   платежа   “Выполнен”
            if   ($_POST['m_sign'] == $sign_hash  && $_POST['m_status'] == 'success') {
                
                $bill_id = (int) $_POST['m_orderid']; //Счёт
                $way = 'Payeer';
                $sum = (float) $_POST['m_amount'];
                $type = strtolower(str_replace ('RUB','RUR', $this->valuta));
                    
                //   Здесь  можно   пометить   счет   как   оплаченный
                Bill::payBill($bill_id,$way,$sum,$type);	    	
                 
                //   Возвращаем, что   платеж   был   успешно обработан 
                exit($_POST['m_orderid'].'|success');
            }
                 
            //   В   противном случае возвращаем ошибку
            
            exit($_POST['m_orderid'].'|error');
        
        }
        
    }
    
    //Это действие отвечает за страничку успешной оплаты
    public function actionSuccess ()
    {
        $this->redirect (Y::bu().'f/ok/w/payeer');                
    }
    
    //Это действие отвечает за страничку неуспешной оплаты
    public function actionFail ()
    {
        $this->redirect (Y::bu().'f/fail/w/payeer');
    }
}