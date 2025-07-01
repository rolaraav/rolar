<?php
class InfoController extends Controller {

  public $layout = '//layouts/empty'; //Пусто

  public function actionGood($id) {

    //{START}
    if (!preg_match('/^[a-zA-Z0-9_]+$/', $id)) die ("Bad id");

    $od = Odno::model()->find(array(
      'condition' => 'good_id = :good_id',
      'params' => array(':good_id' => $id),
    ));

    if (!$od) die ('Извините, товар не найден');

    //Плюс товар
    $gd = Good::model()->findByPk($od->good_id);

    //{KG}
    /*
    $e7uXPUtBAxyKEtfTV = getenv('HTTP_HOST');
    $erhsVdHcztV6jj1EF = substr(OM_LIC, 224, 16);
    $F7tQTBKOU2FFsJWDJ = md5($e7uXPUtBAxyKEtfTV.'9e184ff79279f516b008019f5bd8d4a0');
    $F7tQTBKOU2FFsJWDJ = md5($F7tQTBKOU2FFsJWDJ.$e7uXPUtBAxyKEtfTV.'13c782adb9740c301d534b3caae3c607');
    $F7tQTBKOU2FFsJWDJ = md5($F7tQTBKOU2FFsJWDJ.$e7uXPUtBAxyKEtfTV.'9fed71ca4f0b32cd33ecaf5ba842276d');
    $F7tQTBKOU2FFsJWDJ = substr($F7tQTBKOU2FFsJWDJ, 0, 16);
    if ($F7tQTBKOU2FFsJWDJ !== $erhsVdHcztV6jj1EF) die ();
    */

    if (!$gd) die ('Извините, товар не найден');

    $name = 'good'; //Имя шаблона
    //Если в заголовке прописан шаблон
    if (strpos($od->title, '||') !== false) {
      $title2 = explode('||', $od->title);
      $od->title = trim($title2[0]);
      $name = trim($title2[1]);
    }

    if ($od->visible != 1) die ('Извините, но этот товар временно отключён');

    $this->render($name, array('model' => $od,));
    //{END}
  }

