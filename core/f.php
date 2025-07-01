<?php
defined('A') or die('Access denied');
//echo 'F<br>';

/* Распечатка булевой переменной, строки, числа, массива, объекта или ресурса */
function debug($var = null) {
  if (is_null($var)) {
    echo 'Нет значения (null)<br>';
    return false;
  }
  if (is_bool($var)) {
    if ($var === true) {$v = 'true';} else {$v = 'false';}
    echo 'Булева переменная (bool): '.$v.'<br>';
  }
  /*if (is_nan($var)) {
    echo 'Не число (NaN): '.$var.'<br>';
  }*/
  if (is_string($var)) {
    echo 'Строка (string): '.(string)$var.'<br>';
  }
  if (is_int($var)) {
    echo 'Целое число (integer): '.(int)$var.'<br>';
  }
  if (is_float($var)) {
    echo 'Число с плавающей запятой (float): '.$var.'<br>';
  }
  if (is_array($var)) {
    echo 'Массив (array): <br><pre>'.print_r($var, true).'</pre>';
  }
  if (is_object($var)) {
    echo 'Объект (object): <br><pre>'.print_r($var, true).'</pre>';
  }
  if (is_resource($var)) {
    echo 'Ресурс (resource): <br><pre>'.print_r($var, true).'</pre>';
  }
  return true;
}
/* Распечатка булевой переменной, строки, числа, массива, объекта или ресурса */
/* ===Распечатка массива=== */
function print_array($array) {
  return debug($array);
  //echo '<pre>'.print_r($array, true).'</pre>';
}
function pr($array) {
  return debug($array);
  //echo '<pre>'.print_r($array, true).'</pre>';
}
/* ===Распечатка массива=== */

/* ===Редирект=== */
function redirect($url = null) {
  if (isset($url)) {
    $redirect = $url;
  }
  else {
    $redirect = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : D;
  }
  header('HTTP/1.1 301 Moved Permanently');
  header('Location: '.$redirect);
  exit;
}
/* ===Редирект=== */

/* === Парсинг адресной строки === */
function url_parsing() {
  $url = $_SERVER['REQUEST_URI'];
  if (stripos($url, 'aav') == 1) { // если пользователь зашёл в админку /aav/
    $url = mb_substr($url, 4, mb_strlen($url, "UTF-8") - 4, "UTF-8"); // отрезаем первые 4 символа
    if (stripos($url, '.php') === false) {
      redirect(D.'aav/');
      exit;
    }
  }
//    if (stripos($url,'cell') == 1) { // если пользователь зашёл в директорию /cell/
//        $url = mb_substr($url,5,mb_strlen($url,"UTF-8")-5,"UTF-8"); // отрезаем первые 6 символов
//        if (stripos($url,'.php') === false) {
//            header("Location: ".DOMEN."cell/");
//            exit;
//        }
//    }
  if (stripos($url, 'cisco') == 1) { // если пользователь зашёл в директорию /cisco/
    $url = mb_substr($url, 6, mb_strlen($url, "UTF-8") - 6, "UTF-8"); // отрезаем первые 6 символов
    if (stripos($url, '.php') === false) {
      redirect(D.'cisco/');
      exit;
    }
  }
//  echo "url=".$url."<br>";
//    if (substr($url,0,4-mb_strlen($url,"UTF-8")) == '/aav') { // если пользователь зашел в админку
  //       $url = substr($url,4);
//      echo "newurl=".$url;
//    }
  if ((empty($url)) or ($url == '/') or (stripos($url, '.php') === false)) { // если зашли на главную страницу или в адресной строке не встречается .php
    $get_parametrs = '';
    $view = 'index';
  } else {
    if (stripos($url, '?') === false) { // если зашли на любую страницу без параметров
      $get_parametrs = '';
    } else { // если зашли на страницу с параметрами
      // echo mb_strlen($url,"UTF-8")-stripos($url,'?')-1; - длина строки $get_parametrs
      // получение $get_parametrs через mb_substr($url,stripos($url,'?')+1,mb_strlen($url,"UTF-8")-stripos($url,'?')-1,"UTF-8");
      $get_parametrs = substr($url, stripos($url, '?') + 1);
    }
    $view = mb_substr($url, 1, stripos($url, '.php') - 1, "UTF-8");

  }
  // если в адресной строке есть символ "l" и число, то это короткая ссылка
  if (stripos($url, 'l') == 1 and (preg_match("|^[\d]+$|", mb_substr($url, 2, "UTF-8")))) {
    $view = 'short_link';
    $_GET['id'] = abs((int)mb_substr($url, 2, "UTF-8"));
    //  echo $view;
  }
//  echo "<br>get_parametrs=".$get_parametrs;
//  echo "<br>view=".$view;
  // $_GET["get_parametrs"] = $get_parametrs;
  $_GET["view"] = $view;
}
/* === Парсинг адресной строки === */


/* === Фильтрация пользовательских данных (начало) === */

// функция для очистки кода
function clear_code($input) {
  $search = array(
    '@<script[^>]*?>.*?</script>@si',   // javascript
    '@<[\/\!]*?[^<>]*?>@si',            // HTML теги
    '@<style[^>]*?>.*?</style>@siU',    // теги style
    '@<![\s\S]*?--[ \t\n\r]*>@'         // многоуровневые комментарии
  );
  $output = preg_replace($search, '', $input);
  return $output;
}

// функция проверки имени/фамилии, логина, email-а, даты рождения и прочего
function clear($string = '', $clear_code = true, $strip_tags = true, $stripslashes = false, $htmlspecialchars = true, $htmlentities = false, $url = true) {
  if (empty((string)$string)) return false;
  $string = (string)$string;
  if ($clear_code) {
    $string = clear_code($string); // удаление скриптов, стилей, html-тегов и комментариев
  }
  if ($strip_tags) {
    $string = strip_tags($string); // удаление HTML и PHP тегов
  }
  if ($stripslashes) { // and get_magic_quotes_gpc() - получение текущего значения настройки конфигурации magic_quotes_gpc
    $string = stripslashes($string); // удаление экранированных символов ("Ваc зовут O\'reilly?" => "Вас зовут O'reilly?").
  }
  if ($htmlspecialchars) {
    $string = htmlspecialchars($string, ENT_QUOTES|ENT_HTML401|ENT_XHTML|ENT_HTML5, 'utf-8'); //преобразует специальные символы в HTML-сущности ('&' преобразуется в '&amp;' и т.д.), ENT_QUOTES - преобразует как двойные, так и одинарные кавычки
  }
  if ($htmlentities) {
    $string = htmlentities($string, ENT_QUOTES|ENT_HTML401|ENT_XHTML|ENT_HTML5, 'utf-8'); // преобразует все возможные символы в соответствующие HTML-сущности
  }
  if ($url) {
    $string = preg_replace('/\b(https?|ftp|file):\/\/[-A-Z0-9+&@#\/%?=~_|$!:,.;]*[A-Z0-9+&@#\/%=~_|$]/i', '', $string); // чистка от ссылок и url-адресов
  }
  $string = trim($string); // удаление пробелов и пробельных символов из начала и конца строки
  return $string;
}

// функция для очистки строки и строчного массива
function clear_str($array = array()) {
  if(is_array($array)) {
    $row = array();
    foreach($array as $key => $item) {
      $row[$key] = clear($item);
    }
    return $row;
  }
  return clear($array);
}

// функция для очистки целых чисел
function clear_int($integer = null) {
  return abs((int)$integer); // приведение к типу Integer и возвращение модуля числа
}

// Функция проверки email (для авторизации из социальных сетей)
function get_email($email = null) {
  if ((empty($email)) or ($email == '')) {
    $_SESSION['get_email_form'] = true;
    // return '';
  }
  $email = clear($email);
  return $email;
}

// функция проверки допустимой длины строки
function check_length($string = '', $min = 1, $max = 1000) {
  if (empty((string)$string)) return false;
  $length = mb_strlen((string)$string, 'UTF-8'); // вычисляем длину строки
  //debug($length);
  // если длина строки меньше минимума или больше максимума
  if ($length < $min or $length > $max) {
    return false; // то такая строка не подходит, возвращаем false
  }
  return true; // иначе - подходит, возвращаем true
}

