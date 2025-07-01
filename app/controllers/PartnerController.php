<?php

namespace app\controllers;

use app\models\BaseModel;
use core\libs\Breadcrumbs;
use core\View;
use core\Controller;
use core\Core;
use \R;

class PartnerController extends BaseController {

  public $vars; // тут всякие переменные
  public $partners; // все партнёры (массив)
  public $partner; // текущий партнер

  public function indexAction() {
    //echo 'PartnerProductsController - метод indexAction()<br>';

    // здесь мы получаем данные из БД, формируем массивы и переменные, необходимые только для этого контроллера (центральной части)
    // рендеринг (преобразование в html-код) основной части (контента страницы) осуществляется в главном контроллере Controller в методе getView
    // метод set() главного контроллера Controller позволяет передать все полученные переменные в шаблон нужного вида, например index

    //echo $this->view;
    $this->page = $this->Model->get_page($this->alias); // получение отдельной страницы
    $this->Model->update_view('pages', $this->page['id'], $this->page['view']); // обновление количества просмотров $update_view
    //debug($this->page);

    $this->description = $this->page['description']; // Описание страницы
    $this->keywords = $this->page['keywords']; // Ключевые слова
    $this->title = $this->page['title']; // Заголовок страницы

    $breadcrumbs = new Breadcrumbs(); // получение хлебных крошек
    $this->breadcrumbs = $breadcrumbs->getBreadcrumbs($this->alias,$this->title); //'Партнёрские продукты';

    //$content = 'Тут текст контента';

    $this->set([
      'description' => $this->description,
      'keywords' => $this->keywords,
      'title' => $this->title,
      'breadcrumbs' => $this->breadcrumbs,
      'page' => $this->page,
      //'balls' => $this->balls,
    ]);

    //parent::indexAction(); // выполнение рдительского indexAction

  }

}