<?php
class AuthorModule extends CWebModule {

  public function init() {
    $this->_lc();
    $this->setImport(array(
      'author.models.*',
      'author.components.*',
    ));
    $this->setComponents(array(
      'user' => array(
        'class' => 'CWebUser',
        'allowAutoLogin' => true,
      )
    ));
    Yii::app()->user->setStateKeyPrefix("_{$this->id}");
    Yii::app()->user->loginUrl = Yii::app()->createUrl('author/default/login');
  }

  public function beforeControllerAction($controller, $action) {
    if (parent::beforeControllerAction($controller, $action)) {
      return true;
    } else
      return false;
  }

  private function _lc() {

    if (defined('OM_LIC')) return TRUE;

    $host = strtolower($_SERVER['HTTP_HOST']);

    if (substr($host, 0, 4) == 'www.') {
      $url = 'http://'.substr($host, 4).$_SERVER['REQUEST_URI'];
      Header("Location: $url");
      die ();
    }

    $f = './key.php';

    if (!file_exists($f))
      exit ('Для использования скрипта необходимо загрузить файл лицензии key.php');

    require($f);

    if (!isset ($omkey)) die ('Ключ повреждён');

    $len = strlen($omkey);

    if ($len != 1664) die ('Ключ повреждён');

    $omhost = getenv('HTTP_HOST');
    $jk = substr($omkey, 0, 1600);
    $keycrc = substr($omkey, 1600, 64);
    $crc = md5($jk.'omcrc1'.$omhost).md5($jk.'omcrc2'.$omhost);

    //if ($keycrc !== $crc) die ('Ключ повреждён или лицензия для другого домена');

    if (!defined('OM_LIC')) {
      define('OM_LIC', $jk);
    }

    if (!defined('OM_LIC_HOST')) {
      define('OM_LIC_HOST', $omhost);
    }
    /*
    $dWqcQba7Qrj1jmFH5 = $_SERVER['HTTP_HOST'];
    $Au56Jsfod3vYTj8ZN = substr(OM_LIC, 0, 16);
    $BmvxIGdkXfobwglFD = md5($dWqcQba7Qrj1jmFH5.'222efa4247ac00fe66b82dc204016f0e');
    $BmvxIGdkXfobwglFD = md5($BmvxIGdkXfobwglFD.$dWqcQba7Qrj1jmFH5.'777ddb4260097d6a1cbd3915467596b6');
    $BmvxIGdkXfobwglFD = md5($BmvxIGdkXfobwglFD.$dWqcQba7Qrj1jmFH5.'888e779de3d0e6f65bce2d2737d9e50e');
    $BmvxIGdkXfobwglFD = substr($BmvxIGdkXfobwglFD, 0, 16);
    if ($BmvxIGdkXfobwglFD !== $Au56Jsfod3vYTj8ZN) die ();
    */
  }
}