/* === Проверка (валидация) пользовательских данных (нчало) === */
function validate($string = '', $type = null) {
  if (empty($string)) return false;

  $type_array = array('name','text','html','login','password','email','phone','number','float','url','ip','mac','date','datetime','code','md5'); // допустимые значения типов
  // проверка полученного типа на допустимый
  if ((!in_array($type,$type_array)) or (empty((string)$type))) { // если в массиве $type_array нет искомого значения из массива $type, или если $type - пустой,
    $type = 'name'; // то $type = 'name'
  }

  switch((string)$type){
    case('name'): // имя (фамилия/отчество)
      $string = clear((string)$string);
      if (!preg_match('/^([А-Яа-яЁё]+|[A-Za-z]+)$/ui', $string)) { // /^^([А-Яа-яЁё]+|[A-Za-z]+)$[A-Za-zА-Яа-яЁё]+$/ui
        $_SESSION['message'] = 'Имя введёно неверно. Имя должно состоять только из русских или только из латинских букв';
        return false;
      }
      break;
    case('text'): // обычный текст
      $string = clear((string)$string, true, true, true, true, false, false);
      break;
    case('html'): // html-код
      $string = clear((string)$string, false, false, false, true, false, false);
      break;
    case('login'): // логин
      $string = clear((string)$string);
      if (!preg_match('/^[0-9A-Za-z]+$/i', $string)) {
        $_SESSION['message'] = 'Логин введён неверно. Логин должен состоять только из латинских букв и/или цифр';
        return false;
      }
      break;
    case('password'): // пароль
      //$string = stripslashes($string);
      //$string = htmlspecialchars($string);
      $string = clear((string)$string,false,false, true, false, false, false);
      if (!preg_match('/^[-0-9A-Za-z~!@#$%^&*()_+=|?]+$/i', $string)) { // все символы "/^[-A-Za-z0-9+&@#\\/%?*=~_|$!`'"^:,.;()[\]{}<>]+$/i" по умолчанию "/^[-A-Za-z0-9+&@#\/%?=~_|$!:,.;]+$/i" можно выбрать диапазон символов от !(код 33) до ~(код 126) ^[!-~]+$ пробел имеет код 32
        $_SESSION['message'] = 'Пароль введён неверно. Пароль должен состоять только из латинских букв, цифр и знаков ~!@#$%^&*()-_+=|?'; // все символы -+&@#\/%?*=~_|$!`'"^:,.;()[]{}<>
        return false;
      }
      break;
    case('email'): // адрес электронной почты
      $string = clear((string)$string);
      $string = filter_var($string, FILTER_VALIDATE_EMAIL); // параметр FILTER_VALIDATE_EMAIL для валидации электронного адреса //filter_var - возвращает отфильтрованные данные или FALSE, если фильтрация завершилась неудачей
      // проверка е-mail адреса регулярными выражениями на корректность
      if (!preg_match('/([a-z0-9_\.\-])+\@(([a-z0-9\-])+\.)+([a-z0-9]{2,4})+/i', $string)) {
        // if (!preg_match('/[0-9a-z_]+@[0-9a-z_^\.]+\.[a-z]{2,3}/i', $email)) { - альтернативная проверка из примера
        $_SESSION['message'] = 'Адрес электронной почты введён неверно';
        return false;
      }
      break;
    case('phone'): // номер телефона
      $string = preg_replace('/\b(https?|ftp|file):\/\/[-A-Z0-9+&@#\/%?=~_|$!:,.;]*[A-Z0-9+&@#\/%=~_|$]/i', '', (string)$string);
      // проверка номера телефона на число: если не число, то вводим сообщение
      if (!preg_match('|^[\d]+$|', $string)) {
        $_SESSION['message'] = 'Номер телефона введён неверно. Номер телефона должен состоять только из цифр';
        return false;
      }
      else {
        if (!check_length($string, 8, 11)) { // если длина строки не допустима, то выдаём ошибку
          $_SESSION['message'] = 'Номер телефона введён неверно. Номер телефона должен состоять только из 8-11 цифр';
          return false;
        }
      }
      break;
    case('number'): // целое число
      $string = clear_int($string); // преобразуем к целому числу
      $string = filter_var($string, FILTER_VALIDATE_INT); // filter_var - возвращает отфильтрованные данные или FALSE, если фильтрация завершилась неудачей, параметр FILTER_VALIDATE_INT для валидации целого числа
      if (!preg_match('|^[\d]+$|', $string)) {
        $_SESSION['message'] = 'Не целое число';
        return false;
      }
      break;
    case('float'): // число с плавающей точкой
      $string = filter_var((float)$string, FILTER_VALIDATE_FLOAT); // filter_var - возвращает отфильтрованные данные или FALSE, если фильтрация завершилась неудачей, параметр FILTER_VALIDATE_FLOAT для валидации числа с плавающей точкой
      if (!preg_match('|^[0-9]*[.,]?[0-9]+$|', $string)) { // ^[-+]?[0-9]*[.,]?[0-9]+(?:[eE][-+]?[0-9]+)?$ - чтобы поддерживало и целые, и дробные числа, ^(0|[1-9]\d*)([.,]\d+)? - разрешает целые, дробные, исключает вариант с несколькими нулями перед дробной частью, на подобии: "000.0001"
        $_SESSION['message'] = 'Не число с плавающей точкой';
        return false;
      }
      break;
    case('url'): // url-адрес
      $string = filter_var((string)$string, FILTER_VALIDATE_URL); // filter_var - возвращает отфильтрованные данные или FALSE, если фильтрация завершилась неудачей, параметр FILTER_VALIDATE_URL для валидации url-адреса
      // проверяем введенные данные и чистим неверный адрес сайта
      $string = preg_replace('/([a-z0-9_\.\-])+\@(([a-z0-9\-])+\.)+([a-z0-9]{2,4})+/i', '', $string);
      // проверка сайта регулярными выражениями на корректность
      if (!preg_match('/\b(https?|ftp|file):\/\/[-A-Z0-9+&@#\/%?=~_|$!:,.;]*[A-Z0-9+&@#\/%=~_|$]/i', $string)) {
        $_SESSION['message'] = 'Адрес сайта введён неверно';
        return false;
      }
      break;
    case('ip'): // IP-адрес
      $string = filter_var((string)$string, FILTER_VALIDATE_IP); // filter_var - возвращает отфильтрованные данные или FALSE, если фильтрация завершилась неудачей, параметр FILTER_VALIDATE_IP для валидации IPv4 и IPv6 адреса
      if (!preg_match('/^(25[0-5]|2[0-4][0-9]|[0-1][0-9]{2}|[0-9]{2}|[0-9])(\.(25[0-5]|2[0-4][0-9]|[0-1][0-9]{2}|[0-9]{2}|[0-9])){3}$/', $string)) {
        $_SESSION['message'] = 'IP-адрес v4 введён неверно';
        return false;
      }
      break;
    case('mac'): // MAC-адрес
      $string = filter_var((string)$string, FILTER_VALIDATE_MAC); // filter_var - возвращает отфильтрованные данные или FALSE, если фильтрация завершилась неудачей, параметр FILTER_VALIDATE_MAC для валидации MAC-адреса
      if (!preg_match('/^([0-9A-Fa-f]{2}[:-]){5}([0-9A-Fa-f]{2})$/', $string)) { // ^([0-9A-Fa-f]{2}[:.-]?){5}([0-9A-Fa-f]{2})$
        $_SESSION['message'] = 'MAC-адрес введён неверно';
        return false;
      }
      break;
    case('date'): // Дата
      // проверка даты рождения регулярными выражениями
      if (!preg_match('/(19|20)\d\d-((0[1-9]|1[012])-(0[1-9]|[12]\d)|(0[13-9]|1[012])-30|(0[13578]|1[02])-31)+/i', (string)$string)) {
        // проверка даты в формате YYYY-MM-DD: [0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])
        // второй вариант (\d{4}\-\d{2}\-\d{2})
        $_SESSION['message'] = 'Дата введёна неверно';
        return false;
      }
      break;
    case('datetime'): // Дата и время в формате ГГГГ-ММ-ДД ЧЧ:ММ:СС
      // проверка даты рождения регулярными выражениями
      if (!preg_match('/(\d{2}|\d{4})(?:\-)?([0]{1}\d{1}|[1]{1}[0-2]{1})(?:\-)?([0-2]{1}\d{1}|[3]{1}[0-1]{1})(?:\s)?([0-1]{1}\d{1}|[2]{1}[0-3]{1})(?::)?([0-5]{1}\d{1})(?::)?([0-5]{1}\d{1})/i', (string)$string)) {
        // паттерн взят здесь http://regexlib.com/REDetails.aspx?regexp_id=751
        $_SESSION['message'] = 'Дата и время введены неверно';
        return false;
      }
      break;
    case('code'): // код капчи
      $string = clear((string)$string,false,false, false, false, false, false);
      if (!preg_match('/^[0-9A-Fa-f]{6}$/i', $string)) {
        $_SESSION['message'] = 'Код с картинки введён неверно. Код состоит только из 6 латинских букв A-F и цифр 0-9';
        return false;
      }
      break;
    case('md5'): // закодированная в код md5 последовательность символов
      $string = clear((string)$string,false,false, false, false, false, false);
      if (!preg_match('/^[0-9A-Fa-f]{32}$/i', $string)) {
        $_SESSION['message'] = 'Код md5 введён неверно. Код состоит только из 32 латинских букв A-F и цифр 0-9';
        return false;
      }
      break;
  }

  return $string;
}
/* === Проверка (валидация) пользовательских данных (конец) === */

/* === Фильтрация пользовательских данных (конец) === */


