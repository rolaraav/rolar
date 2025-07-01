<?php

namespace app\controllers\admin;

use core\libs\Pagination;
use app\controllers\BaseController;
use app\models\BaseModel;
use core\libs\Breadcrumbs;
use core\View;
use core\Controller;
use core\Core;
use \R;

class PhrasesController extends AdminController {

  public $phrases; // HTML-блоки со всеми фразами

  public $layout = 'default'; /* 'admin' */

  public $phrase; // выбранная (текущая) фраза

  public function __construct($route) {
    parent::__construct($route);

  }

  public function indexAction() {
    //echo 'PhrasesController - метод indexAction()<br>';

    // здесь мы получаем данные из БД, формируем массивы и переменные, необходимые только для этого контроллера (центральной части)
    // рендеринг (преобразование в html-код) основной части (контента страницы) осуществляется в главном контроллере Controller в методе getView
    // метод set() главного контроллера Controller позволяет передать все полученные переменные в шаблон нужного вида, например index

    //echo $this->view;
    //$this->page = $this->Model->get_category_by_alias($this->alias); // получение отдельной страницы
    //$this->Model->update_view('categories', $this->page['id'], $this->page['view']); // обновление количества просмотров $update_view
    //debug($this->page);
    $this->description = 'Мудрые фразы'; // $this->page['description']; // Описание страницы
    $this->keywords = $this->page['keywords']; // Ключевые слова
    $this->title = 'Мудрые фразы';

    $this->breadcrumbs = $this->breadcrumbs.' &raquo; <a class="current" href="'.ADMIN.S.$this->alias.'" target="_self" title="'.$this->title.'">'.$this->title.'</a>';

    $this->current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // номер текущей страницы
    //debug($this->current_page);

    // если количество постов на странице не определено, то берём данные из настроек
    if(!$this->quantity_posts) {
      $this->quantity_posts = ADMIN_QUANTITY_POSTS;
      //$this->quantity_posts = Core::$core->getProperty('quantity_posts'); // количество постов на странице $pagination
    }

    $this->total_posts_pagination = $this->AdminModel->count_admin_total_phrases(); // общее количество мудрых фраз
    //debug($this->total_posts_pagination);

    $pagination = new Pagination($this->current_page, $this->quantity_posts, $this->total_posts_pagination);
    $start = $pagination->getStart(); // получение номера начального поста (записи, новости, продукта, закачки, товара) для параметра LIMIT
    //var_dump($pagination->pagination);
    $this->pagination = $this->render_cppagination(['pagination' => $pagination->pagination, 'uri' => $pagination->uri, 'quantity_posts' => $this->quantity_posts]);
    //debug($this->pagination);

    //$total_post = count_post($type,$category,null); // общее количество новостей
    $limit = [$start, $this->quantity_posts]; //pagnav_calc2($num,$total_post); // параметры для постраничной навигации

    $phrases = $this->AdminModel->get_view_phrases($limit); // получение мудрых фраз и рендеринг блока (список блоков) с мудрыми фразами
    //debug($phrases);
    //$this->phrases = $this->renderBlock('_phrases', 'Мудрые фразы', ['phrases' => $phrases, 'if_empty' => 'Мудрых фраз пока нет']); // блок с мудрой фразой
    // debug($this->phrases);

    //$this->breadcrumbs = $this->breadcrumbs_obj->getBreadcrumbs($this->title,$this->alias); //'Об авторе'; // false - на главной странице направляющие не выводятся

//      $content = 'Тут текст контента';

    $this->set([
      'description' => $this->description,
      'keywords' => $this->keywords,
      'title' => $this->title,
      'breadcrumbs' => $this->breadcrumbs,
      'pagination' => $this->pagination,
      'phrases' => $phrases,
     ]);

    //parent::indexAction(); // выполнение рдительского indexAction
  }

  public function viewAction() {

  }

  public function createAction() {
    $title = 'Мудрые фразы';
    $this->title = 'Создать фразу';
    $this->breadcrumbs = $this->breadcrumbs.' &raquo; <a href="'.ADMIN.S.$this->alias.'" target="_self" title="'.$title.'">'.$title.'</a> &raquo; <a class="current" href="'.ADMIN.S.$this->alias.S.'create" target="_self" title="'.$this->title.'">'.$this->title.'</a>';

    $published1 = CHECK;
    $published0 = '';
    $del1 = '';
    $del0 = CHECK;
    if (isset($_SESSION['create'])) {
      if (isset($_SESSION['create']['published']) and ($_SESSION['create']['published'] == 1)) {
        $published1 = CHECK;
        $published0 = '';
      }
      else {
        $published1 = '';
        $published0 = CHECK;
      }
      if (isset($_SESSION['create']['del']) and ($_SESSION['create']['del'] == 1)) {
          $del1 = CHECK;
          $del0 = '';
        }
        else {
          $del1 = '';
          $del0 = CHECK;
        }
    }

    if (isset($_POST['submit_phrase'])) {
      if ($this->AdminModel->create_phrase()) {
        redirect(ADMIN.S.$this->alias);
      }
      else {
        redirect();
      }
    }

    $this->set([
      //'description' => $this->description,
      //'keywords' => $this->keywords,
      'title' => $this->title,
      //'image' => $this->image,
      //'text' => $this->text,
      'breadcrumbs' => $this->breadcrumbs,
      //'page' => $this->page,
      'published0' => $published0,
      'published1' => $published1,
      'del1' => $del1,
      'del0' => $del0
    ]);

  }

