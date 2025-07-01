<?php

class InterkassaController extends Controller
{
    
    //Оповещение от платёжной системы Интеркасса
    public function actionIndex ()
    {
		
        if (!Settings::item ('payInterkassaOn')) {
			die ('Error: способ отключен');			
	}
		
	extract ($_POST,EXTR_SKIP);        
        
	    $interkassaid = Settings::item('payInterkassaId');
	    
	    $interkassakey = Settings::item('payInterkassaKey');
            
            
            if (isset ($ik_sign)) {
                
                //Формируем хэш
                
                
                
                $ss = $_POST;
                unset ($ss['ik_sign']);                
                
                ksort ($ss, SORT_STRING);
                array_push ($ss,$interkassakey);
                $signstr = implode (':',$ss);                
                $str = base64_encode (md5 ($signstr,true));
                		
                $crc = $ik_sign;	    
                
                

            if ($crc===$str)
                {
                    if ($ik_inv_st == 'success') {
        	    	$bill_id = $ik_pm_no;
                	$sum = $ik_am;
	    	
                	$way = 'Интеркасса';
	    	
                        Bill::payBill($bill_id,$way,$sum,'rur');
                    }
                }
                else {
                    die ('Error: Неверная контрольная сумма');
                }
                
                
                
            }
            
            
		
		if (empty ($ik_sign_hash)) {
			die ('Error: Не переданы параметры');
		}
		
	    	$str = "$interkassaid:$ik_payment_amount:$ik_payment_id:$ik_paysystem_alias:$ik_baggage_fields";
    		$str .= ":success:$ik_trans_id:$ik_currency_exch:$ik_fees_payer:$interkassakey";			
		
	    $crc = strtolower ($ik_sign_hash);	    

        if ($crc===md5 ($str))
	    {
	    	$bill_id = $ik_payment_id;
	    	$sum = $ik_payment_amount;
	    	
	    	$way = 'Интеркасса';
	    	
                Bill::payBill($bill_id,$way,$sum,'rur');
            }
            else {
                    die ('Error: Неверная контрольная сумма');
            }
        
        
    }
    
    public function actionOk ()
    {
        $this->redirect (Y::bu().'f/ok/w/interkassa');
    }
    
    public function actionFail () 
    {
        $this->redirect (Y::bu().'f/fail/w/interkassa');
    }
    
    
}
