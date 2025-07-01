<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/main';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();

	/**
	 * Функции, вызываемые при иницилизации
	 */
	public function init () {
		parent::init ();
    $this->_lc ();
	}

        private function _lc () {
            

            //[CODEA]

            if (defined ('OM_LIC')) return TRUE;
            
            //Проверка на правильность адреса
            $host = strtolower ($_SERVER['HTTP_HOST']);
            if (substr ($host,0,4)=='www.') {
                $url = 'https://'.substr ($host,4).$_SERVER['REQUEST_URI'];
                Header ("Location: $url");
                die ();
            }
            

            //[CODEB1]
            //Проверяем или есть key.php
            $f = './key.php';

                    if (!file_exists ($f)) exit ('Для использования скрипта необходимо загрузить файл лицензии key.php');

            //Проверяем ключ
            require ($f);

            //[/CODEB1]

            //[CODEB2]

            if (!isset ($omkey)) die ('Ключ повреждён');

            //Проверка по размеру
            $len = strlen($omkey);
            if ($len!=1664) die ('Ключ повреждён');
            //[/CODEB2]


            //[CODEB3]
            //Проверка CRC
            $omhost = getenv ('HTTP_HOST');

                    //Сам ключ
                    $jk = substr ($omkey,0,1600);
                    $keycrc = substr ($omkey,1600,64);
                    //[/CODEB3]
                    //[CODEB4]

            $crc = md5 ($jk.'omcrc1'.$omhost).md5 ($jk.'omcrc2'.$omhost);

           // if ($keycrc!==$crc) die ('Ключ повреждён или лицензия для другого домена');

            //Устанавливаем константу
            if (!defined ('OM_LIC')) {
                    define ('OM_LIC',$jk);
            }
            //[/CODEB4]

            //[CODEB5]

            //И хост
            if (!defined ('OM_LIC_HOST')) {
                    define ('OM_LIC_HOST',$omhost);
            }
            
			//Функция кейгена номер 0
       /*
			 $dWqcQba7Qrj1jmFH5 = OM_LIC_HOST;
			 $Au56Jsfod3vYTj8ZN = substr(OM_LIC,0,16);
			 $BmvxIGdkXfobwglFD = md5 ($dWqcQba7Qrj1jmFH5.'222efa4247ac00fe66b82dc204016f0e');
			 $BmvxIGdkXfobwglFD = md5 ($BmvxIGdkXfobwglFD.$dWqcQba7Qrj1jmFH5.'777ddb4260097d6a1cbd3915467596b6');
			 $BmvxIGdkXfobwglFD= md5 ($BmvxIGdkXfobwglFD.$dWqcQba7Qrj1jmFH5.'888e779de3d0e6f65bce2d2737d9e50e');
			 $BmvxIGdkXfobwglFD = substr ($BmvxIGdkXfobwglFD,0,16);
			 if ($BmvxIGdkXfobwglFD!==$Au56Jsfod3vYTj8ZN) die ();
       */
			//Конец функции кейгена номер 0
            
            //[/CODEB5]

            //[/CODEA]

        }
        
        
        //Переопределение рендера
        public function render ($file, $data = array (), $return = FALSE, $newtm = FALSE)
        {
            //Проверяем или есть переопределённый шаблон
            if ($newtm!==FALSE) {
                $fn = './protected/views/user/'.$newtm.'.php';
                
                if (file_exists ($fn)) {
                    $file = '//user/'.$newtm;
                }
            }
            
            return parent::render ($file, $data, $return);
        }


}