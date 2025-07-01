<?php

class ChController extends Controller
{
    
    public function actionGo ($id = FALSE, $k = FALSE)
    {
        
            if (!$id) {
                die ('Не передан ID товара');
            }

            //Выбить если не правильный ID
            if (!preg_match ('/^[a-z0-9_]{1,100}$/',$id)) {
            	die ('Неверный формат ID');
            }

            //Выбить если не правильный канал
            if (!preg_match ('/^[a-z0-9A-Z_\-\.]{1,100}$/',$k)) {
            	die ('Неверный формат канала');
            }
            
            //Пытаемся найти товар
            $g = Good::model ()->findByPk ($id);
            
            if (!$g) {
                die ('Такого товара не существует');
            }
        
            //Устанавливаем канал для товара
            Y::cookieSet ('om_channel_'.$id,$k); 
            Y::cookieSet ('om_channel',$k); 

            //Редирект на рекламный текст
            $url = $g->affLink;
            
            $this->_click ($g->id,'obsys',$k,'');
        
            if (empty ($url)) {
                $this->redirect (array('/'));
            } else{
                $this->redirect ($url);
            }            
        
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
    
    
}