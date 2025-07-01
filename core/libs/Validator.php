<?php
namespace core\libs;

use core\TSingletone;

class Validator {

  use TSingletone;

  public function __construct() {
    // echo 'Валидатор';
  }

  public $string = ''; // входные данные

  public static $type = 'text'; // тип валидации

  // допустимые значения типов данных для валидации
  private static $type_array = array('text','name','login','password','email','phone','number','url','ip','date','datetime');

  /* === Проверка (валидация) пользовательских данных (нчало) === */
  public static function validate($string = '', $type = 'text') {
    $string = (string)$string; // преобразуем переменную $string в строку
    if (empty($string)) return false;

    self::$type = $type;
    // проверка полученного типа на допустимый
    if(!in_array(self::$type,self::$type_array)) { // если в массиве $type_array нет искомого значения из массива $type, то $type = 'name'
      self::$type = 'text';
    }
    switch(self::$type){
      case('text'): // текст
        $string = stripslashes(strip_tags(trim($string))); // убираем пробелы, html,php-теги и экранирующие слеши
        $string = preg_replace('/[+&@#\/%?=~_|$!:,.;]+/i', ' ', $string); // заменяем символы пробелами
        $string = htmlspecialchars($string, ENT_QUOTES); // преобразуем специальные символы в html-сущности (ENT_QUOTES - вместе с одинарными кавычками ')
        //debug($string);
        if (preg_match('|^[\d]+$|', $string)) { // Проверяем, является ли переменная числом
          return false;
        }
        break;
      case('name'): // имя (фамилия/отчество)
        $string = preg_replace('/\b(https?|ftp|file):\/\/[-A-Z0-9+&@#\/%?=~_|$!:,.;]*[A-Z0-9+&@#\/%=~_|$]/i', '', $string);
        break;
      case('login'): // логин

        break;
      case('password'): // пароль

        break;
      case('email'): // адрес электронной почты
        $string = filter_var($string, FILTER_VALIDATE_EMAIL); //параметром FILTER_VALIDATE_EMAIL для валидации электронного адреса //filter_var - возвращает отфильтрованные данные или FALSE, если фильтрация завершилась неудачей.
        // проверка е-mail адреса регулярными выражениями на корректность
        if (!preg_match('/([a-z0-9_\.\-])+\@(([a-z0-9\-])+\.)+([a-z0-9]{2,4})+/i', $string)) {
          // if (!preg_match('/[0-9a-z_]+@[0-9a-z_^\.]+\.[a-z]{2,3}/i', $email)) { - альтернативная проверка из примера
          $_SESSION['message'] = 'Адрес электронной почты введён неверно.<br>';
          $_POST['message'] = $_SESSION['message'];
          return false;
        }
        break;
      case('phone'): // номер телефона
        $string = preg_replace('/\b(https?|ftp|file):\/\/[-A-Z0-9+&@#\/%?=~_|$!:,.;]*[A-Z0-9+&@#\/%=~_|$]/i', '', $string);
        // проверка номера телефона на число: если не число, то вводим сообщение
        if (!preg_match('|^[\d]+$|', $string)) {
          $_SESSION['message'] = 'Номер телефона введён неверно. Номер телефона должен состоять только из цифр.<br>';
          $_POST['message'] = $_SESSION['message'];
          return false;
        }
        else {
          if (!check_length($string, 8, 11)) { // если длина строки не допустима, то выдаём ошибку
            $_SESSION['message'] = 'Номер телефона введён неверно. Номер телефона должен состоять только из 8-11 цифр.<br>';
            $_POST['message'] = $_SESSION['message'];
            return false;
          }
        }
        break;
      case('number'): // число
        if (!preg_match('|^[\d]+$|', $string)) {
          $_SESSION['message'] = 'Не число.<br>';
          $_POST['message'] = $_SESSION['message'];
          return false;
        }
        break;
      case('url'): // url-адрес
        // проверяем введенные данные и чистим от ссылок, если это имя/фамилия, логин, е-майл, чистим неверный адрес сайта
        $string = preg_replace('/([a-z0-9_\.\-])+\@(([a-z0-9\-])+\.)+([a-z0-9]{2,4})+/i', '', $string);
        // проверка сайта регулярными выражениями на корректность
        if (!preg_match('/\b(https?|ftp|file):\/\/[-A-Z0-9+&@#\/%?=~_|$!:,.;]*[A-Z0-9+&@#\/%=~_|$]/i', $string)) {
          $_SESSION['message'] = 'Адрес сайта введён неверно.<br>';
          $_POST['message'] = $_SESSION['message'];
          return false;
        }
        break;
      case('ip'): // IP-адрес
        if (!preg_match('/^(25[0-5]|2[0-4][0-9]|[0-1][0-9]{2}|[0-9]{2}|[0-9])(\.(25[0-5]|2[0-4][0-9]|[0-1][0-9]{2}|[0-9]{2}|[0-9])){3}$/', $string)) {
          $_SESSION['message'] = 'IP-адрес v4 введён неверно.<br>';
          $_POST['message'] = $_SESSION['message'];
          return false;
        }
        break;
      case('date'): // Дата
        // проверка даты рождения регулярными выражениями
        if (!preg_match('/(19|20)\d\d-((0[1-9]|1[012])-(0[1-9]|[12]\d)|(0[13-9]|1[012])-30|(0[13578]|1[02])-31)+/i', $string)) {
          // проверка даты в формате YYYY-MM-DD: [0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])
          // второй вариант (\d{4}\-\d{2}\-\d{2})
          $_SESSION['message'] = 'Дата Рождения введёна неверно.<br>';
          $_POST['message'] = $_SESSION['message'];
          return false;
        }
        break;
      case('datetime'): // Дата и время в формате ГГГГ-ММ-ДД ЧЧ:ММ:СС
        // проверка даты рождения регулярными выражениями
        if (!preg_match('/(\d{2}|\d{4})(?:\-)?([0]{1}\d{1}|[1]{1}[0-2]{1})(?:\-)?([0-2]{1}\d{1}|[3]{1}[0-1]{1})(?:\s)?([0-1]{1}\d{1}|[2]{1}[0-3]{1})(?::)?([0-5]{1}\d{1})(?::)?([0-5]{1}\d{1})/i', $string)) {
          // паттерн взят здесь http://regexlib.com/REDetails.aspx?regexp_id=751
          $_SESSION['message'] = 'Дата и время введены неверно.<br>';
          $_POST['message'] = $_SESSION['message'];
          return false;
        }
        break;
      default: // имя (фамилия/отчество)

    }

    return $string;
  }
  /* === Проверка (валидация) пользовательских данных (конец) === */

}