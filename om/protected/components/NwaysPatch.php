<?php

class NwaysPatch {

    public function actionPatch ($silent = true) {
        //Патч для добавления новых платёжных систем
        if ($silent) {
            ob_start();
        }

        echo '<pre>';
        echo "Начато применение патча для новых платёжных систем...\r\n";

        //Яндекс.Касса
        //Настройки Яндекс.Кассы
        $this->_create_setting('payYandexOn','Включить ЮMoney',0);
        $this->_create_setting('payYandexAccount','№ счёта ЮMoney',"");
        $this->_create_setting('payYandexKey','Секретное слово ЮMoney',"");

        //Форма способа Яндекс.Деньги
        $way = Way::model()->find ('way_id = "yandex_online"');
        if (!$way) {
            $this->_import_way ("yandex_online","ЮMoney (через сайт)");
        }
        else {
            echo "Способ ЮMoney уже добавлен ранее\r\n";
        }

        //Яндекс.Деньги для раздела "Выбор оплаты"
        $this->_one_waylist(
          'yandex_online',
          "Оплата ЮMoney или VISA/MasterCard",
          'yandex',
          'Электронные платежи',
          180,
          'https://yoomoney.ru/'
        );

        //Патч для PayPal
        $this->_create_setting('payPaypalOn','Включить PayPal',0);
        $this->_create_setting('payPaypalEmail','E-mail в PayPal',"");
        $this->_create_setting('payPaypalKey','Секретный ключ PayPal',"");

        //Форма способа PayPal
        $way = Way::model ()->find ('way_id = "paypal_online"');
        if (!$way) {
            $this->_import_way ("paypal_online","С помощью PayPal");
        }
        else {
            echo "Способ Paypal уже добавлен ранее\r\n";
        }

        //Paypal для раздела "Выбор оплаты"
        $this->_one_waylist(
          'paypal_online',
          "Оплата через PayPal",
          'paypal',
          'Электронные платежи',
          182,'https://paypal.com/'
        );

        //Всё для Qiwi
        $this->_create_setting('payQiwiOn','Включить Qiwi',0);
        $this->_create_setting('payQiwiId','ID магазина Qiwi',"");
        $this->_create_setting('payQiwiPass','Пароль магазина Qiwi',"");

        //Форма способа Qiwi
        $way = Way::model ()->find ('way_id = "qiwi_online"');
        if (!$way) {
            $this->_import_way ("qiwi_online","Платёжная система Qiwi");
        }
        else {
            echo "Способ Qiwi уже добавлен ранее\r\n";
        }

        //Qiwi для раздела "Выбор оплаты"
        $this->_one_waylist(
          'qiwi_online',
          "Оплата с помощью Qiwi",
          'qiwi',
          'Электронные платежи',
          184,
          'https://qiwi.com/'
        );

        //Патч для w1
        $way = Way::model ()->find ('way_id = "w1_online"');
        if (!$way) {
            $this->_import_way ("w1_online","Единая Касса (W1)");
        }
        else {
            echo "Способ Единая касса уже добавлен ранее\r\n";
        }

        //Qiwi для раздела "Выбор оплаты"
        $this->_one_waylist(
          'w1_online',
          "Оплата через Единую Кассу (W1)",
          'w1','Электронные платежи',
          186,
          'http://w1.ru/'
        );

        echo "Патч платёжных систем успешно применён!\r\n";
        echo '</pre>';

        if ($silent) {
            ob_end_clean();
        }

    }

    private function _create_setting($field, $title, $val = "") {
      if (Settings::item($field)===false) {
        //Создаём поля для настроек
        try {
          $cm = Yii::app()->db->createCommand();
          $cm->insert('{{settings}}', array(
            'id' => $field,
            'value' => $val,
          ));
          echo "Поле настроек '$title' успешно создано\r\n";
        }
        catch (Exception $e) {
          echo "Ошибка при создании поля настроек '$title', возможно уже создано\r\n";
        }
      }
      else {
        echo "Поле для настроек '$title' уже существует\r\n";
      }
    }

    private function _import_way ($way, $title) {
        $w = new Way ();
        $w->isNewRecord = true;
        $w->way_id = $way;
        $w->title = $title;
        $w->code = file_get_contents ('./protected/data/patches/payways/'.$way.'.txt');
        $w->save (false);

        echo "Способ $title успешно добавлен\r\n";

    }

    private function _one_waylist ($ways, $title, $pic, $category, $pos, $url = "") {
        if (WayList::model()->find ("ways = '".$ways."'")) {
            echo "Вариант оплаты '".$title."' уже был создан ранее\r\n";
            return true;
        }
        $ww = new WayList ();
        $ww->title = $title;
        $ww->pic = $pic;
        $ww->ways = $ways;
        $ww->category = $category;
        $ww->position = $pos;
        $ww->url = $url;
        $ww->save (false);

        echo "Вариант оплаты '$title' успешно добавлен\r\n";
    }
}