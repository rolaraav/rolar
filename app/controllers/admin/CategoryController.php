<?php
namespace app\controllers\admin;

use core\libs\Pagination;

class CategoryController extends AdminController {

  public $category; // выбранная категория
  public $parent_categories = ''; // блок select для выбора родительской категории

  public function indexAction() {

    //debug($user_id);
    //debug($_GET);
    if(isset($_GET['type'])) {
      $type_string = (string)$_GET['type'];
      switch ($type_string) {
        case('cat');
          $type = null; // все категории или 0
          $this->title = 'Категории'; // материалы
          $button_name = 'Создать категорию';
          $column_title = 'Название категорий';
          $ifempty = 'Категорий пока нет.';
          break;
        case('rub');
          $type = 1;
          $this->title = 'Рубрики новостей'; // материалы
          $button_name = 'Добавить рубрику';
          $column_title = 'Название рубрик';
          $ifempty = 'Рубрик пока нет.';
          break;
        case('partner');
          $type = 2;
          $this->title = 'Раздел (тематика) партнёрских продуктов';
          $button_name = 'Добавить раздел (тематику)';
          $column_title = 'Название разделов (тематик)';
          $ifempty = 'Разделов (тематик) пока нет.';
          break;
        case('section');
          $type = 3;
          $this->title = 'Раздел закачек';
          $button_name = 'Добавить раздел';
          $column_title = 'Название разделов';
          $ifempty = 'Разделов пока нет.';
          break;
        case('goods');
          $type = 4;
          $this->title = 'Категория товаров';
          $button_name = 'Создать категорию товаров';
          $column_title = 'Название категорий товаров';
          $ifempty = 'Категорий товаров пока нет.';
          break;
        case('gallery');
          $type = 5;
          $this->title = 'Тематика галереи';
          $button_name = 'Создать тематику галерей';
          $column_title = 'Название тематик галерей';
          $ifempty = 'Тематик галерей пока нет.';
          break;
        case('album');
          $type = 6;
          $this->title = 'Категория альбомов';
          $button_name = 'Cоздать категорию альбомов';
          $column_title = 'Название категорий альбомов';
          $ifempty = 'Категорий альбомов пока нет.';
          break;
        case('post');
          $type = 7;
          $this->title = 'Категория заметок';
          $button_name = 'Cоздать категорию заметок';
          $column_title = 'Название категорий заметок';
          $ifempty = 'Категорий заметок пока нет.';
          break;
      }
      $type_string_for_url = '?type='.$type_string;
      $this->breadcrumbs = $this->breadcrumbs.' &raquo; <a href="'.ADMIN.S.$this->alias.'" target="_self" title="Категории">Категории</a> &raquo; <a class="current" href="'.ADMIN.S.$this->alias.'?type='.$type_string.'" target="_self" title="'.$this->title.'">'.$this->title.'</a>';
    }
    else {
      $type = null; // все категории
      $this->title = 'Категории';
      $type_string_for_url = '';
      $this->breadcrumbs = $this->breadcrumbs.' &raquo; <a class="current" href="'.ADMIN.S.$this->alias.'" target="_self" title="'.$this->title.'">'.$this->title.'</a>';
      $button_name = 'Cоздать категорию';
      $column_title = 'Название категории';
      $ifempty = 'Категорий пока нет.';
    }






    $this->current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // номер текущей страницы
    //debug($this->current_page);

    // если количество постов на странице не определено, то берём данные из настроек
    if(!$this->quantity_posts) {
      $this->quantity_posts = ADMIN_QUANTITY_POSTS;
      //$this->quantity_posts = Core::$core->getProperty('quantity_posts'); // количество постов на странице $pagination
    }

    $this->total_posts_pagination = $this->AdminModel->count_admin_total_categories($type); // $this->total_data; // общее количество материалов // $this->AdminModel->get_total_posts('data', $category['type'], $query_category_id, null, $partner_id); // общее количество постов в выбранной категории
    //debug($this->total_posts_pagination);
    // debug($this->total_data);

    $pagination = new Pagination($this->current_page, $this->quantity_posts, $this->total_posts_pagination);
    $start = $pagination->getStart(); // получение номера начального поста (записи, новости, продукта, закачки, товара) для параметра LIMIT
    //var_dump($pagination->pagination);
    $this->pagination = $this->render_cppagination(['pagination' => $pagination->pagination, 'uri' => $pagination->uri, 'quantity_posts' => $this->quantity_posts]);
    //debug($this->pagination);

    //$total_post = count_post($type,$category,null); // общее количество новостей
    $limit = [$start, $this->quantity_posts]; //pagnav_calc2($num,$total_post); // параметры для постраничной навигации

    $categories = $this->AdminModel->get_view_categories($limit, $type);
    //debug($categories);










    $this->set([
      //'description' => $this->description,
      //'keywords' => $this->keywords,
      'title' => $this->title,
      //'image' => $this->image,
      'text' => $this->text,
      'breadcrumbs' => $this->breadcrumbs,
      'alias' => $this->alias,
      'page' => $this->page,
      'user' => $this->user,
      'categories' => $categories,
      'pagination' => $this->pagination,
      'type_string_for_url' => $type_string_for_url,
      'button_name' => $button_name,
      'column_title' => $column_title,
      'ifempty' => $ifempty,
      //'current_user' => $current_user,
      //'messages' => $current_user['messages'],
      'quantity_posts' => $this->quantity_posts,
      'token' => $this->getToken('update_user'),
      'message_token' => $this->getToken('send_message'),
    ]);

  }

