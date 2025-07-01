<?php
namespace core;

use \Exception;
use core\libs\Breadcrumbs;
use core\libs\Cache;
use core\libs\CheckMail;
use core\libs\FileUpload;
use core\libs\Gallery;
use core\libs\ImageResize;
use core\libs\Mail;
use core\libs\Menu;
use core\libs\Pagination;
use core\libs\Search;
use core\libs\Validator;
use app\models\BaseModel;

class Core {

  use TSingletone;

  /*
   * Ядро сайта - свойство для хранения других объектов и свойств
   * @var object
   */
  public static $core; // свойство для хранения других объектов и свойств

  /*
   * Запрос, полученный из адресной строки
   * @var string
   */
  protected $url = ''; // запрос, полученный из адресной строки

  public function __construct() {
    //echo 'Core::__construct()<br>';
    new ErrorHandler; // класс для обработки ошибок
    self::$core = Registry::instance(); // класс для хранения других объектов и свойств
    //self::$core->setProperty('test', 'Тестовое значение');
    //self::$core->getProperties();
    //Validator::instance();

    self::$core->setProperty('categories', self::cacheCategory()); // получение и сохранение категорий в память и в кэш
    //debug(self::$core->getProperty('categories'));

    self::$core->setProperty('partners', self::cachePartners()); // получение и сохранение партнёров в память и в кэш
    //debug(self::$core->getProperty('partners'));

    self::$core->setProperty('users', self::cacheUsers()); // получение и сохранение пользователей в память и в кэш
    //debug(self::$core->getProperty('users'));

    //self::$core->getProperties();

    define('DOWNLOAD_DOMEN', self::getDownloadDomen()); // получение домена сервера для закачек из настроек в базе данных
    self::$core->setProperty('download_domen', DOWNLOAD_DOMEN); // сохранение домена сервера для закачек
    //self::$core->getProperties();

    define('EDITOR', self::getEditor()); // получение используемого редактора из настроек в базе данных
    self::$core->setProperty('editor', EDITOR); // сохранение используемого редактора
    //self::$core->getProperties();

    $ftp_logins = self::$core->getProperty('ftp_logins'); // получение массива ftp_logins со значениями констант

    // определение констант для сервера закачек
    define('DOWNLOAD_SERVER', 'ftp://'.$ftp_logins['rolar'].'@'.DOWNLOAD_DOMEN.'/'); // ftp://rolar.ru:Kr6vX3yu@94.41.86.18.dynamic.ufanet.ru/
    define('DOWNLOAD_SERVER4', 'ftp://'.$ftp_logins['courses'].'@'.DOWNLOAD_DOMEN.'/'); // ftp://courses:nTf4k9p5@94.41.86.18.dynamic.ufanet.ru/
    //define('PATH_TO_SECRET_FILE', 'ftp://'.$ftp_logins['cisco'].'@'.DOWNLOAD_DOMEN.'/'); // путь к секретному файлу - не используется

    //debug(DOWNLOAD_SERVER);
    //debug(DOWNLOAD_SERVER4);
    //debug(PATH_TO_SECRET_FILE);

    //debug($_SERVER);
    //$query = trim($_SERVER['QUERY_STRING'], '/');
    $this->url = rtrim($_SERVER['QUERY_STRING'], '/'); // получение url-адреса из строки запроса
    //echo $this->url;

    //echo $_SERVER['QUERY_STRING'].'<br>'; // http://localhost/about выводит about
    //echo $_SERVER['REQUEST_URI'].'<br>'; // http://localhost/about выводит /about

    // подключение библиотеки PHPMailer и класса-расширения Mail
    //require_once LIBS.S.'Mail.php';

    // подключение класса проверки Email
    //require_once LIBS.S.'CheckMail.php';

    // подключение класса изменения размеров изображений
    //require_once LIBS.S.'ImageResize.php';

    // подключение класса для авторизации через Вконтакте
    //require_once 'vkauth.php';

    session_start();
    //debug($_SESSION);

    //$vObj = new View();
    //new Router; // класс маршрутизации
    require_once APP.S.'routes'.R; // подключение таблицы маршрутов


    //echo $peremennaya; // неопределённая переменная
    //myfunc(); // неопределённая функция
    //throw new NotFoundException('Непойманное исключение NotFoundException.', 404); // не пойманный NotFoundException
    //throw new Exception('Непойманное исключение Exception.', 503); // не пойманный Exception

    //try {
      Router::dispatch($this->url);
    //}
    //catch (\Exception $e) {
    //  echo 'Перехват исключений через ErrorHandler';
    //}



  }

  // метод для кэширования категорий
  public static function cacheCategory(){
    $cache = Cache::instance();
    $categories = $cache->get('categories'); // получение категорй из кэша
    //debug($categories);
    // если категорий в кэше не найдено, то получаем их из базы данных
    if (empty($categories)) {
      $model = new BaseModel; // создание модели и соединение с базой данных
      $categories = $model->get_categories(); // получение категорий из базы данных
      $cache->set('categories', $categories, 86400); // сохранение полученных категорий в кэш
      //debug($categories);
    }
    return $categories;
  }

  // метод для кэширования партнёров
  public static function cachePartners(){
    $cache = Cache::instance();
    $partners = $cache->get('partners'); // получение партнёров из кэша
    //debug($partners);
    // если партнёров в кэше не найдено, то получаем их из базы данных
    if (empty($partners)) {
      $model = new BaseModel; // создание модели и соединение с базой данных
      $partners = $model->get_partners(); // получение партнёров из базы данных
      $cache->set('partners', $partners, 86400); // сохранение полученных партнёров в кэш
      //debug($partners);
    }
    return $partners;
  }

  // метод для кэширования пользователей
  public static function cacheUsers(){
    $cache = Cache::instance();
    $users = $cache->get('users'); // получение пользователей из кэша
    //debug($users);
    // если пользователей в кэше не найдено, то получаем их из базы данных
    if (empty($users)) {
      $model = new BaseModel; // создание модели и соединение с базой данных
      $users = $model->get_users(); // получение пользователей из базы данных
      $cache->set('users', $users, 86400); // сохранение полученных пользователей в кэш
      //debug($users);
    }
    return $users;
  }

  // метод для получения домена сервера для закачек
  public static function getDownloadDomen(){
    $model = new BaseModel; // создание модели и соединение с базой данных
    $download_domen_array = $model->get_download_domen(); // получение домена сервера для закачек
    if (empty($download_domen_array['value'])) {
      return DEFAULT_DOWNLOAD_DOMEN;
    }
    return $download_domen_array['value'];
  }

  // метод для получения используемого редактора
  public static function getEditor(){
    $model = new BaseModel; // создание модели и соединение с базой данных
    $editor_array = $model->get_editor(); // получение используемого редактора
    if (empty($editor_array['value'])) {
      return DEFAULT_EDITOR;
    }
    return $editor_array['value'];
  }

}