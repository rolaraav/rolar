<?php
namespace app\controllers;

use app\models\BaseModel;
use core\libs\Breadcrumbs;
use core\View;
use core\Controller;
use core\Core;
use core\libs\Cache;
use \R;

class OfertaController extends BaseController {

  public function indexAction() {
    //echo 'OfertaController - метод indexAction()<br>';

    //debug($this->route);
    //debug($this->id);
    // здесь мы получаем данные из БД, формируем массивы и переменные, необходимые только для этого контроллера (центральной части)
    // рендеринг (преобразование в html-код) основной части (контента страницы) осуществляется в главном контроллере Controller в методе getView
    // метод set() главного контроллера Controller позволяет передать все полученные переменные в шаблон нужного вида, например index

    //echo $this->view;

    $this->page = $this->Model->get_category_by_alias($this->alias); // получение отдельной страницы
    $this->Model->update_view('categories', $this->page['id'], $this->page['view']); // обновление количества просмотров $update_view
    //debug($this->page);

    $this->description = $this->page['description']; // Описание страницы
    $this->keywords = $this->page['keywords']; // Ключевые слова
    $this->title = $this->page['title']; // Заголовок страницы

    $this->image = $this->page['image']; // Картинка страницы
    $this->text = $this->page['text']; // Текст страницы

    //$breadcrumbs = " &raquo; <a class=\"current\" href=\"$view.php\" target=\"_self\" title=\"$title\">$title</a>";

    $this->breadcrumbs = $this->breadcrumbs_obj->getBreadcrumbs($this->title,$this->alias); //'Новости';
    //debug($this->breadcrumbs_obj);

    //$content = 'Тут текст контента';

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