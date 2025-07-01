<?php
namespace core;

use core\vendors\Valitron\Validator;
use \mysqli;
use \Exception;
//use \PDO;
use \R;

// класс для создания подключения и выполнения запросов к базе данных
abstract class Model {

  use TSingletone;

  public $db; // подключение к базе данных
  //protected $pdo;
//  protected static $instance;
  public static $countSql = 0;
  public static $queries = [];

  public $errors = [];

  public $model;
  //protected $pdo;
  //protected $table; // название таблицы
  //protected $pk = 'id'; // название поля для хранения первичного ключа

  protected function __construct() {
    //echo 'Конструктор Model';
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

//    try {
//      $this->model = Db::instance();
//    }
//    catch(Exception $e) {
//      exit();
//    }

  }

  public function __clone() {

  }


  // запись данных, полученных методом POST в массив атрибутов
  public function load($data){
    foreach($this->attributes as $name => $value){
      if(isset($data[$name])) {
        $this->attributes[$name] = $data[$name];
      }
    }
    return true;
  }

  // метод для проверки данных, введённых пользователем
  public function validate($data){
    Validator::lang('ru');
    $v = new Validator($data); // Валидатор https://packagist.org/packages/vlucas/valitron
    $v->rules($this->rules); // передаём набор правил для валидации
    if($v->validate()){
      return true; // если валидация прошла без ошибок, возвращаем true
    }
    $this->errors = $v->errors(); // если есь ошибки, то записываем их в массив ошибок и возвращаем false
    return false;
  }

  public function clear_db($var,$db = false){
    $db = Model::get_instance();
    $var = $db->ins_db->real_escape_string($var);
    return $var;
  }

  public function save($table){
    //$tbl = R::dispense($table);
    foreach($this->attributes as $name => $value){
      $tbl->name = $value;
    }
    return R::store($tbl);
  }

  // метод для отображения ошибок, возникающих при заполнении форм регистрации и авторизации
  public function getErrors(){
    //debug($this->errors);
    $errors = '<div class="error alert alert-danger">В ходе заполнения формы регистрации были допущены следующие ошибки: <ul class="list">';
    foreach($this->errors as $error) {
      foreach($error as $item){
        $errors .= '<li>'.$item.'</li>';
      }
    }
    $errors .= '</ul></div>';
    $_SESSION['errors'] = $errors;
  }

//  public function query($sql) {
//    return $this->db->execute($sql);
//  }

  public function findAll() {
    $sql = 'SELECT * FROM '.$this->table;
    return $this->db->query($sql);
  }

  public function findOne($id, $field = ''){
    $field = $field ?: $this->pk;
    $sql = 'SELECT * FROM '.$this->table.' WHERE '.$field.' = ? LIMIT 1';
    return $this->db->query($sql, [$id]);
  }

  public function findBySql($sql, $params = []){
    return $this->db->query($sql, $params);
  }

  public function findLike($str, $field, $table = ''){
    $table = $table ?: $this->table;
    $sql = 'SELECT * FROM '.$table.' WHERE '.$field.' LIKE ?';
    return $this->db->query($sql, ['%'.$str.'%']);
  }



