<?php
class RegController extends Controller {

  public function actionIndex() {
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
    $model = new Partner;
    if (isset($_POST['Partner'])) {
      $model->attributes = $_POST['Partner'];
      if ($model->id == 'obsys')
        die ('Извините, но этот логин запрещён к регистрации');
      if ($model->id == 'admin')
        die ('Извините, но этот логин запрещён к регистрации');
      if ($model->save()) {
        $data = array(
          'partner_id' => $model->id,
          'password' => $model->password,
        );
        Mail::letter('affreg', $model->email, $model->firstName, $data);
        Log::add('newpartner', 'Зарегистрирован новый партнёр "'.$model->id.'" с e-mail: '.$model->email.' и партнёром 2го уровня: "'.$model->parent_id.'"');
        $this->redirect(array('reg/ok'));
      }
    }
    $this->render('/reg/index', array(
      'model' => $model,
    ));
  }

  public function actionOk() {
    $this->render('/reg/ok');
  }

  public function actions() {
    return array(
      'captcha' => array(
        'class' => 'MyCCaptchaAction',
        'backColor' => 0xFFFFFF,
      ),
    );
  }
}