/* Безопасность (проверка капчи, шифрование и генерация паролей) (начало) */

  // Функция для шифрования пароля
  function shifr_password($password='') {
    if (!isset($password)) return false;
    // старый алгоритм шифрования
    //$shifr_password = md5($password);
    //$shifr_password = strrev($shifr_password);
    //$shifr_password = "g96vnh5p".$shifr_password."xr3qf8a5"; // g96vnh5p 29e2be6e06befb4e2c94f621a25da8df xr3qf8a5

    // новый алгоритм шифрования отличается от старого дополнительной обёрткой полученной строки функцией md5
    // новый пароль = md5(старый пароль);
    // добавляем дополнительные символы в начале и в конце строки, чтобы пароль не смогли подобрать
    // добавляем реверс для надёжности и шифруем пароль по алогитму md5
    $shifr_password = md5('g96vnh5p'.strrev(md5((string)$password)).'xr3qf8a5');
    //debug(md5((string)$password));
    return $shifr_password; // 111 = ca89b6b21f977a18455187a4e229f1fa    // a7f033ff945a2983c8514505939df3a2
  }

  // Функция для генерации кода активации
  function shifr_activation($id='',$login='',$email='') {
    if ((empty($id)) or ((empty($login)) and (empty($email)))) return false;
    // в случае подписки логин пустой
    // старый алгоритм шифрования
    //$shifr_activation = md5($login).'wf2cqt1d'.md5($id);

    // добавляем дополнительные символы в середине строки, чтобы код активации не смогли подобрать
    // добавляем реверс для надёжности и шифруем код по алогитму md5
    $shifr_activation = md5(strrev($id.'htdf7sk3'.$login.'wf2cqt1d'.$email));
    //debug($login.'wf2cqt1d'.$id);
    //debug($shifr_activation);
    return $shifr_activation;
  }

  // функция для генерации нового случайного пароля
  function generate_password(){
    $datenow = date("Y-m-d H:i:s"); // получаем текущую дату и время
    // $datenow = date('YmdHis');
    $new_password = md5($datenow); // шифруем дату по алгоритму md5
    $new_password = strrev($new_password); // для надежности добавим реверс
    $new_password = substr($new_password, 4, 8); // извлекаем из шифра 8 символов начиная с 4го - это и будет наш случайный пароль
    return $new_password;
  }


  // функция для генерации кода капчи
  function generate_code() {
    $hours = date("H");                 // час
    $minuts = substr(date("H"), 0, 1); // минута
    $mouns = date("m");                 // месяц
    $year_day = date("z");              // день в году

    $str = $hours.$minuts.$mouns.$year_day; //создаем строку
    $str = md5(md5($str)); //дважды шифруем в md5
    $str = strrev($str); // реверс строки
    $str = substr($str, 4, 6); // извлекаем 6 символов, начиная с 4
    // Вам конечно же можно постваить другие значения, так как, если взломщики узнают, каким именно способом это все генерируется, то в защите не будет смысла

    $array_mix = preg_split('//', $str, -1, PREG_SPLIT_NO_EMPTY);
    srand((float)microtime() * 1000000);
    shuffle($array_mix);
    // Тщательно перемешиваем, соль, сахар по вкусу!!!
    return implode('', $array_mix);
  }

  // функция для проверки кода капчи
  function check_code($code) {
    if (empty($code)) {
      return false;
    }
    // если есть капча в сессии, проверяем её с полученным кодом
    if ((isset($_SESSION['captcha'])) and ($code == $_SESSION['captcha'])) {
      //echo 'Капча совпадает';
      return true;
    }
    $code = trim((string)$code); // удаляем пробелы
    $array_mix = preg_split('//', generate_code(), -1, PREG_SPLIT_NO_EMPTY);
    $m_code = preg_split('//', $code, -1, PREG_SPLIT_NO_EMPTY);
    $result = array_intersect($array_mix, $m_code);
    if (strlen(generate_code()) != strlen($code)) {
      return false;
    }
    if (sizeof($result) == sizeof($array_mix)) {
      return true;
    } else {
      return false;
    }
  }

// функция для проверки суммы чисел
function check_sum($sum, $random) {
  if ((empty($sum)) or (empty($random))) {return false;}
  // вытаскиваем результат сложения из константы CHECKSUM
  $result = mb_substr(CHECKSUM, $random-1,1, "UTF-8");
  // если совпадает с результатом, то возвращаем true
  if (($sum === (int)$result)) {
    // echo 'Сумма чисел совпадает';
    return true;
  }
  else { // иначе возвращаем false
    // echo 'Cумма чисел не совпадает';
    return false;
  }
}

// функция для генерации хеша для скачивания файлов - строка из 16 случайных символов из диапазона 0123456789abcdef
function generate_hash(){
  return substr(md5(microtime().mt_rand(1,10000)),7,16);
}

/* Безопасность (проверка капчи, шифрование и генерация паролей) (начало) */



/* === Вычисления для постраничной навигации на сайте === */
function pagnav_calc2($num, $total_post) {
  global $page;
  global $total_pages;
  if (isset($_GET['page'])) {
    $page = (int)$_GET['page'];
    if (empty($page) or $page < 1) {
      $page = 1;
    } // если значение $page меньше единицы или отрицательно переходим на первую страницу
  } else {
    $page = 1;
  }
  $total_pages = ceil($total_post / $num); // количество страниц
  if (!$total_pages) {
    $total_pages = 1;
  } // минимум 1 страница
  if ($page > $total_pages) {
    $page = $total_pages;
  } // если запрошенная страница $page больше общего количества страниц, то переходим на последнюю
  $start = ($page - 1) * $num; // начальная позиция для запроса (вычисляем начиная с какого номера следует выводить заметки)
  $limit = $start.', '.$num;
  return $limit;
}

/* === Вычисления для постраничной навигации на сайте === */

/* === Вычисления для постраничной навигации в админке === */
function pagnav_calc($cnum, $total_count) {
  global $pg;
  global $total_pages;
  if (isset($_GET['page'])) {
    $pg = (int)$_GET['page'];
    if (empty($pg) or $pg < 1) {
      $pg = 1;
    } // если значение $pg меньше единицы или отрицательно переходим на первую страницу
  } else {
    $pg = 1;
  }
  $total_pages = ceil($total_count / $cnum); // количество страниц
  if (!$total_pages) {
    $total_pages = 1;
  } // минимум 1 страница
  if ($pg > $total_pages) {
    $pg = $total_pages;
  } // если запрошенная страница $pg больше общего количества страниц, то переходим на последнюю
  $start = ($pg - 1) * $cnum; // начальная позиция для запроса (вычисляем начиная с какого номера следует выводить заметки)
  $limit = ' LIMIT '.$start.', '.$cnum;
  return $limit;
}

/* === Вычисления для постраничной навигации в админке === */

/* ===Постраничная навигация=== */
function paginal_navigation($page, $total_pages) {
  if ($_SERVER['QUERY_STRING']) { // если есть параметры в запросе
    foreach ($_GET as $key => $value) {
      // формируем строку параметров без номера страницы... номер передается параметром функции
      if ($key != 'view' and $key != 'page') {
        $uri = $uri."{$key}={$value}&amp;";
      }
    }
  }
  // формирование ссылок
  $firstpage = ''; // ссылки в начало
  $lastpage = ''; // ссылки в конец
  $page5left = ''; // пятая страница слева
  $page4left = ''; // четвёртая страница слева
  $page3left = ''; // третья страница слева
  $page2left = ''; // вторая страница слева
  $page1left = ''; // первая страница слева
  $page5right = ''; // пятая страница справа
  $page4right = ''; // четвёртая страница справа
  $page3right = ''; // третья страница справа
  $page2right = ''; // вторая страница справа
  $page1right = ''; // первая страница справа

// Проверяем нужны ли стрелки назад
  if ($page > 1) {
    $firstpage = '<a href=\"?'.$uri.'page=1\">Первая</a> | <a href=\"?'.$uri.'page='.($page - 1).'">Предыдущая</a> | ';
  }
// Проверяем нужны ли стрелки вперед
  if ($page < $total_pages) {
    $lastpage = " | <a href='?{$uri}page=".($page + 1)."'>Следующая</a> | <a href='?{$uri}page=".$total_pages."'>Последняя</a>";
  }

// Находим пять ближайших станиц с обоих сторон, если они есть
  if ($page - 5 > 0) {
    $page5left = " <a href='?{$uri}page=".($page - 5)."'>".($page - 5)."</a> | ";
  }
  if ($page - 4 > 0) {
    $page4left = " <a href='?{$uri}page=".($page - 4)."'>".($page - 4)."</a> | ";
  }
  if ($page - 3 > 0) {
    $page3left = " <a href='?{$uri}page=".($page - 3)."'>".($page - 3)."</a> | ";
  }
  if ($page - 2 > 0) {
    $page2left = " <a href='?{$uri}page=".($page - 2)."'>".($page - 2)."</a> | ";
  }
  if ($page - 1 > 0) {
    $page1left = " <a href='?{$uri}page=".($page - 1)."'>".($page - 1)."</a> | ";
  }

  if ($page + 5 <= $total_pages) {
    $page5right = " | <a href='?{$uri}page=".($page + 5)."'>".($page + 5)."</a>";
  }
  if ($page + 4 <= $total_pages) {
    $page4right = " | <a href='?{$uri}page=".($page + 4)."'>".($page + 4)."</a>";
  }
  if ($page + 3 <= $total_pages) {
    $page3right = " | <a href='?{$uri}page=".($page + 3)."'>".($page + 3)."</a>";
  }
  if ($page + 2 <= $total_pages) {
    $page2right = " | <a href='?{$uri}page=".($page + 2)."'>".($page + 2)."</a>";
  }
  if ($page + 1 <= $total_pages) {
    $page1right = " | <a href='?{$uri}page=".($page + 1)."'>".($page + 1)."</a>";
  }
  /* Постраничная навигация - вычисление (конец) */

  //Защита от ошибок, если переменные ближайших страниц не существуют
  Error_Reporting(E_ALL & ~E_NOTICE);
  echo '<div class="pstrnav">';
  echo $firstpage.$page5left.$page4left.$page3left.$page2left.$page1left."<strong>".$page."</strong>".$page1right.$page2right.$page3right.$page4right.$page5right.$lastpage;
  echo "</div>";
}
/* ===Постраничная навигация=== */

//echo date("Y-m-d H:i:s"); // 2001-03-10 17:16:18 (формат MySQL DATETIME)

