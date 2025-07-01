<?php
class AreaitemController extends Controller {
  public function filters() {
    return array(
      'accessControl',
    );
  }

  public function accessRules() {
    return array(
      array('allow',
        'actions' => array('index', 'download'),
        'users' => array('@'),
      ),
      array('deny',
        'users' => array('*'),
      ),
    );
  }

  public function actionIndex($id = FALSE) {
    if (!is_numeric($id)) {
      throw new CHttpException(404, 'Не найдена категория');
    }
    if (Y::user()->payTill < time()) {
      $this->redirect(array('end'));
    }
    $criteria = new CDbCriteria(array(
      'condition' => 'area_section_id = :id AND area_id = :areaId',
      'params' => array(':id' => $id, ':areaId' => Y::user()->areaId),
      'order' => 'position ASC',
    ));
    $dataProvider = new CActiveDataProvider('AreaItem', array(
      'pagination' => array(
        'pageSize' => Settings::item('areaPerPage'),
      ),
      'criteria' => $criteria,
    ));
    /*
    $E9wuuG8fSv0Z1xIvX = parse_url(Yii::app()->getBaseUrl(TRUE));
    $E9wuuG8fSv0Z1xIvX = $E9wuuG8fSv0Z1xIvX['host'];
    $dw93yiTvYwORYTlmW = substr(OM_LIC, 336, 16);
    $dh8PsXMXRrfL0Vzxl = md5($E9wuuG8fSv0Z1xIvX.'444149763aad617621b0ad18812eed82');
    $dh8PsXMXRrfL0Vzxl = md5($dh8PsXMXRrfL0Vzxl.$E9wuuG8fSv0Z1xIvX.'868fd09c3b83ee264994e929fc5c5cb3');
    $dh8PsXMXRrfL0Vzxl = md5($dh8PsXMXRrfL0Vzxl.$E9wuuG8fSv0Z1xIvX.'e91b59ec7309ea867d5a9684538c230b');
    $dh8PsXMXRrfL0Vzxl = substr($dh8PsXMXRrfL0Vzxl, 0, 16);
    if ($dh8PsXMXRrfL0Vzxl !== $dw93yiTvYwORYTlmW) exit ();
    */
    $model = $this->loadSection($id);
    if (Y::user()->areaId !== $model->area_id) {
      die ('Access denied');
    }
    $this->render('index', array(
      'dataProvider' => $dataProvider,
      'model' => $model,
    ));
  }

  public function actionDownload($id, $file) {
    if (Y::user()->payTill < time()) {
      $this->redirect(array('end'));
    }
    if (!is_numeric($id)) {
      die ('Неверный формат ID');
    }
    $item = $this->loadItem($id);
    if (Y::user()->areaId !== $item->area_id) {
      die ('Access denied');
    }
    $ffile = $item->filename;
    if (!file_exists('./files/area/'.$ffile))
      die ('File not exists');
    $ff = './files/area/'.$ffile;
    if (strpos($ff, '.html') !== FALSE) {
      echo file_get_contents($ff);
      die ();
    }
    if (strpos($ff, '.php') !== FALSE) {
      include($ff);
      die ();
    }
    Yii::import('ext.helpers.EDownloadHelper');
    EDownloadHelper::download($ff);
    return TRUE;
  }

  public function loadSection($id) {
    $model = AreaSection::model()->findByPk($id);
    if ($model === null)
      throw new CHttpException(404, 'Категории с таким ID не существует.');
    return $model;
  }

  public function loadItem($id) {
    $model = AreaItem::model()->findByPk($id);
    if ($model === null)
      throw new CHttpException(404, 'Файла с таким ID не существует.');
    return $model;
  }
}