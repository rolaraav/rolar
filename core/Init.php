<?php
namespace core;

use app\models\BaseModel;
use \mysqli;
use \Exception;

class Init {

  public $Model;
  public $download_domen; // текущий домен для закачек

  // внешние динамические домены для скачивания файлов
  public $ddns_domains = array(
    'rolar.ddns.net',
    'rolar.myftp.org',
    '94.41.86.18.dynamic.ufanet.ru',
    //'rolar.keenetic.pro',
    //'rolar.keenetic.link',
    //'rolar.keenetic.name',
    //'rolar.mykeenetic.ru',
    //'rolaraav.no-ip.org',
    //'rolaraav.noip.me',
    //'349941.dyn.ufanet.ru',
  );

  public function __construct() {
    $this->Model = new BaseModel; // создание модели и соединение с базой данных
    $download_domen_array = $this->Model->get_download_domen(); // получение домена для закачек
    $this->download_domen = $download_domen_array['value'];
    //debug($this->download_domen);
  }

  // проверка доступности сайта
  private function isDomainAvailible($url) {
    // Проверка правильности URL
    if(!filter_var($url, FILTER_VALIDATE_URL)){
      return false;
    }

    // Инициализация cURL
    $curlInit = curl_init($url);

    // Установка параметров запроса
    curl_setopt($curlInit,CURLOPT_CONNECTTIMEOUT,10);
    curl_setopt($curlInit,CURLOPT_HEADER,true);
    curl_setopt($curlInit,CURLOPT_NOBODY,true);
    curl_setopt($curlInit,CURLOPT_RETURNTRANSFER,true);

    // Получение ответа
    $response = curl_exec($curlInit);

    // закрываем CURL
    curl_close($curlInit);

    return $response ? true : false;
  }

  /*
   * Проверка доступности URL
   * Источник: https://ru.stackoverflow.com/questions/453590/Как-проверить-доступность-страницы-сайта
   */
  private function sendUrl($url) {
    // Проверка правильности URL
    if (!filter_var($url, FILTER_VALIDATE_URL)) {
      return false;
    }
    if (function_exists('curl_init')) {
      $ch = curl_init(); // Инициализация cURL

      // Установка параметров запроса
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
      curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      $response = curl_exec($ch); // Получение ответа
      curl_close($ch); // закрываем CURL
      if ($response) {
        return $response;
      }
      else {
        return false;
      }
    }
    else {
      $content = @file_get_contents($url);
      if ($content === false) {
        return false;
      }
      else {
        return $content;
      }
    }
  }
  /*
   * //$url = sendUrl('http://www.sadasdasd213.kz/'); // Не рабочий сайт
   * $url = sendUrl('https://batas.kz/'); // Рабочий сайт
   * if ($url) {
   * echo $url;
   * }
   * else {
   * echo 'Страница сайта не работает.';
   * }
   * */


  // обновление и сохранение доступного домена для скачивания в базе данных
  public function update_download_domen() {

    // определяем домен для закачки
    foreach($this->ddns_domains as $item) {

      $metka = false; // метка совпадения домена

      // если выбранный домен совпадает с доменом для закачек по умолчанию, и текущий домен не совпадает с доменом для закачек по умолчанию
      if (($item == DEFAULT_DOWNLOAD_DOMEN) and ($this->download_domen != DEFAULT_DOWNLOAD_DOMEN)) {
        // то обновляем его в базе данных
        $this->Model->update_download_domen($item);
        $metka = true; // метка совпадения домена - домен уже обновлён в базе данных
        //echo 'Домен '.$item.' по умолчанию обновлён в базе данных.<br>';
      }

      // если выбранный домен доступен
      // if ($this->isDomainAvailible('http://'.$item)) {
      if ($this->sendUrl('http://'.$item)) {

        // и если текущий домен (полученный из базы данных) не совпадает с выбранным доменом
        if ($this->download_domen != $item) {
          // то обновляем запись в базе данных, в случае если домен не обновлен
          if ($metka == false) {
            $this->Model->update_download_domen($item);
            //echo 'Домен '.$item.' доступен и обновлён в базе данных.<br>';
          }
          $this->download_domen = $item; // и присваиваем значение выбранного домена к текущему
          //debug($this->download_domen);
        }

        //echo 'Домен '.$item.' доступен.<br>';
        break; // мы нашли доступный домен и выходим из цикла
      }
    }
    //debug($this->download_domen);
    return $this->download_domen; // возвращаем значение текущего домена
  }

  // функция обновления хешей в таблицах data и courses
  public function update_hash($table='data') {
    if (empty($table)) {$table ='data';}

    $this->Model->update_hash(false, false, $table); // чистим все хеши в таблице data
    //$this->Model->update_hash(false, false, $table='courses'); // чистим все хеши в таблице courses

    $elements = $this->Model->count_elements($table); // считаем количество элементов в таблице, расчёт производится по полю 'id'
    echo 'Всего записей в таблице <strong>'.$table.'</strong>: <strong>'.$elements.'</strong>.<br>';

    // в цикле для каждого элемента получаем хеш и записываем в таблицу
    for($i=1;$i<=$elements;$i++){
      $hash = substr(md5(microtime().mt_rand(1,10000)),7,16);
      $this->Model->update_hash($i,$hash,$table);
    }
    echo 'Хеши в таблице <strong>'.$table.'</strong> успешно обновлены.<br>';
    //exit();
    return true;
  }

  // функция для заполнения алиасов в таблицах data и прочих
  public function filling_aliases($table='data'){
    if (empty($table)) {$table ='data';}

    $elements = $this->Model->count_elements($table); // считаем количество элементов в таблице, расчёт производится по полю 'id'
    echo 'Всего записей в таблице <strong>'.$table.'</strong>: <strong>'.$elements.'</strong>.<br>';

    // Получаем названия из таблицы
    $aliases_array = $this->Model->get_aliases_title($table); // получаем массив ID, алиас и заголовок
    //debug($aliases_array);
    $array = array();
    $message = 'Таблица <strong>'.$table.'</strong>:<br>';
    foreach ($aliases_array as $key => $value) {
      $key = $value['id'];
      // в случае, если алиас пустой
      if (empty($value['alias'])) {
        $val = string2url($value['title']); // преобразуем заголовки в url-совместимые алиасы
        $this->Model->update_data_aliases($key, $val, $table); // обновление алиасов в таблице
        $message = $message.'Для записи <strong>'.$value['title'].'</strong> алиас обновлён на <strong>'.$val.'</strong>.<br>';
      }
      $array[$key] = $val;
    }
    echo $message.'Все алиасы в таблице <strong>'.$table.'</strong> заполнены.<br>';
    //debug($array);
    return true;
  }


}