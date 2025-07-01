<?php
namespace core;
use \Exception;

final class Router {

  use TSingletone;

  protected static $routes = []; // массив маршрутов (таблица маршрутов)
  protected static $route = []; // текущий маршрут

/*
 * контроллер по умолчанию = 'Index'
 */
  protected static $default_controller = 'Index';

/*
 * метод класса по умолчанию = 'index'
 */
  protected static $default_action = 'index';

  /*
 * алиас страницы по умолчанию = 'index'
 */
  protected static $default_alias = 'index';

  /*
   * префикс в маршруте - пустая строка
   */
  protected static $default_prefix = '';

  /*
   * разделитель в маршруте - пустая строка
   */
  protected static $default_separator = '';

 /*
 * Постфикс в названии контроллера 'Controller'
 */
  protected static $controller_postfix = 'Controller';

  /*
 * Постфикс в названии метода(действия) 'Action'
 */
  protected static $action_postfix = 'Action';

  // текущий путь;
  protected $url;

  public function __construct() {
    //echo 'Router::__construct()<br>';
    //$this->url = rtrim($_SERVER['QUERY_STRING'], '/');
    //echo $url;
  }

  /* добавляет маршрут в таблицу маршрутов
   * @param string $regexp регулярное выражение маршрута
   * @param array $route маршрут ([controller, action, params])
   */
  public static function add($regexp, $route = []) {
    self::$routes[$regexp] = $route;
  }

  /*
   * возвращает таблицу маршрутов
  */
  public static function getRoutes() {
    return self::$routes;
  }

  /*
   * возврщает текущий маршрут
  */
  public static function getRoute() {
    return self::$route;
  }

  /* ищет URL в таблице маршрутов
   * @param string $url входной URL
   * @return boolean
  */
  protected static function matchRoute($url = '') {
    foreach (self::$routes as $pattern => $route) {
      if (preg_match("#$pattern#i", $url, $matches)) { // сравнение url-адреса с шаблоном и если совпадение найдено, то помещаем его в $matches (совпадения)
        //debug($matches);
        // если соотвествие найдено, то берем только строчные ключи массива соотвествий и их значения
        foreach ($matches as $k => $v) {
          if (is_string($k)) {
            $route[$k] = $v;
          }
        }

        // допустимые префиксы
        $admissible_prefixes = Core::$core->getProperty('route_prefixes'); // получение допустимых алиасов
        //debug($admissible_prefixes);

        // допустимые алиасы
        $admissible_aliases = Core::$core->getProperty('views'); // получение допустимых алиасов
        //debug($admissible_aliases);

        // недопустимые алиасы
        $inadmissible_aliases = Core::$core->getProperty('inadmissible_aliases'); // получение недопустимых алиасов
        //debug($inadmissible_aliases);

        // алиасы категорий
        $categories_aliases = self::get_categories_aliases(Core::$core->getProperty('categories'));
        //debug($categories_aliases);


        // !!!!!!!!!!нужно доработать!!!!!!!!!!!! если в массиве допустимых префиксов есть подходящий алиас
        //if (in_array($url, $admissible_prefixes)) {
          //debug($url);
          //$route['prefix'] = $url;
        //}

        // если в массиве допустимых алиасов (у которых есть свой собственный контроллер) есть подходящий алиас
        if (in_array($url, $admissible_aliases)) {
          $route['controller'] = self::upperCamelCase($url);
          $route['alias'] = $url;
          //debug($route['alias']);
        }

        // если в массиве алиасов категорий есть подходящий алиас, тогда контроллер-обработчик
        if (in_array($url, $categories_aliases)) {
          //debug($categories_aliases);
          // если в массиве недопустимых алиасов нет подходящего алиаса, тогда контроллер-обработчик - Category
          if (!in_array($url, $inadmissible_aliases)) {
            //echo 'недопустимый';
            $route['controller'] = 'Category';
            //$route['alias'] = 'category'; // и алиас = адресу url
            //echo 'Маршрут подходит '.$url;
          }
          //$route['alias'] = $url; // и алиас = адресу url
        }

        // если не задан контроллер, то выбирается контроллер по умолчанию - IndexController
        if (!isset($route['controller'])) {
          $route['controller'] = self::$default_controller;
          $route['alias'] = self::$default_alias; // алиас страницы по умолчанию = 'index'
        }
        else { // иначе используется выбранный контроллер
          if (!isset($route['alias'])) {
            $route['alias'] = lcfirst($route['controller']); // алиас страницы по умолчанию соответсвует выбранному контроллеру
          }
          //echo $route['alias'];
          $route['controller'] = self::upperCamelCase($route['controller']);
        }

        // если не задан метод (действие), то выполняется метод (действие) по умолчанию
        if (!isset($route['action'])) {
          $route['action'] = self::$default_action; // метод (действие) по умолчанию 'index'
        }

        // если не задан префикс, то префикс равен пустой строке ''
        if (!isset($route['prefix'])) {
          $route['prefix'] = self::$default_prefix;
          $route['separator'] = self::$default_separator;
          $route['prefix_separator'] = self::$default_separator;
          //debug($route['prefix']);
        }
        else {
          //$route['prefix'] .= '\\'; // префикс для контроллеров админки
          if (!in_array($route['prefix'], $admissible_prefixes)) { // если значение префикса отличается от допустимых значений, то префикс равен строке 'admin'
            $route['prefix'] = 'admin';
          }
          $route['separator'] = '\\';
          $route['prefix_separator'] = '/';
          //debug($route['prefix']);
        }
        // если не задан id, то получаем его из GET-параметров abs((int)$_GET['id'])
        if (!isset($route['id'])) {
          $route['id'] = 0; // идентификатор id
        }
        //debug($route);
        self::$route = $route;
        return true;
      }
    }
    return false;
  }

