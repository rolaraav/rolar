<?php
namespace core;

trait TSingletone {

  /**
   * @var TSingleton
   */
  private static $instance;

  /**
   * gets the instance via lazy initialization (created on first usage)
   */
  public static function instance() {
    if (static::$instance === null) {
      static::$instance = new static();
    }
    return static::$instance;
  }

  /**
   * is not allowed to call from outside to prevent from creating multiple instances,
   * to use the singleton, you have to obtain the instance from Singleton::instance() instead
   */
  private function __construct() {

  }

  /**
   * prevent the instance from being cloned (which would create a second instance of it)
   */
  private function __clone() {

  }

  /**
   * prevent from being unserialized (which would create a second instance of it)
   */
  private function __wakeup() {

  }

  public function getProperty(){

  }
}