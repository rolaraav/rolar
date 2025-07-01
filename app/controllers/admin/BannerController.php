<?php

namespace app\controllers\admin;

use core\libs\Pagination;

class BannerController extends AdminController {

  public $banners; // HTML-блоки со всеми баннерами

  public $layout = 'default'; /* 'admin' */

  public $banner; // выбранный баннер

  public function __construct($route) {
    parent::__construct($route);

  }

  public function indexAction() {
    //echo 'BannerController - метод indexAction()<br>';

    $this->description = 'Баннеры'; // $this->page['description']; // Описание страницы
    //$this->keywords = $this->page['keywords']; // Ключевые слова
    $this->title = 'Баннеры';

    $this->breadcrumbs = $this->breadcrumbs.' &raquo; <a class="current" href="'.ADMIN.S.$this->alias.'" target="_self" title="'.$this->title.'">'.$this->title.'</a>';

    $this->current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // номер текущей страницы
      //debug($this->current_page);

      // если количество постов на странице не определено, то берём данные из настроек
    if(!$this->quantity_posts) {
    $this->quantity_posts = ADMIN_QUANTITY_POSTS;
      //$this->quantity_posts = Core::$core->getProperty('quantity_posts'); // количество постов на странице $pagination
    }

    $this->total_posts_pagination = $this->AdminModel->count_admin_total_banners(); // общее количество мудрых фраз
    //debug($this->total_posts_pagination);

    $pagination = new Pagination($this->current_page, $this->quantity_posts, $this->total_posts_pagination);
    $start = $pagination->getStart(); // получение номера начального поста (записи, новости, продукта, закачки, товара) для параметра LIMIT
    //var_dump($pagination->pagination);
    $this->pagination = $this->render_cppagination(['pagination' => $pagination->pagination, 'uri' => $pagination->uri, 'quantity_posts' => $this->quantity_posts]);
    //debug($this->pagination);

    //$total_post = count_post($type,$category,null); // общее количество новостей
    $limit = [$start, $this->quantity_posts]; //pagnav_calc2($num,$total_post); // параметры для постраничной навигации

    $banners = $this->AdminModel->get_view_banners($limit); // получение мудрых фраз и рендеринг блока (список блоков) с баннерами
    //debug($banners);
    foreach($banners as $key => $banner) {
      $banner['file_extension'] = getExtension($banner['image']); // получаем расширение файла (отрезаем все символы, кроме 3-х последних символов в названии файла)
      //debug($banner);
      if ($banner['type'] == 1) { // если баннер горизонтальный, type = 1
        $banner['code'] = $this->render('_banner', ['banner' => $banner]); // блок с баннером
      }
      else { // иначе, если баннер вертикальный
        $banner['code'] = $this->render('_leftbanner', ['left_banner' => $banner]); // блок с баннером
      }
      //$banner['code'] = $code;
      //debug($code);
      $banners[$key] = $banner;
    }
    //debug($banners);




    //$this->breadcrumbs = $this->breadcrumbs_obj->getBreadcrumbs($this->title,$this->alias); //'Об авторе'; // false - на главной странице направляющие не выводятся

    //      $content = 'Тут текст контента';

    $this->set([
      'description' => $this->description,
      'keywords' => $this->keywords,
      'title' => $this->title,
      'breadcrumbs' => $this->breadcrumbs,
      'pagination' => $this->pagination,
      'banners' => $banners,
    ]);

    //parent::indexAction(); // выполнение рдительского indexAction
  }

  public function viewAction() {

  }

