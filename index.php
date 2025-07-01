<?php
define('A', TRUE); // константа для запрета прямого обращения к php-файлу
//echo 'Сайт работает!<br>Файл: '.__FILE__.'<br>Директория: '.__DIR__.'<br>';
//session_start(); // создание сессии
require_once __DIR__.'/config.php'; // подключение файла конфигурации (Разделитель пути в Linux /, разделители пути в Windows \ и /)
require_once CORE.S.'f'.R; // подключене функций 'core/f.php';

// функция автозагрузки классов
function autoloader($class) {
  //echo 'Загрузка класса '.$class.'<br>';
  //$file = ROOT.S.str_replace('\\','/', $class).'.php';
  $file = ROOT.S.str_replace('\\','/', $class).R;
  if(is_file($file)) {
    //echo 'Подключение файла '.$file.'<br>';
    require_once $file;
  }
}
spl_autoload_register('autoloader');

new core\Core; // создание объекта класса ядра для создания других объектов

//mysql_close(); // закрытие соединения с сервером MySQL
//session_destroy(); //разрушение сессии
?>