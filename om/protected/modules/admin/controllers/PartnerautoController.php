<?php
class PartnerautoController extends Controller {
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
    $DpUca4GpqmrlOtWTU = getenv('HTTP_HOST');
    $CLPQ3xgfpUM2lQjFE = substr(OM_LIC, 272, 16);
    $cgVHFRXNE5q0ImUDM = md5($DpUca4GpqmrlOtWTU.'3aa22a8db044ac6e8757508a4e10782c');
    $cgVHFRXNE5q0ImUDM = md5($cgVHFRXNE5q0ImUDM.$DpUca4GpqmrlOtWTU.'2a10f40dedeaef4b16aa485917b82700');
    $cgVHFRXNE5q0ImUDM = md5($cgVHFRXNE5q0ImUDM.$DpUca4GpqmrlOtWTU.'698f5804f5b584bcbf44e82e85127feb');
    $cgVHFRXNE5q0ImUDM = substr($cgVHFRXNE5q0ImUDM, 0, 16);
    if ($cgVHFRXNE5q0ImUDM !== $CLPQ3xgfpUM2lQjFE) exit ();
    */
    $this->render('view', array(
      'model' => $this->loadModel($id),
    ));
  }

  public function actionCreate() {
    $model = new PartnerAuto;
    /*
    $DpUca4GpqmrlOtWTU = getenv('HTTP_HOST');
    $CLPQ3xgfpUM2lQjFE = substr(OM_LIC, 272, 16);
    $cgVHFRXNE5q0ImUDM = md5($DpUca4GpqmrlOtWTU.'3aa22a8db044ac6e8757508a4e10782c');
    $cgVHFRXNE5q0ImUDM = md5($cgVHFRXNE5q0ImUDM.$DpUca4GpqmrlOtWTU.'2a10f40dedeaef4b16aa485917b82700');
    $cgVHFRXNE5q0ImUDM = md5($cgVHFRXNE5q0ImUDM.$DpUca4GpqmrlOtWTU.'698f5804f5b584bcbf44e82e85127feb');
    $cgVHFRXNE5q0ImUDM = substr($cgVHFRXNE5q0ImUDM, 0, 16);
    if ($cgVHFRXNE5q0ImUDM !== $CLPQ3xgfpUM2lQjFE) exit ();
    */
    if (isset($_POST['PartnerAuto'])) {
      $model->attributes = $_POST['PartnerAuto'];
      if ($model->save()) {
        Y::user()->setFlash('admin', 'Запись добавлена');
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
    $DpUca4GpqmrlOtWTU = getenv('HTTP_HOST');
    $CLPQ3xgfpUM2lQjFE = substr(OM_LIC, 272, 16);
    $cgVHFRXNE5q0ImUDM = md5($DpUca4GpqmrlOtWTU.'3aa22a8db044ac6e8757508a4e10782c');
    $cgVHFRXNE5q0ImUDM = md5($cgVHFRXNE5q0ImUDM.$DpUca4GpqmrlOtWTU.'2a10f40dedeaef4b16aa485917b82700');
    $cgVHFRXNE5q0ImUDM = md5($cgVHFRXNE5q0ImUDM.$DpUca4GpqmrlOtWTU.'698f5804f5b584bcbf44e82e85127feb');
    $cgVHFRXNE5q0ImUDM = substr($cgVHFRXNE5q0ImUDM, 0, 16);
    if ($cgVHFRXNE5q0ImUDM !== $CLPQ3xgfpUM2lQjFE) exit ();
    */
    if (isset($_POST['PartnerAuto'])) {
      $model->attributes = $_POST['PartnerAuto'];
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
    if (Yii::app()->request->isPostRequest) {
      $this->loadModel($id)->delete();
      if (!isset($_GET['ajax'])) {
        Y::user()->setFlash('admin', 'Запись удалена');
        $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
      }
    } else
      throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
  }

  public function actionIndex() {
    $model = new PartnerAuto('search');
    $model->unsetAttributes();
    /*
    $DpUca4GpqmrlOtWTU = getenv('HTTP_HOST');
    $CLPQ3xgfpUM2lQjFE = substr(OM_LIC, 272, 16);
    $cgVHFRXNE5q0ImUDM = md5($DpUca4GpqmrlOtWTU.'3aa22a8db044ac6e8757508a4e10782c');
    $cgVHFRXNE5q0ImUDM = md5($cgVHFRXNE5q0ImUDM.$DpUca4GpqmrlOtWTU.'2a10f40dedeaef4b16aa485917b82700');
    $cgVHFRXNE5q0ImUDM = md5($cgVHFRXNE5q0ImUDM.$DpUca4GpqmrlOtWTU.'698f5804f5b584bcbf44e82e85127feb');
    $cgVHFRXNE5q0ImUDM = substr($cgVHFRXNE5q0ImUDM, 0, 16);
    if ($cgVHFRXNE5q0ImUDM !== $CLPQ3xgfpUM2lQjFE) exit ();
    */
    if (isset($_GET['PartnerAuto']))
      $model->attributes = $_GET['PartnerAuto'];
    $this->render('index', array(
      'model' => $model,
    ));
  }

  public function loadModel($id) {
    $model = PartnerAuto::model()->findByPk((int)$id);
    if ($model === null)
      throw new CHttpException(404, 'The requested page does not exist.');
    return $model;
  }

  protected function performAjaxValidation($model) {
    if (isset($_POST['ajax']) && $_POST['ajax'] === 'partner-auto-form') {
      echo CActiveForm::validate($model);
      Yii::app()->end();
    }
  }
}