<?php
namespace core\libs;
/*
Класс проверки адреса электронной почты, осуществляет проверку адреса электронной почты по трём параметрам:
- При помощи регулярных выражений.
- Производит проверку домена из белого списка.
- Делает тестовый запрос на сервер.
Ссылка на источник: http://htmlweb.ru/php/example/is_e-mail.php
*/
//define('DEBUG', true); // режим отладки выключен
//define('ADMINEMAIL', 'info@rolar.ru'); // email-адрес администратора
/*
function print_array($array){
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}
*/
class CheckMail {
  var $timeout = 10; // время ожидания 10 секунд
  var $domain_check = false; // не проверять почтовый домен
  var $resolved_domains = array('mail.ru', 'list.ru', 'inbox.ru', 'bk.ru', 'gmail.com',
  'yandex.ru', 'yandex.ua', 'yandex.by', 'yandex.kz', 'yandex.com', 'ya.ru', 'rambler.ru'); // разрешённые домены

  // функция проверки электронной почты регулярными выражениями
  private function is_valid_email($email = '') {
    $email = filter_var($email, FILTER_VALIDATE_EMAIL); //параметром FILTER_VALIDATE_EMAIL для валидации
    // электронного адреса //filter_var - возвращает отфильтрованные данные или FALSE, если фильтрация завершилась
    // неудачей.
    // проверка е-mail адреса регулярными выражениями на корректность
    $result = preg_match('#^([a-z0-9_\.-])+@(([a-z0-9-])+\.)+([a-z0-9]{2,6})$#i', $email);
    // ([a-z0-9_\.-]) - группа символов для имени пользователя, включает буквы от a до z, цифры от 0 до 9,
    // подчеркивание, точку и дефис. + означает 1 и более символов
    // Знак @ разделяет имя пользователя и домен
    // группа ([a-z0-9-]) - буквы от a до z, цифры от 0 до 9 и дефис, располагается в группе с точкой,
    // и может повторяться 1 и более раз, отвечает за домен второго и последующих уровней, можно ограничить {1,4} доменом пятого уровня
    // группа, состоящая от 2 до 6 символов [a-z0-9] обозначает домен первого уровня
    // ^ - начало строки, $ - конец строки, i - игнорировать регистр букв
    return $result;
  }

  // проверка почтового домена
  private function check_domain_rules($domain = '') {
    $result = in_array(strtolower($domain), $this->resolved_domains);
    return $result;
  }

  public function execute($email = '') {
    // проверка адреса электронной почты регулярным выражением
    if (!$this->is_valid_email($email)) {
      return false;
    }
    if (DEBUG) {echo 'Начало проверки e-mail адреса: <strong>'.$email.'</strong><br>';}

    // получение почтового домена
    $host = substr(strstr($email, '@'), 1);

    // проверка почтового домена
    if ($this->domain_check) {
        if ($this->check_domain_rules($host)) {
            return false;
        }
    }
    if (DEBUG) {echo 'Домен почтового сервиса: <strong>'.$host.'</strong><br>';}
    
    // получение и проверка MX-записей
    if (@getmxrr($host, $mxhosts[0], $mxhosts[1]) == true) { // getmxrr — Получает запись MX, соответствующую переданному доменному имени узла
      array_multisort($mxhosts[1], $mxhosts[0]); // array_multisort — Сортирует несколько массивов или многомерные массивы
    }
    else {
      if (DEBUG) {echo 'MX-записи почтовых серверов для домена <strong>'.$host.'</strong> не получены<br>';}
      return false;
      //$mxhosts[0] = $host;
      //$mxhosts[1] = 10;
    }
    if (DEBUG) {echo 'Список почтовых серверов домена <strong>'.$host.'</strong> (MX записи):<br>'; print_array($mxhosts[0]);}

    $port = 25;
    $localhost = $_SERVER['HTTP_HOST'];
    $sender = ADMINEMAIL; // 'info@rolar.ru';
    if (DEBUG) {echo 'Отправитель: '.$sender.'<br>';}

    $result = false;
    $id = 0;

    if (function_exists('fsockopen')) { // если определена функция fsockopen
      $total_mxhosts = count($mxhosts[0]);
      while (!$result && $id < $total_mxhosts) {
        if (DEBUG) {echo '<strong>SMTP сессия '.$id.':</strong><br>Проверка сервера '.$mxhosts[0][$id].'...<br>';}
        // fsockopen — Открывает соединение с интернет сокетом или доменным сокетом Unix
        if ($connection = @fsockopen($mxhosts[0][$id], $port, $errno, $error, $this->timeout)) {
          if (DEBUG) {echo 'Открытие соединения с '.$mxhosts[0][$id].'... Успешно!<br>';}
          fputs($connection, "HELO $localhost\r\n"); // 250
          $data = fgets($connection, 1024); // чтение строки из файла $connection длиной 1024 символа
          $response = substr($data, 0, 1);
          if (DEBUG) {echo 'HELO '.$localhost.'<br>'.$data.'<br>';}
          if ($response == '2') { // 200, 220, 250 etc.
            fputs($connection, "MAIL FROM: <$sender>\r\n");
            $data = fgets($connection, 1024);
            $response = substr($data, 0, 1);
            if (DEBUG) {echo 'MAIL FROM: &lt;'.$sender.'&gt;<br>'.$data.'<br>';}
            if ($response == '2') { // 200, 220, 250 etc.
              fputs($connection, "RCPT TO: <$email>\r\n");
              $data = fgets($connection, 1024);
              $response = substr($data, 0, 1);
              if (DEBUG) {echo 'RCPT TO: &lt;'.$email.'&gt;<br>'.$data.'<br>';}
              if ($response == '2') { // 200, 220, 250 etc.
                fputs($connection, "DATA test .\r\n");
                $data = fgets($connection, 1024);
                $response = substr($data, 0, 1);
                if (DEBUG) {echo 'DATA test .<br>'.$data.'<br>';}
                if ($response == '2') { // 200, 220, 250 etc.
                  $result = true;
                }
              }
            }
          }
          fputs($connection, "QUIT\r\n");
          $data = fgets($connection, 1024);
          if (DEBUG) {echo 'QUIT<br>'.$data.'<br>';}
          fclose($connection);
          if ($result) {
            if (DEBUG) {echo 'Успешное соединение с '.$mxhosts[0][$id].'. Ошибок не обнаружено.<br>';}
            return true;
          }
        }
        $id++;
      }
    }
    return false;
  }
}
//Пример использования:
/*
$address = 'email@email.com';
$checkmail = new CheckMail();
echo '<strong>Адрес электронной почты '.$address.' '.($checkmail->execute($address) ? '<font color="green">существует</font></strong>.' : '<font color="red">не существует</font></strong>.');
*/
?>