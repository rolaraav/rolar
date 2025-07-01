<?php
namespace core;
use \Exception;

class View extends Controller {

  use TSingletone;

  /*
 * Текущий маршрут и параметры (controller, action, params)
 * @var array
 */
  //protected $route = []; // данные для текущего маршрута

  /*
 * Текущий вид
 * @var string
 */
  //public $view;

  /*
 * Текущий шаблон
 * @var string
 */
  //public $layout;

  //public $scripts = [];

  //protected $controller; // свойство для хранения имени контроллера
  //protected $model;

  //protected $prefix; // префикс для имени контроллера

  //protected $data = []; // различные данные, которые передаются в вид

 // protected $meta = []; // мета-данные для веб-страницы - заголовок, ключевые слова и краткое описание


  //public static $meta = ['title' => '', 'desc' => '', 'keywords' =>''];

  public function __construct($route = [], $layout = '', $view = '', $meta = '') {
    //var_dump($layout);
    //var_dump($view);

    $this->route = $route;
    //debug($this->route);

    $this->controller = $route['controller'];
    $this->model = $route['controller'];
    $this->prefix = $route['prefix'];
    $this->separator = $route['separator'];
    $this->prefix_separator = $route['prefix_separator'];
    //debug($this->prefix_separator);
    //$this->meta = $meta;

    // если шаблон выключен, то
    if($layout === false) {
      $this->layout = false; // присваеваем значение false
    }
    else {
      $this->layout = $layout ?: LAYOUT; // иначе выбираем нужный шаблон
    }

    $this->view = $view; //$route['action']; //$view;
  }


  protected function getScript($content) {
    $pattern = "#<script.*?>.*?</script>#si";
    preg_match_all($pattern, $content, $this->scripts);
    if(!empty($this->scripts)) {
      $content = preg_replace($pattern, '', $content);
    }
    return $content;
  }

/*  public static function getMeta(){
    echo '<title>'.self::$meta['title'].'</title>
          <meta name="description" content="'.self::$meta['desc'].'">
<meta name="keywords" content="'.self::$meta['keywords'].'">
';
  }*/

//  public static function setMeta($title='',$desc='',$keywords=''){
//    self::$meta['title'] = $title;
//    self::$meta['desc'] = $desc;
//    self::$meta['keywords'] = $keywords;
//  }

}