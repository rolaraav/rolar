<?php

class RoboxController extends Controller
{
    
    //Оповещение от платёжной системы Robox
    public function actionIndex ()
    {
		
        if (!Settings::item ('payRoboxOn')) {
            die ('Error: способ отключен');			
	}
		
	extract ($_POST,EXTR_SKIP);
	
        $roboxpass2 = Settings::item ('payRoboxPass2');
	    
		
		if (empty ($crc)) {
			die ('Error: Не переданы параметры');
		}
		
	    	$str = "$out_summ:$inv_id:$roboxpass2";
			
        if (!is_numeric ($inv_id)) {
            die ('Bad number');                                    
        }						
		
	    $crc = strtolower ($crc);

            if ($crc===md5 ($str))
	    {
	    	$bill_id = $inv_id-100000;
	    	$sum = $out_summ;
	    	
	    	$way = 'РобоКасса';
	    	
                Bill::payBill($bill_id,$way,$sum,Settings::item('payRoboxValuta'));
            
			die ("OK$inv_id\n");	    	
	    }
		else {
			die ('Error: Неверная контрольная сумма');
		}        
        
    }
    
    public function actionOk ()
    {
        $this->redirect (Y::bu().'f/ok/w/robox');
    }
    
    public function actionFail () 
    {
        $this->redirect (Y::bu().'f/fail/w/robox');
    }
    
    
}
