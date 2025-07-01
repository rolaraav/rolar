<?php
class LinksController extends Controller {
  public function filters() {
    return array(
      'accessControl',
    );
  }

  public function accessRules() {
    return array(
      array('allow',
        'actions' => array('index', 'amd', 'rr'),
        'users' => array('@'),
      ),
      array('deny',
        'users' => array('*'),
      ),
    );
  }

  public function actionRr($id = FALSE) {
    if (!$id)
      die ('No id');
    if (!preg_match('/^[0-9a-z_]+$/', $id))
      die ('Bad good id');
    $ads = Ad::model()->findAll(
      array(
        'condition' => 'good_id=:id',
        'params' => array(
          ':id' => $id,
        ),
        'order' => 'position ASC',
      )
    );
    $good = Good::model()->findByPk($id);
    if (!$good)
      die ('No good');
    $adc = array();
    if (!empty ($ads)) {
      foreach ($ads as $one) {
        $adc[AdCategory::item($one->adcategory_id)][] = $one;
      }
    }
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
    $this->render('ad', array(
      'adc' => $adc,
      'good' => $good,
    ));
  }

  public function actionAmd($id = FALSE) {
    if (!$id)
      die ('No id');
    if (!preg_match('/^[0-9a-z_]+$/', $id))
      die ('Bad good id');
    $ads = Ad::model()->findAll(
      array(
        'condition' => 'good_id=:id',
        'params' => array(
          ':id' => $id,
        ),
        'order' => 'position ASC',
      )
    );
    $good = Good::model()->findByPk($id);
    if (!$good)
      die ('No good');
    $adc = array();
    if (!empty ($ads)) {
      foreach ($ads as $one) {
        $adc[AdCategory::item($one->adcategory_id)][] = $one;
      }
    }
    $this->render('ad', array(
      'adc' => $adc,
      'good' => $good,
    ));
  }

  public function actionIndex() {
    $model = new Good('search');
    $model->unsetAttributes();
    $model->used = 1;
    $model->affOn = 1;
    $model->affShow = 1;
    $this->render('index', array(
      'model' => $model,
    ));
  }
}