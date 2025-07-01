<?php

namespace app\controllers\admin;

class SoccommentsController extends AdminController {

  public function indexAction() {
    // echo 'Метод indexAction контроллера SoccommentsController';

    $this->title = 'Комментарии в социальных сетях';
    $this->breadcrumbs = $this->breadcrumbs.' &raquo; <a class="current" href="'.ADMIN.S.$this->alias.'" target="_self" title="'.$this->title.'">'.$this->title.'</a>';

    $social_comments = $this->render('_social_comments');


    $this->set([
      'description' => $this->description,
      'keywords' => $this->keywords,
      'title' => $this->title,
      'image' => $this->image,
      'text' => $this->text,
      'breadcrumbs' => $this->breadcrumbs,
      'alias' => $this->alias,
      'social_comments' => $social_comments,
    ]);
  }

}