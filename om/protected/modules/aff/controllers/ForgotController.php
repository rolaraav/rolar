<?php
class ForgotController extends Controller {

  public function actionIndex() {
    $model = new AffForgot;
    if (isset($_POST['AffForgot'])) {
      $model->attributes = $_POST['AffForgot'];
      if ($model->validate()) {
        $partner = $this->loadModel($model->id);
        if ($partner->email != $model->email) {
          throw new CHttpException(404, 'Введённый Вами e-mail не соответствует этому RefID.');
        }
        $data = array(
          'partner_id' => $partner->id,
          'password' => $partner->password,
        );
        Mail::letter('forgot_pass', $partner->email, $partner->firstName, $data);
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

  public function loadModel($id) {
    $model = Partner::model()->findByPk($id);
    if ($model === null)
      throw new CHttpException(404, 'Партнёра с таким RefID не существует.');
    return $model;
  }
}