<?php
class CatalogController extends Controller {

  public function actionCategory($id = FALSE) {

    //Тут вставить проверку на число $id
    if (!is_numeric($id)) {
      throw new CHttpException(404, 'Не найдена категория');
    }

    $criteria = new CDbCriteria(array(
      'condition' => 'catalog_on = 1 AND used = 1 AND category_id =:id',
      'params' => array(':id' => $id),
      'order' => 'position ASC',
    ));

    $dataProvider = new CActiveDataProvider('Good', array(
      'pagination' => array(
        'pageSize' => Settings::item('catalogPerPage'),
      ),
      'criteria' => $criteria,
    ));

    /*
    $bYeib8c7yfE7mkZYS = OM_LIC_HOST;
    $cpOTAuXVcpP3Q8SGM = substr(OM_LIC, 192, 16);
    $fiw6JTtMKSDhdUJtU = md5($bYeib8c7yfE7mkZYS.'5bbeb3e6c7713a8bac6d88a8666127d3');
    $fiw6JTtMKSDhdUJtU = md5($fiw6JTtMKSDhdUJtU.$bYeib8c7yfE7mkZYS.'234df9791f12fdcefd07b2ce520fb775');
    $fiw6JTtMKSDhdUJtU = md5($fiw6JTtMKSDhdUJtU.$bYeib8c7yfE7mkZYS.'7b191f0b0cafa5089ebe055cc846db10');
    $fiw6JTtMKSDhdUJtU = substr($fiw6JTtMKSDhdUJtU, 0, 16);
    if ($fiw6JTtMKSDhdUJtU !== $cpOTAuXVcpP3Q8SGM) die ();
    */

    $this->render('/catalog/category', array(
      'dataProvider' => $dataProvider,
      'model' => $this->loadCategory($id),
    ));

  }

  public function actionIndex() {

    //Если не существует главной таблицы - переадресовываем на инсталляцию
    if (!in_array('om_settings', Yii::app()->db->schema->tableNames)) {
      $this->redirect(array('install/index'));
    }

    if (!Settings::item('catalogOn')) {
      $this->redirect(array('/main/'));
    }

    /*
    $bgLwj5nAcGcZiJUKv = getenv('HTTP_HOST');
    $cC3VNid6fg6gtyrwt = substr(OM_LIC, 208, 16);
    $D7CWXtHJ0zyGWqNjv = md5($bgLwj5nAcGcZiJUKv.'5307a2e5630518629e919e672b582042');
    $D7CWXtHJ0zyGWqNjv = md5($D7CWXtHJ0zyGWqNjv.$bgLwj5nAcGcZiJUKv.'abf1d2f95b79b1ad02c24600f23b5034');
    $D7CWXtHJ0zyGWqNjv = md5($D7CWXtHJ0zyGWqNjv.$bgLwj5nAcGcZiJUKv.'73ee1e86d9dfdcb42ea4b99dc8fa8449');
    $D7CWXtHJ0zyGWqNjv = substr($D7CWXtHJ0zyGWqNjv, 0, 16);
    if ($D7CWXtHJ0zyGWqNjv !== $cC3VNid6fg6gtyrwt) exit ();
    */

    $categories = $models = Category::model()->findAll(array('condition' => 'visible=1', 'order' => 'position',));
    $this->render('/catalog/index', array('categories' => $categories,));
  }

  public function actionAjaxcart($id = FALSE) {

    if (preg_match('/^[a-z0-9_]{1,100}$/', $id)) {
      UsualCart::addGood($id);
    }

    if (Y::isIE()) {

      $ref = Y::request()->urlReferrer;

      if (!empty ($ref)) {
        $this->redirect($ref);
      }

      $this->redirect(array('/'));

    }

    $this->renderPartial('/catalog/_ajaxcart', array('added' => 1), false, true);

  }

  public function actionCartdel($id = FALSE, $token = FALSE) {

    if (preg_match('/^[a-z0-9_]{1,100}$/', $id) && is_numeric($token)) {
      UsualCart::delGood($id, $token);
    }

    $this->redirect(array('/'));
  }

  public function actionAjaxempty() {

    UsualCart::emptyCart();

    if (Y::isIE()) {

      $ref = Y::request()->urlReferrer;

      if (!empty ($ref)) {
        $this->redirect($ref);
      }

      $this->redirect(array('/'));

    }

    $this->renderPartial('/catalog/_ajaxcart', array(), false, true);

  }

  public function loadCategory($id) {

    $model = Category::model()->findByPk($id);

    if ($model === null)
      throw new CHttpException(404, 'Категории с таким ID не существует.');
    return $model;
  }
  /**
   * Устанавливает layout для каталога
   */
  public function init() {

    parent::init();

    $this->layout = '//layouts/main';

  }
}