<?php

class ClickController extends Controller
{
	public function actionGo($refid = FALSE, $good_id = FALSE, $page = 'a', $channel = 'default')
	{
	   
        $apart = $_SERVER['QUERY_STRING']; //Часть GET
        if (!empty ($apart)) $apart = '?' . $apart;
        
		//Если значения не переданы - переводим на каталог
		if ((!preg_match('/^[a-z0-9_]{1,100}$/',$refid)) OR (!preg_match('/^[a-z0-9_]{1,100}$/',$good_id)))
		{
			$this->redirect (array('/'));
		}

		if ((!preg_match('/^[a-z0-9_]{1,100}$/',$page)) OR (!preg_match('/^[a-z0-9A-Z_\.\-]{1,100}$/',$channel)))
		{
			$this->redirect (array('/'));
		}

		//Собственно запись клика
		$this->_click ($good_id, $refid, $channel, $page);

		//Запись кукиес на год

		//Если не по последнему партнёру
		if (Settings::item ('affLast')!=1) {

			$cookie = Y::cookieGet ('om_affreg');
			if (empty($cookie)) {
				//Общий кукиес
				Y::cookieSet ('om_affreg',$refid);
			}

			$cookie = Y::cookieGet ('om_ref_'.$good_id);
			if (empty($cookie)) {
				//Общий кукиес
				Y::cookieSet ('om_ref_'.$good_id,$refid);
			}

		} else {

			//Общий кукиес
			Y::cookieSet ('om_affreg',$refid);

			//Для конкретного товара
			Y::cookieSet ('om_ref_'.$good_id,$refid);

		}
                
                Y::cookieSet ('om_channel',$channel); //Канал

		//Определяем ссылку для переадресации

		$url = array ('/'); //По умолчанию - на каталог

		//Для партнёрской программы
		if ($page == 'a') {

			$plink = Settings::item ('affLink');

			if (strlen ($plink)>7) {
				$this->redirect ($plink . $apart);
			} else {
				$this->redirect (array('/aff/'));
			}

		}
                
		if ($page == 'order') {
                    $this->redirect (array('/ord/'.$good_id));
		}

		$db = Yii::app()->db;

		//Если page = 'p' - значит берём основную ссылку товара
		if ($page == 'p') {

			$command = $db->createCommand ();
			$res = $command->select ('*')->
						from ('{{good}}')->
						where ('id=:id',array('id' => $good_id))->queryRow();

			$plink = $res['affLink'];

			if (strlen ($plink)>7) {
				$this->redirect ($plink . $apart);
			}
		}

		//Поиск по plink-таблицы
		$command = $db->createCommand ();
			$res = $command->select ('*')->
						from ('{{plink}}')->
						where ('id=:id',array('id' => $page))->queryRow();

		$plink = $res['plink'];

		if (strlen ($plink)>7) {
			$this->redirect ($plink . $apart);
		}

		$this->redirect ($url);
	}

	//Запись клика в БД
	private function _click ($good_id , $partner_id, $channel, $page)
        {
            if ($page == 'a') $good_id = 'a';
            
            //Ищем запись с таким ID товара, партнёром, каналом и сегодняшней датой
            $r = S::model ()->find (array (
                'condition' => 'p_id = :pid AND sb = :sb AND date = :date AND good_id = :gid',
                'params' => array (
                    ':pid' => $partner_id,
                    ':sb' => $channel,
                    ':gid' => $good_id,
                    ':date' => date ('Ymd'),
                ),
            ));
            
            //Если найдено - увеличиваем число кликов и сохраняем
            if ($r) {
                $r->clicks++;
                $r->save (false);
            } else {
                $s = new S ();
                $s->id = false;
                $s->isNewRecord = true;
                $s->date = date ('Ymd');
                $s->p_id = $partner_id;
                $s->sb = $channel;
                $s->good_id = $good_id;
                $s->clicks = 1;
                $s->save (false);
            }
            return true;

	}

	//Клик по короткой ссылке
	public function actionShorten ($id)
	{
		if (!is_numeric($id)) {
			$this->redirect (array('/'));
		}

		//Поиск ссылки
		$db = Yii::app()->db;
		$command = $db->createCommand ();
		$res = $command->select ('*')->
						from ('{{shorten}}')->
						where ('id=:id',array('id' => $id))->queryRow();
		
		if (empty($res)) {
			$this->redirect (array('/'));
		}

		$this->redirect ($res['url']);
	}

}