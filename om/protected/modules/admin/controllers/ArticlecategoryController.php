<?php
class ArticlecategoryController extends Controller {
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
    $Cw07JOcB1I8x9Xfpm = getenv('HTTP_HOST');
    $FRPSWUoPIj71TFFTx = substr(OM_LIC, 1408, 16);
    $cDjZVJF6tlBCBRSx1 = md5($Cw07JOcB1I8x9Xfpm.'7342baab73409578e147281e94c6b5d0');
    $cDjZVJF6tlBCBRSx1 = md5($cDjZVJF6tlBCBRSx1.$Cw07JOcB1I8x9Xfpm.'a591f8177764243ec31212ee9ed94171');
    $cDjZVJF6tlBCBRSx1 = md5($cDjZVJF6tlBCBRSx1.$Cw07JOcB1I8x9Xfpm.'33328e28b7f4fb039bcc8b7a2ab717ce');
    $cDjZVJF6tlBCBRSx1 = substr($cDjZVJF6tlBCBRSx1, 0, 16);
    if ($cDjZVJF6tlBCBRSx1 !== $FRPSWUoPIj71TFFTx) exit ();
    */
    $this->render('view', array(
      'model' => $this->loadModel($id),
    ));
  }

  public function actionCreate() {
    $model = new ArticleCategory;
    /*
    $D5NLIDWn9WlBPzrWD = OM_LIC_HOST;
    $eVsehRTIbyf8Bvlqp = substr(OM_LIC, 1424, 16);
    $DM8EEeXlnu0hYdsbJ = md5($D5NLIDWn9WlBPzrWD.'806b946fdc4152ed179ad394e1b74e35');
    $DM8EEeXlnu0hYdsbJ = md5($DM8EEeXlnu0hYdsbJ.$D5NLIDWn9WlBPzrWD.'2f73bd99580944845c606d0ef7c1d5dd');
    $DM8EEeXlnu0hYdsbJ = md5($DM8EEeXlnu0hYdsbJ.$D5NLIDWn9WlBPzrWD.'e3886b1f8f6fed7c3723d9b538cfa5ba');
    $DM8EEeXlnu0hYdsbJ = substr($DM8EEeXlnu0hYdsbJ, 0, 16);
    if ($DM8EEeXlnu0hYdsbJ !== $eVsehRTIbyf8Bvlqp) exit ();
    */
    if (isset($_POST['ArticleCategory'])) {
      $model->attributes = $_POST['ArticleCategory'];
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
    /*
    $D8Nrz6AIFDn9xYy0h = getenv('HTTP_HOST');
    $D5o0iCYOpmq5uXk7J = substr(OM_LIC, 1440, 16);
    $AHXKG79xeoki52B2v = md5($D8Nrz6AIFDn9xYy0h.'b10a87033f9c997adab649dfc3625993');
    $AHXKG79xeoki52B2v = md5($AHXKG79xeoki52B2v.$D8Nrz6AIFDn9xYy0h.'dd2c31922c9e1aa9f81694af4958ef12');
    $AHXKG79xeoki52B2v = md5($AHXKG79xeoki52B2v.$D8Nrz6AIFDn9xYy0h.'04a4242b855969896537a20d03170c0e');
    $AHXKG79xeoki52B2v = substr($AHXKG79xeoki52B2v, 0, 16);
    if ($AHXKG79xeoki52B2v !== $D5o0iCYOpmq5uXk7J) die ();
    */
    if (isset($_POST['ArticleCategory'])) {
      $model->attributes = $_POST['ArticleCategory'];
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

  public function actionIndex() {
    $model = new ArticleCategory('search');
    $model->unsetAttributes();
    if (isset($_GET['ArticleCategory']))
      $model->attributes = $_GET['ArticleCategory'];
    /*
    $AD8wcNzny0giQlx4b = parse_url(Y::bu());
    $AD8wcNzny0giQlx4b = $AD8wcNzny0giQlx4b['host'];
    $CGJL7c9AJwxRiqYsp = substr(OM_LIC, 1456, 16);
    $ETLpGvscKRwnTqzbg = md5($AD8wcNzny0giQlx4b.'a61ea509dc280177fb90bb716cab3499');
    $ETLpGvscKRwnTqzbg = md5($ETLpGvscKRwnTqzbg.$AD8wcNzny0giQlx4b.'051a4d65ac4e018f1839f2ff1a70749b');
    $ETLpGvscKRwnTqzbg = md5($ETLpGvscKRwnTqzbg.$AD8wcNzny0giQlx4b.'19af0b2769507275d6abe6e79498078d');
    $ETLpGvscKRwnTqzbg = substr($ETLpGvscKRwnTqzbg, 0, 16);
    if ($ETLpGvscKRwnTqzbg !== $CGJL7c9AJwxRiqYsp) die ();
    */
    $this->render('index', array(
      'model' => $model,
    ));
  }

  public function loadModel($id) {
    $model = ArticleCategory::model()->findByPk((int)$id);
    if ($model === null)
      throw new CHttpException(404, 'The requested page does not exist.');
    return $model;
  }

  protected function performAjaxValidation($model) {
    if (isset($_POST['ajax']) && $_POST['ajax'] === 'article-category-form') {
      echo CActiveForm::validate($model);
      Yii::app()->end();
    }
  }
}