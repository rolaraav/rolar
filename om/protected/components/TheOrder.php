<?php

class TheOrder
{

    /*
     * Функция генерирует случайный номер заказа
     * помещает туда сформированный заказ на 1 товар
     * и возвращает ссылку
     */
    static public function makeOrder ($bill,$good) {

        //Формируем ордер
        $orderNum = md5 (H::random_string ());

        //Записываем товар и первый заказ
        $data = array ();
        $data['bill'] = $bill;        

                //Формируем цену с учётом скидки
                if (!empty ($bill->cupon)) {

                    if (Cupon::valid ($bill->cupon,$bill->email)!='') {
                        $good->newprice = Cupon::goodCena ($bill->cupon, $good);
                    }
                    //Новая рублёвая цена
                } else {
                    $good->newprice = $good->price;
                }
        
        $good = self::_rurcena ($good);


        $data['goods'][] = $good;

        
        Yii::app()->session['order_'.$orderNum] = $data;        

        return $orderNum;
        
    }

    /*
     * Добавляет новый товар к уже существующему заказу
     */
    static public function addGood ($orderNum, $good) {

        $data = Yii::app()->session['order_'.$orderNum];

        if (empty ($data)) {
            Yii::app()->session->destroy ();
            throw new CHttpException(404, 'Заказ не найден или сессия завершена. Пожалуйста, оформите заказ заново.');
        }
        
        $bill = $data['bill'];

        //Формируем цену с учётом скидки
        if (!empty ($bill->kupon)) {
            $good->newprice = Cupon::goodCena ($bill->kupon, $good);
            //Новая рублёвая цена
        } else {
            $good->newprice = $good->price;
        }
        
        $good = self::_rurcena ($good);

        $data['goods'][] = $good;
        Yii::app()->session['order_'.$orderNum] = $data;
        
    }

    /*
     * Возвращает список товаров
     */
    static public function listData ($orderNum) {
        
         if (!preg_match ('/^[a-z0-9_]{1,200}$/',$orderNum)) {
              die ('Неверный формат номера заказа. Начните, пожалуйста, заново');
         }

    
        $data = Yii::app()->session['order_'.$orderNum];        

        if (empty ($data)) {
            Yii::app()->session->destroy ();
            throw new CHttpException(404, 'Заказы не найдены или сессия завершена. Пожалуйста, оформите заказ заново.');
        }

        return $data;
    }

    static private function _rurcena ($gd) {
        $rurcena = (Valuta::conv($gd->newprice, $gd->currency));
        $gd->rurcena = $rurcena['rur'];
        return $gd;
    }


}


?>
