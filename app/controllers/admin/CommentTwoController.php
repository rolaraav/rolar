<?php

namespace app\controllers\admin;

use core\libs\Pagination;

class CommentTwoController extends AdminController {

  public function indexAction(){
    // echo 'Метод indexAction контроллера CommentTwoController';


    $this->title = 'Комментарии 2';
    $this->breadcrumbs = $this->breadcrumbs.' &raquo; <a class="current" href="'.ADMIN.S.$this->alias.'" target="_self" title="'.$this->title.'">'.$this->title.'</a>';


    $this->current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // номер текущей страницы
    //debug($this->current_page);

    // если количество постов на странице не определено, то берём данные из настроек
    if(!$this->quantity_posts) {
      $this->quantity_posts = ADMIN_QUANTITY_POSTS;
      //$this->quantity_posts = Core::$core->getProperty('quantity_posts'); // количество постов на странице $pagination
    }

    $this->total_posts_pagination = $this->AdminModel->count_admin_total_comments2(); // $this->total_data; // общее количество комментариев // $this->AdminModel->get_total_posts('data', $category['type'], $query_category_id, null, $partner_id); // общее количество постов в выбранной категории
    //debug($this->total_posts_pagination);
    // debug($this->total_data);

    $pagination = new Pagination($this->current_page, $this->quantity_posts, $this->total_posts_pagination);
    $start = $pagination->getStart(); // получение номера начального поста (записи, новости, продукта, закачки, товара) для параметра LIMIT
    //var_dump($pagination->pagination);
    $this->pagination = $this->render_cppagination(['pagination' => $pagination->pagination, 'uri' => $pagination->uri, 'quantity_posts' => $this->quantity_posts]);
    //debug($this->pagination);

    //$total_post = count_post($type,$category,null); // общее количество новостей
    $limit = [$start, $this->quantity_posts]; //pagnav_calc2($num,$total_post); // параметры для постраничной навигации

    $commentstwo = $this->AdminModel->get_view_comments2($limit);
    //debug($commentstwo);
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
      'commentstwo' => $commentstwo,
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

  }

  public function editAction(){
    //echo __METHOD__;



  }

  public function deleteAction(){
    //echo __METHOD__;

  }



}