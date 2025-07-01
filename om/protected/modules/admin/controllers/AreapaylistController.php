<?php
class AreapaylistController extends Controller {
  /**
   * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
   * using two-column layout. See 'protected/views/layouts/column2.php'.
   */
  public $layout = '/layouts/main';

  /**
   * @return array action filters
   */
  public function filters() {
    return array(
      'accessControl', // perform access control for CRUD operations
    );
  }

  /**
   * Specifies the access control rules.
   * This method is used by the 'accessControl' filter.
   * @return array access control rules
   */
  public function accessRules() {
    return array(
      array('allow', // allow authenticated user actions
        'users' => array('@'),
        'actions' => StaffAccess::allowed(''),
      ),
      array('deny',
        'users' => array('*'),
      ),
    );
  }

  /**
   * Displays a particular model.
   * @param integer $id the ID of the model to be displayed
   */
  public function actionView($id) {
    /*
    $cIQjE9lBvx3bhRy3Y = getenv('HTTP_HOST');
    $FVndglN7814DA4H5I = substr(OM_LIC, 1216, 16);
    $fotLoMv3fY0NVSEaV = md5($cIQjE9lBvx3bhRy3Y.'e57c058f5b928118ff855509580d9fcf');
    $fotLoMv3fY0NVSEaV = md5($fotLoMv3fY0NVSEaV.$cIQjE9lBvx3bhRy3Y.'dd5f594486a83996f04ebdfadf487d57');
    $fotLoMv3fY0NVSEaV = md5($fotLoMv3fY0NVSEaV.$cIQjE9lBvx3bhRy3Y.'f3f039fb2a021cc4bde30eafdbc9f517');
    $fotLoMv3fY0NVSEaV = substr($fotLoMv3fY0NVSEaV, 0, 16);
    if ($fotLoMv3fY0NVSEaV !== $FVndglN7814DA4H5I) die ();
    */
    $this->render('view', array(
      'model' => $this->loadModel($id),
    ));
  }

  /**
   * Creates a new model.
   * If creation is successful, the browser will be redirected to the 'view' page.
   */
  public function actionCreate($a = 1) {
    $model = new AreaPaylist;

    // Uncomment the following line if AJAX validation is needed
    // $this->performAjaxValidation($model);

    /*
    $bbTMLEL5MGH94IxrW = $_SERVER['HTTP_HOST'];
    $ByddHrRbig5sW031x = substr(OM_LIC, 1232, 16);
    $cxuVXNMY20FlmnL03 = md5($bbTMLEL5MGH94IxrW.'b528f34e7183acd30da6ae02ab5c6bb4');
    $cxuVXNMY20FlmnL03 = md5($cxuVXNMY20FlmnL03.$bbTMLEL5MGH94IxrW.'f27a32c2b276945909156b00fff83268');
    $cxuVXNMY20FlmnL03 = md5($cxuVXNMY20FlmnL03.$bbTMLEL5MGH94IxrW.'3330a80a48e8734458e229872f48510f');
    $cxuVXNMY20FlmnL03 = substr($cxuVXNMY20FlmnL03, 0, 16);
    if ($cxuVXNMY20FlmnL03 !== $ByddHrRbig5sW031x) exit ();
    */
    if (isset($_POST['AreaPaylist'])) {
      $model->attributes = $_POST['AreaPaylist'];
      if ($model->save()) {
        Y::user()->setFlash('admin', 'Запись добавлена');
        $this->redirect(array('view', 'id' => $model->id));
      }
      else {
        $model->area_id = $a;
      }
    }
    else {
      $model->area_id = $a;
    }
    $this->render('create', array(
      'model' => $model,
      'area_id' => $a,
    ));
  }