/* Функция, которая форматирует дату с локализованными месяцами и днями недели */
function rusdate($format = '%DAYWEEK%, j %MONTH% Y, G:i:s', $d = null, $padezh = 1, $upper = false, $offset = 0) {
  if (is_null($d)) {
    $d = time();
  }
  if ($padezh == 1) { // родительный падеж
    $montharr = array('января', 'февраля', 'марта', 'апреля', 'мая', 'июня', 'июля', 'августа', 'сентября', 'октября', 'ноября', 'декабря');
    $dayarr = array('понедельника', 'вторника', 'среды', 'четверга', 'пятницы', 'субботы', 'воскресенья');
  } elseif ($padezh == 2) { // дательный падеж
    $montharr = array('январю', 'февралю', 'марту', 'апрелю', 'маю', 'июню', 'июлю', 'августу', 'сентябрю', 'октябрю', 'ноябрю', 'декабрю');
    $dayarr = array('понедельнику', 'вторнику', 'среде', 'четвергу', 'пятнице', 'субботе', 'воскресенью');
  } elseif ($padezh == 3) { // винительный падеж
    $montharr = array('январь', 'февраль', 'март', 'апрель', 'май', 'июнь', 'июль', 'август', 'сентябрь', 'октябрь', 'ноябрь', 'декабрь');
    $dayarr = array('понедельник', 'вторник', 'среду', 'четверг', 'пятницу', 'субботу', 'воскресенье');
  } elseif ($padezh == 4) { // творительный падеж
    $montharr = array('январём', 'февралём', 'мартом', 'апрелем', 'маем', 'июнем', 'июлем', 'августом', 'сентябрём', 'октябрём', 'ноябрём', 'декабрём');
    $dayarr = array('понедельником', 'вторником', 'средой', 'четвергом', 'пятницей', 'субботой', 'воскресеньем');
  } elseif ($padezh == 5) { // предложный падеж
    $montharr = array('январе', 'феврале', 'марте', 'апреле', 'мае', 'июне', 'июле', 'августе', 'сентябре', 'октябре', 'ноябре', 'декабре');
    $dayarr = array('понедельнике', 'вторнике', 'среде', 'четверге', 'пятнице', 'субботе', 'воскресенье');
  } else { // именительный падеж
    $montharr = array('январь', 'февраль', 'март', 'апрель', 'май', 'июнь', 'июль', 'август', 'сентябрь', 'октябрь', 'ноябрь', 'декабрь');
    $dayarr = array('понедельник', 'вторник', 'среда', 'четверг', 'пятница', 'суббота', 'воскресенье');
  }
  if ($upper) { // преобразование первой буквы в верхний регистр
    $montharr = ucfirst($montharr);
    $dayarr = ucfirst($dayarr);
  }
  $d += 3600 * $offset; // поправка часового пояса
  $sarr = array('/%MONTH%/i', '/%DAYWEEK%/i');
  $rarr = array($montharr[date("m", $d) - 1], $dayarr[date("N", $d) - 1]);
  $format = preg_replace($sarr, $rarr, $format);
  return date($format, $d);
}

/* Функция, которая преобразовывает дату из строки в формате БД MySQL (Y-m-d H:i:s) в секунды UNIX */
function strdatetosec($strdate) {
  $dt_elements = explode(' ', $strdate); // Разбиение строки на 2 части - дату и время
  $date_elements = explode('-', $dt_elements[0]); // Разбиение даты на год, месяц, день
  $time_elements = explode(':', $dt_elements[1]); // Разбиение времени часы, минуты, секунды
  return mktime($time_elements[0], $time_elements[1], $time_elements[2], $date_elements[1], $date_elements[2], $date_elements[0]); // вывод результата
}

/* Функция, которая преобразовывает дату из строки в формате БД MySQL (Y-m-d H:i:s) в массив с датой и временем */
function strdatetoarr($strdate) {
  $dt_elements = explode(' ', $strdate); // Разбиение строки на 2 части - дату и время
  $date_elements = explode('-', $dt_elements[0]); // Разбиение даты на год, месяц, день
  $time_elements = explode(':', $dt_elements[1]); // Разбиение времени часы, минуты, секунды
  $hours = $time_elements[0];
  $minutes = $time_elements[1];
  $seconds = $time_elements[2];
  $month = $date_elements[1];
  $day = $date_elements[2];
  $year = $date_elements[0];
  $date_time_array = array($hours, $minutes, $seconds, $month, $day, $year);
  return $date_time_array;
}

function strdatetotime($strdate) {
  $date_time_array = getdate(strdatetosec($strdate));
  $hours = $date_time_array['hours'];
  $minutes = $date_time_array['minutes'];
  $seconds = $date_time_array['seconds'];
  $month = $date_time_array['mon'];
  $day = $date_time_array['mday'];
  $year = $date_time_array['year'];
}

function dateofurl($date) {
  $date_elements = explode('-', $date); // Разбиение даты на год и месяц
  $yearmonth = array((int)$date_elements[0], (int)$date_elements[1]);
  return $yearmonth;
}

// преобразование даты и времени в удобный для восприятия вид
function get_datetime($datetime = '') {
  $datetime = validate($datetime,'datetime');
  if ((!empty($datetime)) or ($datetime != '1970-01-01 00:00:00')) {
    $datetime_for_view = rusdate("j %MONTH% Y, G:i:s",strdatetosec($datetime),1);
  }
  else {
    $datetime_for_view = 'не указана';
  }
  return $datetime_for_view;
}
// преобразование даты в удобный для восприятия вид
function get_date($date = '') {
  $date = validate($date,'date');
  if ((!empty($date)) or ($date != '1970-01-01')) {
    $date_for_view = rusdate("j %MONTH% Y",strdatetosec($date.' 00:00:00'),1);
  }
  else {
    $date_for_view = 'не указана';
  }
  return $date_for_view;
}


// получение html-кода ссылки сайта
function get_html_link($url = '') {
  $url = validate($url,'url');
  if (!empty($url)) {
    $url_for_view = '<a href="'.$url.'" target="_blank">'.$url.'</a>';
  }
  else {
    $url_for_view = 'не указан';
  }
  return $url_for_view;
}


function download_file($file = null){
  if (!isset($file)) {
    //$file = $_REQUEST['file'] ?: '.';
    exit;
  }
  $filename = basename($file);
  $finfo = finfo_open(FILEINFO_MIME_TYPE);
  header('Content-Type: ' . finfo_file($finfo, $file));
  header('Content-Length: '. filesize($file));
  header(sprintf('Content-Disposition: attachment; filename=%s',
    strpos('MSIE',$_SERVER['HTTP_REFERER']) ? rawurlencode($filename) : "\"$filename\"" ));
  ob_flush();
  readfile($file);
  exit;
}


function thumbsfilename($input) {
  // получаем путь и имя файла (отрезаем 4 последних символа в названии файла)
  $name = mb_substr($input, 0, -4, "UTF-8");
  // echo "Переменная \$file без 4 последних символов: ".$file_name."<br>";
  // получаем расширение файла (отрезаем все символы, кроме 4-х последних символов в названии файла)
  $extension = mb_substr($input, -4, 4, "UTF-8");
  // echo "4 последних символа в переменой \$file: ".$file_extension."<br>";
  // Прибавляем к строке идентификатор _th
  $output = $name."_th".$extension;
  // echo "Строка после добавления символов _th: ".$thumbsfile."<br>";
  return $output;
}

function get_images_path($image) {
  // вичисляем длину пути к файлам изображений
  $length = mb_strripos($image, '/', 0, "UTF-8") + 1; // strripos - вычисляет позицию последнего вхождения подстроки без учёта регистра
  // получаем путь к файлам изображений
  $path = mb_substr($image, 0, $length, "UTF-8");
  return $path;
}

// получение имени файла изображения для авторизации через социальные сети
function get_images_name($image) {
  // получаем расширение файла (отрезаем все символы, кроме 4-х последних символов в названии файла)
  $extension = mb_substr($image, -4, 4, "UTF-8");
  if (preg_match('/[.](JPG)|(jpg)|(jpeg)|(JPEG)|(gif)|(GIF)|(png)|(PNG)$/', $extension)) {
    if (mb_substr($image, -9, 5, "UTF-8") == 'photo') { // для изображений аватаров из Google
      // $total_length = mb_strlen($image,"UTF-8"); // вичисляем длину полного пути к файлу изображения
      $k = mb_strripos($image, '/', 0, "UTF-8"); // Позиция последнего вхождения символа / в строку до обрезки
      // mb_substr($a,0,$k,"UTF-8"); // путь к файлу без имени файла и последнего /
      $l = mb_strripos(mb_substr($image, 0, $k, "UTF-8"), '/', 0, "UTF-8") + 1; // Позиция последнего вхождения символа / в строку после обрезки имени файла, добавляем 1, т.к. отсчет начинается с 0
      // получаем имя изображения
      $name = mb_substr($image, $l, $k - $l, "UTF-8").$extension;
    } else {
      // вичисляем длину имени изображения
      $length = mb_strlen($image, "UTF-8") - mb_strripos($image, '/', 0, "UTF-8") - 1; // strripos - вычисляет позицию последнего вхождения подстроки без учёта регистра
      // получаем имя изображения
      $name = mb_substr($image, -$length, $length, "UTF-8");
    }
  } else {
    // вычисляем время в настоящий момент
    $date = time();
    // именем будет текущее время, чтобы у аватаров не было одинаковых имен
    $name = $date.'.jpg';
  }
  return $name;
}

function get_screenshots($path, $files) {
  // получаем полные пути к файлам изображений и к файлам миниатюр
  $images = array();
  $thumbs = array();
  $images_path = array();
  $thumbs_path = array();
  $img = array();
  $screenshots = '';
  $images = explode(',', $files); // получаем массив изображений
  $count = count($images); // определяем количество изображений в массиве
  // print_array($images); echo $count;
  $i = 0;
  while ($i < $count) {
    // получаем файлы миниатюр с расширениями
    $img = explode('.', $images[$i]);
    if ((!empty($img[0])) and (!empty($img[1]))) {
      $thumbs[$i] = $img[0].'_th.'.$img[1]; // имя файла миниатюр
      $images_path[$i] = $path.$images[$i]; // получаем полные пути к файлам
      $thumbs_path[$i] = $path.$thumbs[$i]; // получаем полные пути к миниатюрам
      $screenshots = $screenshots.'<a class="fancyboxscreenshot" href="'.$images_path[$i].'" target="_blank" title="Скриншот '.($i + 1).'"><img alt="Скриншот '.($i + 1).'" class="screenshotimage" src="'.$thumbs_path[$i].'" title="Скриншот '.($i + 1).'"></a>';
    }
    $i = $i + 1;
  }
  // print_array($thumbs);
  // print_array($images_path);
  // print_array($thumbs_path);
  return $screenshots;
}

