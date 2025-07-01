<?php

class WebmoneyController extends Controller
{
    
    //Оповещение от платёжной системы WebMoney
    public function actionIndex ()
    {
		
        if (!Settings::item ('payWebmoneyOn')) {
			die ('Error: способ отключен');			
	}
		
	extract ($_POST,EXTR_SKIP);
	
	$zpurse = Settings::item ('payWmz');
	//$rpurse = Settings::item ('payWmr');
	$rpurse = Settings::item ('payWmp');
  $epurse = Settings::item ('payWme');
  $upurse = Settings::item ('payWmu');
	$testMode = 0; //Тестовый режим выключен
	    
	$wmkey = Settings::item ('payWebmoneyKey');
		
		
		if (empty ($LMI_HASH)) {
			die ('Error: Не переданы параметры');
		}
		
                $type = 'usd';
                
		if (strpos (strtoupper ($LMI_PAYEE_PURSE),'R')!==false) {			
			$type = 'rur';			
		} elseif (strpos (strtoupper ($LMI_PAYEE_PURSE),'U')!==false) {
                    
                        $type = 'uah';
                    
                } elseif (strpos (strtoupper ($LMI_PAYEE_PURSE),'E')!==false) {
			$type = 'eur';
		}
		
		if ($type == 'usd') {

                    $str = "{$zpurse}{$LMI_PAYMENT_AMOUNT}{$LMI_PAYMENT_NO}{$testMode}{$LMI_SYS_INVS_NO}";
                    $str .="{$LMI_SYS_TRANS_NO}{$LMI_SYS_TRANS_DATE}{$wmkey}{$LMI_PAYER_PURSE}{$LMI_PAYER_WM}";
			
		}
		elseif ($type == 'uah') { 
			
                    $str = "{$upurse}{$LMI_PAYMENT_AMOUNT}{$LMI_PAYMENT_NO}{$testMode}{$LMI_SYS_INVS_NO}";
                    $str .="{$LMI_SYS_TRANS_NO}{$LMI_SYS_TRANS_DATE}{$wmkey}{$LMI_PAYER_PURSE}{$LMI_PAYER_WM}";

		}
		elseif ($type == 'eur') { 
			
                    $str = "{$epurse}{$LMI_PAYMENT_AMOUNT}{$LMI_PAYMENT_NO}{$testMode}{$LMI_SYS_INVS_NO}";
                    $str .="{$LMI_SYS_TRANS_NO}{$LMI_SYS_TRANS_DATE}{$wmkey}{$LMI_PAYER_PURSE}{$LMI_PAYER_WM}";
                    
		} else {
                    
                    $str = "{$rpurse}{$LMI_PAYMENT_AMOUNT}{$LMI_PAYMENT_NO}{$testMode}{$LMI_SYS_INVS_NO}";
                    $str .="{$LMI_SYS_TRANS_NO}{$LMI_SYS_TRANS_DATE}{$wmkey}{$LMI_PAYER_PURSE}{$LMI_PAYER_WM}";
                    
                }
		
	    $LMI_HASH = strtolower ($LMI_HASH);

	    if (($LMI_HASH===md5 ($str)) OR ($LMI_HASH===hash('sha256', ($str))))
	    {
	    	$bill_id = $LMI_PAYMENT_NO;
	    	$sum = $LMI_PAYMENT_AMOUNT;
	    	
	    	switch ($type) {
                    case 'usd':
                       $way = 'WebMoney Z';
                    break;
                    case 'uah':
                       $way = 'WebMoney U';
                    break;
                    case 'eur':
                       $way = 'WebMoney E';
                    break;
                    default:
                       $way = 'WebMoney P';
                
                }
	    	
                Bill::payBill($bill_id,$way,$sum,$type,$LMI_PAYER_PURSE);	    	
	    }
            else {
                die ('Error: Неверная контрольная сумма');
            }
        
    }
    
    public function actionOk ()
    {
        $this->redirect (Y::bu().'f/ok/w/webmoney');
    }
    
    public function actionFail () 
    {
        $this->redirect (Y::bu().'f/fail/w/webmoney');
    }
    
    
}
