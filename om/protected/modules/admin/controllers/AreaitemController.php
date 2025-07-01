<?php
class AreaitemController extends Controller {
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
        'actions' => StaffAccess::allowed('area_files'),
      ),
      array('deny',
        'users' => array('*'),
      ),
    );
  }

  public function actionView($id) {
    /*
    $dNajaTW6pstZHIqgo = OM_LIC_HOST;
    $AkE3gyOyt4zuZPjTc = substr(OM_LIC, 1152, 16);
    $CeyPzEILEh9Hkcv5h = md5($dNajaTW6pstZHIqgo.'19482a89f401f7527dcead389e6e1836');
    $CeyPzEILEh9Hkcv5h = md5($CeyPzEILEh9Hkcv5h.$dNajaTW6pstZHIqgo.'a5819f595c0858465335112f1cbd83c4');
    $CeyPzEILEh9Hkcv5h = md5($CeyPzEILEh9Hkcv5h.$dNajaTW6pstZHIqgo.'9c86cc43205e661752b558105b186046');
    $CeyPzEILEh9Hkcv5h = substr($CeyPzEILEh9Hkcv5h, 0, 16);
    if ($CeyPzEILEh9Hkcv5h !== $AkE3gyOyt4zuZPjTc) die ();
    */
    $this->render('view', array(
      'model' => $this->loadModel($id),
    ));
  }

  public function actionCreate($a = 1) {
    $model = new AreaItem;
    if (isset($_POST['AreaItem'])) {
      $model->attributes = $_POST['AreaItem'];
      $model->uploadDate = time();
      if ($model->save()) {
        Y::user()->setFlash('admin', 'Запись добавлена');
        $this->redirect(array('view', 'id' => $model->id));
      }
    } else {
      $model->area_id = $a;
    }
    /*
    $djKhwRJNwt3G0mAnD = OM_LIC_HOST;
    $FwueuTsreDGnOYb7S = substr(OM_LIC, 1168, 16);
    $EPQlgOuKa7mJPAWzB = md5($djKhwRJNwt3G0mAnD.'8cbd625825b32638c57d4c020bdc4941');
    $EPQlgOuKa7mJPAWzB = md5($EPQlgOuKa7mJPAWzB.$djKhwRJNwt3G0mAnD.'87a950239abf3539040cf36c9d057cfd');
    $EPQlgOuKa7mJPAWzB = md5($EPQlgOuKa7mJPAWzB.$djKhwRJNwt3G0mAnD.'596cf3e9fbc8f226b34cfa22fb42c7ba');
    $EPQlgOuKa7mJPAWzB = substr($EPQlgOuKa7mJPAWzB, 0, 16);
    if ($EPQlgOuKa7mJPAWzB !== $FwueuTsreDGnOYb7S) exit ();
    */
    $this->render('create', array(
      'model' => $model,
      'area_id' => $a,
    ));
  }

  public function actionUpdate($id) {
    $model = $this->loadModel($id);
    if (isset($_POST['AreaItem'])) {
      $model->attributes = $_POST['AreaItem'];
      if ($model->save()) {
        Y::user()->setFlash('admin', 'Изменения сохранены');
        $this->redirect(array('view', 'id' => $model->id));
      }
    }
    /*
    $fO3JOMZR2rUe9bW4A = parse_url(Y::bu());
    $fO3JOMZR2rUe9bW4A = $fO3JOMZR2rUe9bW4A['host'];
    $ceSjpZBfwLpH1Fsyq = substr(OM_LIC, 1184, 16);
    $BSUcbyGCeiAiMC4sW = md5($fO3JOMZR2rUe9bW4A.'8cad669d71fbc8a7ce1cf0a10736b723');
    $BSUcbyGCeiAiMC4sW = md5($BSUcbyGCeiAiMC4sW.$fO3JOMZR2rUe9bW4A.'4ef0d6ccbd3823d53158ca56fb27ebf8');
    $BSUcbyGCeiAiMC4sW = md5($BSUcbyGCeiAiMC4sW.$fO3JOMZR2rUe9bW4A.'09a1c3fd81b26b7a72649333b4529651');
    $BSUcbyGCeiAiMC4sW = substr($BSUcbyGCeiAiMC4sW, 0, 16);
    if ($BSUcbyGCeiAiMC4sW !== $ceSjpZBfwLpH1Fsyq) exit ();
    */
    $this->render('update', array(
      'model' => $model,
      'area_id' => $model->area_id,
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
    $model = new AreaItem('search');
    $model->unsetAttributes();
    if (isset($_GET['AreaItem']))
      $model->attributes = $_GET['AreaItem'];
    $model->area_id = $a;
    /*
    $FuH7ROjE4n4DXTgim = OM_LIC_HOST;
    $CRK3C4I7Mokof4RRn = substr(OM_LIC, 1200, 16);
    $FSy60vu3UZyHNr9PF = md5($FuH7ROjE4n4DXTgim.'3f87b7445a340482610dd530ecab08dc');
    $FSy60vu3UZyHNr9PF = md5($FSy60vu3UZyHNr9PF.$FuH7ROjE4n4DXTgim.'5d5d1ff1f8b4e7a17ed549a2c98b0816');
    $FSy60vu3UZyHNr9PF = md5($FSy60vu3UZyHNr9PF.$FuH7ROjE4n4DXTgim.'e3566b85685af412028e7f73276de3c5');
    $FSy60vu3UZyHNr9PF = substr($FSy60vu3UZyHNr9PF, 0, 16);
    if ($FSy60vu3UZyHNr9PF !== $CRK3C4I7Mokof4RRn) die ();
    */
    $this->render('index', array(
      'model' => $model,
      'area_id' => $a,
    ));
  }

  public function loadModel($id) {
    $model = AreaItem::model()->findByPk((int)$id);
    if ($model === null)
      throw new CHttpException(404, 'The requested page does not exist.');
    return $model;
  }

  protected function performAjaxValidation($model) {
    if (isset($_POST['ajax']) && $_POST['ajax'] === 'area-item-form') {
      echo CActiveForm::validate($model);
      Yii::app()->end();
    }
  }
}