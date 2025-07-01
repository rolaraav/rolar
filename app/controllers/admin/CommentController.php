<?php

namespace app\controllers\admin;

use core\libs\Pagination;

class CommentController extends AdminController {

  public $comment; // выбранный (текущий) комментарий
  public $comment_types; // блок select для типа комментария = типу категории

  public function indexAction(){
    // echo 'Метод indexAction контроллера CommentController';


    $this->title = 'Комментарии';
    $this->breadcrumbs = $this->breadcrumbs.' &raquo; <a class="current" href="'.ADMIN.S.$this->alias.'" target="_self" title="'.$this->title.'">'.$this->title.'</a>';


    $this->current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // номер текущей страницы
    //debug($this->current_page);

    // если количество постов на странице не определено, то берём данные из настроек
    if(!$this->quantity_posts) {
      $this->quantity_posts = ADMIN_QUANTITY_POSTS;
      //$this->quantity_posts = Core::$core->getProperty('quantity_posts'); // количество постов на странице $pagination
    }

    $this->total_posts_pagination = $this->AdminModel->count_admin_total_comments(); // $this->total_data; // общее количество комментариев // $this->AdminModel->get_total_posts('data', $category['type'], $query_category_id, null, $partner_id); // общее количество постов в выбранной категории
    //debug($this->total_posts_pagination);
    // debug($this->total_data);

    $pagination = new Pagination($this->current_page, $this->quantity_posts, $this->total_posts_pagination);
    $start = $pagination->getStart(); // получение номера начального поста (записи, новости, продукта, закачки, товара) для параметра LIMIT
    //var_dump($pagination->pagination);
    $this->pagination = $this->render_cppagination(['pagination' => $pagination->pagination, 'uri' => $pagination->uri, 'quantity_posts' => $this->quantity_posts]);
    //debug($this->pagination);

    //$total_post = count_post($type,$category,null); // общее количество новостей
    $limit = [$start, $this->quantity_posts]; //pagnav_calc2($num,$total_post); // параметры для постраничной навигации

    $comments = $this->AdminModel->get_view_comments($limit);
    //debug($posts);
    // get_data($category['type'], $query_category_id, null, $partner_id, ['date', 'id'], ['DESC','DESC'], $limit));
    //$this->posts = $this->renderPosts(['posts' => $posts, 'posts_block_title' => false, 'link_pattern' => 'post', 'if_empty' => 'Заметок пока нет']);
    //debug($this->posts);


    $this->set([
      'description' => $this->description,
      'keywords' => $this->keywords,
      'title' => $this->title,
      'image' => $this->image,
      'text' => $this->text,
      'breadcrumbs' => $this->breadcrumbs,
      'page' => $this->page,
      'user' => $this->user,
      'comments' => $comments,
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

    $title = 'Комментарии';
    $this->title = 'Создать комментарий';
    $this->breadcrumbs = $this->breadcrumbs.' &raquo; <a href="'.ADMIN.S.$this->alias.'" target="_self" title="'.$title.'">'.$title.'</a> &raquo; <a class="current" href="'.ADMIN.S.$this->alias.S.'create" target="_self" title="'.$this->title.'">'.$this->title.'</a>';

    $published1 = CHECK;
    $published0 = '';
    if (isset($_SESSION['create'])) {
      if (isset($_SESSION['create']['published']) and ($_SESSION['create']['published'] == 1)) {
        $published1 = CHECK;
        $published0 = '';
      }
      else {
        $published1 = '';
        $published0 = CHECK;
      }
    }

    $comment_types = array(['id' => 0, 'title' => 'Страница'],['id' => 1, 'title' => 'Новость'],['id' => 2, 'title' => 'Партнёрский продукт'],['id' => 3, 'title' => 'Закачка'],['id' => 4, 'title' => 'Товар'],['id' => 5, 'title' => 'Галерея'],['id' => 6, 'title' => 'Альбом'],['id' => 7, 'title' => 'Заметка']);
    $this->comment_types = $this->renderSelect(['options' => $comment_types, 'select_name' => 'type', 'select_title' => 'Выберите тип комментария', 'select_class' => 'form-select', 'select_id' => 'create_comment_type_field', 'selected_id' => 1, 'disabled_id' => false, 'select_important' => true, 'disabled' => false]);
    //debug($this->comment_types);

    if (isset($_POST['submit_comment'])) {
      if ($this->AdminModel->create_comment()) {
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
      'comment_types' => $this->comment_types,
      'breadcrumbs' => $this->breadcrumbs,
      //'page' => $this->page,
      'published0' => $published0,
      'published1' => $published1
    ]);
  }

  public function editAction(){
    //echo __METHOD__;

    //debug($this->id); // получаем идентификатор комментария
    if ((empty($this->id) or ($this->id == 0))) {
      $comment_id = 1; // если параметр ID не передан, то показываем первый комментарий
    }
    else {
      $comment_id = $this->id;
    }

    $title = 'Комментарии';
    $this->title = 'Редактировать комментарий';
    $this->breadcrumbs = $this->breadcrumbs.' &raquo; <a href="'.ADMIN.S.$this->alias.'" target="_self" title="'.$title.'">'.$title.'</a> &raquo; <a class="current" href="'.ADMIN.S.$this->alias.S.'edit'.S.$comment_id.'" target="_self" title="'.$this->title.'">'.$this->title.'</a>';

    $this->comment = $this->AdminModel->cp_get_comment($comment_id);
    //debug($this->comment);

    $published1 = CHECK;
    $published0 = '';
    if (isset($this->comment)) {
      if ($this->comment['published'] == 1) {
        $published1 = CHECK;
        $published0 = '';
      }
      else {
        $published1 = '';
        $published0 = CHECK;
      }
      if ($this->comment['del'] == 1) {
        $del1 = CHECK;
        $del0 = '';
      }
      else {
        $del1 = '';
        $del0 = CHECK;
      }
    }

    $comment_types = array(['id' => 0, 'title' => 'Страница'],['id' => 1, 'title' => 'Новость'],['id' => 2, 'title' => 'Партнёрский продукт'],['id' => 3, 'title' => 'Закачка'],['id' => 4, 'title' => 'Товар'],['id' => 5, 'title' => 'Галерея'],['id' => 6, 'title' => 'Альбом'],['id' => 7, 'title' => 'Заметка']);
    $this->comment_types = $this->renderSelect(['options' => $comment_types, 'select_name' => 'type', 'select_title' => 'Выберите тип комментария', 'select_class' => 'form-select', 'select_id' => 'edit_comment_type_field', 'selected_id' => $this->comment['type'], 'disabled_id' => false, 'select_important' => true, 'disabled' => false]);
    //debug($this->comment_types);

    if (isset($_POST['submit_comment'])) {
      if ($this->AdminModel->edit_comment($comment_id)) {
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
      'comment_types' => $this->comment_types,
      'comment' => $this->comment,
      'published0' => $published0,
      'published1' => $published1,
      'del1' => $del1,
      'del0' => $del0,
    ]);
  }

  public function deleteAction(){
    //echo __METHOD__;

    //debug($this->id); // получаем идентификатор комментария
    if ((empty($this->id) or ($this->id == 0))) {
      $comment_id = 1; // если параметр ID не передан, то показываем первый комментарий
    }
    else {
      $comment_id = $this->id;
    }

    $title = 'Комментарии';
    $this->title = 'Удалить комментарий';
    $this->breadcrumbs = $this->breadcrumbs.' &raquo; <a href="'.ADMIN.S.$this->alias.'" target="_self" title="'.$title.'">'.$title.'</a> &raquo; <a class="current" href="'.ADMIN.S.$this->alias.S.'delete'.S.$comment_id.'" target="_self" title="'.$this->title.'">'.$this->title.'</a>';

    $this->comment = $this->AdminModel->cp_get_comment($comment_id);
    //debug($this->comment);

    $published1 = CHECK;
    $published0 = '';
    if (isset($this->comment)) {
      if ($this->comment['published'] == 1) {
        $published1 = CHECK;
        $published0 = '';
      }
      else {
        $published1 = '';
        $published0 = CHECK;
      }
      if ($this->comment['del'] == 1) {
        $del1 = CHECK;
        $del0 = '';
      }
      else {
        $del1 = '';
        $del0 = CHECK;
      }
    }

    $comment_types = array(['id' => 0, 'title' => 'Страница'],['id' => 1, 'title' => 'Новость'],['id' => 2, 'title' => 'Партнёрский продукт'],['id' => 3, 'title' => 'Закачка'],['id' => 4, 'title' => 'Товар'],['id' => 5, 'title' => 'Галерея'],['id' => 6, 'title' => 'Альбом'],['id' => 7, 'title' => 'Заметка']);
    $this->comment_types = $this->renderSelect(['options' => $comment_types, 'select_name' => 'type', 'select_title' => 'Тип комментария', 'select_class' => 'form-select', 'select_id' => 'delete_comment_type_field', 'selected_id' => $this->comment['type'], 'disabled_id' => false, 'select_important' => true, 'disabled' => true]);
    //debug($this->comment_types);

    if (isset($_POST['submit_comment'])) {
      if ($this->AdminModel->delete_comment($comment_id)) {
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
      'comment_types' => $this->comment_types,
      'comment' => $this->comment,
      'published0' => $published0,
      'published1' => $published1,
      'del1' => $del1,
      'del0' => $del0,
    ]);
  }



}