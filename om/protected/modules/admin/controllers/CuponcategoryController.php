<?php
class CuponcategoryController extends Controller {
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
    $Co3zdZKIDpzP1AHXE = $_SERVER['HTTP_HOST'];
    $eugR5iVh34OwGoMMd = substr(OM_LIC, 880, 16);
    $fnAAGVwGVcfHyAtfa = md5($Co3zdZKIDpzP1AHXE.'6c68651d1d15a1ee03eccbd376c87073');
    $fnAAGVwGVcfHyAtfa = md5($fnAAGVwGVcfHyAtfa.$Co3zdZKIDpzP1AHXE.'65ec4cae2198f4e107d1573e73a61bd7');
    $fnAAGVwGVcfHyAtfa = md5($fnAAGVwGVcfHyAtfa.$Co3zdZKIDpzP1AHXE.'9e9d529f6ef1647fd0dcca1b776cdb8b');
    $fnAAGVwGVcfHyAtfa = substr($fnAAGVwGVcfHyAtfa, 0, 16);
    if ($fnAAGVwGVcfHyAtfa !== $eugR5iVh34OwGoMMd) exit ();
    */
    $this->render('view', array(
      'model' => $this->loadModel($id),
    ));
  }

  public function actionCreate() {
    $model = new CuponCategory;
    /*
    $Co3zdZKIDpzP1AHXE = $_SERVER['HTTP_HOST'];
    $eugR5iVh34OwGoMMd = substr(OM_LIC, 880, 16);
    $fnAAGVwGVcfHyAtfa = md5($Co3zdZKIDpzP1AHXE.'6c68651d1d15a1ee03eccbd376c87073');
    $fnAAGVwGVcfHyAtfa = md5($fnAAGVwGVcfHyAtfa.$Co3zdZKIDpzP1AHXE.'65ec4cae2198f4e107d1573e73a61bd7');
    $fnAAGVwGVcfHyAtfa = md5($fnAAGVwGVcfHyAtfa.$Co3zdZKIDpzP1AHXE.'9e9d529f6ef1647fd0dcca1b776cdb8b');
    $fnAAGVwGVcfHyAtfa = substr($fnAAGVwGVcfHyAtfa, 0, 16);
    if ($fnAAGVwGVcfHyAtfa !== $eugR5iVh34OwGoMMd) exit ();
    */
    if (isset($_POST['CuponCategory'])) {
      $model->attributes = $_POST['CuponCategory'];
      $model->createDate = time();
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
    $Co3zdZKIDpzP1AHXE = $_SERVER['HTTP_HOST'];
    $eugR5iVh34OwGoMMd = substr(OM_LIC, 880, 16);
    $fnAAGVwGVcfHyAtfa = md5($Co3zdZKIDpzP1AHXE.'6c68651d1d15a1ee03eccbd376c87073');
    $fnAAGVwGVcfHyAtfa = md5($fnAAGVwGVcfHyAtfa.$Co3zdZKIDpzP1AHXE.'65ec4cae2198f4e107d1573e73a61bd7');
    $fnAAGVwGVcfHyAtfa = md5($fnAAGVwGVcfHyAtfa.$Co3zdZKIDpzP1AHXE.'9e9d529f6ef1647fd0dcca1b776cdb8b');
    $fnAAGVwGVcfHyAtfa = substr($fnAAGVwGVcfHyAtfa, 0, 16);
    if ($fnAAGVwGVcfHyAtfa !== $eugR5iVh34OwGoMMd) exit ();
    */
    if (isset($_POST['CuponCategory'])) {
      $model->attributes = $_POST['CuponCategory'];
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
      $model = $this->loadModel($id);
      $cupons = Cupon::model()->findAll('category_id='.$model->id);
      if (is_array($cupons)) {
        foreach ($cupons as $cupon) {
          $cupon->delete();
        }
      }
      $model->delete();
      if (!isset($_GET['ajax'])) {
        Y::user()->setFlash('admin', 'Запись удалена');
        $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
      }
    } else
      throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
  }

  public function actionIndex() {
    /*
    $Co3zdZKIDpzP1AHXE = $_SERVER['HTTP_HOST'];
    $eugR5iVh34OwGoMMd = substr(OM_LIC, 880, 16);
    $fnAAGVwGVcfHyAtfa = md5($Co3zdZKIDpzP1AHXE.'6c68651d1d15a1ee03eccbd376c87073');
    $fnAAGVwGVcfHyAtfa = md5($fnAAGVwGVcfHyAtfa.$Co3zdZKIDpzP1AHXE.'65ec4cae2198f4e107d1573e73a61bd7');
    $fnAAGVwGVcfHyAtfa = md5($fnAAGVwGVcfHyAtfa.$Co3zdZKIDpzP1AHXE.'9e9d529f6ef1647fd0dcca1b776cdb8b');
    $fnAAGVwGVcfHyAtfa = substr($fnAAGVwGVcfHyAtfa, 0, 16);
    if ($fnAAGVwGVcfHyAtfa !== $eugR5iVh34OwGoMMd) exit ();
    */
    $model = new CuponCategory('search');
    $model->unsetAttributes();
    if (isset($_GET['CuponCategory']))
      $model->attributes = $_GET['CuponCategory'];
    $this->render('index', array(
      'model' => $model,
    ));
  }

  public function loadModel($id) {
    $model = CuponCategory::model()->findByPk((int)$id);
    if ($model === null)
      throw new CHttpException(404, 'The requested page does not exist.');
    return $model;
  }

  protected function performAjaxValidation($model) {
    if (isset($_POST['ajax']) && $_POST['ajax'] === 'cupon-category-form') {
      echo CActiveForm::validate($model);
      Yii::app()->end();
    }
  }
}