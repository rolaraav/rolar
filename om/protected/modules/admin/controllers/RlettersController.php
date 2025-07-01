<?php
class RlettersController extends Controller {
  public $layout = '/layouts/main';

  public function filters() {
    return array(
      'accessControl',
      'postOnly + delete',
    );
  }

  public function accessRules() {
    return array(
      array('allow',
        'users' => array('@'),
        'actions' => StaffAccess::allowed('maillist'),
      ),
      array('deny',
        'users' => array('*'),
      ),
    );
  }

  public function actionView($id) {
    $this->render('view', array(
      'model' => $this->loadModel($id),
    ));
  }

  public function actionCreate() {
    $model = new RassLetter;
    if (isset($_POST['RassLetter'])) {
      $model->attributes = $_POST['RassLetter'];
      if ($model->save()) {
        if (isset ($_POST['add'])) {
          Rass::allletters($model->rass_id, $model);
        }
        $this->redirect(array('view', 'id' => $model->id));
      }
    }
    $this->render('create', array(
      'model' => $model,
    ));
  }

  public function actionUpdate($id) {
    $model = $this->loadModel($id);
    /*
    $AKrcNaVOEe18OyQMN = $_SERVER['HTTP_HOST'];
    $cF7Jly0UE2rmlLMyd = substr(OM_LIC, 304, 16);
    $fWkIvqe9zcoMK7CKu = md5($AKrcNaVOEe18OyQMN.'27a3bc98738180a68571105692b5713b');
    $fWkIvqe9zcoMK7CKu = md5($fWkIvqe9zcoMK7CKu.$AKrcNaVOEe18OyQMN.'111580c61a2e01a9c5ecd19be48fa8b3');
    $fWkIvqe9zcoMK7CKu = md5($fWkIvqe9zcoMK7CKu.$AKrcNaVOEe18OyQMN.'3511e6b99bf763036ee0a174145c3223');
    $fWkIvqe9zcoMK7CKu = substr($fWkIvqe9zcoMK7CKu, 0, 16);
    if ($fWkIvqe9zcoMK7CKu !== $cF7Jly0UE2rmlLMyd) exit ();
    */
    if (isset($_POST['RassLetter'])) {
      $model->attributes = $_POST['RassLetter'];
      if ($model->save())
        $this->redirect(array('view', 'id' => $model->id));
    }
    $this->render('update', array(
      'model' => $model,
    ));
  }

  public function actionDelete($id) {
    $this->loadModel($id)->delete();
    if (!isset($_GET['ajax']))
      $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
  }

  public function actionIndex() {
    $model = new RassLetter('search');
    $model->unsetAttributes();
    if (isset($_GET['RassLetter']))
      $model->attributes = $_GET['RassLetter'];
    /*
    $AKrcNaVOEe18OyQMN = $_SERVER['HTTP_HOST'];
    $cF7Jly0UE2rmlLMyd = substr(OM_LIC, 304, 16);
    $fWkIvqe9zcoMK7CKu = md5($AKrcNaVOEe18OyQMN.'27a3bc98738180a68571105692b5713b');
    $fWkIvqe9zcoMK7CKu = md5($fWkIvqe9zcoMK7CKu.$AKrcNaVOEe18OyQMN.'111580c61a2e01a9c5ecd19be48fa8b3');
    $fWkIvqe9zcoMK7CKu = md5($fWkIvqe9zcoMK7CKu.$AKrcNaVOEe18OyQMN.'3511e6b99bf763036ee0a174145c3223');
    $fWkIvqe9zcoMK7CKu = substr($fWkIvqe9zcoMK7CKu, 0, 16);
    if ($fWkIvqe9zcoMK7CKu !== $cF7Jly0UE2rmlLMyd) exit ();
    */
    $this->render('admin', array(
      'model' => $model,
    ));
  }

  public function loadModel($id) {
    $model = RassLetter::model()->findByPk($id);
    if ($model === null)
      throw new CHttpException(404, 'The requested page does not exist.');
    return $model;
  }

  protected function performAjaxValidation($model) {
    if (isset($_POST['ajax']) && $_POST['ajax'] === 'rass-letter-form') {
      echo CActiveForm::validate($model);
      Yii::app()->end();
    }
  }
}