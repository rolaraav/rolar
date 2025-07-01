<?php
namespace app\controllers;

use app\models\BaseModel;
use core\libs\Breadcrumbs;
use core\View;
use core\Controller;
use core\Core;

class ScriptController extends BaseController {

  public function indexAction() {
    //echo 'ScriptController - метод indexAction()<br>';

    //debug($post_id);

    //debug($this->route);
    //$alias = $this->route['alias'];

    /* Заполнение алиасов в таблице data
    $post_array = $this->Model->get_all_data(); // массив всех заметок - ID и заголовок
    //debug($post_array);
    $array = array();
    foreach ($post_array as $key => $value) {
      $key = $value['id'];
      $val = string2url($value['title']); // преобразуем заголовки в url-совместимые алиасы
      $this->Model->update_data_aliases($key, $val); // обновление алиасов
      $array[$key] = $val;
    }
    // debug($array);
    */

    $this->title = 'Контроллер для выполнения скриптов';
    $this->breadcrumbs = $this->title;
    $this->text = 'Выполнение скрипта - заполнение алиасов в таблице data';

    $this->set([
      'title' => $this->title,
      'breadcrumbs' => $this->breadcrumbs,
      'text' => $this->text,
      'post' => $this->post,
    ]);

    //parent::indexAction(); // выполнение рдительского indexAction
  }

  public function testAction() {
    //echo 'Script::test';
  }
}