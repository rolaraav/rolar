<?php

namespace app\controllers\admin;

use core\libs\Pagination;


class PartnerController extends AdminController  {

  public $partner; // выбранный партнёр

  public function indexAction(){
    // echo 'Метод indexAction контроллера PartnerController';

    $this->title = 'Партнёры';
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

    $this->total_posts_pagination = $this->AdminModel->count_admin_total_partners(); // $this->total_data; // общее количество записей // $this->AdminModel->get_total_posts('data', $category['type'], $query_category_id, null, $partner_id); // общее количество постов в выбранной категории
    //debug($this->total_posts_pagination);
    // debug($this->total_data);

    $pagination = new Pagination($this->current_page, $this->quantity_posts, $this->total_posts_pagination);
    $start = $pagination->getStart(); // получение номера начального поста (записи, новости, продукта, закачки, товара) для параметра LIMIT
    //var_dump($pagination->pagination);
    $this->pagination = $this->render_cppagination(['pagination' => $pagination->pagination, 'uri' => $pagination->uri, 'quantity_posts' => $this->quantity_posts]);
    //debug($this->pagination);

    //$total_post = count_post($type,$category,null); // общее количество новостей
    $limit = [$start, $this->quantity_posts]; //pagnav_calc2($num,$total_post); // параметры для постраничной навигации

    $partners = $this->AdminModel->get_view_partners($limit);
    //debug($partners);
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
      'partners' => $partners,
      'pagination' => $this->pagination,
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

    $title = "Партнёры";
    $this->title = "Добавить партнёра";
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

    if (isset($_POST['submit_partner'])) {
      if ($this->AdminModel->create_partner()) {
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
      //'del1' => $del1,
      //'del0' => $del0,
    ]);

  }

  public function editAction(){
    //echo __METHOD__;

    //debug($this->id); // получаем идентификатор партнёра
    if ((empty($this->id) or ($this->id == 0))) {
      $partner_id = 1; // если параметр ID не передан, то показываем первого партнёра
    }
    else {
      $partner_id = $this->id;
    }

    $title = 'Партнёры';
    $this->title = 'Редактировать партнёра';
    $this->breadcrumbs = $this->breadcrumbs.' &raquo; <a href="'.ADMIN.S.$this->alias.'" target="_self" title="'.$title.'">'.$title.'</a> &raquo; <a class="current" href="'.ADMIN.S.$this->alias.S.'edit'.S.$partner_id.'" target="_self" title="'.$this->title.'">'.$this->title.'</a>';

    $this->partner = $this->AdminModel->cp_get_partner($partner_id);
    //debug($this->partner);

    $published1 = CHECK;
    $published0 = '';
    $del1 = '';
    $del0 = CHECK;

    if (isset($this->partner)) {
      if ($this->partner['published'] == 1) {
        $published1 = CHECK;
        $published0 = '';
      }
      else {
        $published1 = '';
        $published0 = CHECK;
      }
      if ($this->partner['del'] == 1) {
        $del1 = CHECK;
        $del0 = '';
      }
      else {
        $del1 = '';
        $del0 = CHECK;
      }
    }

    if (!empty($this->partner)) {
      if (isset($_POST['submit_partner'])) {
        if ($this->AdminModel->edit_partner($partner_id)) {
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
      'partner' => $this->partner,
      'published0' => $published0,
      'published1' => $published1,
      'del1' => $del1,
      'del0' => $del0,
    ]);

  }

  public function deleteAction(){
    //echo __METHOD__;

    //debug($this->id); // получаем идентификатор партнёра
    if ((empty($this->id) or ($this->id == 0))) {
      $partner_id = 1; // если параметр ID не передан, то показываем первого партнёра
    }
    else {
      $partner_id = $this->id;
    }

    $title = 'Партнёры';
    $this->title = 'Удалить партнёра';
    $this->breadcrumbs = $this->breadcrumbs.' &raquo; <a href="'.ADMIN.S.$this->alias.'" target="_self" title="'.$title.'">'.$title.'</a> &raquo; <a class="current" href="'.ADMIN.S.$this->alias.S.'delete'.S.$partner_id.'" target="_self" title="'.$this->title.'">'.$this->title.'</a>';

    $this->partner = $this->AdminModel->cp_get_partner($partner_id);
    //debug($this->partner);

    $published1 = CHECK;
    $published0 = '';
    $del1 = '';
    $del0 = CHECK;

    if (isset($this->partner)) {
      if ($this->partner['published'] == 1) {
        $published1 = CHECK;
        $published0 = '';
      }
      else {
        $published1 = '';
        $published0 = CHECK;
      }
      if ($this->partner['del'] == 1) {
        $del1 = CHECK;
        $del0 = '';
      }
      else {
        $del1 = '';
        $del0 = CHECK;
      }
    }

    if (!empty($this->partner)) {
      if (isset($_POST['submit_partner'])) {
        if ($this->AdminModel->delete_partner($partner_id)) {
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
      'partner' => $this->partner,
      'published0' => $published0,
      'published1' => $published1,
      'del1' => $del1,
      'del0' => $del0,
    ]);
  }


}