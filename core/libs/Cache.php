<?php
namespace core\libs;

use core\TSingletone;
// класс кэширования
class Cache {

  use TSingletone;

  public function __construct() {

  }

  // сохранение данных в кэш
  public function set($key, $data, $seconds = 3600){
    if($seconds) {
      $content['data'] = $data;
      $content['end_time'] = time() + $seconds;
      if(file_put_contents(CACHE.S.md5($key).'.txt', serialize($content))){
        return true;
      }
    }
    return false;
  }

  // получение данных из кэша
  public function get($key){
    $file = CACHE.S.md5($key).'.txt';
    if (file_exists($file)) {
      $content = unserialize(file_get_contents($file));
      if(time() <= $content['end_time']) {
        return $content['data'];
      }
      unlink($file);
    }
    return false;
  }

  // удаление данных из кэша
  public function delete($key){
    $file = CACHE.S.md5($key).'.txt';
    if (file_exists($file)) {
      unlink($file);
    }
  }

}