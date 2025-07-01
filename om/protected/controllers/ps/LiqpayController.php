<?php

class LiqpayController extends Controller
{
    
    //Оповещение от платёжной системы Liqpay
    public function actionIndex ()
    {
		
        if (!Settings::item ('payLiqpayOn')) {
			die ('Error: способ отключен');			
	}

        $sign = Settings::item ('payLiqpayKey');
        
        $xml = base64_decode($_POST['operation_xml']);
        $signature = base64_encode(sha1($sign.$xml.$sign, 1));

        if($_POST['signature']==$signature) {
    
            $xml_arr = simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA);
    
            if($xml_arr->status=='success') {

                $bill_id = array_pop(explode('_', $xml_arr->order_id))+0;
                $way = 'LiqPay';
                
                Bill::payBill ($bill_id,$way,$xml_arr->amount,strtolower($xml_arr->currency),$xml_arr->sender_phone);
                $this->redirect (array('ok'));
            
            } elseif($xml_arr->status=='wait_secure') {
                Bill::err ($bill->id,'Счёт LiqPay передан на ручное зачисление. Проверьте самостоятельно поступление средств и пометьте в Админке платёж как оплаченный');
                $this->redirect (Y::bu().'f/wait/w/liqpay');
            
            }
        }
        
        $this->redirect (array ('fail'));
        
    }
    
    public function actionOk ()
    {
        $this->redirect (Y::bu().'f/ok/w/liqpay');
    }
    
    public function actionFail () 
    {
        $this->redirect (Y::bu().'f/fail/w/liqpay');
    }
    
    
}
