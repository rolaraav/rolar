<?php
class TemplatesController extends Controller {
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

  public function actionEdit() {
    if (empty($_GET)) {
      die ('Не переданы параметры');
    }
    /*
    $AKrcNaVOEe18OyQMN = $_SERVER['HTTP_HOST'];
    $cF7Jly0UE2rmlLMyd = substr(OM_LIC, 304, 16);
    $fWkIvqe9zcoMK7CKu = md5($AKrcNaVOEe18OyQMN.'27a3bc98738180a68571105692b5713b');
    $fWkIvqe9zcoMK7CKu = md5($fWkIvqe9zcoMK7CKu.$AKrcNaVOEe18OyQMN.'111580c61a2e01a9c5ecd19be48fa8b3');
    $fWkIvqe9zcoMK7CKu = md5($fWkIvqe9zcoMK7CKu.$AKrcNaVOEe18OyQMN.'3511e6b99bf763036ee0a174145c3223');
    $fWkIvqe9zcoMK7CKu = substr($fWkIvqe9zcoMK7CKu, 0, 16);
    if ($fWkIvqe9zcoMK7CKu !== $cF7Jly0UE2rmlLMyd) exit ();
    */
    $module = $_GET['m'];
    $tm = $_GET['t'];
    if (!empty ($_GET['n'])) {
      $new = $_GET['n'];
    } else {
      $new = FALSE;
    }
    if ($module != 'main') {
      $fn = './protected/modules/'.$module.'/views/'.$tm.'.php';
    } else {
      $fn = './protected/views/'.$tm.'.php';
    }
    if (!empty ($new)) {
      $ffn = './protected/views/user/'.$new.'.php';
      if (file_exists($ffn)) {
        $fn = $ffn;
      }
    }
    $fn2 = $fn;
    if (!empty ($new)) {
      $fn2 = $ffn;
    }
    if (!file_exists($fn))
      die ('Файл с шаблоном не существует');
    if (!is_writeable($fn))
      die ('К сожалению, на данный файл '.$fn.' не установлены права на запись (обычно это 766)');
    $template_data = file_get_contents($fn);
    if ($_POST) {
      $template_data = $_POST['template_data'];
      if (!empty($new)) {
        if (!file_exists($ffn)) {
          fclose(fopen($ffn, 'w'));
        }
      }
      $fp = fopen($fn2, 'w');
      fwrite($fp, $template_data);
      fclose($fp);
      Y::user()->setFlash('admin', 'Изменения сохранены');
    }
    $this->render('edit', array(
      'template_data' => $template_data,
      'tmname' => $module.'/'.$tm,
    ));
  }

  public function actionIndex() {
    $this->render('index');
  }
}