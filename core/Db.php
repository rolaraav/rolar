<?php
namespace core;
use \mysqli;
use \Exception;
//use \PDO;
//use \R;

// Класс для создания подключения к базе данных
class Db {

  use TSingletone;

  public $db; // подключение к базе данных
  //protected $pdo;
//  protected static $instance;
  public static $countSql = 0;
  public static $queries = [];

  protected function __construct() {
    // получаем настойки подключения к базе данных
    //$this->db = ['dsn' => 'mysql:host='.HOST.';dbname='.DB.';charset=utf8', 'user' => USER, 'pass' => PASS];
    $this->db = new mysqli(HOST,USER,PASS,DB); // установка соединения с базой данных
    //debug($this->db);

    //$options = [
    //  \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
    //  \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
    //];

    //$this->pdo = new PDO('mysql:host='.HOST.';dbname='.DB.';charset=utf8', USER, PASS, $options);

    if($this->db->connect_error) {
      throw new Exception('Ошибка соединения: '.$this->db->connect_errno.' - '.iconv('CP1251', 'UTF-8', $this->db->connect_error), 500);
    }

    $this->db->query('SET NAMES \'UTF8\''); // установка кодировки по-умолчанию
    $this->db->query('SET LC_TIME_NAMES = \'ru_RU\''); // установка языка/времени
    $this->db->set_charset('utf8'); //задает набор символов по умолчанию

    //require_once VENDORS.S.'rb.php'; // подключение библиотеки ReadBean PHP
    //echo VENDORS.S.'rb.php';
    //R::setup($this->db['dsn'], $this->db['user'], $this->db['pass']); // установка соединения с базой данных
    //R::freeze(true);
    //R::fancyDebug(true); // отладка
  }

  public function __clone() {

  }

  public function execute($sql, $params = []) {
    self::$countSql++;
    self::$queries[] = $sql;
    $statement = $this->db->prepare($sql);
    return $statement->execute($params);
  }

  public function query($sql, $params = []) {
    self::$countSql++;
    self::$queries[] = $sql;
    $statement = $this->db->prepare($sql);
    $result = $statement->execute($params);
    if ($result !== false) {
      return $statement->fetchAll();
    }
    return [];
  }


}