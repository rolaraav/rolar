<?php

namespace app\controllers\admin;

use app\models\AdminModel;
use core\Core;

class EditorController extends AdminController {

  public function indexAction() {
    // echo 'Метод indexAction контроллера IndexController';
    //$title = "Текстовый редактор CK Editor";

    $this->title = 'Выбор текстового редактора';
    $this->breadcrumbs = $this->breadcrumbs.' &raquo; <a class="current" href="'.ADMIN.S.$this->alias.'" target="_self" title="'.$this->title.'">'.$this->title.'</a>';

    if (Core::$core->getProperty('editor') == 'tinymce') {
      $editor1 = CHECK;
      $editor2 = '';
      $editor0 = '';
    }
    elseif (Core::$core->getProperty('editor') == 'ckeditor') {
      $editor1 = '';
      $editor2 = CHECK;
      $editor0 = '';
    }
    else {
      $editor1 = '';
      $editor2 = '';
      $editor0 = CHECK;
    }

    if (isset($_POST['change_editor'])) {
      //debug($_POST['editor']);
      Core::$core->setProperty('editor', $_POST['editor']);

      if ($this->AdminModel->change_editor($_POST['editor'])) {
        redirect(ADMIN.S.$this->alias);
      }
      else {
        redirect();
      }
    }

    $this->set([
      'description' => $this->description,
      'keywords' => $this->keywords,
      'title' => $this->title,
      'image' => $this->image,
      'text' => $this->text,
      'breadcrumbs' => $this->breadcrumbs,
      'alias' => $this->alias,
      'editor0' => $editor0,
      'editor1' => $editor1,
      'editor2' => $editor2,
    ]);
  }

}