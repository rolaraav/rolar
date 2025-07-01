<?php

class AreasectionController extends Controller {
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
    $emOE9WHhRr2vtdTLs = parse_url(Y::bu());
    $emOE9WHhRr2vtdTLs = $emOE9WHhRr2vtdTLs['host'];
    $bdvSVvt7eQgeVw4wf = substr(OM_LIC, 1280, 16);
    $fE0t3fvClMGsIhFms = md5($emOE9WHhRr2vtdTLs.'57bb6680d33c7da64deed1ae6bcdb99d');
    $fE0t3fvClMGsIhFms = md5($fE0t3fvClMGsIhFms.$emOE9WHhRr2vtdTLs.'f3ffd3fb9b989b7a7e1fa8d679d1ac66');
    $fE0t3fvClMGsIhFms = md5($fE0t3fvClMGsIhFms.$emOE9WHhRr2vtdTLs.'d882e04e3ac82054c3dc0364de919466');
    $fE0t3fvClMGsIhFms = substr($fE0t3fvClMGsIhFms, 0, 16);
    if ($fE0t3fvClMGsIhFms !== $bdvSVvt7eQgeVw4wf) die ();
    */
    $this->render('view', array(
      'model' => $this->loadModel($id),
    ));
  }

  public function actionCreate($a = 1) {
    $model = new AreaSection;
    /*
    $C1zbZxXEoHjwZ54t4 = getenv('HTTP_HOST');
    $dbfd92Wamyz7F4QU9 = substr(OM_LIC, 1296, 16);
    $DrvkcTQCH9OG6dvpg = md5($C1zbZxXEoHjwZ54t4.'00ffd4f5b538da04a2526b130d49b2f2');
    $DrvkcTQCH9OG6dvpg = md5($DrvkcTQCH9OG6dvpg.$C1zbZxXEoHjwZ54t4.'e945509722a59ff3f30c78e962aaca87');
    $DrvkcTQCH9OG6dvpg = md5($DrvkcTQCH9OG6dvpg.$C1zbZxXEoHjwZ54t4.'3b3b01b3f3e17710cc75a78692676a13');
    $DrvkcTQCH9OG6dvpg = substr($DrvkcTQCH9OG6dvpg, 0, 16);
    if ($DrvkcTQCH9OG6dvpg !== $dbfd92Wamyz7F4QU9) exit ();
    */
    if (isset($_POST['AreaSection'])) {
      $model->attributes = $_POST['AreaSection'];
      if ($model->save()) {
        Y::user()->setFlash('admin', 'Запись добавлена');
        $this->redirect(array('view', 'id' => $model->id));
      }
    } else {
      $model->area_id = $a;
    }
    $this->render('create', array(
      'model' => $model,
      'area_id' => $a,
    ));
  }

  public function actionUpdate($id) {
    $model = $this->loadModel($id);
    /*
    $DpPLghh3dcYIqhPqR = $_SERVER['HTTP_HOST'];
    $ERW4QT9PFU3nCrFqf = substr(OM_LIC, 1312, 16);
    $deEii6ymV0D1SGjFq = md5($DpPLghh3dcYIqhPqR.'b59102573006f4208689f87975f8a725');
    $deEii6ymV0D1SGjFq = md5($deEii6ymV0D1SGjFq.$DpPLghh3dcYIqhPqR.'94398b20d7fb992348cfb9f2e0c30885');
    $deEii6ymV0D1SGjFq = md5($deEii6ymV0D1SGjFq.$DpPLghh3dcYIqhPqR.'3336b3cf2d31686203289da180a8ace8');
    $deEii6ymV0D1SGjFq = substr($deEii6ymV0D1SGjFq, 0, 16);
    if ($deEii6ymV0D1SGjFq !== $ERW4QT9PFU3nCrFqf) die ();
    */
    if (isset($_POST['AreaSection'])) {
      $model->attributes = $_POST['AreaSection'];
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

  public function actionIndex($a = 1) {
    $model = new AreaSection('search');
    $model->unsetAttributes();
    if (isset($_GET['AreaSection']))
      $model->attributes = $_GET['AreaSection'];
    $model->area_id = $a;
    /*
    $bhuJP1c4VvnD4bSv9 = OM_LIC_HOST;
    $E4dSG9Z2K4A6uuRPo = substr(OM_LIC, 1328, 16);
    $bXk6ZW5CwNP5eWP8N = md5($bhuJP1c4VvnD4bSv9.'3b481d971cef12f29f2b366a72290cde');
    $bXk6ZW5CwNP5eWP8N = md5($bXk6ZW5CwNP5eWP8N.$bhuJP1c4VvnD4bSv9.'f56386781ba3d89bbb1ff1d70bce4da5');
    $bXk6ZW5CwNP5eWP8N = md5($bXk6ZW5CwNP5eWP8N.$bhuJP1c4VvnD4bSv9.'529df4c74623cdc9a9b607e5fecc4c94');
    $bXk6ZW5CwNP5eWP8N = substr($bXk6ZW5CwNP5eWP8N, 0, 16);
    if ($bXk6ZW5CwNP5eWP8N !== $E4dSG9Z2K4A6uuRPo) exit ();
    */
    $this->render('index', array(
      'model' => $model,
    ));
  }

  public function loadModel($id) {
    $model = AreaSection::model()->findByPk((int)$id);
    if ($model === null)
      throw new CHttpException(404, 'The requested page does not exist.');
    return $model;
  }

  protected function performAjaxValidation($model) {
    if (isset($_POST['ajax']) && $_POST['ajax'] === 'area-section-form') {
      echo CActiveForm::validate($model);
      Yii::app()->end();
    }
  }
}