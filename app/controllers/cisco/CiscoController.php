<?php

namespace app\controllers\cisco;

use app\models\BaseModel;
use core\Controller;
use core\Core;

class CiscoController extends Controller {

  public static $registry;

  protected $CiscoModel; // переменная для хранения объекта модели админки

  public $layout = 'cisco';

  /** переменные для шаблона default */
  protected $meta; // мета теги
  protected $styles; // стили с полными путями
  protected $scripts1; // скрипты с полными путями
  protected $title; // хранение заголовка страницы
  protected $analytics; // счетчики для статистики
  protected $body;
  protected $scripts2; // скрипты с полными путями

  /* Переменные для вида _meta */
  //public $view;
  protected $description; // описание
  protected $keywords; // ключевые слова

  /* Переменные для вида _styles */
  protected $template; // шаблон(тема)

  protected $totop; // кнопка наверх

  protected $zakaz; // блок оформления заказа
  protected $webmoney; // блок оплаты через webmoney
  protected $yandex; // блок оплаты через yandex
  public $subscription; // блок для формы подписки

  protected $settings; // настройки сайта

  //public $id; // идентификатор категории, поста, пользователя и прочее
  protected $text; // текст страницы
  protected $pages; // список всех страниц и их алиасов
  protected $p; // номер текущей страницы для постраничной навигации
  protected $image;

  protected $online_users; // общее количество онлайн пользователей на сайте


  public function __construct($route) {
    //echo 'CiscoController (CISCO) - метод __construct() до родительского метода __construct()<br>';
    parent::__construct($route);
    //echo 'CiscoController (CISCO) - метод __construct() после родительского метода __construct()<br>';
    //session_start();

    //debug($this->route);
    //debug($this->alias);

    // блок оформления заказа
    $this->zakaz = $this->render('_zakaz');
    //echo $this->zakaz;

    // блок оплаты через webmoney
    $this->webmoney = $this->render('_webmoney');
    //echo $this->webmoney;

    // блок оплаты через yandex
    $this->yandex = $this->render('_yandex');
    //echo $this->yandex;

    // форма подписки

    // рендеринг блока подписки на рассылку новостей
    $this->subscription = $this->render('_subscription', ['subscription_token' => $this->getToken('subscription')]);
    //debug($this->subscription);

  }

  public function defaultAction(){

  }

  public function indexAction(){

    //echo 'CiscoController (CISCO) - IndexAction';



  }

  // метод для получения HTML-кода и вывода страницы на экран
  public function output() {
    // echo 'CiscoController - родительский метод output()<br>';

    // ГЕНЕРАЦИЯ ОБЩИХ ВИДОВ ДЛЯ СТРАНИЦ (начало)

    // кнопка вверх
    $this->totop = $this->render('_totop');
    //echo $this->totop;

    //$this->body = $this->render('_body', array(
      //'modal' => $this->modal,
      //'header' => $this->header,
      //'topmenu' => $this->topmenu,

      //'leftmenu' => $this->leftmenu,
      //'authorization' => $this->authorization,
      //'statistics' => $this->statistics,

      //'centerblock' => $this->centerblock,
      //'breadcrumbs' => $this->breadcrumbs,
      //'content' => $this->content,
      //'bottommenu' => $this->bottommenu,
      //'footer' => $this->footer,
      //'totop' => $this->totop,
    //));

    $this->meta = $this->render('_meta', ['view' => $this->view, 'description' => $this->description, 'keywords' => $this->keywords]);
    //debug($this->meta);

    $this->template = 'light';

    $this->styles = $this->render('_styles', ['prefix' => $this->prefix, 'template' => $this->template]);

    $this->scripts1 = $this->render('_scripts1');

    $this->analytics = ''; //$this->render('_analytics');

    $this->scripts2 = $this->render('_scripts2', ['prefix' => $this->prefix]);

    $this->set([
      'meta' => $this->meta,
      'styles' => $this->styles,
      'scripts1' => $this->scripts1,
      'title' => $this->title,
      'analytics' => $this->analytics,
      //'body' => $this->body,
      'content' => $this->content,
      'totop' => $this->totop,
      'scripts2' => $this->scripts2
    ]);

    //echo 'CiscoController - родительский метод output()';
    // ГЕНЕРАЦИЯ ОБЩИХ ВИДОВ ДЛЯ СТРАНИЦ (конец)

  }





}