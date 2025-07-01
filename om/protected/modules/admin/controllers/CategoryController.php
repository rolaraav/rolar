<?php
class CategoryController extends Controller {
  public function filters() {
    return array(
      'accessControl',
    );
  }

  public function accessRules() {
    return array(
      array('allow',
        'users' => array('@'),
        'actions' => StaffAccess::allowed('category'),
      ),
      array('deny',
        'users' => array('*'),
      ),
    );
  }

  public function actionView($id) {
    /*
    $fbTAttd2rAZbUt6me = OM_LIC_HOST;
    $f8svMpOSAoz2INutu = substr(OM_LIC, 848, 16);
    $EvbsH3l8qCi1pIVq4 = md5($fbTAttd2rAZbUt6me.'5ab7c5234a69aeeea488307ca4ef1e59');
    $EvbsH3l8qCi1pIVq4 = md5($EvbsH3l8qCi1pIVq4.$fbTAttd2rAZbUt6me.'f39f60481c44de76f6eef09ed61a3a1e');
    $EvbsH3l8qCi1pIVq4 = md5($EvbsH3l8qCi1pIVq4.$fbTAttd2rAZbUt6me.'a2b290988f4804cee28d9cce72368336');
    $EvbsH3l8qCi1pIVq4 = substr($EvbsH3l8qCi1pIVq4, 0, 16);
    if ($EvbsH3l8qCi1pIVq4 !== $f8svMpOSAoz2INutu) exit ();
    */
    $this->render('view', array(
      'model' => $this->loadModel($id),
    ));
  }

  public function actionCreate() {
    $model = new Category;
    /*
    $fbTAttd2rAZbUt6me = OM_LIC_HOST;
    $f8svMpOSAoz2INutu = substr(OM_LIC, 848, 16);
    $EvbsH3l8qCi1pIVq4 = md5($fbTAttd2rAZbUt6me.'5ab7c5234a69aeeea488307ca4ef1e59');
    $EvbsH3l8qCi1pIVq4 = md5($EvbsH3l8qCi1pIVq4.$fbTAttd2rAZbUt6me.'f39f60481c44de76f6eef09ed61a3a1e');
    $EvbsH3l8qCi1pIVq4 = md5($EvbsH3l8qCi1pIVq4.$fbTAttd2rAZbUt6me.'a2b290988f4804cee28d9cce72368336');
    $EvbsH3l8qCi1pIVq4 = substr($EvbsH3l8qCi1pIVq4, 0, 16);
    if ($EvbsH3l8qCi1pIVq4 !== $f8svMpOSAoz2INutu) exit ();
    */
    if (isset($_POST['Category'])) {
      $model->attributes = $_POST['Category'];
      if ($model->save())
        $this->redirect(array('view', 'id' => $model->id));
    }
    $this->render('create', array(
      'model' => $model,
    ));
  }

  public function actionUpdate($id) {
    $model = $this->loadModel($id);
    /*
    $fbTAttd2rAZbUt6me = OM_LIC_HOST;
    $f8svMpOSAoz2INutu = substr(OM_LIC, 848, 16);
    $EvbsH3l8qCi1pIVq4 = md5($fbTAttd2rAZbUt6me.'5ab7c5234a69aeeea488307ca4ef1e59');
    $EvbsH3l8qCi1pIVq4 = md5($EvbsH3l8qCi1pIVq4.$fbTAttd2rAZbUt6me.'f39f60481c44de76f6eef09ed61a3a1e');
    $EvbsH3l8qCi1pIVq4 = md5($EvbsH3l8qCi1pIVq4.$fbTAttd2rAZbUt6me.'a2b290988f4804cee28d9cce72368336');
    $EvbsH3l8qCi1pIVq4 = substr($EvbsH3l8qCi1pIVq4, 0, 16);
    if ($EvbsH3l8qCi1pIVq4 !== $f8svMpOSAoz2INutu) exit ();
    */
    if (isset($_POST['Category'])) {
      $model->attributes = $_POST['Category'];
      if ($model->save())
        $this->redirect(array('view', 'id' => $model->id));
    }
    $this->render('update', array(
      'model' => $model,
    ));
  }

  public function actionDelete($id) {
    if (Yii::app()->request->isPostRequest) {
      $this->loadModel($id)->delete();
      if (!isset($_GET['ajax'])) $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
    } else
      throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
  }

  public function actionIndex() {
    $model = new Category('search');
    $model->unsetAttributes();
    if (isset($_GET['Category']))
      $model->attributes = $_GET['Category'];
    /*
    $fbTAttd2rAZbUt6me = OM_LIC_HOST;
    $f8svMpOSAoz2INutu = substr(OM_LIC, 848, 16);
    $EvbsH3l8qCi1pIVq4 = md5($fbTAttd2rAZbUt6me.'5ab7c5234a69aeeea488307ca4ef1e59');
    $EvbsH3l8qCi1pIVq4 = md5($EvbsH3l8qCi1pIVq4.$fbTAttd2rAZbUt6me.'f39f60481c44de76f6eef09ed61a3a1e');
    $EvbsH3l8qCi1pIVq4 = md5($EvbsH3l8qCi1pIVq4.$fbTAttd2rAZbUt6me.'a2b290988f4804cee28d9cce72368336');
    $EvbsH3l8qCi1pIVq4 = substr($EvbsH3l8qCi1pIVq4, 0, 16);
    if ($EvbsH3l8qCi1pIVq4 !== $f8svMpOSAoz2INutu) exit ();
    */
    $this->render('admin', array(
      'model' => $model,
    ));
  }

  public function loadModel($id) {
    $model = Category::model()->findByPk((int)$id);
    if ($model === null)
      throw new CHttpException(404, 'The requested page does not exist.');
    return $model;
  }

  protected function performAjaxValidation($model) {
    if (isset($_POST['ajax']) && $_POST['ajax'] === 'category-form') {
      echo CActiveForm::validate($model);
      Yii::app()->end();
    }
  }
}