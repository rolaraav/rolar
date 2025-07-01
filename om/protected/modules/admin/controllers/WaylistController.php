<?php
class WaylistController extends Controller {
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
    $this->render('view', array(
      'model' => $this->loadModel($id),
    ));
  }

  public function actionCreate() {
    $model = new WayList;
    /*
    $CpeG6dIbUSw7xRJ5I = $_SERVER['HTTP_HOST'];
    $A6ecKSIfRsj53Fy4K = substr(OM_LIC, 320, 16);
    $FyvUKx7iJ1DTcZEm1 = md5($CpeG6dIbUSw7xRJ5I.'85b8de2d7a1cfd9a513bf1a1d31b702a');
    $FyvUKx7iJ1DTcZEm1 = md5($FyvUKx7iJ1DTcZEm1.$CpeG6dIbUSw7xRJ5I.'002f7c424973877577f098c88ac9ee64');
    $FyvUKx7iJ1DTcZEm1 = md5($FyvUKx7iJ1DTcZEm1.$CpeG6dIbUSw7xRJ5I.'19fc3787f8b39e2debdbaf058c3c351e');
    $FyvUKx7iJ1DTcZEm1 = substr($FyvUKx7iJ1DTcZEm1, 0, 16);
    if ($FyvUKx7iJ1DTcZEm1 !== $A6ecKSIfRsj53Fy4K) die ();
    */
    if (isset($_POST['WayList'])) {
      $model->attributes = $_POST['WayList'];
      if ($model->save()) {
        Y::user()->setFlash('admin', 'Запись добавлена');
        $this->redirect(array('view', 'id' => $model->plist_id));
      }
    }
    $this->render('create', array(
      'model' => $model,
    ));
  }

  public function actionUpdate($id) {
    $model = $this->loadModel($id);
    if (isset($_POST['WayList'])) {
      $model->attributes = $_POST['WayList'];
      if ($model->save()) {
        Y::user()->setFlash('admin', 'Изменения сохранены');
        $this->redirect(array('view', 'id' => $model->plist_id));
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
    $model = new WayList('search');
    $model->unsetAttributes();
    if (isset($_GET['WayList']))
      $model->attributes = $_GET['WayList'];
    /*
    $CpeG6dIbUSw7xRJ5I = $_SERVER['HTTP_HOST'];
    $A6ecKSIfRsj53Fy4K = substr(OM_LIC, 320, 16);
    $FyvUKx7iJ1DTcZEm1 = md5($CpeG6dIbUSw7xRJ5I.'85b8de2d7a1cfd9a513bf1a1d31b702a');
    $FyvUKx7iJ1DTcZEm1 = md5($FyvUKx7iJ1DTcZEm1.$CpeG6dIbUSw7xRJ5I.'002f7c424973877577f098c88ac9ee64');
    $FyvUKx7iJ1DTcZEm1 = md5($FyvUKx7iJ1DTcZEm1.$CpeG6dIbUSw7xRJ5I.'19fc3787f8b39e2debdbaf058c3c351e');
    $FyvUKx7iJ1DTcZEm1 = substr($FyvUKx7iJ1DTcZEm1, 0, 16);
    if ($FyvUKx7iJ1DTcZEm1 !== $A6ecKSIfRsj53Fy4K) die ();
    */
    $this->render('index', array(
      'model' => $model,
    ));
  }

  public function loadModel($id) {
    $model = WayList::model()->findByPk($id);
    if ($model === null)
      throw new CHttpException(404, 'The requested page does not exist.');
    return $model;
  }

  protected function performAjaxValidation($model) {
    if (isset($_POST['ajax']) && $_POST['ajax'] === 'way-list-form') {
      echo CActiveForm::validate($model);
      Yii::app()->end();
    }
  }
}