function get_galleryimages($path, $files) {
  // получаем полные пути к файлам изображений и к файлам миниатюр
  $images = array();
  $images_path = array();
  $images = explode(',', $files); // получаем массив изображений
  $count = count($images); // определяем количество изображений в массиве
  // print_array($images); echo $count;
  $i = 0;
  $gallery_images = "";
  while ($i < $count) {
    $images_path[$i] = $path.$images[$i]; // получаем полные пути к файлам
    $gallery_images = $gallery_images."<a class='fancyboxgallery' href='".$images_path[$i]."' target='_blank' title='Картинка ".($i + 1)."'>
        <img alt='Картинка ".($i + 1)."' class='galleryimage' src='".$images_path[$i]."' title='Картинка ".($i + 1)."'></a>";
    $i = $i + 1;
  }
  // print_array($images_path);
  return $gallery_images;
}

// получение адреса аватара для авторизации через социальные сети
function get_avatar($photo) {
  // если переменная $photo существует, то копируем его в нужную папку
  if (isset($photo)) {
    $filename = get_images_name($photo); // получаем имя файла
    $path_to_90_directory = 'images/users/avatars/'; //папка, куда будет загружаться исходная картинка
    $destination = $_SERVER['DOCUMENT_ROOT'].'/'.$path_to_90_directory.$filename;
    if (copy($photo, $destination)) {
      // заносим в переменную путь до аватара
      $avatar = $path_to_90_directory.$filename;
    } else {
      $avatar = DAVATAR;
    }
  } else {
    $avatar = DAVATAR;
  }
  // конец процесса загрузки и присвоения переменной $avatar адреса загруженной авы
  return $avatar;
}

// получение одного адреса электронной почты
function get_one_email($email = null, $first_name = null, $letter_type = 0) {
  if ((empty($email)) or (!preg_match("/([a-z0-9_\.\-])+\@(([a-z0-9\-])+\.)+([a-z0-9]{2,4})+/i", $email))) {
    //echo $email;
    return false;
  }
  $array['email'] = trim($email);
  $array['first_name'] = trim($first_name);
  $array['letter_type'] = (int)$letter_type; // обычное текстовое письмо
  $output_array[] = $array;
  return $output_array;
}

// получение данных пользователей из текстового поля для отправки почты
function get_emails($input_string = '') {
  if (!is_string($input_string)) {
    return false;
  }
  $clean_string = preg_replace('#((?<!\d{4}(-\d{2}){2})[ \t]+)|([ \t]+(?!(\d{2}:){2}\d{2}))#u', '', $input_string); // убираем все пробелы и табуляции
  // ((?<!\d{4}(-\d{2}){2})[\t ]+)|([\t ]+(?!(\d{2}:){2}\d{2})) - ищем либо все пробелы и табуляции, сзади которых
  // нет цифр в формате ГГГГ-ММ-ДД, либо все пробелы и табуляции, впереди которых нет цифр в формате ЧЧ:ММ:СС
  $users_data = preg_split('#((?<!\d{4}(-\d{2}){2})\s+)|(\s+(?!(\d{2}:){2}\d{2}))#u', $clean_string, null, PREG_SPLIT_NO_EMPTY); // разбиваем текстовые строки на данные пользователя
  // '#((?<!\d{4}(-\d{2}){2})\s+)|(\s+(?!(\d{2}:){2}\d{2}))#u' - ищем либо все пробельные символы, сзади которых
  // нет цифр в формате ГГГГ-ММ-ДД, либо все пробельные символы, впереди которых нет цифр в формате ЧЧ:ММ:СС
  $blackemails = get_blackemails('users'); // получаем массив заблокированных email-адресов пользователей (админские адреса проходят)
  $_SESSION['blackemail'] = ''; // чистим сообщения в чёрном списке
  $output_array = array(); // объявляем массив
  foreach ($users_data as $key => $item) {
    //$array = str_getcsv($item,',','','\\'); // функция str_getcsv работает на PHP 5.3 и выше
    $array = explode(',', $item); // разбиваем данные пользователя на отдельные элементы
    foreach ($array as $key => $value) {
      if (!empty($array[0])) {
        $array['email'] = $array[0];
      }
      unset($array[0]);
      if (!empty($array[1])) {
        $array['first_name'] = $array[1];
      }
      unset($array[1]);
      if (!empty($array[2])) {
        $array['last_name'] = $array[2];
      }
      unset($array[2]);
      if (isset($array[3])) {
        $array['letter_type'] = (int)$array[3];
      }
      unset($array[3]);
      if (!empty($array[4])) {
        $array['login'] = $array[4];
      }
      unset($array[4]);
      if (!empty($array[5])) {
        $array['site'] = $array[5];
      }
      unset($array[5]);
      if (!empty($array[6])) {
        $array['reg_date'] = $array[6];
      }
      unset($array[6]);
      if (!empty($array[7])) {
        $array['login_date'] = $array[7];
      }
      unset($array[7]);
      if (!empty($array[8])) {
        $array['birthday'] = $array[8];
      }
      unset($array[8]);
      if (isset($array[9])) {
        $array['gender'] = (int)$array[9];
      }
      unset($array[9]);
      if ($key > 9) {
        unset($array[$key]);
      } // удаление лишних элементов, если они есть
    }
    if ((empty($array['email'])) or (!preg_match("/([a-z0-9_\.\-])+\@(([a-z0-9\-])+\.)+([a-z0-9]{2,4})+/i", $array['email']))) {
      //echo 'Неверный емайл'; // перебираем дальше
      continue;
    } else {
      // сверка email подписчиков с чёрным списком email адресов
      $isset_blackemail = 0; // флаг указатель что email в чёрном списке есть
      foreach ($blackemails as $val) {
        if ($array['email'] == $val['email']) {
          $isset_blackemail = 1;
          $_SESSION['blackemail'] = $_SESSION['blackemail'].'<div class="yellowfon">Email адрес <a href="mailto:'.$array['email'].'" target="_blank">'.$array['email'].'</a> находится в чёрном списке. Письмо на адрес адрес <a href="mailto:'.$array['email'].'" target="_blank">'.$array['email'].'</a> не отправлено.</div>';
        }
      }
      if ($isset_blackemail == 0) { // если email не найден, то оставляем его вместе с другими данными для дальнейшей обработки
        $output_array[] = $array;
      } else {
        continue;
      }
    }
  }
  return $output_array;
}

// получение данных пользователей из текстового файла для отправки почты
function get_emails_from_file($filename = null) {
  $users_data = file_get_contents($filename['tmp_name'], true);
  $output_array = get_emails(iconv("cp1251", "UTF-8", (string)$users_data));
  return $output_array;
}

// сверка email подписчиков с чёрным списком email адресов
function filter_blacklist($array = array()) {
  if (!is_array($array)) {
    $array = array();
  }
  $blackemails = get_blackemails();
  //print_array($blackemails);

  foreach ($array as $item) {
    $isset_email = 0; // флаг указатель что email в чёрном списке есть
    foreach ($blackemails as $val) {
      if ($item['email'] == $val['email']) {
        $isset_email = 1;
      }
    }
    if ($isset_email == 0) { // если email не найден, то оставляем его вместе с другими данными для дальнейшей обработки
      $newarray[] = $item;
    }
  }
  // print_array($newarray);
  return $newarray;
}


// импорт подписчиков в базу данных
function import_subscribers() {
  if (!empty($_FILES['emailfile']['name'])) { // если значение name в массиве &_FILES не пустое, то
    //print_array($_FILES);
    // получаем получаем адреса и данные пользователей из файла
    $import_subscribers = get_emails_from_file($_FILES['emailfile']);
  } else {
    //print_array($_POST);
    // получаем адреса и данные пользователей из списка
    $import_subscribers = get_emails($_POST['emaillist']);
  }
  //print_array($import_subscribers);
  // получаем список адресов имеющихся подписчиков из базы данных
  $all_users = get_subscriber_emails();
  // print_array($all_users);
  $_SESSION['logmessage'] = ''; // удаляем предыдущее сообщение, если оно есть в сессиях
  $count_insert_email = 0; // зануляем счётчик вставленных email-адресов
  foreach ($import_subscribers as $item) {
    $isset_user = 0; // флаг указатель что пользователь с таким email уже есть
    foreach ($all_users as $val) {
      if ($item['email'] == $val['email']) {
        $isset_user = 1;
        //echo '<hr>';
        //print_array($item);
        //echo '<br><br>';
        //print_array($val);
        //echo '<hr>';
      }
    }
    if ($isset_user == 0) { // если пользователь с таким email не найден, то добавляем его в базу данных
      if (insert_subscriber_emails($item)) {
        $_SESSION['logmessage'] = $_SESSION['logmessage'].'<div class="green1">Подписчик '.$item['email'].' в базу данных добавлен.</div>';
        $count_insert_email = $count_insert_email + 1;
      } else {
        $_SESSION['logmessage'] = $_SESSION['logmessage'].'<div class="red1">Подписчик '.$item['email'].' в базу данных не добавлен.</div>';
      }
      //print_array($item);
    } else {
      $_SESSION['logmessage'] = $_SESSION['logmessage'].'<div class="blue1">Подписчик '.$item['email'].' уже есть в базе данных. Подписчик '.$item['email'].' не добавлен.</div>';
    }
  }
  if ($count_insert_email > 0) {
    $_SESSION['logmessage'] = $_SESSION['logmessage'].'<div class="bold">Итого добавлено '.$count_insert_email.' email адресов.</div>';
  } else {
    $_SESSION['logmessage'] = $_SESSION['logmessage'].'<div class="bold">Ни одного email адреса не добавлено.</div>';
  }
  return true;
}