  public function viewAction() {

  }

  public function createAction(){
    //echo __METHOD__;

    $title = 'Категории';
    $this->title = 'Создать категорию';
    $this->breadcrumbs = $this->breadcrumbs.' &raquo; <a href="'.ADMIN.S.$this->alias.'" target="_self" title="'.$title.'">'.$title.'</a> &raquo; <a class="current" href="'.ADMIN.S.$this->alias.S.'create" target="_self" title="'.$this->title.'">'.$this->title.'</a>';

    $menu1 = '';
    $menu0 = CHECK;
    $published1 = CHECK;
    $published0 = '';
    //$del1 = '';
    //$del0 = CHECK;
    $selected_category = 0; // выбранная родительская категория по умолчанию

    if (isset($_SESSION['create'])) {
      if (isset($_SESSION['create']['menu']) and ($_SESSION['create']['menu'] == 1)) {
        $menu1 = CHECK;
        $menu0 = '';
      }
      else {
        $menu1 = '';
        $menu0 = CHECK;
      }
      if (isset($_SESSION['create']['published']) and ($_SESSION['create']['published'] == 1)) {
        $published1 = CHECK;
        $published0 = '';
      }
      else {
        $published1 = '';
        $published0 = CHECK;
      }
      /*
      if ($_SESSION['create']['del'] == 1) {
        $del1 = CHECK;
        $del0 = '';
      }
      else {
        $del1 = '';
        $del0 = CHECK;
      } */
      if (isset($_SESSION['create']['category'])) {
        $selected_category = $_SESSION['create']['parent']; // выбранная родительская категрия
      }
      else {
        $selected_category = 0;
      }
    }

    $category_types = array(['id' => 0, 'title' => 'Страница'],['id' => 1, 'title' => 'Новость'],['id' => 2, 'title' => 'Партнёрский продукт'],['id' => 3, 'title' => 'Закачка'],['id' => 4, 'title' => 'Товар'],['id' => 5, 'title' => 'Галерея'],['id' => 6, 'title' => 'Альбом'],['id' => 7, 'title' => 'Заметка']);
    $this->category_types = $this->renderSelect(['options' => $category_types, 'select_name' => 'type', 'select_title' => 'Выберите тип категории', 'select_class' => 'form-select', 'select_id' => 'create_category_type_field', 'selected_id' => 1, 'disabled_id' => false, 'select_important' => true, 'disabled' => false]);
    //debug($this->category_types);

    //debug($this->categories);
    $parent_categories = array(['id' => 0, 'title' => '[Без родительской категории]']);
    $parent_categories = array_merge($parent_categories, $this->categories); // сливает один или большее количество массивов
    $this->parent_categories = $this->renderSelect(['options' => $parent_categories, 'select_name' => 'parent', 'select_title' => 'Выберите родительскую категорию', 'select_class' => 'form-select', 'select_id' => 'create_category_parent_field', 'selected_id' => $selected_category, 'disabled_id' => false, 'select_important' => true, 'disabled' => false]);
    //debug($this->parent_categories);

    if (isset($_POST['submit_category'])) {
      if ($this->AdminModel->create_category()) {
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
      'category_types' => $this->category_types,
      'parent_categories' => $this->parent_categories,
      'menu1' => $menu1,
      'menu0' => $menu0,
      'published0' => $published0,
      'published1' => $published1,
      //'del1' => $del1,
      //'del0' => $del0,
    ]);

  }