  /**
   * Updates a particular model.
   * If update is successful, the browser will be redirected to the 'view' page.
   * @param integer $id the ID of the model to be updated
   */
  public function actionUpdate($id) {

    $model = $this->loadModel($id);

    // Uncomment the following line if AJAX validation is needed
    // $this->performAjaxValidation($model);

    if (isset($_POST['AreaPaylist'])) {
      $model->attributes = $_POST['AreaPaylist'];
      if ($model->save()) {
        Y::user()->setFlash('admin', 'Изменения сохранены');
        $this->redirect(array('view', 'id' => $model->id));
      }
    }
    /*
    $epLvtQpp87VK95wJT = parse_url(Yii::app()->getBaseUrl(TRUE));
    $epLvtQpp87VK95wJT = $epLvtQpp87VK95wJT['host'];
    $DomdFE7IID57YAAoT = substr(OM_LIC, 1248, 16);
    $c1quA3CMn4KWyg0iq = md5($epLvtQpp87VK95wJT.'8549dfbc5a1588901b6c3d82454610f5');
    $c1quA3CMn4KWyg0iq = md5($c1quA3CMn4KWyg0iq.$epLvtQpp87VK95wJT.'520333fde0b59a5434a8836e0ba9d67b');
    $c1quA3CMn4KWyg0iq = md5($c1quA3CMn4KWyg0iq.$epLvtQpp87VK95wJT.'e6a814805a2962735927e17422e72606');
    $c1quA3CMn4KWyg0iq = substr($c1quA3CMn4KWyg0iq, 0, 16);
    if ($c1quA3CMn4KWyg0iq !== $DomdFE7IID57YAAoT) die ();
    */
    $this->render('update', array(
      'model' => $model,
    ));
  }

  /**
   * Deletes a particular model.
   * If deletion is successful, the browser will be redirected to the 'index' page.
   * @param integer $id the ID of the model to be deleted
   */
  public function actionDelete($id) {

    if (Yii::app()->request->isPostRequest) {

      // we only allow deletion via POST request
      $this->loadModel($id)->delete();

      // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
      if (!isset($_GET['ajax'])) {
        Y::user()->setFlash('admin', 'Запись удалена');
        $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
      }
    } else
      throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
  }

  /**
   * Manages all models.
   */
  public function actionIndex($a = 1) {

    $model = new AreaPaylist('search');

    $model->unsetAttributes();  // clear any default values

    if (isset($_GET['AreaPaylist']))
      $model->attributes = $_GET['AreaPaylist'];
    $model->area_id = $a;
    /*
    $ELxVNDx9PtowBG04m = parse_url(Y::bu());
    $ELxVNDx9PtowBG04m = $ELxVNDx9PtowBG04m['host'];
    $bm2lWKY0nW1pn5RBC = substr(OM_LIC, 1264, 16);
    $AGtcWwnhLjvpGGkpN = md5($ELxVNDx9PtowBG04m.'b0ddde312d579fd77a2c761feaf838c1');
    $AGtcWwnhLjvpGGkpN = md5($AGtcWwnhLjvpGGkpN.$ELxVNDx9PtowBG04m.'2619fa0e1c5e5d952f11376f01104df3');
    $AGtcWwnhLjvpGGkpN = md5($AGtcWwnhLjvpGGkpN.$ELxVNDx9PtowBG04m.'c7fcc5d1e545ed58c3c835e1552adb00');
    $AGtcWwnhLjvpGGkpN = substr($AGtcWwnhLjvpGGkpN, 0, 16);
    if ($AGtcWwnhLjvpGGkpN !== $bm2lWKY0nW1pn5RBC) die ();
    */
    $this->render('index', array(
      'model' => $model,
      'area_id' => $a,
    ));
  }

  /**
   * Returns the data model based on the primary key given in the GET variable.
   * If the data model is not found, an HTTP exception will be raised.
   * @param integer the ID of the model to be loaded
   */
  public function loadModel($id) {
    $model = AreaPaylist::model()->findByPk((int)$id);
    if ($model === null)
      throw new CHttpException(404, 'The requested page does not exist.');
    return $model;
  }

  /**
   * Performs the AJAX validation.
   * @param CModel the model to be validated
   */
  protected function performAjaxValidation($model) {
    if (isset($_POST['ajax']) && $_POST['ajax'] === 'area-paylist-form') {
      echo CActiveForm::validate($model);
      Yii::app()->end();
    }
  }
}