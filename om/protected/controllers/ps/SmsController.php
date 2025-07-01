<?php

class SmsController extends Controller
{
    
    //Оповещение от платёжной системы SmsCoin
    public function actionIndex ()
    {
		
        if (!Settings::item ('paySmsOn')) {
			die ('Error: способ отключен');			
	}
		
	extract ($_POST,EXTR_SKIP);

	    $smsid = Settings::item('paySmsId');
	    
	    $smskey = Settings::item('paySmsKey');
		
		if (empty ($s_sign_v2)) {
			die ('Error: Не переданы параметры');
		}
		
	    $str = "$smskey::$smsid::$s_order_id::$s_amount::$s_clear_amount::$s_inv::$s_phone";
				
	    $crc = strtolower ($s_sign_v2);

        if ($crc===md5 ($str))
	    {
	    	$bill_id = $s_order_id;
	    	$sum = $s_amount;
	    	
	    	$way = 'SMSCoin';
	    	
                Bill::payBill($bill_id,$way,$sum,'usd', $s_phone);	    	
	    }
		else {
			die ('Error: Неверная контрольная сумма');
		}
        
        
    }
    
    public function actionOk ()
    {
        $this->redirect (Y::bu().'f/ok/w/sms');
    }
    
    public function actionFail () 
    {
        $this->redirect (Y::bu().'f/fail/w/sms');
    }
    
    
}