  public function execute($sql, $params = []) {
    self::$countSql++;
    self::$queries[] = $sql;
    $statement = $this->db->prepare($sql);
    return $statement->execute($params);
  }
//
//  public function query($sql, $params = []) {
//    self::$countSql++;
//    self::$queries[] = $sql;
//    $statement = $this->db->prepare($sql);
//    $result = $statement->execute($params);
//    if ($result !== false) {
//      return $statement->fetchAll();
//    }
//    return [];
//  }



/*
 * Метод для получения данных из базы данных
 *
 * при подсчёте элементов возвращает число
 * при отсутствуии элементов возвращает false
 * при наличии одного элемента (если задан limit=1) возвращает этот элемент в виде ассоциативного массива
 * при наличии нескольких элементов возвращает многомерный ассоциативный массив с ключами, нумерация ключей начинается с 1
 *
 */
  public function select(
    $param,
    $table,
    $where = array(),
    $operand = array('='),
    $order = false,
    $napr = 'ASC',
    $limit = false,
    $not = false,
    $distinct = false,
    $match = array(),
    $show_sql = false
  ) {
    $count = false;
    $sql = 'SELECT'; // формирование SQL-запроса SELECT
    if ($distinct) {
      $sql .= ' DISTINCT';
    }
    if (is_array($param)) {
      foreach($param as $item) {
        $sql .= ' '.$item.', ';
      }
      $sql = rtrim($sql,', ');
    }
    elseif(!empty($param)) {
      $sql .= ' COUNT('.$param.')';
      $count = true;
    }
    else {
      $sql .= ' *';
    }
    $sql .= ' FROM '.$table;

    if(count($where) > 0) {
      $i = 0;
      $sql .= ' WHERE';
      foreach($where as $key=>$val) {
        if ($not) {
          $sql .= ' NOT';
        }
        if($i > 0) {
          $sql .= ' AND';
        }

        if ($operand[$i] == 'IN') {
          $sql .= ' '.strtolower($key).' '.$operand[$i].' ('.$val.')';
        }
        elseif ($operand[$i] == 'BETWEEN') {
          // echo $val;
          $val_str = '';
          if (stripos($val, 'AND') !== false) { // если в диапазоне значений есть строка 'AND' или 'and'
            $val_str = strtoupper($val); // преобразуем строку в верхний регистр
            //echo $val_str;
          }
          else {
            $val_array = array();
            $val_array = explode(',',$val);
            //debug($val_array);
            $val_str = $val_array[0].' AND '.trim($val_array[1],' '); // добавляем AND
            //echo $val_str;
          }
          $sql .= ' '.strtolower($key).' '.$operand[$i].' '.$val_str;
        }
        elseif ($operand[$i] == 'IS NULL') {
          $sql .= ' '.strtolower($key).' '.$operand[$i];
        }
        elseif ($operand[$i] == 'LIKE') {
          $sql .= ' '.strtolower($key).' '.$operand[$i].' \'%'.$this->db->real_escape_string($val).'%\'';
        }
        else {
          $sql .= ' '.strtolower($key).' '.$operand[$i].' \''.$this->db->real_escape_string($val).'\'';
        }

        $i++;
        if((count($operand) - 1) < $i) {
          $operand[$i] = $operand[$i - 1];
        }
      }
    }

    if(count($match) > 0) {
      foreach($match as $k=>$v) {
        if(count($where) > 0) {
          $sql .= ' AND MATCH ('.$k.') AGAINST (\''.$this->db->real_escape_string($v).'\')';
        }
        elseif(count($where) == 0) {
          $sql .= ' WHERE MATCH ('.$k.') AGAINST (\''.$this->db->real_escape_string($v).'\')';
        }
      }
    }

    if($order) {
      $sql .= ' ORDER BY';
      if($order == 'RAND') {
        $sql .= ' RAND()';
      }
      else {
        if((is_array($order)) and (is_array($napr))) {
          $orders_array = array_combine($order,$napr);
          foreach($orders_array as $key => $val) {
            $sql .= ' '.$key.' '.$val.', ';
          }
          $sql = rtrim($sql,', ');
        }
        else {
          $sql .= ' '.$order.' '.$napr;
        }
      }
    }

    if($limit) {
      if(is_array($limit)) {
        $sql .= ' LIMIT '.$limit[0].', '.$limit[1];
      }
      else {
        $sql .= ' LIMIT '.$limit;
      }
    }

    if (DEBUG) {
      self::$countSql++;
      self::$queries[] = $sql;
      if (SHOW_SQL or $show_sql) {
        echo 'Запрос: "'.$sql.'"<br>';
      }
    }

    $result = $this->db->query($sql); // запрос к базе данных
    if(!$result) {
      throw new Exception('Ошибка запроса: '.$this->db->errno.' - '.iconv('CP1251', 'UTF-8', $this->db->error), 500);
    }
    if($count) {
      $res = $result->fetch_row();
      return (int)$res[0]; // при подсчёте элементов возвращает число
    }
    if($result->num_rows == 0) {
      return false; // при отсутствуии элементов возвращает false
    }
    if($result->num_rows == 1 and $limit == 1) {
      return $result->fetch_assoc(); // при наличии одного элемента (если задан limit=1) возвращает этот элемент в виде ассоциативного массива
    }
    else {
      $row = array();
      for($i = 0; $i < $result->num_rows; $i++) {
        $row[$i+1] = $result->fetch_assoc(); // нумерация элементов в массиве начинается с 1, $row[$i+1]
      }
      return $row; // при наличии нескольких элементов возвращает многомерный ассоциативный массив с ключами, нумерация ключей начинается с 1
    }
    //return true;
  }

  // метод для вставки данных в базу данных
  public function insert($table, $data = array(), $values = array(), $id = false, $show_sql = false) {
    $sql = 'INSERT INTO '.$table.' ('; // формирование SQL-запроса INSERT
    $sql .= implode(',',$data).') ';
    $sql .= 'VALUES (';
    foreach($values as $val) {
      $sql .= '\''.$val.'\',';
    }
    $sql = rtrim($sql,',').')';

    if (DEBUG) {
      self::$countSql++;
      self::$queries[] = $sql;
      if (SHOW_SQL or $show_sql) {
        echo 'Запрос: "'.$sql.'"<br>';
      }
    }

    $result = $this->db->query($sql); // запрос к базе данных
    if(!$result) {
      throw new Exception('Ошибка запроса: '.$this->db->errno.' - '.iconv('CP1251', 'UTF-8', $this->db->error), 500);
    }
    if($id) {
      return $this->db->insert_id;
    }
    return true;
  }