  //Оформление заказа наложенным платежом
  public function actionOrder() {

    if (empty ($_POST)) die ('Не переданы данные');

    $id = $_POST['good_id'];

    if (!preg_match('/^[a-zA-Z0-9_]+$/', $id)) die ("Bad id");

    $od = Odno::model()->find(array(
      'condition' => 'good_id = :good_id',
      'params' => array(':good_id' => $id),
    ));

    //{START}
    if (!$od) die ('Извините, товар не найден');

    //Плюс товар
    $gd = Good::model()->findByPk($od->good_id);

    //{KG}
    /*
    $dJHVGknrAOZHVOxHS = parse_url(Y::bu());
    $dJHVGknrAOZHVOxHS = $dJHVGknrAOZHVOxHS['host'];
    $drzYNqZL6UzwPGAQA = substr(OM_LIC, 240, 16);
    $AjzOyqclGEgsRdyRM = md5($dJHVGknrAOZHVOxHS.'aaf1dfef3633646f29110ba1117c394d');
    $AjzOyqclGEgsRdyRM = md5($AjzOyqclGEgsRdyRM.$dJHVGknrAOZHVOxHS.'bd8bda0b24a99774bc7bc9bc47c5df32');
    $AjzOyqclGEgsRdyRM = md5($AjzOyqclGEgsRdyRM.$dJHVGknrAOZHVOxHS.'ef96fbdd5dbc207380233e5131745de1');
    $AjzOyqclGEgsRdyRM = substr($AjzOyqclGEgsRdyRM, 0, 16);
    if ($AjzOyqclGEgsRdyRM !== $drzYNqZL6UzwPGAQA) die ();
    */

    if (!$gd) die ('Извините, товар не найден');

    $uname = trim($_POST['uname']);
    $phone = trim($_POST['uphone']);
    $email = 'noemail@example.com';
    $address = '';
    $comment = '';

    if (isset ($_POST['email'])) $email = $_POST['email'];

    if (isset ($_POST['address'])) $email = $_POST['address'];

    if (isset ($_POST['comment'])) $comment = $_POST['comment'];

    if (empty ($uname)) die ('Не заполнено имя');

    if (empty ($phone)) die ('Не указан телефон');

    $bill = new Bill ();
    $bill->id = NULL;
    $bill->isNewRecord = TRUE; //Новая запись

    //{KG}
    /*
    $BOjoAhjHIRQ2KPJWL = getenv('HTTP_HOST');
    $DksIxurM4KT1tVXcV = substr(OM_LIC, 256, 16);
    $dWGEI8cZziF0w7VPW = md5($BOjoAhjHIRQ2KPJWL.'42d95c2f536d6ca72faa71d2c518728d');
    $dWGEI8cZziF0w7VPW = md5($dWGEI8cZziF0w7VPW.$BOjoAhjHIRQ2KPJWL.'c2beadbb1dcb004ddec48ad133df619e');
    $dWGEI8cZziF0w7VPW = md5($dWGEI8cZziF0w7VPW.$BOjoAhjHIRQ2KPJWL.'72a7836c735acdca7dfbe847d209fe53');
    $dWGEI8cZziF0w7VPW = substr($dWGEI8cZziF0w7VPW, 0, 16);
    if ($dWGEI8cZziF0w7VPW !== $DksIxurM4KT1tVXcV) die ();
    */

    $bill->uname = $uname;
    $bill->phone = $phone;
    $bill->email = $email;
    $bill->address = $address;
    $bill->comment = $comment;
    $bill->createDate = time();
    $bill->payDate = 0;
    $bill->status_id = 'nalozh';
    $bill->ip = Yii::app()->request->userHostAddress;
    $bill->way = 'Наложенный';
    $bill->kind = $gd->kind;
    $bill->orderCount = 1;
    $bill->postNumber = '';

    //Курсы валют
    $bill->usdkurs = Settings::item('kursUsd');
    $bill->eurkurs = Settings::item('kursEur');
    $bill->uahkurs = Settings::item('kursUah');

    $bill->valuta = $gd->currency;
    $bill->sum = $gd->price;

    //Сохраняем новый счёт
    if (!$bill->save(false)) {
      Yii::app()->session->destroy();
      throw new CHttpException(403, 'Произошла неизвестная ошибка при формировании счёта. Пожалуйста, выпишите новый.');
    }

    $ord = new Order;

    $ord->id = NULL;
    $ord->isNewRecord = TRUE;
    $ord->bill_id = $bill->id;
    $ord->good_id = $gd->id;
    $ord->createDate = $bill->createDate;
    $ord->cena = $gd->price;
    $ord->valuta = $gd->currency;
    $ord->status_id = $bill->status_id;
    $ord->partner_id = Partner::getAff($gd->id);

    if (!$ord->save()) {
      Yii::app()->session->destroy();
      throw new CHttpException(403, 'Произошла неизвестная ошибка при формировании заказа. Пожалуйста, сделайте новый заказ');
    }

    //{KG}
    /*
    $fcWo6YnjfMlZFHyvT = parse_url(Yii::app()->getBaseUrl(TRUE));
    $fcWo6YnjfMlZFHyvT = $fcWo6YnjfMlZFHyvT['host'];
    $c8N9ZkIsoj88mdzsv = substr(OM_LIC, 272, 16);
    $A1byWvpkgmhd1ffe6 = md5($fcWo6YnjfMlZFHyvT.'3aa22a8db044ac6e8757508a4e10782c');
    $A1byWvpkgmhd1ffe6 = md5($A1byWvpkgmhd1ffe6.$fcWo6YnjfMlZFHyvT.'2a10f40dedeaef4b16aa485917b82700');
    $A1byWvpkgmhd1ffe6 = md5($A1byWvpkgmhd1ffe6.$fcWo6YnjfMlZFHyvT.'698f5804f5b584bcbf44e82e85127feb');
    $A1byWvpkgmhd1ffe6 = substr($A1byWvpkgmhd1ffe6, 0, 16);
    if ($A1byWvpkgmhd1ffe6 !== $c8N9ZkIsoj88mdzsv) die ();
    */

    //Здесь отправляем письмо о новом заказе
    $ar = array(
      'good_id' => $gd->id,
      'uname' => $bill->uname,
      'phone' => $bill->phone,
      'sum' => $bill->sum,
      'valuta' => $bill->valuta,
      'ip' => $bill->ip,
    );

    Mail::sys('admin_odno', $ar);

    //Выбор разных страничек
    $fn = './protected/data/odno.txt';

    if (file_exists($fn)) {

      $ff = file($fn);

      foreach ($ff as $one) {
        $one = explode('||', $one);
        $id = trim($one[0]);
        if ($id == $gd->id) {
          $this->redirect(trim($one[1]));
        }
      }

    }

    //После того, как счёт выписан - подтверждение
    $this->redirect(Y::bu().'f/order');
    //{END}
  }

}