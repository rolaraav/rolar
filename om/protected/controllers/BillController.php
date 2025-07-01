<?php

class BillController extends Controller
{
	public function actionConfirm()
	{
		$this->render('confirm');
	}

	public function actionIndex()
	{
      
            if ((!isset ($_GET['bill_id'])) OR (!isset ($_GET['hash'])))   {
                die ('Не передан номер счёта или CRC!');
            }
            $bill_id = $_GET['bill_id'];
            $hash = $_GET['hash'];
            
            if (!is_numeric ($bill_id)) die ('Счёт должен быть числом');
            
            //Проверяем хэш
            if ($hash!==Bill::hashBill($bill_id)) {
                die ('Неверная контрольная сумма!');
            }

            //{START}
            //Ищем счёт
            $bill = Bill::model()->findByPk ($bill_id);

            if (!$bill) {
                throw new CHttpException(404, 'Счёт с номером '.$bill_id.' не найден в базе');
            }
            
            //{KG}
            
            //Проверяем статус
            if ($bill->status_id!='waiting') {
                throw new CHttpException(404, 'Форма оплаты счёта №'.$bill_id.' не может быть отображена, так как он или уже был оплачен ранее или же находится в процессе обработки');
            }
            
            $good = $bill->orders[0]->good;
            
            //Получаем список всех способов
            $ways = Way::model()->findAll ();
            
            //{END}
            
            
            //Преобразовываем список
            $nways = array ();
            foreach ($ways as $ws) {
                $nways[$ws->way_id] = $ws;
            }
            $ways = $nways;
            
            //Список всех вариантов
            $wlist = WayList::model ()->findAllbySQL ('SELECT * FROM {{way_list}} ORDER BY position ASC');
            
            //Создаём дополнительный список отключённых способов
            $bb = array ();
            if (Settings::item('payWebmoneyOn')!=1) { $bb[]='wmz'; $bb[]='wmr'; $bb[]='wmp'; $bb[]='wme'; $bb[]='wmu'; }
            if (Settings::item('payRbkmoneyOn')!=1) $bb[]='rbkmoney';
            if (Settings::item('payRoboxOn')!=1) $bb[]='robox';
            if (Settings::item('payZpaymentOn')!=1) $bb[]='zpay';
            if (Settings::item('pay2checkoutOn')!=1) $bb[]='checkout';
            if (Settings::item('paySmsOn')!=1) $bb[]='sms';
            if (Settings::item('payInterkassaOn')!=1) $bb[]='interkassa';
            if (Settings::item('paySprypayOn')!=1) $bb[]='sprypay';
            if (Settings::item('payLiqpayOn')!=1) $bb[]='liqpay';
            if (Settings::item('payPayeerOn')!=1) $bb[]='payeer';
            if (Settings::item('payOnpayOn')!=1) $bb[]='onpay';
            if (Settings::item('payPosOn')!=1) $bb[]='pos';
            if (Settings::item('payW1On')!=1) $bb[]='w1';
            if (Settings::item('payYandexOn')!=1) { $bb[]='yandex'; $bb[]='yandex_online'; }
            if (Settings::item('payYandexkassaOn')!=1) $bb[]='yandexkassa';
            if (Settings::item('payPaypalOn')!=1) $bb[]='paypal_online';
            if (Settings::item('payQiwiOn')!=1) $bb[]='qiwi_online';
            if (Settings::item('payW1On')!=1) $bb[]='w1_online';
            
            $bb = implode (',',$bb);
            
            if (!empty ($bb)) {
                if (!empty ($good->disabledWays)) {
                    $good->disabledWays.= ','.$bb;
                } else {
                    $good->disabledWays = $bb;
                }
            }
            
            
                
            //Запрещённые способы - вычищаем
            if (!empty ($good->disabledWays)) {
                
                $dis = explode (',',$good->disabledWays);
                    
                    foreach ($ways as $kk=>$ww) {
                        if (in_array ($ww->way_id,$dis)) {
                            unset($ways[$kk]);
                        }
                    }
                    
                    //Удаляем из wlist
                    foreach ($wlist as $kk=>$ww) {
                        $dd = explode (',',$ww->ways);
                        foreach ($dd as $dk=>$dw) {
                            if (in_array ($dw,$dis)) {
                                unset ($dd[$dk]);
                            }
                            $wlist[$kk]->ways = implode (',',$dd);
                            if (empty ($dd)) {
                                unset($wlist[$kk]);
                            }
                        }
                    }
                    
          }
          
          //Делаем массив способов
          $nwlist = array ();
          
          foreach ($wlist as $wl) {
              $wl->ways = explode (',',$wl->ways);
              $nwlist[$wl->category][] = $wl;
          }
          
          $ceny = Valuta::conv($bill->sum, $bill->valuta, $bill->usdkurs, $bill->eurkurs, $bill->uahkurs);
          
          //Подготовка данных для платёжных систем
          $vv = array ();
          $vv['bu'] = Y::bu();
          $vv['rur'] = $ceny['rur'];

          $vv['qrur'] = floor ($ceny['rur']);
          $vv['qkop'] = ceil(($ceny['rur']-$vv['qrur'])*100);

	  setcookie ('qiwibill',$bill->id);


          $vv['usd'] = $ceny['usd'];
          $vv['uah'] = $ceny['uah'];
          $vv['eur'] = $ceny['eur'];
          $vv['bill_id'] = $bill->id;
          $vv['email'] = $bill->email;
          $vv['uname'] = $bill->uname;
          $vv['date'] = date('j.m.Y');

          $vv['notify_link'] = Y::bu().'notify/index/b/'.$bill->id.'/c/'.Bill::notifyCrc ($bill->id);
          $vv['status_link'] = Bill::statusLink ($bill->id);

          //WM
          $vv['wmz'] = Settings::item ('payWmz');
          $vv['wmr'] = Settings::item ('payWmr');
          $vv['wmp'] = Settings::item ('payWmp');
          $vv['wme'] = Settings::item ('payWme');
          $vv['wmu'] = Settings::item ('payWmu');

          //Rbk
          $vv['rbkmoney_id'] = Settings::item ('payRbkmoneyId');

          //Zpay
          $vv['zpay_id'] = Settings::item ('payZpaymentId');

          //Robox
          $vv['robox_login'] = Settings::item ('payRoboxLogin');
          $vv['robox_id'] = $vv['bill_id'] + 100000;		

          //2Checkout
          $vv['checkout_id'] = Settings::item ('pay2checkoutId');
          $vv['checkout_num'] = $vv['bill_id'] + 1000;

          //Интеркасса
          $vv['interkassa_id'] = Settings::item ('payInterkassaId');

          //Payeer
          $vv['payeer_id'] = Settings::item ('payPayeerId');

          //OnPay
          $vv['onpay_id'] = Settings::item ('payOnpayId');

          //SMS Coin
          $vv['sms_id'] = Settings::item ('paySmsId');
          $vv['sms_url'] = Settings::item ('paySmsUrl');
          $vv['sms_cost'] = Settings::item ('paySmsCost');
          
          $vv['sms_crc'] = md5($vv['sms_id'].'::'.$vv['bill_id'].'::'.$vv['usd'].'::'.$vv['sms_cost'].'::Oplata scheta::'.Settings::item ('paySmsKey'));
          
          if (Settings::item ('payRoboxOn')) {
              
              //Если включена робокасса
              $vv['robox_sum'] = (Settings::item('payRoboxValuta')=='rur')?$ceny['rur']:$ceny['usd'];
              $vv['robox_crc'] = md5($vv['robox_login'].':'.$vv['robox_sum'].':'.$vv['robox_id'].':'.Settings::item('payRoboxPass1'));
              
          }

        //Яндекс:
        $vv['yandex_account'] = Settings::item ('payYandexAccount');
        $vv['success_url_encoded'] = urlencode (Y::bu().'f/ok');

        //PayPal
        $vv['paypal_email'] = Settings::item ('payPaypalEmail');

        //Qiwi:
        $vv['qiwi_link'] = Y::bu().'ps/qiwi/index/b/'.$bill->id.'/c/'.Bill::notifyCrc ($bill->id);

        //w1
        $vv['w1_merchant'] = Settings::item ('payW1Id');
        $vv['w1_form'] = $this->_w1form($ceny['rur'],$bill->id);


        //Payeer:
        $m_amount = number_format($vv['rur'], 2, '.', '');
        $m_curr = 'RUB';
        $vv['payeer_desc'] = base64_encode('Paybill #'.$vv['bill_id']);
        $m_key = Settings::item ('payPayeerKey');

        $arHash = array(
          $vv['payeer_id'],
          $vv['bill_id'],
          $m_amount,
          $m_curr,
          $vv['payeer_desc'],
          $m_key
        );
        $vv['payeer_crc'] = strtoupper(hash('sha256', implode(':', $arHash)));

        //OnPay:
        $o_pay_mode = 'fix';
        $o_price = number_format($vv['rur'], 1, '.', '');
        $o_ticker = 'RUR';
        $o_pay_for = $vv['bill_id'];
        $o_convert = 'yes';
        $o_secret_key = Settings::item ('payOnpayKey');

        $o_arHash = array(
          $o_pay_mode,
          $o_price,
          $o_ticker,
          $o_pay_for,
          $o_convert,
          $o_secret_key
        );
        $vv['onpay_crc'] = md5(implode(';', $o_arHash));

          //LiqPay:
          
          $lxml='<request>      
		<version>1.2</version>
		<result_url>'.Y::bu().'ps/liqpay/ok</result_url>
		<server_url>'.Y::bu().'ps/liqpay</server_url>
		<merchant_id>'.Settings::item('payLiqpayId').'</merchant_id>
		<order_id>'.$vv['bill_id'].'</order_id>
		<amount>'.$vv['usd'].'</amount>
		<currency>USD</currency>
		<description>Paybill #'.$vv['bill_id'].'</description>
		<default_phone>'.Settings::item('payLiqpayPhone').'</default_phone>
		<pay_way></pay_way> 
		</request>';
          $vv['liqpay_xml'] = base64_encode($lxml); 
          $signature = Settings::item ('payLiqpayKey');
          $vv['liqpay_crc'] = base64_encode(sha1($signature.$lxml.$signature,1));
          
          //SpryPay
          $vv['spry_id'] = Settings::item ('paySprypayId');
            
          
            
            //Проверяем страну для наложенного
            if (!empty ($bill->strana)) {
                $clist = explode (',',Settings::item ('nalozhCountries'));
                if (!in_array ($bill->strana,$clist)) {
                    $good->nalozhOn = FALSE;
                }
            }
            
            //Проверяем страну для курьерской доставки
            if ($good->kurier) {
                
                if (!empty ($bill->strana) && (!empty ($good->kurstrany))) {
                    $clist = explode (',',$good->kurstrany);
                    if (!in_array ($bill->strana,$clist)) {
                        $good->kurier = FALSE;
                    }
                }            
                
                if (!empty ($bill->gorod) && (!empty ($good->kurgorod))) {
                    $clist = explode (',',$good->kurgorod);
                    if (!in_array ($bill->gorod,$clist)) {
                        $good->kurier = FALSE;
                    }
                }            
                
                
            }
            
            //На всякий случай
            if ($good->kind!='disk') $good->nalozhOn = FALSE;
            if ($good->kind!='disk') $good->kurier = FALSE;
            
            $stlink = Y::bu().'status/index/b/'.$bill->id.'/c/'.Bill::statusCrc ($bill->id);

            $this->render('index', array (
                'model' => $bill,
                'good' => $good,
                'wlist' => $nwlist,
                'fw' => Settings::item('firstWay'),
                'ways' => $ways,
                'values' => $vv,
                'stlink' => $stlink,
                'nalozhLink' => Y::bu().'nl/index/b/'.$bill->id.'/c/'.Bill::nalozhCrc($bill->id),
            ));
            
            
	}

