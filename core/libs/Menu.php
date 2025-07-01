<?php
namespace core\libs;
use core\Controller;
use core\Core;
use app\models\BaseModel;
//use \R;

// Класс для формирования меню
class Menu {

  public $data = []; // данные из БД
  protected $tree; // дерево
  protected $menuHtml; // html- кода меню

  protected $partners = []; // массив партнёров из БД
  protected $tpl; // путь к шаблону
  protected $container = 'ul'; // контейнер в который будет оборачиваться меню
  //protected $class = 'menu';
  //protected $table = 'categories'; // таблица для получения данных
  protected $cache = 86400; // время кеширования в секундах, одни сутки 60 * 60 * 24 = 86400 секунд
  protected $cacheKey = 'menu'; // ключ кеша
  protected $attrs = []; // массив с атрибутами
  protected $prepend = ''; // вставка дополнительного кода перед меню

  public function __construct($options = []) {
    //echo 'Menu::__construct()<br>';
    //$this->tpl = 'menu.tpl'; // шаблон для меню по умолчанию
    $this->getOptions($options); // получение исходных параметров
    //$this->run();
  }

  // функция для получения исходных параметров
  protected function getOptions($options){
    foreach($options as $k => $v) {
      if(property_exists($this, $k)){ // проверка существования свойств класса в массиве опций
        $this->$k = $v;
      }
    }
    if ($this->container == 'select') {
      $this->tpl = 'select';
    }
    elseif($this->container == 'ul-li') {
      $this->tpl = 'ul-li';
    }
    else {
      $this->tpl = 'menu.tpl'; // шаблон для меню по умолчанию
    }
    //echo $this->tpl;
  }

  public function run() {
    //$cache = Cache::instance();
    $this->tree = Core::$core->Cache->get($this->cacheKey); // получаем дерево категорий из кеша
    //debug($this->tree);
    // если дерево категорий в кэше не найдено, то вычисляем его
    if(empty($this->tree)) {
      // получаем массив категорий из памяти
      $this->data = Core::$core->getProperty('categories');
      //debug($this->data);
      // если данные из памяти не получены, то получаем их из базы данных
      if (empty($this->data)) {
        $this->Model = new BaseModel; // создание модели и соединение с базой данных
        $this->data = $this->Model->get_categories_for_menu(); // получение категорий из базы данных
        //$cache->set('categories_for_menu', $this->data, $this->cache);
      }
      //debug($this->data);
      $format_data = $this->formatCategories($this->data); // приводим к нужному виду
      //debug($format_data);
      $this->tree = $this->getTree($format_data);
      //debug($this->tree);
      Core::$core->Cache->set($this->cacheKey, $this->tree, $this->cache); // сохранение в кеш
    }
    $this->menuHtml = $this->getMenuHtml($this->tree);
    //debug($this->menuHtml);
    //$this->output();
    return $this->menuHtml;
  }

  // метод для форматирования массива категорий из кэша или из памяти
  protected function formatCategories($categories = []){
    if (empty($categories)) {
      return false;
    }
    $array = [];
    foreach ($categories as $item) {
      if (isset($item['menu'])) {
        if ($item['menu'] == 1) {
          unset($item['menu']);
          $array[$item['id']] = $item;
        }
      }
      else {
        $array[$item['id']] = $item;
      }
    }
    return $array;
  }

  // метод для построения дерева из массива данных
  protected function getTree($data = []){
    if (empty($data)) {
      return false;
    }
    $tree = [];
    foreach ($data as $id => &$node) {
      //$tree[$node['id']] = $node;
      if (!$node['parent']){
        $tree[$id] = &$node;
      }else{
        $data[$node['parent']]['childs'][$id] = &$node;
      }
    }
    return $tree;
  }

  // метод для получения html-кода меню
  protected function getMenuHtml($tree, $tab = ''){
    if (empty($tree)) {
      return false;
    }
    $str = '';
    foreach($tree as $category){
      $str.= $this->catToTemplate($category, $tab);
    }
    return $str;
  }

  // метод для рендеринга нужного шаблона меню
  protected function catToTemplate($category, $tab){
    ob_start();
    require __DIR__.'/menu/'.$this->tpl.'.php';
    return ob_get_clean();
  }

  // метод для вывода данных
  protected function output(){
    $attrs = '';
    if (!empty($this->attrs)) {
      foreach($this->attrs as $k => $v) {
        $attrs .= ' '.$k.'=>'.$v.' ';
      }
    }
    echo '<'.$this->container.' class="'.$this->class.'"'.$this->attrs.'>'.$this->prepend.$this->menuHtml.'</'.$this->container.'>';
  }

}