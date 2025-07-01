<?php

class ZpaymentController extends Controller
{
    
    //Оповещение от платёжной системы ZPayment
    public function actionIndex ()
    {
		
        if (!Settings::item ('payZpaymentOn')) {
			die ('Error: способ отключен');			
	}
		
	extract ($_POST,EXTR_SKIP);
        
        
        
	$zpayid = Settings::item ('payZpaymentId');
	   
	$zpkey = Settings::item ('payZpaymentKey');	    
		
		
		if (empty ($LMI_HASH)) {
			die ('Error: Не переданы параметры');
		}
		
		
    	$str = "{$zpayid}{$LMI_PAYMENT_AMOUNT}{$LMI_PAYMENT_NO}0{$LMI_SYS_INVS_NO}".
        	   "{$LMI_SYS_TRANS_NO}{$LMI_SYS_TRANS_DATE}{$zpkey}{$LMI_PAYER_PURSE}{$LMI_PAYER_WM}";
		
	    $LMI_HASH = strtolower ($LMI_HASH);

	    if ($LMI_HASH===md5 ($str))
	    {
	    	$bill_id = $LMI_PAYMENT_NO;
	    	$sum = $LMI_PAYMENT_AMOUNT;
	    	
	    	$way = 'Z-Payment';
	    	
                Bill::payBill ($bill_id,$way,$sum,'rur', $LMI_PAYER_PURSE);
	    }
		else {
			die ('Error: Неверная контрольная сумма');
		}
    }
    
    public function actionOk ()
    {
        $this->redirect (Y::bu().'f/ok/w/zpayment');
    }
    
    public function actionFail () 
    {
        $this->redirect (Y::bu().'f/fail/w/zpayment');
    }
    
    
}
