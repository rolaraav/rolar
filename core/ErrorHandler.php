<?php
namespace core;

use \Exception;
//use \Throwable;

/*class NotFoundException extends Exception{

  public function __construct($message = '', $code = 404, Throwable $previous = null) {
    parent::__construct($message, $code, $previous);
  }

}*/

class ErrorHandler {

  use TSingletone;

  public $response = 500; // код ответа HTTP-сервера

  public function __construct() {
    //echo 'ErrorHandler::__construct()<br>';
    // если режим отладки включен, то отображаются все ошибки
    if (DEBUG == true) {
      error_reporting(-1); // отображать все ошибки
      $this->response = 500; // http_response_code(); // код ответа HTTP-сервера
    }
    else {
      error_reporting(0); // иначе не отображать ошибки
    }
    set_error_handler([$this, 'errorHandler']); // перехват ошибок из php и задание функции для обработчика ошибок
    register_shutdown_function([$this, 'fatalErrorHandler']); // перехват фатальных ошибок
    set_exception_handler([$this, 'exceptionHandler']); // перехват исключений
  }

  // обработчик обычных ошибок
  public function errorHandler($errno, $errstr, $errfile, $errline){
    //echo 'Сработал метод errorHandler';
    $this->logErrors($errno, $errstr, $errfile, $errline, $this->response);
    if(DEBUG || in_array($errno, [E_USER_ERROR, E_RECOVERABLE_ERROR])) { // в режиме отладки выводить на экран и останавливать скрипт
      $this->displayError($errno, $errstr, $errfile, $errline, $this->response);
    }
    return true; // не нужно возвращать false, чтобы обработка ошибок не передавась дальше
  }

  // обработчик фатальных ошибок
  public function fatalErrorHandler(){
    //echo 'Сработал метод fatalErrorHandler';
    $error = error_get_last(); // получение последней ошибки скрипта
    ob_start();
    if(!empty($error) && $error['type'] & (E_ERROR | E_PARSE | E_COMPILE_ERROR | E_CORE_ERROR)) {
      $this->logErrors($error['type'],$error['message'],$error['file'],$error['line'],$this->response);
      ob_end_clean();
      $this->displayError($error['type'],$error['message'],$error['file'],$error['line'],$this->response); // вывод сообщения об ошибке
    }
    else {
      ob_end_flush();
    }
    return true;
  }

  // обработчик исключений
  public function exceptionHandler(Exception $e){
    // echo 'Сработал метод exceptionHandler';
    $this->logErrors('Исключение', $e->getMessage(), $e->getFile(), $e->getLine(), $e->getCode());
    $this->displayError('Исключение', $e->getMessage(), $e->getFile(), $e->getLine(), $e->getCode());
    return true;
  }

  // запись ошибок в log-файл
  protected function logErrors($type = '', $message = '', $file = '', $line = '', $response = 500) {
    $error = '['.date('Y-m-d H:i:s').'] Ошибка: '.$type.' | Код ответа HTTP: '.$response.' | Текст ошибки: '.strip_tags($message).' | Файл: '.$file.' | Строка: '.$line."\r\n";
    error_log($error, 3, T.S.'errors.log'); // отправляет сообщение об ошибке заданному обработчику ошибок
    //file_put_contents(T.S.'log.txt',$error,FILE_APPEND); // запись ошибок в log-файл
    return true;
  }

  // вывод сообщений от ошибке на экран
  protected function displayError($errno, $errstr, $errfile, $errline, $response = 500){
    $this->response = http_response_code($response); // Получает или устанавливает код ответа HTTP-сервера
    if($response == 404 && !DEBUG) {
      require_once CORE.S.'errors/404.php';
      die;
    }
    if(DEBUG) {
      require_once CORE.S.'errors/dev.php';
    }
    else {
      require_once CORE.S.'errors/prod.php';
    }
    die;
  }

}