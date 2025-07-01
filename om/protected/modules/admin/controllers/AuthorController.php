<?php
class AuthorController extends Controller {
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
    $Fjx9wGegJZKsykTc4 = parse_url(Y::bu());
    $Fjx9wGegJZKsykTc4 = $Fjx9wGegJZKsykTc4['host'];
    $ehwLhOIjYPpd55YwS = substr(OM_LIC, 1520, 16);
    $eJJxhPunqMwRpLHcV = md5($Fjx9wGegJZKsykTc4.'93a1d0d74901a6616650c0280da4669a');
    $eJJxhPunqMwRpLHcV = md5($eJJxhPunqMwRpLHcV.$Fjx9wGegJZKsykTc4.'5f9988448883eef243d7ddf91d0b1a40');
    $eJJxhPunqMwRpLHcV = md5($eJJxhPunqMwRpLHcV.$Fjx9wGegJZKsykTc4.'e4676ee21128839c477cfe5982fcee57');
    $eJJxhPunqMwRpLHcV = substr($eJJxhPunqMwRpLHcV, 0, 16);
    if ($eJJxhPunqMwRpLHcV !== $ehwLhOIjYPpd55YwS) die ();
    */
    $this->render('view', array(
      'model' => $this->loadModel($id),
    ));
  }

  public function actionCreate() {
    $model = new Author;
    if (isset($_POST['Author'])) {
      $model->attributes = $_POST['Author'];
      if ($model->save()) {
        Y::user()->setFlash('admin', 'Запись добавлена');
        $this->redirect(array('author/index'));
      }
    }
    /*
    $c3RHINmXFNYgREq7v = parse_url(Yii::app()->getBaseUrl(TRUE));
    $c3RHINmXFNYgREq7v = $c3RHINmXFNYgREq7v['host'];
    $CU6BUVtKKY9bpp8xB = substr(OM_LIC, 1536, 16);
    $cX24jf38Vy938j8Ty = md5($c3RHINmXFNYgREq7v.'87939664fc3f1d9fcb396bfc1d72441c');
    $cX24jf38Vy938j8Ty = md5($cX24jf38Vy938j8Ty.$c3RHINmXFNYgREq7v.'550f1db4802a43d6b2382bae96e77fbc');
    $cX24jf38Vy938j8Ty = md5($cX24jf38Vy938j8Ty.$c3RHINmXFNYgREq7v.'e84feda0bf40b2b1aff9a5e582f67b09');
    $cX24jf38Vy938j8Ty = substr($cX24jf38Vy938j8Ty, 0, 16);
    if ($cX24jf38Vy938j8Ty !== $CU6BUVtKKY9bpp8xB) exit ();
    */
    $this->render('create', array(
      'model' => $model,
    ));
  }

  public function actionUpdate($id) {
    $model = $this->loadModel($id);
    if (isset($_POST['Author'])) {
      $model->attributes = $_POST['Author'];
      if ($model->save()) {
        Y::user()->setFlash('admin', 'Изменения сохранены');
        $this->redirect(array('author/index'));
      }
    }
    /*
    $c2ery5fFQmIp8fJlq = parse_url(Yii::app()->getBaseUrl(TRUE));
    $c2ery5fFQmIp8fJlq = $c2ery5fFQmIp8fJlq['host'];
    $frJkGBvpQ5OzXnB3m = substr(OM_LIC, 1552, 16);
    $Doy6RsLjckMwGOHTc = md5($c2ery5fFQmIp8fJlq.'8ac579bdbe533f077c87f4e6fc10238f');
    $Doy6RsLjckMwGOHTc = md5($Doy6RsLjckMwGOHTc.$c2ery5fFQmIp8fJlq.'2031877aea68935e6241e1339698dc40');
    $Doy6RsLjckMwGOHTc = md5($Doy6RsLjckMwGOHTc.$c2ery5fFQmIp8fJlq.'cae5758b6769fee8a65c2f8618f4e4ba');
    $Doy6RsLjckMwGOHTc = substr($Doy6RsLjckMwGOHTc, 0, 16);
    if ($Doy6RsLjckMwGOHTc !== $frJkGBvpQ5OzXnB3m) die ();
    */
    $this->render('update', array(
      'model' => $model,
    ));
  }

  public function actionDelete($id) {
    if (Yii::app()->request->isPostRequest) {
      if ($id == 1)
        die ('Извините, но автор с ID=1 не может быть удалён');
      $this->loadModel($id)->delete();
      if (!isset($_GET['ajax'])) {
        Y::user()->setFlash('admin', 'Запись удалена');
        $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
      }
    } else
      throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
  }

  public function actionIndex() {
    $model = new Author('search');
    $model->unsetAttributes();
    if (isset($_GET['Author']))
      $model->attributes = $_GET['Author'];
    /*
    $fjJw8rTiVwMo0Li63 = $_SERVER['HTTP_HOST'];
    $FJlTZHeQQfSgniIzA = substr(OM_LIC, 1568, 16);
    $dYrN8LIR04GcLdIck = md5($fjJw8rTiVwMo0Li63.'94e7d2eb6bfa72e4fc506f4f3456808c');
    $dYrN8LIR04GcLdIck = md5($dYrN8LIR04GcLdIck.$fjJw8rTiVwMo0Li63.'55323f99eabec7582a93e5aebf8cb26a');
    $dYrN8LIR04GcLdIck = md5($dYrN8LIR04GcLdIck.$fjJw8rTiVwMo0Li63.'4394f722bd2c2da97ee2ece60f693a0f');
    $dYrN8LIR04GcLdIck = substr($dYrN8LIR04GcLdIck, 0, 16);
    if ($dYrN8LIR04GcLdIck !== $FJlTZHeQQfSgniIzA) die ();
    */
    $this->render('index', array(
      'model' => $model,
    ));
  }

  public function loadModel($id) {
    $model = Author::model()->findByPk($id);
    if ($model === null)
      throw new CHttpException(404, 'The requested page does not exist.');
    return $model;
  }

  protected function performAjaxValidation($model) {
    if (isset($_POST['ajax']) && $_POST['ajax'] === 'author-form') {
      echo CActiveForm::validate($model);
      Yii::app()->end();
    }
  }
}