<?php

class OnpayController extends Controller
{
    
    //Оповещение от платёжной системы OnPay.ru
    public function actionIndex ()
    {
		
        if (!Settings::item ('payOnpayOn')) {
			die ('Error: способ отключен');			
	}

    if (empty($_POST)) {
        die ('Error: Не переданы параметры');
    }

	extract ($_POST,EXTR_SKIP);
        
        //var_dump($_POST);
        
	    $onpayid = Settings::item('payOnpayId');
	    
	    $onpaykey = Settings::item('payOnpayKey');
        
        //Формируем хэш
        $ss = $_POST;
        ksort ($ss, SORT_STRING);
        array_push ($ss,$onpaykey);
        $signstr = implode (':',$ss);                

    	$bill_id = $ik_pm_no;
    	$sum = $ik_am;

    	$way = 'Onpay';
        Bill::payBill($bill_id,$way,$sum,'rur');
        // die ('Error: Неверная контрольная сумма');

    }
    
    public function actionOk ()
    {
        $this->redirect (Y::bu().'f/ok/w/onpay');
    }
    
    public function actionFail () 
    {
        $this->redirect (Y::bu().'f/fail/w/onpay');
    }
    
    
}
