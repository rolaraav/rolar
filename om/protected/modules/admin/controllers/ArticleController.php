<?php
class ArticleController extends Controller {
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
        'actions' => StaffAccess::allowed('knowbase'),
      ),
      array('deny',
        'users' => array('*'),
      ),
    );
  }

  public function actionView($id) {
    /*
    $DDpMTofipvldY2DNU = parse_url(Yii::app()->getBaseUrl(TRUE));
    $DDpMTofipvldY2DNU = $DDpMTofipvldY2DNU['host'];
    $BzuTaMXwViuN9ePJd = substr(OM_LIC, 1472, 16);
    $CH1qAFwX0yk7426f4 = md5($DDpMTofipvldY2DNU.'0dced4aa08659b93ee3edd1ade3ffba2');
    $CH1qAFwX0yk7426f4 = md5($CH1qAFwX0yk7426f4.$DDpMTofipvldY2DNU.'a28ca3a1dbbfbf073e79b67247351566');
    $CH1qAFwX0yk7426f4 = md5($CH1qAFwX0yk7426f4.$DDpMTofipvldY2DNU.'0bd0020b5e0e8fbdf5c0add49ae36eb9');
    $CH1qAFwX0yk7426f4 = substr($CH1qAFwX0yk7426f4, 0, 16);
    if ($CH1qAFwX0yk7426f4 !== $BzuTaMXwViuN9ePJd) die ();
    */
    $this->render('view', array(
      'model' => $this->loadModel($id),
    ));
  }

  public function actionCreate() {
    $model = new Article;
    /*
    $EJGsLoUzQoC9HFJ8E = parse_url(Yii::app()->getBaseUrl(TRUE));
    $EJGsLoUzQoC9HFJ8E = $EJGsLoUzQoC9HFJ8E['host'];
    $FtpOyt9D0pWWzkrOy = substr(OM_LIC, 1488, 16);
    $eYjZYlfad02Xab4zZ = md5($EJGsLoUzQoC9HFJ8E.'6a1bc8e14f5b6611c0d6686b2af8b1b0');
    $eYjZYlfad02Xab4zZ = md5($eYjZYlfad02Xab4zZ.$EJGsLoUzQoC9HFJ8E.'04e68ce2073dbee03a0c7372fa2ae83a');
    $eYjZYlfad02Xab4zZ = md5($eYjZYlfad02Xab4zZ.$EJGsLoUzQoC9HFJ8E.'eda2a42079cc8bf9a00842079c27b632');
    $eYjZYlfad02Xab4zZ = substr($eYjZYlfad02Xab4zZ, 0, 16);
    if ($eYjZYlfad02Xab4zZ !== $FtpOyt9D0pWWzkrOy) exit ();
    */
    if (isset($_POST['Article'])) {
      $model->attributes = $_POST['Article'];
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
    if (isset($_POST['Article'])) {
      $model->attributes = $_POST['Article'];
      if ($model->save()) {
        Y::user()->setFlash('admin', 'Изменения сохранены');
        $this->redirect(array('view', 'id' => $model->id));
      }
    }
    /*
    $eoJ3tNyLAh5YGAsAj = parse_url(Y::bu());
    $eoJ3tNyLAh5YGAsAj = $eoJ3tNyLAh5YGAsAj['host'];
    $cOcqVNYmjNmsEJ3hy = substr(OM_LIC, 1504, 16);
    $cOp3IZRlBflW7Si9x = md5($eoJ3tNyLAh5YGAsAj.'147d5ef14caf64b5cae7d354c1c435b6');
    $cOp3IZRlBflW7Si9x = md5($cOp3IZRlBflW7Si9x.$eoJ3tNyLAh5YGAsAj.'d58ba6d6dc85253d52bf0f39d8b04ec1');
    $cOp3IZRlBflW7Si9x = md5($cOp3IZRlBflW7Si9x.$eoJ3tNyLAh5YGAsAj.'3339459333865af12097f9737543107b');
    $cOp3IZRlBflW7Si9x = substr($cOp3IZRlBflW7Si9x, 0, 16);
    if ($cOp3IZRlBflW7Si9x !== $cOcqVNYmjNmsEJ3hy) exit ();
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
    $model = new Article('search');
    $model->unsetAttributes();
    if (isset($_GET['Article']))
      $model->attributes = $_GET['Article'];
    $this->render('index', array(
      'model' => $model,
    ));
  }

  public function loadModel($id) {
    $model = Article::model()->findByPk((int)$id);
    if ($model === null)
      throw new CHttpException(404, 'The requested page does not exist.');
    return $model;
  }

  protected function performAjaxValidation($model) {
    if (isset($_POST['ajax']) && $_POST['ajax'] === 'article-form') {
      echo CActiveForm::validate($model);
      Yii::app()->end();
    }
  }
}