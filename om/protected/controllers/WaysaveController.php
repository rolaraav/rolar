<?php

class WaysaveController extends Controller
{
	//Сохраняет способ оплаты
	public function actionIndex ()
	{
        if ((!isset ($_GET['bill_id'])) OR (!isset ($_GET['hash'])))   {
            die ('Не передан номер счёта или CRC!');
        }
        $bill_id = $_GET['bill_id'];
        $hash = $_GET['hash'];
        $way = trim (substr ($_GET['way'],0,40));

        if (!is_numeric ($bill_id)) die ('Счёт должен быть числом');

        //Проверяем хэш
        if ($hash!==Bill::hashBill($bill_id)) {
            die ('Неверная контрольная сумма!');
        }

        //Ищем счёт
        $bill = Bill::model()->findByPk ($bill_id);

        if (!$bill) {
            die ();
        }
        
        if ($bill->status_id != 'waiting') {
            die ();
        }
        
        
        $ww = Way::model ()->findByPk ($way);
        
        if (!$ww) die ();

        $bill->way = $ww->title;
        $bill->save (false,array('way'));
        die ('');
	   
	}


}