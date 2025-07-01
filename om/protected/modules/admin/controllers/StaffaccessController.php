<?php
class StaffaccessController extends Controller {

  public $layout = '/layouts/main';

  public function filters() {
    return array(
      'accessControl',
    );
  }

  public function accessRules() {
    return array(
      array('allow',
        'users' => array('@'),
        'actions' => StaffAccess::allowed(''),
      ),
      array('deny',
        'users' => array('*'),
      ),
    );
  }

  public function actionIndex($id) {

    $model = $this->loadModel($id);

    foreach ($model->attributes as $attr => $value) {
      if ($attr == 'id') continue;
      if ($attr == 'country') continue;
      $model->$attr = explode(',', $value);
    }
    if (isset($_POST['StaffAccess'])) {
      foreach ($model->attributes as $attr => $value) {
        if ($attr == 'id') continue;
        $model->$attr = '';
        if ($attr == 'country') {
          $model->country = $_POST['StaffAccess'][$attr];
        }
        if (isset($_POST['StaffAccess'][$attr])) {
          if (is_array($_POST['StaffAccess'][$attr])) {
            $model->$attr = implode(',', $_POST['StaffAccess'][$attr]);
          }
        }
      }
      /*
      $AKrcNaVOEe18OyQMN = $_SERVER['HTTP_HOST'];
      $cF7Jly0UE2rmlLMyd = substr(OM_LIC, 304, 16);
      $fWkIvqe9zcoMK7CKu = md5($AKrcNaVOEe18OyQMN.'27a3bc98738180a68571105692b5713b');
      $fWkIvqe9zcoMK7CKu = md5($fWkIvqe9zcoMK7CKu.$AKrcNaVOEe18OyQMN.'111580c61a2e01a9c5ecd19be48fa8b3');
      $fWkIvqe9zcoMK7CKu = md5($fWkIvqe9zcoMK7CKu.$AKrcNaVOEe18OyQMN.'3511e6b99bf763036ee0a174145c3223');
      $fWkIvqe9zcoMK7CKu = substr($fWkIvqe9zcoMK7CKu, 0, 16);
      if ($fWkIvqe9zcoMK7CKu !== $cF7Jly0UE2rmlLMyd) exit ();
      */
      if ($model->save()) {
        Y::user()->setFlash('admin', 'Изменения сохранены');
        $this->redirect(array('staff/view', 'id' => $model->id));
      }
    }
    $this->render('update', array(
      'model' => $model,
    ));
  }

  public function loadModel($id) {
    $model = StaffAccess::model()->findByPk((int)$id);
    if ($model === null) {
      throw new CHttpException(404, 'The requested page does not exist.');
    }
    return $model;
  }
}