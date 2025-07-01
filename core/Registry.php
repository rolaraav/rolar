<?php
namespace core;

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

// класс для создания/хранения других объектов/классов
class Registry {

  use TSingletone;

  public static $objects = []; // контейнер для хранения объектов

  public static $properties = []; // контейнер для хранения свойств

  public function __construct() {
    //echo 'Registry::__construct()<br>';
    //global $config;
    $config = require_once APP.S.'config'.R; // подключение файла с настройками
    //debug($config);
    if(!empty($config)){
      foreach($config['components'] as $name => $component) {
        self::$objects[$name] = new $component;
      }

      foreach($config['settings'] as $k => $v) {
        $this->setProperty($k, $v);
      }
    }





  }

  // запись объекта (компонента/класса) в реестр
  public function __set($name, $object){
    if(!isset(self::$objects[$name])) {
      self::$objects[$name] = new $object;
    }
  }

  // получение объекта (компонента/класса) из реестра
  public function __get($name){
    if(is_object(self::$objects[$name])){
      return self::$objects[$name];
    }
  }

  // положить свойство в контейнер
  public function setProperty($name, $value){
    self::$properties[$name] = $value;
  }

  // получить свойство из контейнера
  public function getProperty($name){
    if(isset(self::$properties[$name])){
      return self::$properties[$name];
    }
    return null;
  }

  // получение всех объектов
  public function getObjects(){
    debug(self::$objects); // '<pre>'.print_r(self::$objects, true).'</pre>';
  }

  // получение всех свойств
  public function getProperties(){
    debug(self::$properties);
  }

}