function secret_check($secret = null) {
  $secret_flag = '';
  if ($secret == 1) {
    if (isset($_SESSION['secret_access']) and ($_SESSION['secret_access'] == true)) {
      $secret_flag = ' <span class="green1" title="Секретно! Доступ открыт!">(&#9679)</span>';
    } else {
      $secret_flag = ' <span class="red1" title="Секретно! Доступ закрыт!">(&#215)</span>';
    }
  }
  return $secret_flag;
}

function get_size($b) {
  $b = (int)$b;
  if (empty($b)) { // если $b - не число
    $size = $b." байт"; // 0 байт
  } else { // если $b - число
    $length = mb_strlen((string)$b, "UTF-8"); // echo "<p>Длина строки \$length=".$length."</p>";
    if ($length < 4) {
      $size = $b." байт";
    } else {
      $kb = round($b / 1024, 2);
      if ($length < 7) {
        $size = $kb." Кб (".$b." байт)";
      } else {
        $mb = round($kb / 1024, 2);
        if ($length < 10) {
          $size = $mb." Мб (".$b." байт)";
        } else {
          $gb = round($mb / 1024, 2);
          if ($length < 13) {
            $size = $gb." Гб (".$b." байт)";
          } else {
            $tb = round($gb / 1024, 2);
            if ($length < 16) {
              $size = $tb." Тб (".$b." байт)";
            }
          }
        }
      }
    }
  }
  return $size;
}

// получает из гигабайтов, мегабайтов, килобайтов байты
// если размер указан в сокращённом виде, например 10G или 50M, то получаем размер в байтах тип integer
function get_bytes($val = 0) {
  if (empty($val)) {return 0;}
  $val = trim($val);
  $last = strtolower($val[strlen($val) - 1]); // получаем последний символ
  if ((string)$last == 'g') {
    $bytes = (int)$val * 1024 * 1024 * 1024; // Модификатор 'G' доступен, начиная с PHP 5.1.0
  }
  elseif((string)$last == 'm') {
    $bytes = (int)$val * 1024 * 1024;
  }
  elseif((string)$last == 'k') {
    $bytes = (int)$val * 1024;
  }
  else {
    $bytes = (int)$val;
  }
  return $bytes;
}


// получение IP-адреса
function get_ip() {
  $ip = '127.0.0.1';
  if (getenv('HTTP_CLIENT_IP')) { // получаем значение константы HTTP_CLIENT_IP
    $ip = getenv('HTTP_CLIENT_IP');
  }
  elseif (getenv('HTTP_X_FORWARDED_FOR')) {
    $ip = getenv('HTTP_X_FORWARDED_FOR');
  }
  elseif (getenv('HTTP_X_FORWARDED')) {
    $ip = getenv('HTTP_X_FORWARDED');
  }
  elseif (getenv('HTTP_FORWARDED_FOR')) {
    $ip = getenv('HTTP_FORWARDED_FOR');
  }
  elseif (getenv('HTTP_FORWARDED')) {
    $ip = getenv('HTTP_FORWARDED');
  }
  else {
    $ip = getenv('REMOTE_ADDR'); // $_SERVER['REMOTE_ADDR'];
  }
  return $ip;
}

// проверка доступности сайта
function isDomainAvailible($url) {
  // Проверка правильности URL
  if(!filter_var($url, FILTER_VALIDATE_URL)){
      return false;
  }
  $agent = "Mozilla/5.0 (Windows NT 6.2; WOW64; rv:17.0) Gecko/20100101 Firefox/17.0";

  $curlInit = curl_init($url); // инициализация cURL

  // Установка параметров запроса
  // curl_setopt($curlInit, CURLOPT_URL, $url); // Установка URL
  curl_setopt($curlInit,CURLOPT_USERAGENT, $agent); // Указываю USERAGENT браузера
  curl_setopt($curlInit,CURLOPT_CONNECTTIMEOUT,5); // количество секунд ожидания при попытке соединения, если 0 - ждать бесконечно
  curl_setopt($curlInit,CURLOPT_HEADER,true); // выводить заголовки
  curl_setopt($curlInit,CURLOPT_NOBODY,true); // исключить тело ответа из вывода
  curl_setopt($curlInit,CURLOPT_FOLLOWLOCATION, true); // следовать за любым заголовком Location
  curl_setopt($curlInit,CURLOPT_RETURNTRANSFER,true); // возврат результата передачи в качестве строки
  curl_setopt($curlInit, CURLOPT_VERBOSE, false); // отключение вывода отладочной информации
  curl_setopt($curlInit, CURLOPT_TIMEOUT, 5); // установка максимально позволенного количества секунд для выполнения cURL-функций

  $response = curl_exec($curlInit); // получение ответа
  //curl_exec($curlInit);

  //$httpcode = curl_getinfo($curlInit, CURLINFO_RESPONSE_CODE); // Получение кода HTTP ответа CURLINFO_HTTP_CODE

  curl_close($curlInit); // закрываем CURL

  // если ответ от сервера > 200 - тогда сайт доступен
  //if ($httpcode >= 200 && $httpcode < 300) {
  if (!empty($response)) { // если ответ не пустой, то возвращаем true
    return true;
  } else {
    return false;
  }
}

// функция перевода текста в транслит
// $str - текст сообщения в кириллице
function translit_text($str) {
  $translit = array(
    "А" => "A", "Б" => "B", "В" => "V", "Г" => "G", "Д" => "D", "Е" => "E", "Ё" => "YO", "Ж" => "ZH", "З" => "Z", "И" => "I", "Й" => "J",
    "К" => "K", "Л" => "L", "М" => "M", "Н" => "N", "О" => "O", "П" => "P", "Р" => "R", "С" => "S", "Т" => "T", "У" => "U", "Ф" => "F", "Х" => "H",
    "Ц" => "TS", "Ч" => "CH", "Ш" => "SH", "Щ" => "SCH", "Ъ" => "\"", "Ы" => "Y", "Ь" => "'", "Э" => "E", "Ю" => "YU", "Я" => "YA",
    "а" => "a", "б" => "b", "в" => "v", "г" => "g", "д" => "d", "е" => "e", "ё" => "yo", "ж" => "zh", "з" => "z", "и" => "i", "й" => "j",
    "к" => "k", "л" => "l", "м" => "m", "н" => "n", "о" => "o", "п" => "p", "р" => "r", "с" => "s", "т" => "t", "у" => "u", "ф" => "f", "х" => "h",
    "ц" => "ts", "ч" => "ch", "ш" => "sh", "щ" => "sch", "ъ" => "\"", "ы" => "y", "ь" => "'", "э" => "e", "ю" => "yu", "я" => "ya");
  return strtr($str, $translit);
}

// функция для преобразования кириллического текста в транслит с сохранением некоторых букв
function translit($input, $noloss = false) {
  if ($noloss == true) {
    $replace1 = array('Ъ' => '"\'', 'Ь' => '\'\'', 'Э' => 'E\'', 'э' => 'e\'');
    $input = strtr((string)$input, $replace1);
  }
  //echo 'Промежуточный вывод: '.$input.'<br><br>';
  $replace = array(
    'А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G', 'Д' => 'D', 'Е' => 'E',
    'Ё' => 'YO', 'Ж' => 'ZH', 'З' => 'Z', 'И' => 'I', 'Й' => 'J', 'К' => 'K',
    'Л' => 'L', 'М' => 'M', 'Н' => 'N', 'О' => 'O', 'П' => 'P', 'Р' => 'R',
    'С' => 'S', 'Т' => 'T', 'У' => 'U', 'Ф' => 'F', 'Х' => 'H', 'Ц' => 'TS',
    'Ч' => 'CH', 'Ш' => 'SH', 'Щ' => 'SCH', 'Ъ' => '"', 'Ы' => 'Y', 'Ь' => '\'',
    'Э' => 'E', 'Ю' => 'YU', 'Я' => 'YA',

    'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e',
    'ё' => 'yo', 'ж' => 'zh', 'з' => 'z', 'и' => 'i', 'й' => 'j', 'к' => 'k',
    'л' => 'l', 'м' => 'm', 'н' => 'n', 'о' => 'o', 'п' => 'p', 'р' => 'r',
    'с' => 's', 'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'ts',
    'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sch', 'ъ' => '"', 'ы' => 'y', 'ь' => '\'',
    'э' => 'e', 'ю' => 'yu', 'я' => 'ya');
  return strtr((string)$input, $replace);
}

