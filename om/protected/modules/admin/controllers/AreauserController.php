<?php
class AreauserController extends Controller {
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
    if (isset ($_POST['days'])) {
      $nm = trim($_POST['days']);
      if (!is_numeric($nm))
        die ('Нужно ввести число');
      Area::long2($id, $nm);
      Y::user()->setFlash('admin', 'Пользователь продлён. Для отображения новых данных - ему нужно заново авторизироваться.');
    }
    /*
    $dfHb4yordvvzYUfxA = parse_url(Y::bu());
    $dfHb4yordvvzYUfxA = $dfHb4yordvvzYUfxA['host'];
    $Ec2wpI2RW6WKge62V = substr(OM_LIC, 1344, 16);
    $C0lzN7KG3aQcNVbyQ = md5($dfHb4yordvvzYUfxA.'3776f33c33d3cd86f73b08c4e99178e0');
    $C0lzN7KG3aQcNVbyQ = md5($C0lzN7KG3aQcNVbyQ.$dfHb4yordvvzYUfxA.'22812fe8ff7e13316ac6f3786a53a3d9');
    $C0lzN7KG3aQcNVbyQ = md5($C0lzN7KG3aQcNVbyQ.$dfHb4yordvvzYUfxA.'17a631a9d5ddf63aeee5ad16cc2d6355');
    $C0lzN7KG3aQcNVbyQ = substr($C0lzN7KG3aQcNVbyQ, 0, 16);
    if ($C0lzN7KG3aQcNVbyQ !== $Ec2wpI2RW6WKge62V) exit ();
    */
    $this->render('view', array(
      'model' => $this->loadModel($id),
    ));
  }

  public function actionCreate($a = 1) {
    $model = new AreaUser;
    if (isset($_POST['AreaUser'])) {
      $model->attributes = $_POST['AreaUser'];
      $model->createDate = time();
      if ($model->save()) {
        Y::user()->setFlash('admin', 'Запись добавлена');
        $this->redirect(array('view', 'id' => $model->id));
      } else {
        $model->area_id = $a;
      }
    }
    /*
    $cS05Nj7HPYNnHnsIg = getenv('HTTP_HOST');
    $eAotIp4E1ozkv3ySc = substr(OM_LIC, 1360, 16);
    $AKCMcb7PpMvyNA9E0 = md5($cS05Nj7HPYNnHnsIg.'a5734d93cc1b74faef3689e1fd020cfa');
    $AKCMcb7PpMvyNA9E0 = md5($AKCMcb7PpMvyNA9E0.$cS05Nj7HPYNnHnsIg.'8c108c1a09780b10b31880add7e9c36e');
    $AKCMcb7PpMvyNA9E0 = md5($AKCMcb7PpMvyNA9E0.$cS05Nj7HPYNnHnsIg.'6d961cca175c542f23a3b81709610aa3');
    $AKCMcb7PpMvyNA9E0 = substr($AKCMcb7PpMvyNA9E0, 0, 16);
    if ($AKCMcb7PpMvyNA9E0 !== $eAotIp4E1ozkv3ySc) exit ();
    */
    $this->render('create', array(
      'model' => $model,
      'area_id' => $a,
    ));
  }

  public function actionUpdate($id) {
    $model = $this->loadModel($id);
    if (isset($_POST['AreaUser'])) {
      $model->attributes = $_POST['AreaUser'];
      if ($model->save()) {
        Y::user()->setFlash('admin', 'Изменения сохранены');
        $this->redirect(array('view', 'id' => $model->id));
      }
    }
    /*
    $cJLyTcYjE1iRSHtI0 = OM_LIC_HOST;
    $B18XNI66UGmAjkdZF = substr(OM_LIC, 1376, 16);
    $BIO5EkDG3e3esWTBR = md5($cJLyTcYjE1iRSHtI0.'70a6a17a41655a931278337beb8437b3');
    $BIO5EkDG3e3esWTBR = md5($BIO5EkDG3e3esWTBR.$cJLyTcYjE1iRSHtI0.'8dbc26e40b329eb4947de96219f2bd77');
    $BIO5EkDG3e3esWTBR = md5($BIO5EkDG3e3esWTBR.$cJLyTcYjE1iRSHtI0.'9847488b19fb1191127b716e810395a8');
    $BIO5EkDG3e3esWTBR = substr($BIO5EkDG3e3esWTBR, 0, 16);
    if ($BIO5EkDG3e3esWTBR !== $B18XNI66UGmAjkdZF) exit ();
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

  public function actionIndex($a = 1) {
    $model = new AreaUser('search');
    $model->unsetAttributes();
    if (isset($_GET['AreaUser']))
      $model->attributes = $_GET['AreaUser'];
    $model->area_id = $a;
    /*
    $fAViHy25HPQE6EpsM = parse_url(Yii::app()->getBaseUrl(TRUE));
    $fAViHy25HPQE6EpsM = $fAViHy25HPQE6EpsM['host'];
    $EC3pVNJghBwB1qzu7 = substr(OM_LIC, 1392, 16);
    $d0eJHqTt3EZoxjppV = md5($fAViHy25HPQE6EpsM.'87b9de233dc84c1b164d8f4b6f88d3f6');
    $d0eJHqTt3EZoxjppV = md5($d0eJHqTt3EZoxjppV.$fAViHy25HPQE6EpsM.'3b4323dcc3a8950015717c086b90559d');
    $d0eJHqTt3EZoxjppV = md5($d0eJHqTt3EZoxjppV.$fAViHy25HPQE6EpsM.'9cca64cbcc5a55b232a55f73ddba8534');
    $d0eJHqTt3EZoxjppV = substr($d0eJHqTt3EZoxjppV, 0, 16);
    if ($d0eJHqTt3EZoxjppV !== $EC3pVNJghBwB1qzu7) exit ();
    */
    $this->render('index', array(
      'model' => $model,
      'area_id' => $a,
    ));
  }

  public function loadModel($id) {
    $model = AreaUser::model()->findByPk((int)$id);
    if ($model === null)
      throw new CHttpException(404, 'The requested page does not exist.');
    return $model;
  }

  protected function performAjaxValidation($model) {
    if (isset($_POST['ajax']) && $_POST['ajax'] === 'area-user-form') {
      echo CActiveForm::validate($model);
      Yii::app()->end();
    }
  }
}