<?php

class RbkmoneyController extends Controller
{
    
    //Оповещение от платёжной системы RBKMoney
    public function actionIndex ()
    {
		
        if (!Settings::item ('payRbkmoneyOn')) {
			die ('Error: способ отключен');			
	}
		
	extract ($_POST,EXTR_SKIP);
        
        $rbkmoneyid = Settings::item ('payRbkmoneyId');

        $rbkmoneykey = Settings::item ('payRbkmoneyKey');

            if (empty ($hash)) {
                    die ('Error: Не переданы параметры');
            }

            $str = "$rbkmoneyid::$orderId::$serviceName::$eshopAccount::$recipientAmount";
            $str .= "::RUR::5::$userName::$userEmail::$paymentData::$rbkmoneykey";			

        $crc = strtolower ($hash);

        if ($crc===md5 ($str))
	    {
	    	$bill_id = $orderId;
	    	$sum = $recipientAmount;
	    	
	    	$way = 'RBKMoney';
	    	
                    Bill::payBill ($bill_id,$way,$sum,'rur');
			
			header("http/1.0 200 Ok");
			echo 'OK';
				    	
	    }
		else {
			die ('Error: Неверная контрольная сумма');
		}
        
    }
    
    public function actionOk ()
    {
        $this->redirect (Y::bu().'f/ok/w/rbkmoney');
    }
    
    public function actionFail () 
    {
        $this->redirect (Y::bu().'f/fail/w/rbkmoney');
    }
    
    
}