// функция для преобразования транслита в кириллический текст
function antitranslit($input, $noloss = false) {
  if ($noloss == true) {
    $replace1 = array('"\'' => 'Ъ', '\'\'' => 'Ь', 'E\'' => 'Э', 'e\'' => 'э');
    $input = strtr((string)$input, $replace1);
  }
  // echo 'Промежуточный вывод: '.$input.'<br><br>';
  $replace = array(
    'A' => 'А', 'B' => 'Б', 'V' => 'В', 'G' => 'Г', 'D' => 'Д', 'E' => 'Е',
    'YO' => 'Ё', 'ZH' => 'Ж', 'Z' => 'З', 'I' => 'И', 'J' => 'Й', 'K' => 'К',
    'L' => 'Л', 'M' => 'М', 'N' => 'Н', 'O' => 'О', 'P' => 'П', 'R' => 'Р',
    'S' => 'С', 'T' => 'Т', 'U' => 'У', 'F' => 'Ф', 'H' => 'Х', 'TS' => 'Ц',
    'CH' => 'Ч', 'SH' => 'Ш', 'SCH' => 'Щ', 'Y' => 'Ы', 'YU' => 'Ю', 'YA' => 'Я',

    'a' => 'а', 'b' => 'б', 'v' => 'в', 'g' => 'г', 'd' => 'д', 'e' => 'е',
    'yo' => 'ё', 'zh' => 'ж', 'z' => 'з', 'i' => 'и', 'j' => 'й', 'k' => 'к',
    'l' => 'л', 'm' => 'м', 'n' => 'н', 'o' => 'о', 'p' => 'п', 'r' => 'р',
    's' => 'с', 't' => 'т', 'u' => 'у', 'f' => 'ф', 'h' => 'х', 'ts' => 'ц',
    'ch' => 'ч', 'sh' => 'ш', 'sch' => 'щ', '"' => 'ъ', 'y' => 'ы', '\'' => 'ь',
    'yu' => 'ю', 'ya' => 'я');
  return strtr((string)$input, $replace);
}

// функция для преобразования строки в url-адрес
function string2url($s, $cyrillic = true) {
  $s = trim(strip_tags(html_entity_decode((string)$s, ENT_QUOTES | ENT_XHTML, 'utf-8'))); // убираем HTML-теги, символы &nbsp; &quot; &lt; &gt; лишние пробелы в начале и в конце строк
  //echo 'Без HTML-тегов, спецсимволов и пробелов в начале/в конце строки: '.$s.'<br>';
  $s = function_exists('mb_strtolower') ? mb_strtolower($s, 'utf-8') : strtolower($s); // переводим строку в нижний регистр (иногда надо задать локаль)
  //echo 'В нижнем регистре: '.$s.'<br>';
  if ($cyrillic == true) { // оставлять кириллические символы
    $s = translit($s); // преобразование в транслит
    $pattern = '#[^-0-9a-zа-яё\s]+#u';
  }
  else { // убирать кириллические символы
    $pattern = '#[^-0-9a-z\s]+#u';
  }
  $s = preg_replace($pattern, '', $s); // очищаем строку от недопустимых символов (оставляем дефис, цифры, буквы, пробельные символы)
  //echo 'Без лишних символов: '.$s.'<br>
  $s = preg_replace('#[-\s]+#u', '-', $s); // заменяем пробелы и лишние дефисы одним дефисом
  $s = trim($s, '-'); // удаляем начальные и конечные дефисы
  $s_length = mb_strlen($s, 'utf-8'); // вычисляем длину полученной строки
  // echo 'Длина строки: '.$s_length.'<br><br>';
  if ($s_length > 255) { // если длина строки больше 255 символов,
    $s = mb_substr($s, 0, 255, 'utf-8'); // то отрезаем её до 255 символов
  };
  return $s; // возвращаем результат
}

// функция для транслитерации и преобразования строки в буквенно-числовой вид с подчеркиваниями и дефисами, например stroka_preobrazovannaya_v_translit
// может применяться для получения имён файлов
function translit2($input, $lower_ext = true) {
  $replace = array(
    'А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G', 'Д' => 'D', 'Е' => 'E',
    'Ё' => 'Yo', 'Ж' => 'Zh', 'З' => 'Z', 'И' => 'I', 'Й' => 'J', 'К' => 'K',
    'Л' => 'L', 'М' => 'M', 'Н' => 'N', 'О' => 'O', 'П' => 'P', 'Р' => 'R',
    'С' => 'S', 'Т' => 'T', 'У' => 'U', 'Ф' => 'F', 'Х' => 'H', 'Ц' => 'Ts',
    'Ч' => 'Ch', 'Ш' => 'Sh', 'Щ' => 'Sch', 'Ъ' => '', 'Ы' => 'Y', 'Ь' => '',
    'Э' => 'E', 'Ю' => 'Yu', 'Я' => 'Ya',

    'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e',
    'ё' => 'yo', 'ж' => 'zh', 'з' => 'z', 'и' => 'i', 'й' => 'j', 'к' => 'k',
    'л' => 'l', 'м' => 'm', 'н' => 'n', 'о' => 'o', 'п' => 'p', 'р' => 'r',
    'с' => 's', 'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'ts',
    'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sch', 'ъ' => '', 'ы' => 'y', 'ь' => '',
    'э' => 'e', 'ю' => 'yu', 'я' => 'ya');
  $s = strtr((string)$input, $replace);
  $s = trim(strip_tags(html_entity_decode($s, ENT_QUOTES | ENT_XHTML, 'utf-8'))); // убираем HTML-теги, символы &nbsp; &quot; &lt; &gt; лишние пробелы в начале и в конце строк
  //echo 'Без HTML-тегов, спецсимволов и пробелов в начале/в конце строки: '.$s.'<br>';
  if (isset($lower_ext)) {
    // получаем расширение файла
    $ext = getExtension($s);
    if(isset($ext)) { // если расширение не пустое, то преобразуем его в нижний регистр
      $ext = function_exists('mb_strtolower') ? mb_strtolower($ext, 'utf-8') : strtolower($ext); // переводим строку в нижний регистр (иногда надо задать локаль)
    }
    $filename = pathinfo($s, PATHINFO_FILENAME);
    $s = $filename.'.'.$ext;
    //echo 'Расширение в нижнем регистре: '.$s.'<br>';
  }
  $s = preg_replace('#[^-_0-9A-Za-z\s\.]+#u', '', $s); // очищаем строку от недопустимых символов (оставляем подчёркивание, дефис, точку, цифры, буквы, пробельные символы)
  //echo 'Без лишних символов: '.$s.'<br>
  $s = preg_replace('#[-]+#u', '-', $s); // заменяем лишние дефисы одним дефисом
  $s = preg_replace('#[_\s]+#u', '_', $s); // заменяем лишние подчёркивания и пробелы одним подчёркиванием
  $s = trim($s, '_'); // удаляем начальные и конечные подчёркивания
  return $s;
}

// получение расширения файла по его имени
function getExtension($filename) {
  //$extension1 = end(explode('.', $filename));
  // используя функцию explode(), полученная строка преобразуется в массив строк, границами которых в оригинале был
  // разделитесь «точка». И все бы хорошо, если речь идет об имени файла в стиле «file.txt», но как быть если точек
  // несколько? Для этого end() возвращает последний элемент массива, т.е. то, что было после последней точки.
  $extension2 = pathinfo($filename,PATHINFO_EXTENSION);
  // Здесь на помощь приходит функция pathinfo(), которая возвращает ассоциативный массив, содержащий информацию
  // о нужном нам файле. И если ваша задача узнать не только расширение файла, а так же полный путь к нему и полное
  // имя файла, то этот способ для вас: массив, возвращаемый данной функцией, содержит элементы dirname, basename
  // и extension - в них вся нужная информация.
  //$extension3 = substr($filename, strrpos($filename, '.') + 1);
  // В данном случае strrpos() возвращает позицию последней точки в строке, а substr() вырезает все символы,
  // начиная с полученной ранее позиции точки, до конца строки. Чтобы избавится от самой точки в полученной
  // подстроке, мы увеличивает начало старта на одно смещение вправо (+1).
  //$extension4 = ltrim(strrchr($filename, '.'),'.');
  //$extension5 = substr(strrchr($filename, '.'), 1);
  // strrchr() возвращает участок строки, следующий за указанным параметром (точкой в нашем случае), после чего
  // substr() отрезает первый символ - точку.
  //$extension6 = array_pop(explode('.', $filename));
  // array_pop() - выталкивает элемент в конце массива, end() - устанавливает внутренний указатель массива на
  // последний элемент.
  //$extension7 = preg_replace('#.+\.([a-z]+)$#i', '$1', $filename);
  $extension = function_exists('mb_strtolower') ? mb_strtolower($extension2, 'utf-8') : strtolower($extension2); // переводим расширение в нижний регистр
  return strtolower($extension);
}


/**
 * Обрезает строку до определённого количества символов не разбивая слова.
 * @param string $str строка
 * @param int $length длина, до скольки символов обрезать
 * @param string $postfix постфикс, который добавляется к строке
 * @return string обрезанная строка
 * http://zabolotskikh.com/functions/kak-obrezat-stroku-po-slovam-php/
 */
function cutStr($str, $length=50, $postfix='...'){
  if (strlen($str) <= $length) {
    return $str;
  }
  $temp = substr($str, 0, $length);
  return substr($temp, 0, strrpos($temp, ' ') ).$postfix;
}

/**
 * Обрезает строку до определённого количества символов не разбивая слова.
 * Поддерживает многобайтовые кодировки.
 * @param string $str строка
 * @param int $length длина, до скольки символов обрезать
 * @param string $postfix постфикс, который добавляется к строке
 * @param string $encoding кодировка, по-умолчанию 'UTF-8'
 * @return string обрезанная строка
 * http://zabolotskikh.com/functions/kak-obrezat-stroku-po-slovam-php/
 */
function mbCutString($str, $length, $postfix='...', $encoding='UTF-8'){
  if (mb_strlen($str, $encoding) <= $length) {
    return $str;
  }
  $tmp = mb_substr($str, 0, $length, $encoding);
  return mb_substr($tmp, 0, mb_strripos($tmp, ' ', 0, $encoding), $encoding).$postfix;
}






// смена внешнего вида
function change_template() {
  // присваиваем переменной $template значение, выбранное пользователем
  if (isset($_POST['template'])) {
    $template = $_POST['template'];
  }
  // запоминаем в куки выбранный шаблон, время жизни куки 60 сек * 60 мин * 24 часа * 365 дней = 31 536 000 сек = 1 год
  setcookie('template', $template, time() + 31536000);
}

