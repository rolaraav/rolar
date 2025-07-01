<?php

namespace app\controllers\admin;

class SendmailController extends AdminController {

  public function indexAction(){
    // echo 'Метод indexAction контроллера SendmailController';

    $this->title = 'Рассылка почты';
    $this->breadcrumbs = $this->breadcrumbs.' &raquo; <a class="current" href="'.ADMIN.S.$this->alias.'" target="_self" title="'.$this->title.'">'.$this->title.'</a>';


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
    ]);
  }

}