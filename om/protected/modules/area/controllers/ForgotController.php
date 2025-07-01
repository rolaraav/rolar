<?php
class ForgotController extends Controller {

  public function actionIndex() {
    $model = new AreaForgot;
    if (isset($_POST['AreaForgot'])) {
      $model->attributes = $_POST['AreaForgot'];
      if ($model->validate()) {
        $auser = AreaUser::model()->findAll(array(
          'condition' => 'email = :email',
          'params' => array(
            ':email' => $model->email,
          )
        ));
        if (!$auser) {
          die ('Извините, но пользователя с таким e-mail нет в базе');
        }
        $dd = '';
        $nn = 1;
        foreach ($auser as $one) {
          $dd .= 'Логин';
          if ($nn > 1) {
            $dd .= ' #'.$nn;
          }
          $dd .= ':'.$one->username."\r\n";
          $dd .= 'Пароль: '.$one->password."\r\n\r\n";
          $nn++;
        }
        $data = array(
          'data' => $dd,
        );
        Mail::letter('forgot_area', $model->email, 'User', $data);
        $this->redirect(array('forgot/sent'));
      }
    }
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
    $this->render('/forgot/index', array('model' => $model));
  }

  public function actionSent() {
    $this->render('/forgot/sent');
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