  // метод для обнвления данных в базе данных
  public function update($table, $data = array(), $values = array(), $where = array(), $operand = array('='), $limit = false, $show_sql = false) {
    $data_array = array_combine($data,$values);
    $sql = 'UPDATE '.$table.' SET '; // формирование SQL-запроса UPDATE
    foreach($data_array as $key => $val) {
      $sql .= $key.'=\''.$val.'\', ';
    }
    $sql = rtrim($sql,', ');

    if(count($where) > 0) {
      $i = 0;
      foreach($where as $key=>$val) {
        if($i == 0) {
          $sql .= ' WHERE '.strtolower($key).' '.$operand[$i].' \''.$this->db->real_escape_string($val).'\'';
        }
        if($i > 0) {
          $sql .= ' AND '.strtolower($key).' '.$operand[$i].' \''.$this->db->real_escape_string($val).'\'';
        }
        $i++;
        if((count($operand) - 1) < $i) {
          $operand[$i] = $operand[$i - 1];
        }
      }
    }
    if($limit) {
      $sql .= ' LIMIT '.$limit;
    }

    if (DEBUG) {
      self::$countSql++;
      self::$queries[] = $sql;
      if (SHOW_SQL or $show_sql) {
        echo 'Запрос: "'.$sql.'"<br>';
      }
    }

    $result = $this->db->query($sql); // запрос к базе данных
    if(!$result) {
      throw new Exception('Ошибка запроса: '.$this->db->errno.' - '.iconv('CP1251', 'UTF-8', $this->db->error), 500);
    }
    return true;
  }

  // метод для удаления данных из базы данных
  public function delete($table, $where = array(), $operand = array('='), $limit = FALSE, $show_sql=false) {
    $sql = 'DELETE FROM '.$table; // формирование SQL-запроса DELETE
    if(count($where) > 0) {
      $i = 0;
      foreach($where as $key=>$val) {
        if($i == 0) {
          $sql .= ' WHERE '.strtolower($key).' '.$operand[$i].' \''.$this->db->real_escape_string($val).'\'';
        }
        if($i > 0) {
          $sql .= ' AND '.strtolower($key).' '.$operand[$i].' \''.$this->db->real_escape_string($val).'\'';
        }
        $i++;
        if((count($operand) - 1) < $i) {
          $operand[$i] = $operand[$i - 1];
        }
      }
    }
    if($limit) {
      $sql .= ' LIMIT '.$limit;
    }

    if (DEBUG) {
      self::$countSql++;
      self::$queries[] = $sql;
      if (SHOW_SQL or $show_sql) {
        echo 'Запрос: "'.$sql.'"<br>';
      }
    }

    $result = $this->db->query($sql); // запрос к базе данных
    if(!$result) {
      throw new Exception('Ошибка запроса: '.$this->db->errno.' - '.iconv('CP1251', 'UTF-8', $this->db->error), 500);
    }
    return true;
  }

  // метод для выполнения произвольных SQL-запросов
  public function sql($sql, $id = true, $limit = false, $show_sql = false) {
    //$sql = clear_str($sql);

    if (DEBUG) {
      self::$countSql++;
      self::$queries[] = $sql;
      if (SHOW_SQL or $show_sql) {
        echo 'Запрос: "'.$sql.'"<br>';
      }
    }

    $result = $this->db->query($sql); // запрос к базе данных
    if(!$result) {
      throw new Exception('Ошибка запроса: '.$this->db->errno.' - '.iconv('CP1251', 'UTF-8', $this->db->error), 500);
    }
    if($id) {
      if($result->num_rows == 0) {
        return false; // при отсутствуии элементов возвращает false
      }
      elseif($result->num_rows == 1 and $limit == 1) {
        return $result->fetch_assoc(); // при наличии одного элемента возвращает этот элемент в виде ассоциативного массива
      }
      else {
        $row = array();
        for($i = 0; $i < $result->num_rows; $i++) {
          $row[$i+1] = $result->fetch_assoc(); // нумерация элементов в массиве начинается с 1, $row[$i+1]
        }
        return $row; // при наличии нескольких элементов возвращает многомерный ассоциативный массив с ключами, нумерация ключей начинается с 1
      }
    }
    return true; // если параметр $id не указан возвращает true // return $this->db->insert_id;
  }





}