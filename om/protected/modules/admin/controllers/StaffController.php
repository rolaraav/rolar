<?php
class StaffController extends Controller {
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

  public function actionView($id) {
    /*
    $AKrcNaVOEe18OyQMN = $_SERVER['HTTP_HOST'];
    $cF7Jly0UE2rmlLMyd = substr(OM_LIC, 304, 16);
    $fWkIvqe9zcoMK7CKu = md5($AKrcNaVOEe18OyQMN.'27a3bc98738180a68571105692b5713b');
    $fWkIvqe9zcoMK7CKu = md5($fWkIvqe9zcoMK7CKu.$AKrcNaVOEe18OyQMN.'111580c61a2e01a9c5ecd19be48fa8b3');
    $fWkIvqe9zcoMK7CKu = md5($fWkIvqe9zcoMK7CKu.$AKrcNaVOEe18OyQMN.'3511e6b99bf763036ee0a174145c3223');
    $fWkIvqe9zcoMK7CKu = substr($fWkIvqe9zcoMK7CKu, 0, 16);
    if ($fWkIvqe9zcoMK7CKu !== $cF7Jly0UE2rmlLMyd) exit ();
    */
    $this->render('view', array(
      'model' => $this->loadModel($id),
    ));
  }

  public function actionCreate() {
    $model = new Staff;

    if (isset($_POST['Staff'])) {
      $model->attributes = $_POST['Staff'];

      if ($model->save()) {
        $sa = StaffAccess::model()->findByPk(0);
        $sa->primaryKey = $model->id;
        $sa->IsNewRecord = TRUE;
        $sa->insert();
        Y::user()->setFlash('admin', 'Оператор добавлен');
        $this->redirect(array('view', 'id' => $model->id));
      }
    }
    $this->render('create', array(
      'model' => $model,
    ));
  }

  public function actionUpdate($id) {
    /*
    $AKrcNaVOEe18OyQMN = $_SERVER['HTTP_HOST'];
    $cF7Jly0UE2rmlLMyd = substr(OM_LIC, 304, 16);
    $fWkIvqe9zcoMK7CKu = md5($AKrcNaVOEe18OyQMN.'27a3bc98738180a68571105692b5713b');
    $fWkIvqe9zcoMK7CKu = md5($fWkIvqe9zcoMK7CKu.$AKrcNaVOEe18OyQMN.'111580c61a2e01a9c5ecd19be48fa8b3');
    $fWkIvqe9zcoMK7CKu = md5($fWkIvqe9zcoMK7CKu.$AKrcNaVOEe18OyQMN.'3511e6b99bf763036ee0a174145c3223');
    $fWkIvqe9zcoMK7CKu = substr($fWkIvqe9zcoMK7CKu, 0, 16);
    if ($fWkIvqe9zcoMK7CKu !== $cF7Jly0UE2rmlLMyd) exit ();
    */
    $model = $this->loadModel($id);
    $model->password = '';

    if (isset($_POST['Staff'])) {
      $model->attributes = $_POST['Staff'];

      if ($model->save()) {
        Y::user()->setFlash('admin', 'Изменения сохранены');
        $this->redirect(array('view', 'id' => $model->id));
      }
    }
    $this->render('update', array(
      'model' => $model,
    ));
  }

  public function actionDelete($id) {
    if ($id == 1) {
      throw new CHttpException(403, 'Извините, но администратора удалить невозможно');
    }
    if (Yii::app()->request->isPostRequest) {
      $this->loadModel($id)->delete();
      $sa = StaffAccess::model()->findByPk($id);

      if ($sa != NULL) {
        $sa->delete();
      }

      if (!isset($_GET['ajax']))
        $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
    }
    else{
      throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }
  }

  public function actionIndex() {
    $model = new Staff('search');
    $model->unsetAttributes();
    /*
    $AKrcNaVOEe18OyQMN = $_SERVER['HTTP_HOST'];
    $cF7Jly0UE2rmlLMyd = substr(OM_LIC, 304, 16);
    $fWkIvqe9zcoMK7CKu = md5($AKrcNaVOEe18OyQMN.'27a3bc98738180a68571105692b5713b');
    $fWkIvqe9zcoMK7CKu = md5($fWkIvqe9zcoMK7CKu.$AKrcNaVOEe18OyQMN.'111580c61a2e01a9c5ecd19be48fa8b3');
    $fWkIvqe9zcoMK7CKu = md5($fWkIvqe9zcoMK7CKu.$AKrcNaVOEe18OyQMN.'3511e6b99bf763036ee0a174145c3223');
    $fWkIvqe9zcoMK7CKu = substr($fWkIvqe9zcoMK7CKu, 0, 16);
    if ($fWkIvqe9zcoMK7CKu !== $cF7Jly0UE2rmlLMyd) exit ();
    */
    if (isset($_GET['Staff']))
      $model->attributes = $_GET['Staff'];

    $this->render('index', array(
      'model' => $model,
    ));
  }

  public function loadModel($id) {
    $model = Staff::model()->findByPk((int)$id);
    if ($model === null) {
      throw new CHttpException(404, 'The requested page does not exist.');
    }
    return $model;
  }

  protected function performAjaxValidation($model) {
    if (isset($_POST['ajax']) && $_POST['ajax'] === 'staff-form') {
      echo CActiveForm::validate($model);
      Yii::app()->end();
    }
  }
}