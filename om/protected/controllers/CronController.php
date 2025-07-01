<?php

class CronController extends Controller
{
        //Запуск крона
	public function actionI($s = FALSE)
	{   
            $cw = Settings::item ('cronWord');
            if (!empty ($cw)) {
                if ($s!=$cw) {
                    die ('Bad CRON URL!');
                }
            }
		
		//Текущее время
		$t = time ();
		
		//Проверяем дату последнего запуска
		$ldate = Settings::item('cronLast');
		//Если да - переходим к заданиям		
		if (($ldate+300)<=$t) {
			
			//Обновляем время запуска
			$this->_save ('cronLast',$t);
			
			//Курсы
			if (Settings::item('kursAuto')==1) {
		
	
				//Проверяем обновление курса (раз в сутки) 
				$kurs = Settings::item('cronKurs');	
				if (($kurs+Settings::item('cronKursRate'))<=$t) {
					
					//Обновляем время запуска
					$this->_save ('cronKurs',$t);
					
					$this->_gkurs();
					
				}
			}
			
			
			//Письма - раз в час
			$rass = Settings::item('cronRass');
			//Если да - переходим к заданиям		
			if (($rass+Settings::item('mailInterval')*60)<=$t) {	

      					//Обновляем время запуска
					$this->_save ('cronRass',$t);

				if (Queue::model()->count()>0) {
					
					
					$this->_dorass();
					
				}
                                
                                Rass::dorass(); //Другая рассылка
                                
				
			}
                        
                        if (Settings::item ('notifyOn')) {
                        
                            //Напоминания для счетов
                            $rass = Settings::item('cronNotify');
                            //Если да - переходим к заданиям		
                            if (($rass+(Settings::item('notifyInterval')*60))<=$t) {				

                                    //Обновляем время запуска
                                    $this->_save ('cronNotify',$t);
                                    $this->_donotify();

                            }                        
                            
                        }
                            
		}
		echo 'Cron Ok';
				
	}
	
	//Сохранение нового значения в настройках
	private function _save ($key, $val) {
        
           Yii::app()->db->createCommand()
                ->update('{{settings}}', array(
                    'value'=>$val,
                    ),'id=:id', array(':id'=>$key));		
	}
	
	
	
	//Обновление курсов с сайта ЦБР
	private function _gkurs () {		
		
		$url = "http://www.cbr.ru/scripts/XML_daily.asp"; //URL of the XML FEED

		$contents = file_get_contents($url);

		$data = simplexml_load_string($contents, 'SimpleXMLElement', LIBXML_NOCDATA);
                                
                if (!$data) return FALSE;
		
		$usd = 0;
		$eur = 0;
		$uah = 0;
		
		foreach ($data as $one) {
                    
			$ov = str_replace (',','.',$one->Value);
			
			switch ($one->CharCode) {
				case 'USD':
					$usd = $ov/$one->Nominal;
				break;
				case 'EUR':
					$eur = $ov/$one->Nominal;
				break;
				case 'UAH':
					$uah = $ov/$one->Nominal;
				break;				
			}
		}
		
		//echo '<pre>';
		//print_r($data);                             
		
		//Обновление в базе
		if ($usd>0) {
			$this->_upkurs ('kursUsd',$usd);
		}
		
		if ($eur>0) {
			$this->_upkurs ('kursEur',$eur);
		}
		
		if ($uah>0) {
			$this->_upkurs ('kursUah',$uah);
		}
		
		echo 'Обновление курсов завершено<br>';
	}
	
	private function _upkurs ($nm,$vl) {
		
		$koef = Settings::item('kursAutoMul');		
		
		$val = round ($vl*$koef,2);
		
		$this->_save ($nm,$val);
	}
	
	//Выполняет рассылку	
	private function _dorass () {		
            
                $limit = Settings::item ('mailLimit');
                
                $criteria = new CDbCriteria;
                $criteria->limit = (int) $limit;
                $criteria->order = 'priority DESC';
                
                $res = Queue::model()->findAll ($criteria);
		
		foreach ($res as $r) {		
                    
                    $em = trim($r->email);
                    if (!empty ($em)) {
                        Mail::send ($r->email,'',$r->subject,$r->body,$r->format);    
                    }                    
                    //echo ($r->email);
			
                    $r->delete (); //Удаляем из очереди
                    
		}
		
		echo 'Разослано '.count ($res).' сообщений<br>';
		
	}       
        
        private function _donotify () {
            
            //Отправка напоминаний

            
                $limit = ceil(Settings::item ('notifyLimit')/2);

                //Первые напоминания
                
                $criteria = new CDbCriteria;
                $criteria->limit = (int) $limit;
                $criteria->order = 'createDate ASC';
                $criteria->condition = 'notifySent=0 AND status_id=:st AND createDate < :dd';
                $criteria->params = array (':st' => 'waiting',':dd' => time ()-Settings::item ('notifyFirst')*86400);                
            
                $res = Bill::model()->findAll ($criteria);
                
                foreach ($res as $b) {
                    
                    $b->notify = TRUE;
                    $b->notifySent = 1;
                    $b->save (FALSE);
                    
                    //Отправляем напоминание
                    
                    //Готовим данные
                    $d = array (
                        'bill_id' => $b->id,
                        'date' => H::date ($b->createDate),
                        'sum' => H::mysum($b->sum).H::valuta($b->valuta),                        
                    );
                    
                    $d['pay_link'] = Y::bu().'bill/index?bill_id='.$b->id.'&hash='.Bill::hashBill($b->id);
                    $d['status_link'] = Bill::statusLink ($b->id);
                    $d['unsub'] = Y::bu().'notify/unsub/t/b/i/'.$b->id.'/c/'.Queue::unsubCrc('b',$b->id);
                    
                    Mail::letter ('bill_notify_1',$b->email,$b->uname,$d);
                }
                
                //Вторые напоминания
                $criteria = new CDbCriteria;
                $criteria->limit = (int) $limit;
                $criteria->order = 'createDate ASC';
                $criteria->condition = 'notifySent=1 AND status_id=:st AND createDate < :dd';
                $criteria->params = array (':st' => 'waiting',':dd' => time ()-Settings::item ('notifySecond')*86400);                
            
                $res = Bill::model()->findAll ($criteria);                
                
                foreach ($res as $b) {
                    
                    $b->notify = TRUE;
                    $b->notifySent = 2;
                    $b->save (FALSE);
                    
                    //Отправляем напоминание
                    
                    //Готовим данные
                    $d = array (
                        'bill_id' => $b->id,
                        'date' => H::date ($b->createDate),
                        'sum' => H::mysum($b->sum).H::valuta($b->valuta),                        
                    );
                    
                    $d['pay_link'] = Y::bu().'bill/index?bill_id='.$b->id.'&hash='.Bill::hashBill($b->id);
                    $d['status_link'] = Bill::statusLink ($b->id);
                    $d['unsub'] = Y::bu().'notify/unsub/t/b/i/'.$b->id.'/c/'.Queue::unsubCrc('b',$b->id);
                    
                    Mail::letter ('bill_notify_2',$b->email,$b->uname,$d);
                }
            
        }
        
        
}