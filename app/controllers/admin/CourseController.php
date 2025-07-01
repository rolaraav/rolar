<?php

namespace app\controllers\admin;

use core\libs\Pagination;

class CourseController extends AdminController {

  public $course = ''; // выбранный курс

  public $course_categories = ''; // блок select с категориями курсов

  public function indexAction(){
    // echo 'Метод indexAction контроллера CoursesController';


    $this->title = 'Обучающие курсы';
    $this->breadcrumbs = $this->breadcrumbs.' &raquo; <a class="current" href="'.ADMIN.S.$this->alias.'" target="_self" title="'.$this->title.'">'.$this->title.'</a>';


    $this->current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // номер текущей страницы
    //debug($this->current_page);

    // если количество постов на странице не определено, то берём данные из настроек
    if(!$this->quantity_posts) {
      $this->quantity_posts = ADMIN_QUANTITY_POSTS;
      //$this->quantity_posts = Core::$core->getProperty('quantity_posts'); // количество постов на странице $pagination
    }

    $this->total_posts_pagination = $this->AdminModel->count_admin_total_courses(); // $this->total_data; // общее количество комментариев // $this->AdminModel->get_total_posts('data', $category['type'], $query_category_id, null, $partner_id); // общее количество постов в выбранной категории
    //debug($this->total_posts_pagination);
    // debug($this->total_data);

    $pagination = new Pagination($this->current_page, $this->quantity_posts, $this->total_posts_pagination);
    $start = $pagination->getStart(); // получение номера начального поста (записи, новости, продукта, закачки, товара) для параметра LIMIT
    //var_dump($pagination->pagination);
    $this->pagination = $this->render_cppagination(['pagination' => $pagination->pagination, 'uri' => $pagination->uri, 'quantity_posts' => $this->quantity_posts]);
    //debug($this->pagination);

    //$total_post = count_post($type,$category,null); // общее количество новостей
    $limit = [$start, $this->quantity_posts]; //pagnav_calc2($num,$total_post); // параметры для постраничной навигации

    $courses = $this->AdminModel->get_view_courses($limit);
    //debug($posts);
    // get_data($category['type'], $query_category_id, null, $partner_id, ['date', 'id'], ['DESC','DESC'], $limit));
    //$this->posts = $this->renderPosts(['posts' => $posts, 'posts_block_title' => false, 'link_pattern' => 'post', 'if_empty' => 'Заметок пока нет']);
    //debug($this->posts);









//    $this->set(['test' => $test,
//      'data' => $data,
//      ]);
    $this->set([
      'description' => $this->description,
      'keywords' => $this->keywords,
      'title' => $this->title,
      'image' => $this->image,
      'text' => $this->text,
      'breadcrumbs' => $this->breadcrumbs,
      'page' => $this->page,
      'user' => $this->user,
      'courses' => $courses,
      'pagination' => $this->pagination,
      //'current_user' => $current_user,
      //'messages' => $current_user['messages'],
      'quantity_posts' => $this->quantity_posts,
      'token' => $this->getToken('update_user'),
      'message_token' => $this->getToken('send_message'),
    ]);

  }

  public function viewAction(){
    //echo __METHOD__;

  }

  public function createAction(){
    //echo __METHOD__;


    $title = 'Обучающие курсы';
    $this->title = 'Создать курс';
    $this->breadcrumbs = $this->breadcrumbs.' &raquo; <a href="'.ADMIN.S.$this->alias.'" target="_self" title="'.$title.'">'.$title.'</a> &raquo; <a class="current" href="'.ADMIN.S.$this->alias.S.'create" target="_self" title="'.$this->title.'">'.$this->title.'</a>';

    $hide_plink1 = '';
    $hide_plink0 = CHECK;
    $published1 = CHECK;
    $published0 = '';
    //$del1 = '';
    //$del0 = CHECK;
    $selected_category = 18; // выбранная категория по умолчанию

    if (isset($_SESSION['create'])) {
      if (isset($_SESSION['create']['hide_plink']) and ($_SESSION['create']['hide_plink'] == 1)) {
        $hide_plink1 = CHECK;
        $hide_plink0 = '';
      }
      else {
        $hide_plink1 = '';
        $hide_plink0 = CHECK;
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
        $selected_category = $_SESSION['create']['category']; // выбранная категрия
      }
      else {
        $selected_category = 18;
      }
    }

    /*
    $post_types = array(['id' => 0, 'title' => 'Страница'],['id' => 1, 'title' => 'Новость'],['id' => 2, 'title' => 'Партнёрский продукт'],['id' => 3, 'title' => 'Закачка'],['id' => 4, 'title' => 'Товар'],['id' => 5, 'title' => 'Галерея'],['id' => 6, 'title' => 'Альбом']);
    $this->post_types = $this->renderSelect(['options' => $post_types, 'select_name' => 'type', 'select_title' => 'Выберите тип материала', 'select_class' => 'form-select', 'select_id' => 'create_post_type_field', 'selected_id' => 1, 'disabled_id' => false, 'select_important' => true]);
    */
    //debug($this->post_types);

    //debug($this->categories);
    $course_categories = array(['id' => 0, 'title' => 'Выберите категорию курса'],['id' => 18, 'title' => 'Курсы'],['id' => 7, 'title' => 'Товары']);
    $this->course_categories = $this->renderSelect(['options' => $course_categories, 'select_name' => 'category', 'select_title' => 'Выберите категорию курса', 'select_class' => 'form-select', 'select_id' => 'create_course_category_field', 'selected_id' => $selected_category, 'disabled_id' => 0, 'select_important' => true, 'disabled' => false]);
    //debug($this->course_categories);

    if (isset($_POST['submit_course'])) {
      if ($this->AdminModel->create_course()) {
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
      //'post_types' => $this->post_types,
      'course_categories' => $this->course_categories,
      'hide_plink1' => $hide_plink1,
      'hide_plink0' => $hide_plink0,
      'published0' => $published0,
      'published1' => $published1,
      //'del1' => $del1,
      //'del0' => $del0,
    ]);

  }