  public function editAction() {

    //debug($this->id); // получаем идентификатор фразы
    if ((empty($this->id) or ($this->id == 0))) {
      $phrase_id = 1; // если параметр ID не передан, то показываем первую фразу
    }
    else {
      $phrase_id = $this->id;
    }

    $title = 'Мудрые фразы';
    $this->title = 'Редактировать фразу';
    $this->breadcrumbs = $this->breadcrumbs.' &raquo; <a href="'.ADMIN.S.$this->alias.'" target="_self" title="'.$title.'">'.$title.'</a> &raquo; <a class="current" href="'.ADMIN.S.$this->alias.S.'edit'.S.$phrase_id.'" target="_self" title="'.$this->title.'">'.$this->title.'</a>';

    $this->phrase = $this->AdminModel->cp_get_phrase($phrase_id);
    //debug($this->phrase);

    $published1 = CHECK;
    $published0 = '';
    $del1 = '';
    $del0 = CHECK;
    if (isset($this->phrase)) {
      if ($this->phrase['published'] == 1) {
        $published1 = CHECK;
        $published0 = '';
      }
      else {
        $published1 = '';
        $published0 = CHECK;
      }
      if ($this->phrase['del'] == 1) {
        $del1 = CHECK;
        $del0 = '';
      }
      else {
        $del1 = '';
        $del0 = CHECK;
      }
    }

    if (!empty($this->phrase)) {
      if (isset($_POST['submit_phrase'])) {
        if ($this->AdminModel->edit_phrase($phrase_id)) {
          redirect(ADMIN.S.$this->alias);
        }
        else {
          redirect();
        }
      }
    }

    $this->set([
      //'description' => $this->description,
      //'keywords' => $this->keywords,
      'title' => $this->title,
      //'image' => $this->image,
      //'text' => $this->text,
      'breadcrumbs' => $this->breadcrumbs,
      'phrase' => $this->phrase,
      'published0' => $published0,
      'published1' => $published1,
      'del1' => $del1,
      'del0' => $del0
    ]);

  }

  public function deleteAction() {
    //debug($this->id); // получаем идентификатор фразы
    if ((empty($this->id) or ($this->id == 0))) {
      $phrase_id = 1; // если параметр ID не передан, то показываем первую фразу
    }
    else {
      $phrase_id = $this->id;
    }

    $title = 'Мудрые фразы';
    $this->title = 'Удалить фразу';
    $this->breadcrumbs = $this->breadcrumbs.' &raquo; <a href="'.ADMIN.S.$this->alias.'" target="_self" title="'.$title.'">'.$title.'</a> &raquo; <a class="current" href="'.ADMIN.S.$this->alias.S.'delete'.S.$phrase_id.'" target="_self" title="'.$this->title.'">'.$this->title.'</a>';

    $this->phrase = $this->AdminModel->cp_get_phrase($phrase_id);
    //debug($this->phrase);

    $published1 = CHECK;
    $published0 = '';
    $del1 = '';
    $del0 = CHECK;
    if (isset($this->phrase)) {
      if ($this->phrase['published'] == 1) {
        $published1 = CHECK;
        $published0 = '';
      }
      else {
        $published1 = '';
        $published0 = CHECK;
      }
      if ($this->phrase['del'] == 1) {
        $del1 = CHECK;
        $del0 = '';
      }
      else {
        $del1 = '';
        $del0 = CHECK;
      }
    }

    if (!empty($this->phrase)) {
      if (isset($_POST['submit_phrase'])) {
        if ($this->AdminModel->delete_phrase($phrase_id)) {
          redirect(ADMIN.S.$this->alias);
        }
        else {
          redirect();
        }
      }
    }

    $this->set([
      //'description' => $this->description,
      //'keywords' => $this->keywords,
      'title' => $this->title,
      //'image' => $this->image,
      //'text' => $this->text,
      'breadcrumbs' => $this->breadcrumbs,
      'phrase' => $this->phrase,
      'published0' => $published0,
      'published1' => $published1,
      'del1' => $del1,
      'del0' => $del0
    ]);

  }

}