  public function createAction() {
    $title = 'Баннеры';
    $this->title = 'Создать баннер';
    $this->breadcrumbs = $this->breadcrumbs.' &raquo; <a href="'.ADMIN.S.$this->alias.'" target="_self" title="'.$title.'">'.$title.'</a> &raquo; <a class="current" href="'.ADMIN.S.$this->alias.S.'create" target="_self" title="'.$this->title.'">'.$this->title.'</a>';

    $published1 = CHECK;
    $published0 = '';
    $type1 = CHECK;
    $type2 = '';
    if (isset($_SESSION['create'])) {
      if (isset($_SESSION['create']['published']) and ($_SESSION['create']['published'] == 1)) {
        $published1 = CHECK;
        $published0 = '';
      }
      else {
        $published1 = '';
        $published0 = CHECK;
      }
      if (isset($_SESSION['create']['type']) and ($_SESSION['create']['type'] == 1)) {
        $type1 = CHECK;
        $type2 = '';
      }
      else {
        $type1 = '';
        $type2 = CHECK;
      }
    }

    if (isset($_POST['submit_banner'])) {
      if ($this->AdminModel->create_banner()) {
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
      'type1' => $type1,
      'type2' => $type2
    ]);

  }

  public function editAction() {

    //debug($this->id); // получаем идентификатор баннера
    if ((empty($this->id) or ($this->id == 0))) {
      $banner_id = 1; // если параметр ID не передан, то показываем первый баннер
    }
    else {
      $banner_id = $this->id;
    }

    $title = 'Баннеры';
    $this->title = 'Редактировать баннер';
    $this->breadcrumbs = $this->breadcrumbs.' &raquo; <a href="'.ADMIN.S.$this->alias.'" target="_self" title="'.$title.'">'.$title.'</a> &raquo; <a class="current" href="'.ADMIN.S.$this->alias.S.'edit'.S.$banner_id.'" target="_self" title="'.$this->title.'">'.$this->title.'</a>';

    $this->banner = $this->AdminModel->cp_get_banner($banner_id);
    //debug($this->banner);

    $published1 = CHECK;
    $published0 = '';
    $type1 = CHECK;
    $type2 = '';
    if (isset($this->banner)) {
      if ($this->banner['published'] == 1) {
        $published1 = CHECK;
        $published0 = '';
      }
      else {
        $published1 = '';
        $published0 = CHECK;
      }
      if ($this->banner['type'] == 1) {
        $type1 = CHECK;
        $type2 = '';
      }
      else {
        $type1 = '';
        $type2 = CHECK;
      }
    }

    if (!empty($this->banner)) {
      if (isset($_POST['submit_banner'])) {
        if ($this->AdminModel->edit_banner($banner_id)) {
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
      'banner' => $this->banner,
      'published0' => $published0,
      'published1' => $published1,
      'type1' => $type1,
      'type2' => $type2
    ]);

  }

  public function deleteAction() {
    //debug($this->id); // получаем идентификатор баннера
    if ((empty($this->id) or ($this->id == 0))) {
      $banner_id = 1; // если параметр ID не передан, то показываем первый баннер
    }
    else {
      $banner_id = $this->id;
    }

    $title = 'Баннеры';
    $this->title = 'Удалить баннер';
    $this->breadcrumbs = $this->breadcrumbs.' &raquo; <a href="'.ADMIN.S.$this->alias.'" target="_self" title="'.$title.'">'.$title.'</a> &raquo; <a class="current" href="'.ADMIN.S.$this->alias.S.'delete'.S.$banner_id.'" target="_self" title="'.$this->title.'">'.$this->title.'</a>';

    $this->banner = $this->AdminModel->cp_get_banner($banner_id);
    //debug($this->banner);

    $published1 = CHECK;
    $published0 = '';
    $type1 = CHECK;
    $type2 = '';
    if (isset($this->banner)) {
      if ($this->banner['published'] == 1) {
        $published1 = CHECK;
        $published0 = '';
      }
      else {
        $published1 = '';
        $published0 = CHECK;
      }
      if ($this->banner['type'] == 1) {
        $type1 = CHECK;
        $type2 = '';
      }
      else {
        $type1 = '';
        $type2 = CHECK;
      }
    }

    if (!empty($this->banner)) {
      if (isset($_POST['submit_banner'])) {
        if ($this->AdminModel->delete_banner($banner_id)) {
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
      'banner' => $this->banner,
      'published0' => $published0,
      'published1' => $published1,
      'type1' => $type1,
      'type2' => $type2
    ]);

  }


}