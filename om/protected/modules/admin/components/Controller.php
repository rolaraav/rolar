<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	public $helpName = 'index';

	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='/layouts/main';
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
	public function init ()
	{
		parent::init ();
                $this->_lc ();
                Updater::checkUpdate (); //Установка обновления
	}

        private function _lc () {

            //[CODEA]

            if (defined ('OM_LIC')) return TRUE;
            
            //Проверка на правильность адреса
            $host = strtolower ($_SERVER['HTTP_HOST']);
            if (substr ($host,0,4)=='www.') {
                $url = 'http://'.substr ($host,4).$_SERVER['REQUEST_URI'];                
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

            //if ($keycrc!==$crc) die ('Ключ повреждён или лицензия для другого домена');

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
            //[/CODEB5]

            //[/CODEA]

        }


}