  public function editAction(){
    //echo __METHOD__;

    //debug($this->id); // получаем идентификатор курса
    if ((empty($this->id) or ($this->id == 0))) {
      $course_id = 1; // если параметр ID не передан, то показываем первый курс
    }
    else {
      $course_id = $this->id;
    }

    $title = 'Курсы';
    $this->title = 'Редактировать курс';
    $this->breadcrumbs = $this->breadcrumbs.' &raquo; <a href="'.ADMIN.S.$this->alias.'" target="_self" title="'.$title.'">'.$title.'</a> &raquo; <a class="current" href="'.ADMIN.S.$this->alias.S.'edit'.S.$course_id.'" target="_self" title="'.$this->title.'">'.$this->title.'</a>';

    $this->course = $this->AdminModel->cp_get_course($course_id);
    //debug($this->course);

    $hide_plink1 = '';
    $hide_plink0 = CHECK;
    $published1 = CHECK;
    $published0 = '';
    $del1 = '';
    $del0 = CHECK;
    if (isset($this->course)) {
      if ($this->course['hide_plink'] == 1) {
        $hide_plink1 = CHECK;
        $hide_plink0 = '';
      }
      else {
        $hide_plink1 = '';
        $hide_plink0 = CHECK;
      }
      if ($this->course['published'] == 1) {
        $published1 = CHECK;
        $published0 = '';
      }
      else {
        $published1 = '';
        $published0 = CHECK;
      }
      if ($this->course['del'] == 1) {
        $del1 = CHECK;
        $del0 = '';
      }
      else {
        $del1 = '';
        $del0 = CHECK;
      }
      //$selected_category = $this->course['category'];
    }

    //debug($this->categories);
    $course_categories = array(['id' => 0, 'title' => 'Выберите категорию курса'],['id' => 18, 'title' => 'Курсы'],['id' => 7, 'title' => 'Товары']);
    $this->course_categories = $this->renderSelect(['options' => $course_categories, 'select_name' => 'category', 'select_title' => 'Выберите категорию курса', 'select_class' => 'form-select', 'select_id' => 'edit_course_category_field', 'selected_id' => $this->course['category'], 'disabled_id' => 0, 'select_important' => true, 'disabled' => false]);
    //debug($this->course_categories);

    if (!empty($this->course)) {
      if (isset($_POST['submit_course'])) {
        if ($this->AdminModel->edit_course($course_id)) {
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
      //'post_types' => $this->post_types,
      'course' => $this->course,
      'course_categories' => $this->course_categories,
      'hide_plink1' => $hide_plink1,
      'hide_plink0' => $hide_plink0,
      'published0' => $published0,
      'published1' => $published1,
      'del1' => $del1,
      'del0' => $del0,
    ]);
  }

  public function deleteAction(){
    //echo __METHOD__;
    //debug($this->id); // получаем идентификатор курса
    if ((empty($this->id) or ($this->id == 0))) {
      $course_id = 1; // если параметр ID не передан, то показываем первый курс
    }
    else {
      $course_id = $this->id;
    }

    $title = 'Курсы';
    $this->title = 'Удалить курс';
    $this->breadcrumbs = $this->breadcrumbs.' &raquo; <a href="'.ADMIN.S.$this->alias.'" target="_self" title="'.$title.'">'.$title.'</a> &raquo; <a class="current" href="'.ADMIN.S.$this->alias.S.'delete'.S.$course_id.'" target="_self" title="'.$this->title.'">'.$this->title.'</a>';

    $this->course = $this->AdminModel->cp_get_course($course_id);
    //debug($this->course);

    $hide_plink1 = '';
    $hide_plink0 = CHECK;
    $published1 = CHECK;
    $published0 = '';
    $del1 = '';
    $del0 = CHECK;
    if (isset($this->course)) {
      if ($this->course['hide_plink'] == 1) {
        $hide_plink1 = CHECK;
        $hide_plink0 = '';
      }
      else {
        $hide_plink1 = '';
        $hide_plink0 = CHECK;
      }
      if ($this->course['published'] == 1) {
        $published1 = CHECK;
        $published0 = '';
      }
      else {
        $published1 = '';
        $published0 = CHECK;
      }
      if ($this->course['del'] == 1) {
        $del1 = CHECK;
        $del0 = '';
      }
      else {
        $del1 = '';
        $del0 = CHECK;
      }
      //$selected_category = $this->course['category'];
    }

    //debug($this->categories);
    $course_categories = array(['id' => 0, 'title' => 'Выберите категорию курса'],['id' => 18, 'title' => 'Курсы'],['id' => 7, 'title' => 'Товары']);
    $this->course_categories = $this->renderSelect(['options' => $course_categories, 'select_name' => 'category', 'select_title' => 'Выберите категорию курса', 'select_class' => 'form-select', 'select_id' => 'edit_course_category_field', 'selected_id' => $this->course['category'], 'disabled_id' => 0, 'select_important' => true, 'disabled' => true]);
    //debug($this->course_categories);

    if (!empty($this->course)) {
      if (isset($_POST['submit_course'])) {
        if ($this->AdminModel->delete_course($course_id)) {
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
      //'post_types' => $this->post_types,
      'course' => $this->course,
      'course_categories' => $this->course_categories,
      'hide_plink1' => $hide_plink1,
      'hide_plink0' => $hide_plink0,
      'published0' => $published0,
      'published1' => $published1,
      'del1' => $del1,
      'del0' => $del0,
    ]);

  }



}