<?php
namespace app\controllers;


class AudioController extends BaseController {


  public function indexAction() {
    //echo 'AudioController - метод indexAction()<br>';

    //echo $this->view;
    $this->page = $this->Model->get_category_by_alias($this->alias); // получение отдельной страницы
    $this->Model->update_view('categories', $this->page['id'], $this->page['view']); // обновление количества просмотров $update_view
    //debug($this->page);

    $this->description = $this->page['description']; // Описание страницы
    $this->keywords = $this->page['keywords']; // Ключевые слова
    $this->title = $this->page['title']; // Заголовок страницы

    $this->breadcrumbs = $this->breadcrumbs_obj->getBreadcrumbs($this->title,$this->alias); //'Об авторе'; // false - на главной странице направляющие не выводятся

    $this->set([
      'description' => $this->description,
      'keywords' => $this->keywords,
      'title' => $this->title,
      'breadcrumbs' => $this->breadcrumbs,
      'page' => $this->page,
    ]);

    //parent::indexAction(); // выполнение рдительского indexAction
  }

}