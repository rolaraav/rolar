<?php

namespace app\controllers\admin;

use core\libs\Pagination;

class MessageController extends AdminController {

  public $message; // выбранное (текущее) сообщение

  public $addressees = ''; // блок select для выбора адресата сообщения

  public function indexAction(){
    // echo 'Метод indexAction контроллера MessageController';

    $this->title = 'Сообщения';
    $this->breadcrumbs = $this->breadcrumbs.' &raquo; <a class="current" href="'.ADMIN.S.$this->alias.'" target="_self" title="'.$this->title.'">'.$this->title.'</a>';
    //$limit = pagnav_calc($cnum,$total_news); // параметры для постраничной навигации
    //$news = get_view_news($limit);

    //debug($this->route);
    //$alias = $this->route['alias'];


    $this->current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // номер текущей страницы
    //debug($this->current_page);

    // если количество записей на странице не определено, то берём данные из настроек
    if(!$this->quantity_posts) {
      $this->quantity_posts = ADMIN_QUANTITY_POSTS;
      //$this->quantity_posts = Core::$core->getProperty('quantity_posts'); // количество записей на странице $pagination
    }

    $this->total_posts_pagination = $this->AdminModel->count_admin_total_messages(); // $this->total_data; // общее количество записей // $this->AdminModel->get_total_posts('data', $category['type'], $query_category_id, null, $partner_id); // общее количество постов в выбранной категории
    //debug($this->total_posts_pagination);
    // debug($this->total_data);

    $pagination = new Pagination($this->current_page, $this->quantity_posts, $this->total_posts_pagination);
    $start = $pagination->getStart(); // получение номера начального поста (записи, новости, продукта, закачки, товара) для параметра LIMIT
    //var_dump($pagination->pagination);
    $this->pagination = $this->render_cppagination(['pagination' => $pagination->pagination, 'uri' => $pagination->uri, 'quantity_posts' => $this->quantity_posts]);
    //debug($this->pagination);

    //$total_post = count_post($type,$category,null); // общее количество новостей
    $limit = [$start, $this->quantity_posts]; //pagnav_calc2($num,$total_post); // параметры для постраничной навигации

    $messages = $this->AdminModel->get_view_messages($limit);
    //debug($links);
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
      'messages' => $messages,
      'pagination' => $this->pagination,
      //'current_user' => $current_user,
      //'messages' => $current_user['messages'],
      'quantity_posts' => $this->quantity_posts,
    ]);

  }

  public function viewAction() {

  }

  public function createAction(){
    //echo __METHOD__;

    $title = 'Сообщения';
    $this->title = 'Создать сообшение';
    $this->breadcrumbs = $this->breadcrumbs.' &raquo; <a href="'.ADMIN.S.$this->alias.'" target="_self" title="'.$title.'">'.$title.'</a> &raquo; <a class="current" href="'.ADMIN.S.$this->alias.S.'create" target="_self" title="'.$this->title.'">'.$this->title.'</a>';

    // получение всех обычных пользователей для selecta
  // AND activation='1' AND status>'2' - выбираем среди активированных пользователей со статусом "обычный пользователь" и более
    $addressees = $this->AdminModel->get_users(1,2, '>');
    // debug($addressees);
    $addressees_array = [];
    foreach($addressees as $key => $item) {
      $item['title'] = $item['id'];
      $item['id'] = $item['login'];
      $addressees_array[$key] = $item;
    }
    //debug($addressees_array);

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
      $_SESSION['create']['all_users'] = false; // '' or CHECK;
    }

    // выбор ID получателя сообщения
    if (isset($_SESSION['create']['addressee'])) {
      $addressee = $_SESSION['create']['addressee'];
    }
    else {
      $addressee = 'rolar';
    }

    $this->addressees = $this->renderSelect(['options' => $addressees_array, 'select_name' => 'addressee', 'select_title' => 'Выберите имя получателя сообщения', 'select_class' => 'form-select', 'select_id' => 'create_message_addressee_field', 'selected_id' => $addressee, 'disabled_id' => false, 'select_important' => true, 'disabled' => false, 'readonly' => false]);
    //debug($this->addressees);

    if (isset($_POST['submit_message'])) {
      if ($this->AdminModel->create_message()) {
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
      'addressees' => $this->addressees,
      'published0' => $published0,
      'published1' => $published1
    ]);
  }

  public function editAction(){
    //echo __METHOD__;

    //debug($this->id); // получаем идентификатор сообщения
    if ((empty($this->id) or ($this->id == 0))) {
      $message_id = 1; // если параметр ID не передан, то показываем первое сообщение
    }
    else {
      $message_id = $this->id;
    }

    $title = 'Сообщения';
    $this->title = 'Редактировать сообщение';
    $this->breadcrumbs = $this->breadcrumbs.' &raquo; <a href="'.ADMIN.S.$this->alias.'" target="_self" title="'.$title.'">'.$title.'</a> &raquo; <a class="current" href="'.ADMIN.S.$this->alias.S.'edit'.S.$message_id.'" target="_self" title="'.$this->title.'">'.$this->title.'</a>';

    // получение всех обычных пользователей для selecta
    // AND activation='1' AND status>'2' - выбираем среди активированных пользователей со статусом "обычный пользователь" и более
    $addressees = $this->AdminModel->get_users(1,2, '>');
    // debug($addressees);
    $addressees_array = [];
    foreach($addressees as $key => $item) {
      $item['title'] = $item['id'];
      $item['id'] = $item['login'];
      $addressees_array[$key] = $item;
    }
    //debug($addressees_array);

    $this->message = $this->AdminModel->cp_get_message($message_id);
    //debug($this->message);

    $published1 = CHECK;
    $published0 = '';
    if (isset($this->message)) {
      if ($this->message['published'] == 1) {
        $published1 = CHECK;
        $published0 = '';
      }
      else {
        $published1 = '';
        $published0 = CHECK;
      }
      $this->message['all_users'] = false; // '' or CHECK;
    }

    $this->addressees = $this->renderSelect(['options' => $addressees_array, 'select_name' => 'addressee', 'select_title' => 'Выберите имя получателя сообщения', 'select_class' => 'form-select', 'select_id' => 'create_message_addressee_field', 'selected_id' => $this->message['addressee'], 'disabled_id' => false, 'select_important' => true, 'disabled' => false, 'readonly' => false]);
    //debug($this->addressees);

    if (isset($_POST['submit_message'])) {
      if ($this->AdminModel->edit_message($message_id)) {
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
      'message' => $this->message,
      'addressees' => $this->addressees,
      'published0' => $published0,
      'published1' => $published1
    ]);

  }

  public function deleteAction(){
    //echo __METHOD__;

    //debug($this->id); // получаем идентификатор сообщения
    if ((empty($this->id) or ($this->id == 0))) {
      $message_id = 1; // если параметр ID не передан, то показываем первое сообщение
    }
    else {
      $message_id = $this->id;
    }

    $title = 'Сообщения';
    $this->title = 'Удалить сообщение';
    $this->breadcrumbs = $this->breadcrumbs.' &raquo; <a href="'.ADMIN.S.$this->alias.'" target="_self" title="'.$title.'">'.$title.'</a> &raquo; <a class="current" href="'.ADMIN.S.$this->alias.S.'delete'.S.$message_id.'" target="_self" title="'.$this->title.'">'.$this->title.'</a>';

    // получение всех обычных пользователей для selecta
    // AND activation='1' AND status>'2' - выбираем среди активированных пользователей со статусом "обычный пользователь" и более
    $addressees = $this->AdminModel->get_users(1,2, '>');
    // debug($addressees);
    $addressees_array = [];
    foreach($addressees as $key => $item) {
      $item['title'] = $item['id'];
      $item['id'] = $item['login'];
      $addressees_array[$key] = $item;
    }
    //debug($addressees_array);

    $this->message = $this->AdminModel->cp_get_message($message_id);
    //debug($this->message);

    $published1 = CHECK;
    $published0 = '';
    if (isset($this->message)) {
      if ($this->message['published'] == 1) {
        $published1 = CHECK;
        $published0 = '';
      }
      else {
        $published1 = '';
        $published0 = CHECK;
      }
      $this->message['all_users'] = false; // '' or CHECK;
    }

    $this->addressees = $this->renderSelect(['options' => $addressees_array, 'select_name' => 'addressee', 'select_title' => 'Выберите имя получателя сообщения', 'select_class' => 'form-select', 'select_id' => 'create_message_addressee_field', 'selected_id' => $this->message['addressee'], 'disabled_id' => false, 'select_important' => true, 'disabled' => true, 'readonly' => false]);
    //debug($this->addressees);

    if (isset($_POST['submit_message'])) {
      if ($this->AdminModel->delete_message($message_id)) {
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
      'message' => $this->message,
      'addressees' => $this->addressees,
      'published0' => $published0,
      'published1' => $published1
    ]);
  }


}