<?php
class BillsController extends Controller {
  public function filters() {
    return array(
      'accessControl',
    );
  }

  public function accessRules() {
    return array(
      array('allow',
        'actions' => array('index'),
        'users' => array('@'),
      ),
      array('deny',
        'users' => array('*'),
      ),
    );
  }

  public function actionIndex($paid = FALSE) {
    $model = $this->loadModel(Y::user()->id);
    $goods = $model->goods;
    /*
    $E9wuuG8fSv0Z1xIvX = parse_url(Yii::app()->getBaseUrl(TRUE));
    $E9wuuG8fSv0Z1xIvX = $E9wuuG8fSv0Z1xIvX['host'];
    $dw93yiTvYwORYTlmW = substr(OM_LIC, 336, 16);
    $dh8PsXMXRrfL0Vzxl = md5($E9wuuG8fSv0Z1xIvX.'444149763aad617621b0ad18812eed82');
    $dh8PsXMXRrfL0Vzxl = md5($dh8PsXMXRrfL0Vzxl.$E9wuuG8fSv0Z1xIvX.'868fd09c3b83ee264994e929fc5c5cb3');
    $dh8PsXMXRrfL0Vzxl = md5($dh8PsXMXRrfL0Vzxl.$E9wuuG8fSv0Z1xIvX.'e91b59ec7309ea867d5a9684538c230b');
    $dh8PsXMXRrfL0Vzxl = substr($dh8PsXMXRrfL0Vzxl, 0, 16);
    if ($dh8PsXMXRrfL0Vzxl !== $dw93yiTvYwORYTlmW) exit ();
    */
    if (empty ($goods))
      die ('Извините, но администратор Вам не назначил товаров - поэтому доступ невозможен');
    $model = new Order('search');
    $model->unsetAttributes();
    if (isset($_GET['Order']))
      $model->attributes = $_GET['Order'];
    $this->render('index', array(
      'model' => $model,
    ));
  }

  public function loadModel($id) {
    $model = Author::model()->findByPk($id);
    if ($model === null)
      throw new CHttpException(404, 'Автора с таким ID не существует.');
    return $model;
  }
}