// функция для генерации случайной строки
// источник https://code.tutsplus.com/ru/tutorials/generate-random-alphanumeric-strings-in-php--cms-32132
function generate_string($input = PERMITTED_CHARS, $strength = 16) {
  $input_length = strlen($input); // определяем длину исходной строки, по умолчанию равна 64 символам из набора PERMITTED_CHARS - как ID-youtube-видео
  $random_string = '';
  for($i = 0; $i < $strength; $i++) {
    $random_character = $input[mt_rand(0, $input_length - 1)]; // в PHP7 mt_rand можно заменить на random_int - Генерирует криптографически безопасные псевдослучайные целые числа
    $random_string .= $random_character;
  }
  return $random_string;
}

// функция для получения короткой ссылки
function get_short_link($domen = DOMEN) {
  $short_link = $domen.S.generate_string(PERMITTED_CHARS, 8); // получение короткой ссылки типа http://rolar.ru/KShslf25
  return $short_link;
}

// функция для получения секретной ссылки для скачивания курса по cisco
function get_secret_link($id=null) {
  if (isset($id) and (abs((int)$id) > 0)) {
    $id = abs((int)$id);
  }
  else {
    $id = 1;
  }
  // echo 'stroka';
  // http://localhost/lessons/onetime/get_file.php?hash=stroka
  $hash = md5($id.microtime()); // генерация случайной строки (хеша)
  $file = 'hash.txt';
  $fd = fopen($file,'a'); // создание файла для записи хеша
  if(!$fd) { // проверка открытия файла
    echo 'Не возможно открыть файл';
    return 0; // принудительный выход из функции
  }
  if(!flock($fd,LOCK_EX)) { // временная блокировка файла
    echo 'Блокировка файла не удалась';
    return 0; // принудительный выход из функции
  }
  fwrite($fd,$hash."\n"); // запись хеша в файл
  if(!flock($fd,LOCK_UN)) { // разблокировка файла
    echo 'Не возможно разблокировать файл';
    return 0; // принудительный выход из функции
  }
  fclose($fd);
  $path = substr($_SERVER['PHP_SELF'],0,strrpos($_SERVER['PHP_SELF'],'/'));
  $secret_link = 'http://'.$_SERVER['HTTP_HOST'].$path.S.'cisco/getfile?hash='.$hash; // 'http://'.$_SERVER['HTTP_HOST'].$path.'/get_file.php?id='.$id.'&amp;hash='.$hash;
  // $secret_link = '<p>Ваша ссылка для скачивания <a href="http://'.$_SERVER['HTTP_HOST'].$path.'/download_file.php?id='.$id.'&amp;hash='.$hash.'" target="_blank">http://'.$_SERVER['HTTP_HOST'].$path.'/download_file.php?id='.$id.'&amp;hash='.$hash.'</a></p>';
  return $secret_link;
}

// функция для проверки секретного файла для скачивания (курс по cisco)
function check_download_file($hash,$id=null){
  //if (isset($id) and (abs((int)$id) > 0)) {
  //    $id = abs((int)$id);
  //}
  //else {
  //    $id = 1;
  //}
  $secret_file = P.DOWNLOAD_DOMEN.S.SECRET_FILE; // ссылка на секретный файл http://rolar.ddns.net/cisco/ccna.iso , константа PATH_TO_SECRET_FILE - не используется
  $file = 'hash.txt';
  $check = false;
  // $hash = $_GET['hash'];
  if (mb_strlen($hash,'UTF-8') != 32) {
    echo 'Неправильная ссылка';
    return false; // принудительный выход из функции
  }
  $arr = file($file); // получение данных из файла хешей
  $fd = fopen($file,'w'); // открытие файла для записи
  if(!$fd) {
    exit('Не возможно открыть файл'); // принудительный выход из функции
    //return false;
  }
  if(!flock($fd,LOCK_EX)) {
    echo 'Блокировка файла не удалась';
    return false; // принудительный выход из функции
  }
  $count = count($arr); // подсчёт элементов массива
  for ($i = 0; $count > $i; $i++) { // проверка наличия хеша в файле
    if($hash == rtrim($arr[$i])) {
      $check = true; // проверка прошла успешно, в этом случае хеш в файл не записывается
    }
    else {
      fwrite($fd,$arr[$i]); // перезаписываем строки
    }
  }
  if(!flock($fd,LOCK_UN)) {
    echo 'Не возможно разблокировать файл';
    return false; // принудительный выход из функции
  }
  fclose($fd);
  if($check) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/rar'); // header('Content-Type: application/iso');
    header('Content-Disposition: attachment; filename='.basename($secret_file));
    header('Content-Transfer-Encoding:binary');
    header('Content-Length: '.filesize($secret_file)); // header('Content-Length: 9022908416'); //9022908416 байт .filesize($secret_file)
    ob_clean(); // очистка буфера
    flush(); // функция очистки буфера, но не закрывает буферизацию
    readfile($secret_file);
    exit();
  }
  else {
    // echo 'Не правильная ссылка';
    return false; // принудительный выход из функции
  }
}




// функция валидации пути к файлу - ВОЗМОЖНО ТРЕБУЕТСЯ ДОРАБОТКА и проверка
function validate_path($path = '') {
  if (empty($path)) {return false;}
  $regexp1 = '#^[*|\\\:"<>?/\s]+|[*|:"<>?]+|[\s]+$#'; // недопустимые символы в имени директорий - ВОЗМОЖНО ТРЕБУЕТСЯ ДОРАБОТКА и проверка, в windows пропадают символы ":" идущие в D:\dir1
  $regexp2 = '#\\\+#'; // прямые слеши
  $regexp3 = '#(\s){2,}|(/){2,}#'; // двойные пробелы, обратные слеши
  //debug($path);
  $path = preg_replace($regexp1, '', (string)$path); // чистим имена директорий от недопустимых символов
  //$path = realpath($path);
  //debug($path);
  $path = preg_replace($regexp2, '/', $path); // прямые слеши заменяем на обратные
  //debug($path);
  $path = preg_replace($regexp3, '$1$2', $path); // убираем двойные пробелы и двойные обратные слеши
  //debug($path);
  return $path;
}

// функция валидации имени файла
function validate_file_name($file_name = '') {
  if (empty($file_name))
    return false;
  $regexp1 = '#[*|\\\:"<>?/]+#'; // недопустимые символы в имени файла
  $regexp2 = '#^(\s)+|(\s)+$#'; // пробелы в начале и в конце строки, двойные пробелы в середине строки
  $regexp3 = '#(\s){2,}#'; // повторяющиеся пробелы в середине строки
  //pr($file_name);
  $file_name = preg_replace($regexp1, '', (string)$file_name); // чистим имена файлов от недопустимых символов
  //pr($file_name);
  $file_name = preg_replace($regexp2, '', $file_name); // убираем двойные пробелы
  //pr($file_name);
  $file_name = preg_replace($regexp3, ' ', $file_name); // заменяем повторяющиеся пробелы на один пробел
  //pr($file_name);
  return $file_name;
}

// функция удаления файла
function delete_file($file = null) {
  if (!isset($file)) {return false;}
  if ((file_exists($file)) and (is_file($file))) { // если файл существует
    @unlink($file); // удаляем файл
  }
  return true;
}


/* Функция для сортировки массива файлов */
function sort_files($files, $by = 'type', $order = SORT_ASC) {
  if (!is_array($files)) {
    return false;
  }
  if ($order != SORT_ASC or $order != SORT_DESC) {
    $order == SORT_ASC;
  }
  $by_array = array('none', 'name', 'type', 'time', 'size'); // допустимые значения
  if (in_array($by, $by_array)) { // если параметр $by содержится в массиве $by_array, то выполняем сортировку
    switch ($by) {
      case('name'): // сортировка по имени
        $basenames = array();
        // Получение списка столбцов
        foreach ($files as $key => $value) {
          $basenames[$key] = strtolower($value['basename']); // приведение к нижнему регистру
        }
        //pr($basenames);
        // Сортируем данные по extension и по basename по возрастанию
        // Добавляем $files в качестве последнего параметра, для сортировки по общему ключу
        array_multisort($basenames, $order, SORT_LOCALE_STRING, $files);
        break;
      case('type'): // сортировка по расширению и имени
        $basenames = array();
        $extensions = array();
        // Получение списка столбцов
        foreach ($files as $key => $value) {
          $basenames[$key] = strtolower($value['basename']); // приведение к нижнему регистру
          $extensions[$key] = strtolower($value['extension']); // приведение к нижнему регистру
        }
        //pr($basenames);
        //pr($extensions);
        // Сортируем данные по extension и по basename по возрастанию
        // Добавляем $files в качестве последнего параметра, для сортировки по общему ключу
        array_multisort($extensions, $order, SORT_REGULAR, $basenames, SORT_ASC, SORT_LOCALE_STRING, $files);
        break;
      case('time'): // сортировка по времени
        $mtimes = array();
        // Получение списка столбцов
        foreach ($files as $key => $value) {
          $mtimes[$key] = $value['mtime'];
        }
        //pr($mtimes);
        // Сортируем данные по extension и по basename по возрастанию
        // Добавляем $files в качестве последнего параметра, для сортировки по общему ключу
        array_multisort($mtimes, $order, SORT_REGULAR, $files);
        break;
      case('size'): // сортировка по размеру
        $sizes = array();
        // Получение списка столбцов
        foreach ($files as $key => $value) {
          $sizes[$key] = $value['size'];
        }
        //pr($sizes);
        // Сортируем данные по extension и по basename по возрастанию
        // Добавляем $files в качестве последнего параметра, для сортировки по общему ключу
        array_multisort($sizes, $order, SORT_NUMERIC, $files);
        break;
      default:

    }
  }
  return $files;
}


?>