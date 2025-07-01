<?php

class SprypayController extends Controller
{
    
    //Оповещение от платёжной системы SpryPay
    public function actionIndex ()
    {
		
        if (!Settings::item ('paySprypayOn')) {
			die ('Error: способ отключен');			
	}        	
		
	extract ($_POST,EXTR_SKIP);
        
        $sid = Settings::item ('paySprypayId');

        $skey = Settings::item ('paySprypayKey');
        

        if (empty ($spHashString)) {
              die ('Error: Не переданы параметры');
        }

        $str = $spPaymentId.$spShopId.$spShopPaymentId.$spBalanceAmount.$spAmount.$spCurrency.$spCustomerEmail.$spPurpose.$spPaymentSystemId.$spPaymentSystemAmount.$spPaymentSystemPaymentId.$spEnrollDateTime.$skey;


        $crc = strtolower ($spHashString);
        //
        //Bill::err ($bill_id,var_export($_POST));

        if ($crc===md5 ($str))
	{
	    	$bill_id = $spShopPaymentId;
	    	$sum = $spAmount;
	    	
	    	$way = 'SpryPay';
	    	
                    Bill::payBill ($bill_id,$way,$sum,strtolower ($spCurrency));
			
			header("http/1.0 200 Ok");
			echo 'ok';
				    	
	}
	else {
            die ('Error: Неверная контрольная сумма');
	}
        
    }
    
    public function actionOk ()
    {
        $this->redirect (Y::bu().'f/ok/w/sprypay');
    }
    
    public function actionFail () 
    {
        $this->redirect (Y::bu().'f/fail/w/sprypay');
    }
    
    
}
