<?php
class CuponController extends Controller {
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
        'actions' => StaffAccess::allowed('cupon'),
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
    $model = new Cupon;
    /*
    $Co3zdZKIDpzP1AHXE = $_SERVER['HTTP_HOST'];
    $eugR5iVh34OwGoMMd = substr(OM_LIC, 880, 16);
    $fnAAGVwGVcfHyAtfa = md5($Co3zdZKIDpzP1AHXE.'6c68651d1d15a1ee03eccbd376c87073');
    $fnAAGVwGVcfHyAtfa = md5($fnAAGVwGVcfHyAtfa.$Co3zdZKIDpzP1AHXE.'65ec4cae2198f4e107d1573e73a61bd7');
    $fnAAGVwGVcfHyAtfa = md5($fnAAGVwGVcfHyAtfa.$Co3zdZKIDpzP1AHXE.'9e9d529f6ef1647fd0dcca1b776cdb8b');
    $fnAAGVwGVcfHyAtfa = substr($fnAAGVwGVcfHyAtfa, 0, 16);
    if ($fnAAGVwGVcfHyAtfa !== $eugR5iVh34OwGoMMd) exit ();
    */
    if (isset($_POST['Cupon'])) {
      $model->attributes = $_POST['Cupon'];
      $model->startDate = H::dateParse($model->startDate);
      $model->stopDate = H::dateParse($model->stopDate);
      if ($model->validate()) {
        if ($model->pack < 1) {
          if ($model->save()) {
            Y::user()->setFlash('admin', 'Запись добавлена');
            $this->redirect(array('view', 'id' => $model->id));
          }
        } else {
          $cpid = $model->code;
          for ($i = 1; $i <= $model->pack; $i++) {
            $mm = clone $model;
            $mm->code = $cpid.H::random_string('lower', 15);
            $mm->save();
          }
          Y::user()->setFlash('admin', 'Купоны созданы');
          $this->redirect(array('cupon/index', 'Cupon[category_id]' => $model->category_id));
        }
      }
      $model->startDate = H::date($model->startDate);
      $model->stopDate = H::date($model->stopDate);
    } else {
      $model->pack = 0;
    }
    $this->render('create', array(
      'model' => $model,
    ));
  }

  public function actionUpdate($id) {
    $model = $this->loadModel($id);
    $model->startDate = H::date($model->startDate);
    $model->stopDate = H::date($model->stopDate);
    if (isset($_POST['Cupon'])) {
      $model->attributes = $_POST['Cupon'];
      $model->startDate = H::dateParse($model->startDate);
      $model->stopDate = H::dateParse($model->stopDate);
      if ($model->save()) {
        Y::user()->setFlash('admin', 'Изменения сохранены');
        $this->redirect(array('view', 'id' => $model->id));
      }
      $model->startDate = H::date($model->startDate);
      $model->stopDate = H::date($model->stopDate);
    }
    /*
    $Co3zdZKIDpzP1AHXE = $_SERVER['HTTP_HOST'];
    $eugR5iVh34OwGoMMd = substr(OM_LIC, 880, 16);
    $fnAAGVwGVcfHyAtfa = md5($Co3zdZKIDpzP1AHXE.'6c68651d1d15a1ee03eccbd376c87073');
    $fnAAGVwGVcfHyAtfa = md5($fnAAGVwGVcfHyAtfa.$Co3zdZKIDpzP1AHXE.'65ec4cae2198f4e107d1573e73a61bd7');
    $fnAAGVwGVcfHyAtfa = md5($fnAAGVwGVcfHyAtfa.$Co3zdZKIDpzP1AHXE.'9e9d529f6ef1647fd0dcca1b776cdb8b');
    $fnAAGVwGVcfHyAtfa = substr($fnAAGVwGVcfHyAtfa, 0, 16);
    if ($fnAAGVwGVcfHyAtfa !== $eugR5iVh34OwGoMMd) exit ();
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
    $model = new Cupon('search');
    $model->unsetAttributes();
    if (isset($_GET['Cupon']))
      $model->attributes = $_GET['Cupon'];
    /*
    $cVD9qC0zypezMeGC1 = OM_LIC_HOST;
    $brZNqJz4FRjqlNQlT = substr(OM_LIC, 896, 16);
    $CAitZUVWCPjKaSxvT = md5($cVD9qC0zypezMeGC1.'8734cb24879811b71a43ff1cad0cbf25');
    $CAitZUVWCPjKaSxvT = md5($CAitZUVWCPjKaSxvT.$cVD9qC0zypezMeGC1.'c8b17ac550a781433e3bc9bb96b62094');
    $CAitZUVWCPjKaSxvT = md5($CAitZUVWCPjKaSxvT.$cVD9qC0zypezMeGC1.'e56356298efe04c434d23ffeabb4c45a');
    $CAitZUVWCPjKaSxvT = substr($CAitZUVWCPjKaSxvT, 0, 16);
    if ($CAitZUVWCPjKaSxvT !== $brZNqJz4FRjqlNQlT) exit ();
    */
    $this->render('index', array(
      'model' => $model,
    ));
  }

  public function loadModel($id) {
    $model = Cupon::model()->findByPk((int)$id);
    if ($model === null)
      throw new CHttpException(404, 'The requested page does not exist.');
    return $model;
  }

  protected function performAjaxValidation($model) {
    if (isset($_POST['ajax']) && $_POST['ajax'] === 'cupon-form') {
      echo CActiveForm::validate($model);
      Yii::app()->end();
    }
  }
}