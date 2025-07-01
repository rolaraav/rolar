<?php
class ForgotController extends Controller {
  public $layout = '/layouts/login';

  public function actionIndex() {
    $model = new AdminForgot;
    if (isset($_POST['AdminForgot'])) {
      $model->attributes = $_POST['AdminForgot'];
      if ($model->validate()) {
        $admin = $this->loadModel($model->id);
        if ($admin->email != $model->email) {
          throw new CHttpException(404, 'Введённый Вами e-mail не соответствует этому логину');
        }
        $data = array(
          'username' => $admin->username,
          'link' => Yii::app()->getBaseUrl(true).'/admin/forgot/newpass/id/'.$admin->username.'/hash/'.$this->_hashPass($admin->password),
          'time' => date('j.m.Y H:i:s'),
          'ip' => Y::request()->userHostAddress,
        );
        Mail::letter('admin_forgot_link', $admin->email, $admin->firstName, $data);
        $this->redirect(array('forgot/sent'));
      }
    }
    /*
    $FZZmWU9ZvJZujubNZ = parse_url(Yii::app()->getBaseUrl(TRUE));
    $FZZmWU9ZvJZujubNZ = $FZZmWU9ZvJZujubNZ['host'];
    $dfeaVaUtRQ9lNID5t = substr(OM_LIC, 224, 16);
    $AQer9IRRDa47ylTuu = md5($FZZmWU9ZvJZujubNZ.'9e184ff79279f516b008019f5bd8d4a0');
    $AQer9IRRDa47ylTuu = md5($AQer9IRRDa47ylTuu.$FZZmWU9ZvJZujubNZ.'13c782adb9740c301d534b3caae3c607');
    $AQer9IRRDa47ylTuu = md5($AQer9IRRDa47ylTuu.$FZZmWU9ZvJZujubNZ.'9fed71ca4f0b32cd33ecaf5ba842276d');
    $AQer9IRRDa47ylTuu = substr($AQer9IRRDa47ylTuu, 0, 16);
    if ($AQer9IRRDa47ylTuu !== $dfeaVaUtRQ9lNID5t) die ();
    */
    $this->render('index', array('model' => $model));
  }

  public function actionSent() {
    $this->render('/forgot/sent');
  }

  public function actionNewpass($id, $hash) {
    if (!preg_match('/^[a-z0-9]+$/', $id)) {
      throw new CHttpException(404, 'Недопустимые символы в ID');
    }
    if (!preg_match('/^[a-z0-9]+$/', $hash)) {
      throw new CHttpException(404, 'Неверный формат хэша');
    }
    /*
    $FZZmWU9ZvJZujubNZ = parse_url(Yii::app()->getBaseUrl(TRUE));
    $FZZmWU9ZvJZujubNZ = $FZZmWU9ZvJZujubNZ['host'];
    $dfeaVaUtRQ9lNID5t = substr(OM_LIC, 224, 16);
    $AQer9IRRDa47ylTuu = md5($FZZmWU9ZvJZujubNZ.'9e184ff79279f516b008019f5bd8d4a0');
    $AQer9IRRDa47ylTuu = md5($AQer9IRRDa47ylTuu.$FZZmWU9ZvJZujubNZ.'13c782adb9740c301d534b3caae3c607');
    $AQer9IRRDa47ylTuu = md5($AQer9IRRDa47ylTuu.$FZZmWU9ZvJZujubNZ.'9fed71ca4f0b32cd33ecaf5ba842276d');
    $AQer9IRRDa47ylTuu = substr($AQer9IRRDa47ylTuu, 0, 16);
    if ($AQer9IRRDa47ylTuu !== $dfeaVaUtRQ9lNID5t) die ();
    */
    $admin = $this->loadModel($id);
    if ($hash != $this->_hashPass($admin->password)) {
      throw new CHttpException(404, 'Данная ссылка недействительна или уже была использована');
    }
    $newpass = H::random_string('alnum', rand(8, 11));
    $admin->password = $newpass;
    $admin->passwordRepeat = $admin->password;
    $admin->save();
    $data = array(
      'username' => $admin->username,
      'password' => $newpass,
    );
    Mail::letter('admin_forgot_pass', $admin->email, $admin->firstName, $data);
    $this->render('/forgot/sent2');
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
    $model = Staff::model()->findByAttributes(array('username' => $id));
    if ($model === null)
      throw new CHttpException(404, 'Администратора/Оператора с таким логином не существует.');
    return $model;
  }

  private function _hashPass($pass) {
    $str = md5($pass.'theForgotten');
    return md5('hash1'.$str).md5('hash2'.$str);
  }
}