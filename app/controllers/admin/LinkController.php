<?php

namespace app\controllers\admin;

use core\libs\Pagination;

class LinkController extends AdminController {

  public $link = ''; // выбранная ссылка

  public function indexAction(){
    // echo 'Метод indexAction контроллера LinkController';

    $this->title = 'Ссылки';
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

    $this->total_posts_pagination = $this->AdminModel->count_admin_total_links(); // $this->total_data; // общее количество записей // $this->AdminModel->get_total_posts('data', $category['type'], $query_category_id, null, $partner_id); // общее количество постов в выбранной категории
    //debug($this->total_posts_pagination);
    // debug($this->total_data);

    $pagination = new Pagination($this->current_page, $this->quantity_posts, $this->total_posts_pagination);
    $start = $pagination->getStart(); // получение номера начального поста (записи, новости, продукта, закачки, товара) для параметра LIMIT
    //var_dump($pagination->pagination);
    $this->pagination = $this->render_cppagination(['pagination' => $pagination->pagination, 'uri' => $pagination->uri, 'quantity_posts' => $this->quantity_posts]);
    //debug($this->pagination);

    //$total_post = count_post($type,$category,null); // общее количество новостей
    $limit = [$start, $this->quantity_posts]; //pagnav_calc2($num,$total_post); // параметры для постраничной навигации

    $links = $this->AdminModel->get_view_links($limit);
    //debug($links);
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
      'links' => $links,
      'pagination' => $this->pagination,
      //'current_user' => $current_user,
      //'messages' => $current_user['messages'],
      'quantity_posts' => $this->quantity_posts,
    ]);

  }

  public function createAction(){
    //echo __METHOD__;

    $title = 'Ссылки';
    $this->title = 'Создать ссылку';
    $this->breadcrumbs = $this->breadcrumbs.' &raquo; <a href="'.ADMIN.S.$this->alias.'" target="_self" title="'.$title.'">'.$title.'</a> &raquo; <a class="current" href="'.ADMIN.S.$this->alias.S.'create" target="_self" title="'.$this->title.'">'.$this->title.'</a>';

    $secret1 = '';
    $secret0 = CHECK;
    $ref1 = '';
    $ref0 = CHECK;
    $published1 = CHECK;
    $published0 = '';
    if (isset($_SESSION['create'])) {
      if (isset($_SESSION['create']['secret']) and ($_SESSION['create']['secret'] == 1)) {
        $secret1 = CHECK;
        $secret0 = '';
      }
      else {
        $secret1 = '';
        $secret0 = CHECK;
      }
      if (isset($_SESSION['create']['ref']) and ($_SESSION['create']['ref'] == 1)) {
        $ref1 = CHECK;
        $ref0 = '';
      }
      else {
        $ref1 = '';
        $ref0 = CHECK;
      }
      if (isset($_SESSION['create']['published']) and ($_SESSION['create']['published'] == 1)) {
        $published1 = CHECK;
        $published0 = '';
      }
      else {
        $published1 = '';
        $published0 = CHECK;
      }
    }

    if (isset($_POST['submit_link'])) {
      if ($this->AdminModel->create_link()) {
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
      'secret1' => $secret1,
      'secret0' => $secret0,
      'ref1' => $ref1,
      'ref0' => $ref0,
      'published0' => $published0,
      'published1' => $published1
    ]);
  }

  public function editAction(){
    //echo __METHOD__;

    //debug($this->id); // получаем идентификатор ссылки
    if ((empty($this->id) or ($this->id == 0))) {
      $link_id = 1; // если параметр ID не передан, то показываем первую ссылку
    }
    else {
      $link_id = $this->id;
    }

    $title = 'Ссылки';
    $this->title = 'Редактировать ссылку';
    $this->breadcrumbs = $this->breadcrumbs.' &raquo; <a href="'.ADMIN.S.$this->alias.'" target="_self" title="'.$title.'">'.$title.'</a> &raquo; <a class="current" href="'.ADMIN.S.$this->alias.S.'edit'.S.$link_id.'" target="_self" title="'.$this->title.'">'.$this->title.'</a>';

    $this->link = $this->AdminModel->cp_get_link($link_id);
    //debug($this->link);

    $secret1 = '';
    $secret0 = CHECK;
    $ref1 = '';
    $ref0 = CHECK;
    $published1 = CHECK;
    $published0 = '';
    if (isset($this->link)) {
      if ($this->link['secret'] == 1) {
        $secret1 = CHECK;
        $secret0 = '';
      }
      else {
        $secret1 = '';
        $secret0 = CHECK;
      }
      if ($this->link['ref'] == 1) {
        $ref1 = CHECK;
        $ref0 = '';
      }
      else {
        $ref1 = '';
        $ref0 = CHECK;
      }
      if ($this->link['published'] == 1) {
        $published1 = CHECK;
        $published0 = '';
      }
      else {
        $published1 = '';
        $published0 = CHECK;
      }
    }

    if (!empty($this->link)) {
      if (isset($_POST['submit_link'])) {
        if ($this->AdminModel->edit_link($link_id)) {
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
      'link' => $this->link,
      'secret1' => $secret1,
      'secret0' => $secret0,
      'ref1' => $ref1,
      'ref0' => $ref0,
      'published0' => $published0,
      'published1' => $published1
    ]);
  }

  public function deleteAction(){
    //echo __METHOD__;

    //debug($this->id); // получаем идентификатор ссылки
    if ((empty($this->id) or ($this->id == 0))) {
      $link_id = 1; // если параметр ID не передан, то показываем первую ссылку
    }
    else {
      $link_id = $this->id;
    }

    $title = 'Ссылки';
    $this->title = 'Удалить ссылку';
    $this->breadcrumbs = $this->breadcrumbs.' &raquo; <a href="'.ADMIN.S.$this->alias.'" target="_self" title="'.$title.'">'.$title.'</a> &raquo; <a class="current" href="'.ADMIN.S.$this->alias.S.'delete'.S.$link_id.'" target="_self" title="'.$this->title.'">'.$this->title.'</a>';

    $this->link = $this->AdminModel->cp_get_link($link_id);
    //debug($this->link);

    $secret1 = '';
    $secret0 = CHECK;
    $ref1 = '';
    $ref0 = CHECK;
    $published1 = CHECK;
    $published0 = '';
    if (isset($this->link)) {
      if ($this->link['secret'] == 1) {
        $secret1 = CHECK;
        $secret0 = '';
      }
      else {
        $secret1 = '';
        $secret0 = CHECK;
      }
      if ($this->link['ref'] == 1) {
        $ref1 = CHECK;
        $ref0 = '';
      }
      else {
        $ref1 = '';
        $ref0 = CHECK;
      }
      if ($this->link['published'] == 1) {
        $published1 = CHECK;
        $published0 = '';
      }
      else {
        $published1 = '';
        $published0 = CHECK;
      }
    }

    if (!empty($this->link)) {
      if (isset($_POST['submit_link'])) {
        if ($this->AdminModel->delete_link($link_id)) {
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
      'link' => $this->link,
      'secret1' => $secret1,
      'secret0' => $secret0,
      'ref1' => $ref1,
      'ref0' => $ref0,
      'published0' => $published0,
      'published1' => $published1
    ]);
  }

}