    public function actionCancel ()
    {

        if ((!isset ($_GET['bill_id'])) OR (!isset ($_GET['hash'])))   {
            die ('Не передан номер счёта или CRC!');
        }
        $bill_id = $_GET['bill_id'];
        $hash = $_GET['hash'];

        if (!is_numeric ($bill_id)) die ('Счёт должен быть числом');

        //Проверяем хэш
        if ($hash!==Bill::hashBill($bill_id)) {
            die ('Неверная контрольная сумма!');
        }

        //{START}
        //Ищем счёт
        $bill = Bill::model()->findByPk ($bill_id);

        if (!$bill) {
            throw new CHttpException(404, 'Счёт с номером '.$bill_id.' не найден в базе');
        }

        //{KG}

        if ($bill->status_id=='cancelled') {
            throw new CHttpException(403, 'Счёт №'.$bill_id.' уже отменён, нет необходимости его отменять повторно');
        }


        //Проверяем статус
        if ($bill->status_id!='waiting') {
            throw new CHttpException(403, 'Счёт №'.$bill_id.' не может быть отменён, так как он или уже был оплачен ранее или же находится в процессе обработки');
        }

        $bill->status_id = 'cancelled';
        $bill->save (false,array('status_id'));
        die ('<center><h3>Счёт №'.$bill_id.' теперь отменён</h3><center>');

    }

