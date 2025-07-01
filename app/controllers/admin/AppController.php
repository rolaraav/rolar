<?php
namespace app\controllers;
use app\controllers\BaseController;

class AppController extends BaseController {

  public $layout = 'admin';

  public function __construct($route) {
    parent::__construct($route);
    //if(!isset($is_admin) || $is_admin !== 1 ) {
      //header('Location: /');
      //die ('Access Denied!');
    //}
  }

}