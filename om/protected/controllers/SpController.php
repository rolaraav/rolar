<?php

    //Данный контроллер отвечает за блокирующую ссылку

class SpController extends Controller
{
    //Функция проверяет - нужна ли установка блокирующего контроллера
    //устанавливает его если нужно
    
    public function actionGo ($id = FALSE, $d = FALSE, $id2 = FALSE) {
        
            if (!$id) {
                die ('Не передан ID товара');
            }

            //Выбить если не правильный ID
            if (!preg_match ('/^[a-z0-9_]{1,100}$/',$id)) {
            	die ('Неверный формат ID');
            }
            
            //Пытаемся найти товар
            $g = Good::model ()->findByPk ($id);
            
            if (!$g) {
                die ('Такого товара не существует');
            }
            
            if (is_numeric ($d)) {
                
                if (($d < 0) or ($d > 365)) die ('Bad number');
                
                $tt = time () + $d*86400;
                Y::cookieSet ('om_block_'.$id,1,$tt); 
                
            } else {
        
                //Устанавливаем блок для товара
                Y::cookieSet ('om_block_'.$id,1); 
               
            }

            //На второй товар
            if ($id2) {
                
                            //Пытаемся найти товар
                $g2 = Good::model ()->findByPk ($id2);
            
                if (!$g2) {
                    die ('Такого товара не существует');
                }
                
                    if (is_numeric ($d)) {

                        if (($d < 0) or ($d > 365)) die ('Bad number');

                        $tt = time () + $d*86400;
                        Y::cookieSet ('om_block_'.$id2,1,$tt); 

                    } else {

                        //Устанавливаем блок для товара
                        Y::cookieSet ('om_block_'.$id2,1); 

                    }
                
                
            }
            
            
            //Редирект на рекламный текст
            $url = $g->affLink;
        
            if (empty ($url)) {
                $this->redirect (array('/'));
            } else{
                $this->redirect ($url);
            }
                    
    }            
            
}