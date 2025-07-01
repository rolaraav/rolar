<?php define('A', TRUE); // константа для запрета прямого обращения к php-файлу
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

if (DEBUG !== true) {
  $init = new core\Init();
  // проверяем на доступность домены
  $download_domen = $init->update_download_domen();
  echo 'Домен <strong>'.$download_domen.'</strong> доступен.<br><hr>';
  // запускаем процедуру обновления хешей в таблицах data и coueses
  $init->update_hash('data');
  $init->update_hash('courses');
  echo '<hr>';
  // запускаем процедуру получения алиасов для таблиц data и partners
  $init->filling_aliases('data');
  $init->filling_aliases('partners');
  echo '<hr>';
}
else {
  echo 'Всё ОК!';
}
//debug($download_domen);
//debug(PATH_TO_SECRET_FILE);
