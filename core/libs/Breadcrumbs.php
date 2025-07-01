<?php

namespace core\libs;

use core\Controller;
use core\Core;
use app\models\BaseModel;

class Breadcrumbs {

  public $breadcrumbs; // готовые хлебные крошки

  public $breadcrumbs_array = array(); // массив хлебных крошек

  public $link_alias = 'post';

  public function __construct($options = []) {
    $this->getOptions($options); // получение исходных параметров
  }

  // вывод объекта класса через echo
  public function __toString() {
    return $this->breadcrumbs; // вывод строки из хлебных крошек (верхней навигации)
  }

  // функция для получения исходных параметров
  protected function getOptions($options){
    foreach($options as $k => $v) {
      if(property_exists($this, $k)){ // проверка существования свойств класса в массиве опций
        $this->$k = $v;
      }
    }
  }

  /* метод для формирования хлебных крошек
    $title - заголовок текущего поста (заметки) или категории (раздела, страницы)
    $id_or_alias - идентификатор или алиас текущего поста (заметки) или категории (раздела, страницы)
    $category - инедтификатор категории, если есть
  */
  public function getBreadcrumbs($title = '', $id_or_alias = 0, $category = 0, $link_alias = 'post'){
    // если передан идентификатор категории, то вычисляем название и id текущей и всех родительских категорий и получаем массив хлебных крошек
    if (abs((int)$category) > 0) {
      // получение всех категорий из массива параметров
      $categories = Core::$core->getProperty('categories');
      //debug($categories);
      // если категории в массиве параметров не найдены, получаем категории из кэша или базы данных
      if (empty($categories)) {
        $categories = Core::cacheCategory();
        //debug($categories);
      }
      $this->breadcrumbs_array = $this->getParts($categories, $category);
      //debug($this->breadcrumbs_array);
    }
    // если передан заголовок и идентификатор/алиас, то делаем дальнейшие проверки и определяем элементы массива $this->breadcrumbs_array
    if ((!empty($title)) and (!empty($id_or_alias))) {
      //echo (int)$id_or_alias;
      // определяем что передано строка или число
      if (abs((int)$id_or_alias) > 0) { // передан идентификатор $id ($alias - пустой)
        //echo 'передан идентификатор<br>';
        if (preg_match("#^20[0-9]{2}-0[1-9]|1[012]$#", $id_or_alias)) {
          $this->breadcrumbs_array[$link_alias.$id_or_alias] = $title; // для даты
        }
        else {
          $this->breadcrumbs_array[$link_alias.abs((int)$id_or_alias)] = $title;
        }
      }
      else { // иначе передан алиас ($id == 0)
        //echo 'передан алиас<br>';
        $this->breadcrumbs_array[(string)$id_or_alias] = $title;
      }

    }
    //debug($this->breadcrumbs_array);

    $this->breadcrumbs = $this->renderBreadcrumbs(['breadcrumbs_array' => $this->breadcrumbs_array]);
    //debug($this->breadcrumbs);
    return $this->breadcrumbs;
  }

  // метод для получения массива категорий
  public function getParts($categories = [], $id){
    //debug($id);
    //debug($categories);

    if(!$id) return false;
    //$categories = [];
    $breadcrumbs = [];
    foreach($categories as $key => $value){
      if(isset($categories[$id])){
        $breadcrumbs[$categories[$id]['alias']] = $categories[$id]['title'];
        $id = $categories[$id]['parent'];
      } else break;
    }
    return array_reverse($breadcrumbs, true);
  }

  // метод для рендеринга хлебных крошек
  public function renderBreadcrumbs($vars = []) {
    if (empty($vars)) return false;
    if (is_array($vars)) {
      extract($vars); // формирование переменных из массива параметров
    }
    ob_start();
    require __DIR__.'/breadcrumb/breadcrumb.tpl.php';
    return ob_get_clean();
    //return $this->render('_breadcrumbs',$vars);
  }


  // метод для получения html-кода хлебных крошек НЕ ИСПОЛЬЗУЕТСЯ
  protected function getBreadcrumbsHtml($breadcrumbs_array = []){
    if (empty($breadcrumbs_array)) return false;
    $breadcrumbs_tail = '';
    if (is_array($breadcrumbs_array)) {
      foreach($breadcrumbs_array as $alias => $title){
        $breadcrumbs_tail .= $this->breadcrumbToTemplate($breadcrumbs_array);
      }
    }
    return $breadcrumbs_tail;
  }

  // метод для рендеринга нужного шаблона хлебных крошек НЕ ИСПОЛЬЗУЕТСЯ
  protected function breadcrumbToTemplate($breadcrumbs_array = []){
    ob_start();
    require __DIR__.'/breadcrumb/breadcrumb.tpl.php';
    return ob_get_clean();
  }


}