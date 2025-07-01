<?php
class AdcategoryController extends Controller {
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
    $ECNORweaNSFuGjgyj = parse_url(Yii::app()->getBaseUrl(TRUE));
    $ECNORweaNSFuGjgyj = $ECNORweaNSFuGjgyj['host'];
    $F2zeujZtq6eo2Lxzt = substr(OM_LIC, 1008, 16);
    $CO1udnqcyKOB2M3Ft = md5($ECNORweaNSFuGjgyj.'4b5f03e69686bd0c946d422105263955');
    $CO1udnqcyKOB2M3Ft = md5($CO1udnqcyKOB2M3Ft.$ECNORweaNSFuGjgyj.'dbf659b4b7e2c0a11341168416a1fd80');
    $CO1udnqcyKOB2M3Ft = md5($CO1udnqcyKOB2M3Ft.$ECNORweaNSFuGjgyj.'9cebe8fbccdb7d346921e00c0ebb95fb');
    $CO1udnqcyKOB2M3Ft = substr($CO1udnqcyKOB2M3Ft, 0, 16);
    if ($CO1udnqcyKOB2M3Ft !== $F2zeujZtq6eo2Lxzt) die ();
    */
    $this->render('view', array(
      'model' => $this->loadModel($id),
    ));
  }

  public function actionCreate() {
    $model = new AdCategory;
    if (isset($_POST['AdCategory'])) {
      $model->attributes = $_POST['AdCategory'];
      if ($model->save()) {
        Y::user()->setFlash('admin', 'Запись добавлена');
        $this->redirect(array('view', 'id' => $model->id));
      }
    }
    /*
    $DUoPbDsKaXyYEajhj = getenv('HTTP_HOST');
    $eAnZiX3g3tUISt1ig = substr(OM_LIC, 1024, 16);
    $bVZsYQGSWO4lObfTA = md5($DUoPbDsKaXyYEajhj.'d8c08c0c8e8c75c1f6679a878fbbf778');
    $bVZsYQGSWO4lObfTA = md5($bVZsYQGSWO4lObfTA.$DUoPbDsKaXyYEajhj.'da146227f253f403f324880f42677c2c');
    $bVZsYQGSWO4lObfTA = md5($bVZsYQGSWO4lObfTA.$DUoPbDsKaXyYEajhj.'86d854747e8f6cd607bb41f477e29f5e');
    $bVZsYQGSWO4lObfTA = substr($bVZsYQGSWO4lObfTA, 0, 16);
    if ($bVZsYQGSWO4lObfTA !== $eAnZiX3g3tUISt1ig) exit ();
    */
    $this->render('create', array(
      'model' => $model,
    ));
  }

  public function actionUpdate($id) {
    $model = $this->loadModel($id);
    if (isset($_POST['AdCategory'])) {
      $model->attributes = $_POST['AdCategory'];
      if ($model->save()) {
        Y::user()->setFlash('admin', 'Изменения сохранены');
        $this->redirect(array('view', 'id' => $model->id));
      }
    }
    /*
    $egGs72nvX2k86roI1 = parse_url(Yii::app()->getBaseUrl(TRUE));
    $egGs72nvX2k86roI1 = $egGs72nvX2k86roI1['host'];
    $cqrgLpukHEx7Wt4IW = substr(OM_LIC, 1040, 16);
    $E881A1NhD7n9X2ciU = md5($egGs72nvX2k86roI1.'ed1ce0c39aac1cbbea4e4591810a04c6');
    $E881A1NhD7n9X2ciU = md5($E881A1NhD7n9X2ciU.$egGs72nvX2k86roI1.'61c1bf210b29ac7798c27bb8144b9963');
    $E881A1NhD7n9X2ciU = md5($E881A1NhD7n9X2ciU.$egGs72nvX2k86roI1.'693cd31c05c834a44f7821d07ff84916');
    $E881A1NhD7n9X2ciU = substr($E881A1NhD7n9X2ciU, 0, 16);
    if ($E881A1NhD7n9X2ciU !== $cqrgLpukHEx7Wt4IW) die ();
    */
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
    $model = new AdCategory('search');
    $model->unsetAttributes();
    if (isset($_GET['AdCategory']))
      $model->attributes = $_GET['AdCategory'];
    $this->render('index', array(
      'model' => $model,
    ));
  }

  public function loadModel($id) {
    $model = AdCategory::model()->findByPk((int)$id);
    if ($model === null)
      throw new CHttpException(404, 'The requested page does not exist.');
    return $model;
  }

  protected function performAjaxValidation($model) {
    if (isset($_POST['ajax']) && $_POST['ajax'] === 'ad-category-form') {
      echo CActiveForm::validate($model);
      Yii::app()->end();
    }
  }
}