  /* перенаправляет URL по корректному маршруту
    @param string $url входящий URL
    @return void
  */
  public static function dispatch($url = '') {
    //debug($url);
    $url = self::removeQueryString($url);
    //var_dump($url);
    //debug($url);

    if (self::matchRoute($url)) {
      // полное имя контроллера
      $controller = 'app\controllers\\'.self::$route['prefix'].self::$route['separator'].self::$route['controller'].self::$controller_postfix;
      //debug($controller);
      if (class_exists($controller)) {
        $controller_object = new $controller(self::$route); // создание нового объекта класса для соответсвующего контроллера, параметром принимает текущий маршрут
        $action = self::lowerCamelCase(self::$route['action']).self::$action_postfix; // получение нужного метода полученного контроллера

        if (method_exists($controller_object, $action)) {
          $controller_object->$action(); // выполнение нужного метода полученного контроллера, получение данных для контента
          //$controller_object->request();
          $controller_object->renderHtml(); // генерация страницы и вывод на экран HTML-кода
          //$controller_object->outputpage();
          //echo $controller_object->getView();
        } else {
          //echo 'Метод <b>'.$controller.'::'.$action.'</b> не найден.';
          throw new Exception('Метод <strong>'.$controller.'::'.$action.'()</strong> не найден.', 404);
        }
      } else {
        //echo 'Контроллер <b>'.$controller.'</b> не найден.';
        throw new Exception('Контроллер <strong>'.$controller.'</strong> не найден.', 404);
      }
    } else {
      //http_response_code(404);
      //include '404.php';
      throw new Exception('Страница не найдена.', 404);
    }
  }

  /*
   * Преобразует имена к виду CamelCase
   * @param string $name строка для преобразования
   * @return string
   */
  protected static function upperCamelCase($name) {
    return str_replace(' ', '', ucwords(str_replace('-', ' ', str_replace('_', ' ', $name))));
  }

  /*
   * Преобразует имена к виду camelCase
   * @param string $name строка для преобразования
   * @return string
   */
  protected static function lowerCamelCase($name) {
    return lcfirst(self::upperCamelCase($name));
  }

/*
 * Представление Get-параметров, вырезает (удаляет) из url-адреса явные get-параметры, возвращает только неявные get-параметры, если они есть
 */
  protected static function removeQueryString($url) {
    //debug($url);
    $url = preg_replace('#\.php(&?(\w+)?=?([0-9]+)?)?#iu', '$3', $url); // замена для старых ссылок \.php(&?(id|rub|partner|cat|date)?=?([0-9]+)?)?
    //debug($url);
    if (isset($url)) {
      $params = explode('&', $url, 2); // разделение $url-адреса на две части: 1 - с неявными get-параметрами, 2 - с явными get-параметрами
      // если в нулевом элементе нет знака =, то возвращаем этот элемент (отрезая последний /), иначе возвращаем пустую строку
      if (strpos($params[0], '=') === false) {
        return rtrim($params[0], '/');
      }
      else {
        return '';
      }
    }
    return $url;
  }

  // Получение алиасов из массива категорий
  protected static function get_categories_aliases($categories) {
    if (!isset($categories)) return false;
    $aliases = array();
    foreach($categories as $item) {
      $aliases[] = $item['alias'];
    }
    return $aliases;
  }

}