    public function _w1form ($sum, $bill_id)
    {

        if (Settings::item('payW1On')!=1) return '';

        $mid = Settings::item('payW1Id');
        $key = Settings::item('payW1Key');

        $fields = array();

        // Добавление полей формы в ассоциативный массив
        $fields["WMI_MERCHANT_ID"]    = $mid;
        $fields["WMI_PAYMENT_AMOUNT"] = "$sum";
        $fields["WMI_CURRENCY_ID"]    = "643";
        $fields["WMI_PAYMENT_NO"]     = "$bill_id";
        $fields["WMI_DESCRIPTION"]    = "BASE64:".base64_encode("Oplata scheta #$bill_id");
        $fields["WMI_SUCCESS_URL"]    = Y::bu().'f/ok';
        $fields["WMI_FAIL_URL"]       = Y::bu().'f/fail';

        //Сортировка значений внутри полей
        foreach($fields as $name => $val)
        {
            if (is_array($val))
            {
                usort($val, "strcasecmp");
                $fields[$name] = $val;
            }
        }

        // Формирование сообщения, путем объединения значений формы,
        // отсортированных по именам ключей в порядке возрастания.
        uksort($fields, "strcasecmp");
        $fieldValues = "";

        foreach($fields as $value)
        {
            if (is_array($value))
                foreach($value as $v)
                {
                    //Конвертация из текущей кодировки (UTF-8)
                    //необходима только если кодировка магазина отлична от Windows-1251
                    $v = iconv("utf-8", "windows-1251", $v);
                    $fieldValues .= $v;
                }
            else
            {
                //Конвертация из текущей кодировки (UTF-8)
                //необходима только если кодировка магазина отлична от Windows-1251
                $value = iconv("utf-8", "windows-1251", $value);
                $fieldValues .= $value;
            }
        }

        // Формирование значения параметра WMI_SIGNATURE, путем
        // вычисления отпечатка, сформированного выше сообщения,
        // по алгоритму MD5 и представление его в Base64

        $signature = base64_encode(pack("H*", md5($fieldValues . $key)));

        //Добавление параметра WMI_SIGNATURE в словарь параметров формы

        $fields["WMI_SIGNATURE"] = $signature;

        // Формирование HTML-кода платежной формы
        $out = "";

          foreach($fields as $key => $val)
          {
              if (is_array($val))
                  foreach($val as $value)
                  {
                      $out .= '<input type="hidden" name="'.$key.'" value="'.$value.'"/>
        ';
                 }
              else
                  $out .= '<input type="hidden" name="'.$key.'" value="'.$val.'"/>
        ';
          }

        return $out;
    }


}