  public function editAction(){
    //debug($this->id); // получаем идентификатор категории
    if ((empty($this->id) or ($this->id == 0))) {
      $category_id = 1; // если параметр ID не передан, то показываем первую категорию
    }
    else {
      $category_id = $this->id;
    }

    $title = 'Категории';
    $this->title = 'Редактировать категорию';
    $this->breadcrumbs = $this->breadcrumbs.' &raquo; <a href="'.ADMIN.S.$this->alias.'" target="_self" title="'.$title.'">'.$title.'</a> &raquo; <a class="current" href="'.ADMIN.S.$this->alias.S.'edit'.S.$category_id.'" target="_self" title="'.$this->title.'">'.$this->title.'</a>';

    $this->category = $this->AdminModel->cp_get_category($category_id);
    //debug($this->category);

    $menu1 = '';
    $menu0 = CHECK;
    $published1 = CHECK;
    $published0 = '';
    $del1 = '';
    $del0 = CHECK;

    if (isset($this->category)) {
      if ($this->category['menu'] == 1) {
        $menu1 = CHECK;
        $menu0 = '';
      }
      else {
        $menu1 = '';
        $menu0 = CHECK;
      }
      if ($this->category['published'] == 1) {
        $published1 = CHECK;
        $published0 = '';
      }
      else {
        $published1 = '';
        $published0 = CHECK;
      }
      if ($this->category['del'] == 1) {
        $del1 = CHECK;
        $del0 = '';
      }
      else {
        $del1 = '';
        $del0 = CHECK;
      }
    }


    //debug($this->category['type']);
    $category_types = array(['id' => 0, 'title' => 'Страница'],['id' => 1, 'title' => 'Новость'],['id' => 2, 'title' => 'Партнёрский продукт'],['id' => 3, 'title' => 'Закачка'],['id' => 4, 'title' => 'Товар'],['id' => 5, 'title' => 'Галерея'],['id' => 6, 'title' => 'Альбом'],['id' => 7, 'title' => 'Заметка']);
    $this->category_types = $this->renderSelect(['options' => $category_types, 'select_name' => 'type', 'select_title' => 'Выберите тип категории', 'select_class' => 'form-select', 'select_id' => 'edit_category_type_field', 'selected_id' => (int)$this->category['type'], 'disabled_id' => false, 'select_important' => true, 'disabled' => false]);
    //debug($this->category_types);

    //debug($this->categories);
    $parent_categories = array(['id' => 0, 'title' => '[Без родительской категории]']);
    $parent_categories = array_merge($parent_categories,$this->categories); // сливает один или большее количество массивов
    $this->parent_categories = $this->renderSelect(['options' => $parent_categories, 'select_name' => 'parent', 'select_title' => 'Выберите родительскую категорию', 'select_class' => 'form-select', 'select_id' => 'edit_category_parent_field', 'selected_id' => (int)$this->category['parent'], 'disabled_id' => false, 'select_important' => true, 'disabled' => false]);
    //debug($this->parent_categories);

    if (!empty($this->category)) {
      if (isset($_POST['submit_category'])) {
        if ($this->AdminModel->edit_category($category_id)) {
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
      //'page' => $this->page,
      'category_types' => $this->category_types,
      'category' => $this->category,
      'parent_categories' => $this->parent_categories,
      'menu1' => $menu1,
      'menu0' => $menu0,
      'published0' => $published0,
      'published1' => $published1,
      'del1' => $del1,
      'del0' => $del0,
    ]);
  }

  public function deleteAction(){
    //debug($this->id); // получаем идентификатор категории
    if ((empty($this->id) or ($this->id == 0))) {
      $category_id = 1; // если параметр ID не передан, то показываем первый курс
    }
    else {
      $category_id = $this->id;
    }

    $title = 'Категории';
    $this->title = 'Удалить категорию';
    $this->breadcrumbs = $this->breadcrumbs.' &raquo; <a href="'.ADMIN.S.$this->alias.'" target="_self" title="'.$title.'">'.$title.'</a> &raquo; <a class="current" href="'.ADMIN.S.$this->alias.S.'delete'.S.$category_id.'" target="_self" title="'.$this->title.'">'.$this->title.'</a>';

    $this->category = $this->AdminModel->cp_get_category($category_id);
    //debug($this->category);

    $menu1 = '';
    $menu0 = CHECK;
    $published1 = CHECK;
    $published0 = '';
    $del1 = '';
    $del0 = CHECK;

    if (isset($this->category)) {
      if ($this->category['menu'] == 1) {
        $menu1 = CHECK;
        $menu0 = '';
      }
      else {
        $menu1 = '';
        $menu0 = CHECK;
      }
      if ($this->category['published'] == 1) {
        $published1 = CHECK;
        $published0 = '';
      }
      else {
        $published1 = '';
        $published0 = CHECK;
      }
      if ($this->category['del'] == 1) {
        $del1 = CHECK;
        $del0 = '';
      }
      else {
        $del1 = '';
        $del0 = CHECK;
      }
    }

    //debug($this->category['type']);
    $category_types = array(['id' => 0, 'title' => 'Страница'],['id' => 1, 'title' => 'Новость'],['id' => 2, 'title' => 'Партнёрский продукт'],['id' => 3, 'title' => 'Закачка'],['id' => 4, 'title' => 'Товар'],['id' => 5, 'title' => 'Галерея'],['id' => 6, 'title' => 'Альбом'],['id' => 7, 'title' => 'Заметка']);
    $this->category_types = $this->renderSelect(['options' => $category_types, 'select_name' => 'type', 'select_title' => 'Выберите тип категории', 'select_class' => 'form-select', 'select_id' => 'edit_category_type_field', 'selected_id' => (int)$this->category['type'], 'disabled_id' => false, 'select_important' => true, 'disabled' => true]);
    //debug($this->category_types);

    //debug($this->categories);
    $parent_categories = array(['id' => 0, 'title' => '[Без родительской категории]']);
    $parent_categories = array_merge($parent_categories,$this->categories); // сливает один или большее количество массивов
    $this->parent_categories = $this->renderSelect(['options' => $parent_categories, 'select_name' => 'parent', 'select_title' => 'Выберите родительскую категорию', 'select_class' => 'form-select', 'select_id' => 'edit_category_parent_field', 'selected_id' => (int)$this->category['parent'], 'disabled_id' => false, 'select_important' => true, 'disabled' => true]);
    //debug($this->parent_categories);

    if (!empty($this->category)) {
      if (isset($_POST['submit_category'])) {
        if ($this->AdminModel->delete_category($category_id)) {
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
      //'page' => $this->page,
      'category_types' => $this->category_types,
      'category' => $this->category,
      'parent_categories' => $this->parent_categories,
      'menu1' => $menu1,
      'menu0' => $menu0,
      'published0' => $published0,
      'published1' => $published1,
      'del1' => $del1,
      'del0' => $del0,
    ]);

  }



}