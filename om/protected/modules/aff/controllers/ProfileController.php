<?php
class ProfileController extends Controller {
  public function filters() {
    return array(
      'accessControl',
    );
  }

  public function accessRules() {
    return array(
      array('allow',
        'actions' => array('index', 'edit'),
        'users' => array('@'),
      ),
      array('deny',
        'users' => array('*'),
      ),
    );
  }

  public function actionIndex() {
    $id = Y::user()->id;
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
    $this->render('/profile/index', array(
      'model' => $this->loadModel($id),
    ));
  }

  public function actionEdit() {
    $id = Y::user()->id;
    $model = $this->loadModel($id);
    $model->passwordRepeat = $model->password;
    if (isset($_POST['Partner'])) {
      $allowed = array('country', 'firstName', 'email', 'password', 'passwordRepeat', 'url', 'aboutProject', 'maillist',
        'wmz', 'wmr', 'rbkmoney', 'yandex', 'zpayment', 'city');
      $fields = array();
      foreach ($allowed as $one) {
        $fields[$one] = $_POST['Partner'][$one];
      }
      $model->attributes = $fields;
      if ($model->save()) {
        Y::user()->setFlash('aff', Yii::t('aff', 'Изменения сохранены'));
        $this->redirect(array('/aff/profile'));
      }
    }
    $this->render('/profile/edit', array(
      'model' => $model,
    ));
  }

  public function loadModel($id) {
    $model = Partner::model()->findByPk($id);
    if ($model === null)
      throw new CHttpException(404, 'Такого партнёра не существует.');
    return $model;
  }
}