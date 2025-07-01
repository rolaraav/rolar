<?php
namespace app\controllers\admin;
use app\controllers\admin\AdminController;
use core\View;

class IndexController extends AdminController {

  public function indexAction(){
    // echo 'Метод indexAction контроллера IndexController';

    //$this->alias = 'user';
    //debug($this->alias);
    //echo 'IndexController';

    //debug($this->id);
    // получаем идентификатор пользователя $user_id
    // нужна проверка, если $user_id больше имеющихся количества пользователей, или пользователь удалён (скрыт), то данные этого пользователя не получаются
    if ((empty($this->id) or ($this->id == 0))) {
      $user_id = 1; // если параметр не передан, то показываем первого пользователя
    }
    else {
      $user_id = $this->id;
    }
    //debug($user_id);

    //debug($this->route);
    //$alias = $this->route['alias'];

    $this->title = 'Панель управления сайта '.DOMEN;

    $this->set([
      'description' => $this->description,
      'keywords' => $this->keywords,
      'title' => $this->title,
      'image' => $this->image,
      'text' => $this->text,
      'breadcrumbs' => $this->breadcrumbs,
      'alias' => $this->alias,
      'page' => $this->page,
      'user' => $this->user,
      //'current_user' => $current_user,
      //'messages' => $current_user['messages'],
      'token' => $this->getToken('update_user'),
      'message_token' => $this->getToken('send_message'),
    ]);

  }

  public function testAction(){
    //echo __METHOD__;

    $this->layout = 'admin';

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

  public function sendmailAction(){
    //echo __METHOD__;

  }

  public function subscribersAction(){
    //echo __METHOD__;

  }

  public function ckeditorAction(){
    //echo __METHOD__;

  }

}